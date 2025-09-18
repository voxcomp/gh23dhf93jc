<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Registrant;
use Illuminate\Http\Request;

// use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        \View::share('options', $this->options->all());
    }

    /**
     * Show the application dashboard.
     */
    public function index(): View
    {
        if ($this->options->get('sitestatus') == 'closed') { // (time() > strtotime(date('Y').'-05-19 8:00') && time() < strtotime($this->options->get('startdate')).', '.(date('Y')+1))) {
            return view('pages.full', ['statusmessage' => $this->options->get('statusmessage')]);
        }
        if (session()->has('registration') && ! session()->has('registrationoptions')) {
            $registration = session()->get('registration');

            return view('pages.registeroptions', compact('registration'));
        } elseif (session()->has('registrationoptions')) {
            $registration = session()->get('registration');
            $registrationoptions = session()->get('registrationoptions');

            return view('pages.registerfinal', ['cost' => $registrationoptions['cost'], 'option' => $registrationoptions['option'], 'dob' => $registration['dob']]);
        } else {
            return view('pages.register');
        }
    }

    public function unauthorized(): View
    {
        return view('pages.unauthorized');
    }

    public function register(): View
    {
        if (session()->has('registration') && ! session()->has('registrationoptions')) {
            $registration = session()->get('registration');

            return view('pages.registeroptions', compact('registration'));
        } elseif (session()->has('registrationoptions')) {
            $registration = session()->get('registration');
            $registrationoptions = session()->get('registrationoptions');

            return view('pages.registerfinal', ['cost' => $registrationoptions['cost'], 'option' => $registrationoptions['option'], 'dob' => $registration['dob']]);
        } else {
            return view('pages.register');
        }
    }

    public function registerStep1(Request $request): View
    {
        $this->validate($request, [
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:75',
            'email' => 'required|email:rfc,dns|max:150',
            'phone' => 'required|string|max:20',
            'cell' => 'nullable|string|max:20',
            'address' => 'required|string|max:200',
            'city' => 'required|string|max:75',
            'state' => 'required|string|max:75',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'econtact' => 'required|string|max:150',
            'enumber' => 'required|string|max:20',
            'gender' => 'required|string|max:6|in:male,female',
            'dob' => 'required|date_format:m/d/Y|max:10',
        ]);
        $registration = $request->all();
        $registration['invoice'] = time();
        $request->session()->put('registration', $registration);

        return view('pages.registeroptions', compact('registration'));
    }

    public function registerStepOptions(Request $request)
    {
        $this->validate($request, [
            'startdate' => 'nullable|date_format:m/d/Y|max:10|required_if:option,4',
            'enddate' => 'nullable|date_format:m/d/Y|max:10|after_or_equal:startdate|required_if:option,4',
            'option' => 'required|in:1,2,3,4',
        ]);
        if ($request->session()->has('registration')) {
            $registrationoptions = $request->all();

            $options = $this->options->all();
            $cost = 0;
            switch ($registrationoptions['option']) {
                case 1: $cost = $options['option1price'];
                    break;
                case 2: $cost = $options['option2price'];
                    break;
                case 3: $cost = $options['option3price'];
                    break;
                case 4:
                    $earlier = new \DateTime(date('Y-m-d', strtotime($registrationoptions['startdate'])));
                    $later = new \DateTime(date('Y-m-d', strtotime($registrationoptions['enddate'])));
                    $diff = $later->diff($earlier)->format('%a');
                    $cost = $diff * $options['option4price'];
                    break;
            }
            if ($registrationoptions['recumbent'] == 'yes' && $registrationoptions['option'] == 1) {
                $cost += $options['recumbentoption1'];
            } elseif ($registrationoptions['recumbent'] == 'yes' && $registrationoptions['option'] == 2) {
                $cost += $options['recumbentoption2'];
            }
            if ($registrationoptions['towel'] == 'yes' && ($registrationoptions['option'] == 1 || $registrationoptions['option'] == 3 || $registrationoptions['option'] == 4)) {
                $cost += $options['towel'];
            }
            if ($registrationoptions['shower'] == 'yes' && ($registrationoptions['option'] == 1 || $registrationoptions['option'] == 3 || $registrationoptions['option'] == 4)) {
                $cost += 45;
            }
            $jerseys = explode(';', $registrationoptions['jersey']);
            if (! empty($jerseys)) {
                $cost += (count($jerseys) - 1) * $options['jersey'];
            }
            $registrationoptions['cost'] = $cost;

            $request->session()->put('registrationoptions', $registrationoptions);
            $registration = $request->session()->get('registration');

            return view('pages.registerfinal', ['cost' => $cost, 'option' => $registrationoptions['option'], 'dob' => $registration['dob']]);
        } else {
            return \Redirect::route('event.register')->with('message', 'It appears your session expired.  Please register again.');
        }
    }

    public function registerPay(Request $request)
    {
        $registration = $request->session()->get('registration');
        $registrationoptions = $request->session()->get('registrationoptions');

        if (is_null($registration) || is_null($registrationoptions)) {
            return \Redirect::route('event.register')->with('message', 'It appears your session expired. Please register again.');
        }

        if (isset($request->discount)) {
            $damount = ($request->discount <= 4 && $request->discount > 0) ? $request->discount * 5 : (($request->discount > 4) ? 20 + (($request->discount - 4) * 10) : 0);
            $discount = ($registrationoptions['option'] == 4) ? 0 : $damount;
            if ($registrationoptions['option'] == 1 && $discount > 100) {
                $discount = 100;
            } elseif ($registrationoptions['option'] == 2 && $discount > 35) {
                $discount = 35;
            } elseif ($registrationoptions['option'] == 3 && $discount > 50) {
                $discount = 50;
            }

            $registration['invoice'] = time();
            $registration['discount'] = $discount;
            $registration['charters'] = $request->discount;
            $registration['paid'] = $registrationoptions['cost'] - $discount;
            $registration['paytype'] = $request->paymenttype;
            $registration['signature'] = $request->signature;
            $registration['signdate'] = date('Y-m-d', strtotime($request->signdate));
            $registration['mailinglist'] = (isset($request->mailinglist)) ? true : false;
            $request->session()->put('registration', $registration);
        }

        $create = [
            'invoice' => $registration['invoice'],
            'fname' => $registration['fname'],
            'lname' => $registration['lname'],
            'email' => $registration['email'],
            'phone' => $registration['phone'],
            'cell' => $registration['cell'],
            'address' => $registration['address'],
            'city' => $registration['city'],
            'state' => $registration['state'],
            'zip' => $registration['zip'],
            'country' => $registration['country'],
            'econtact' => $registration['econtact'],
            'enumber' => $registration['enumber'],
            'medical' => $registration['medical'],
            'dob' => date('Y-m-d', strtotime($registration['dob'])),
            'group' => $registration['group'],
            'gender' => $registration['gender'],
            'startdate' => date('Y-m-d', strtotime($registrationoptions['startdate'])),
            'enddate' => date('Y-m-d', strtotime($registrationoptions['enddate'])),
            'option' => $registrationoptions['option'],
            'recumbent' => $registrationoptions['recumbent'],
            'towel' => $registrationoptions['towel'],
            'shower' => $registrationoptions['shower'],
            'jersey' => $registrationoptions['jersey'],
            'discount' => $registration['discount'],
            'paid' => $registration['paid'],
            'paytype' => $registration['paytype'],
            'signature' => $registration['signature'],
            'signdate' => $registration['signdate'],
            'ragbrais' => $registration['ragbrais'],
            'charters' => $request->discount,
        ];

        if ($registration['paytype'] != 'online') {
            $exists = Registrant::where('invoice', $create['invoice'])->first();
            if ($exists !== null) {
                $exists->delete();
            }

            $registrant = Registrant::create($create);

            // add person to mailchimp mailing list
            if ($registration['mailinglist']) {
                try {
                    if (\Mailchimp::check('00e053e6f0', $registration['email']) != 'subscribed') {
                        \Mailchimp::subscribe('00e053e6f0', $registration['email'], ['FNAME' => $registration['fname'], 'LNAME' => $registration['lname']], false);
                    }
                } catch (\Exception $e) {
                }
            }

            try {
                \Mail::to($registrant->email)->send(new \App\Mail\Registration($registrant));
            } catch (\Exception $e) {

            }

            \Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\Registration($registrant));

            $request->session()->forget('registration');
            $request->session()->forget('registrationoptions');

            return view('pages.registerconfirm', ['registration' => $create]);
        } else {
            $exists = Registrant::where('invoice', $registration['invoice'])->where('payid', 0)->first();
            if ($exists !== null) {
                $exists->delete();
            }

            return view('pages.registerpayment', ['registration' => $create]);
        }

    }

    public function registerSubmit(Request $request)
    {
        $registration = $request->session()->get('registration');
        $registrationoptions = $request->session()->get('registrationoptions');

        if (is_null($registration) || is_null($registrationoptions)) {
            return \Redirect::route('event.register')->with('message', 'It appears your session expired. Please register again.');
        }

        // create registrant entry
        $create = [
            'invoice' => $registration['invoice'],
            'fname' => $registration['fname'],
            'lname' => $registration['lname'],
            'email' => $registration['email'],
            'phone' => $registration['phone'],
            'cell' => $registration['cell'],
            'address' => $registration['address'],
            'city' => $registration['city'],
            'state' => $registration['state'],
            'zip' => $registration['zip'],
            'country' => $registration['country'],
            'econtact' => $registration['econtact'],
            'enumber' => $registration['enumber'],
            'medical' => $registration['medical'],
            'dob' => date('Y-m-d', strtotime($registration['dob'])),
            'group' => $registration['group'],
            'gender' => $registration['gender'],
            'startdate' => date('Y-m-d', strtotime($registrationoptions['startdate'])),
            'enddate' => date('Y-m-d', strtotime($registrationoptions['enddate'])),
            'option' => $registrationoptions['option'],
            'recumbent' => $registrationoptions['recumbent'],
            'towel' => $registrationoptions['towel'],
            'shower' => $registrationoptions['shower'],
            'jersey' => $registrationoptions['jersey'],
            'discount' => $registration['discount'],
            'paid' => $registrationoptions['cost'] - $registration['discount'],
            'paytype' => $registration['paytype'],
            'signature' => $registration['signature'],
            'signdate' => $registration['signdate'],
            'ragbrais' => $registration['ragbrais'],
            'ragbrais' => $registration['charters'],
            'payid' => '0',
        ];

        $registrant = Registrant::where('invoice', '=', $create['invoice'])->first();
        if (is_null($registrant)) {
            $registrant = Registrant::create($create);
        }

        $stripe_token = (isset($request->stripeToken)) ? $request->stripeToken : '';

        if (isset($request->stripeToken) && ! empty($request->stripeToken) && $registrant->payid == '0') {
            \Stripe\Stripe::setApiKey(((env('STRIPE_MODE', 'test') == 'live') ? env('STRIPE_SK') : env('STRIPE_TEST_SK')));
            try {
                \Stripe\Charge::create([
                    'amount' => $create['paid'] * 100,
                    'currency' => 'usd',
                    'source' => $request->stripeToken,
                    'description' => 'Option: '.$registrant->option,
                    'statement_descriptor' => 'Brancel Charters',
                    'metadata' => ['name' => $request->cardname, 'e-mail' => $registrant->email],
                ]);

                $registrant->payid = $request->stripeToken;
                $registrant->save();

            } catch (\Exception $e) {
                $registrant->delete();
                $message = $e->getMessage();

                return \Redirect::route('event.register.pay.get')->with('registration', $create)->with('message', $message);
            }

            // add person to mailchimp mailing list
            if (isset($registrant->mailinglist) && $registrant->mailinglist) {
                try {
                    if (\Mailchimp::check('00e053e6f0', $registration['email']) != 'subscribed') {
                        \Mailchimp::subscribe('00e053e6f0', $registration['email'], ['FNAME' => $registration['fname'], 'LNAME' => $registration['lname']], false);
                    }
                } catch (\Exception $e) {
                }
            }

            try {
                \Mail::to($registrant->email)->send(new \App\Mail\Registration($registrant));
            } catch (\Exception $e) {

            }

            \Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\Registration($registrant));
        }

        $request->session()->forget('registration');
        $request->session()->forget('registrationoptions');

        return view('pages.registersuccess', ['registration' => $registrant]);
    }

    public function registerSuccess($invoice): View
    {
        $registration = Registrant::where('invoice', $invoice)->first();
        $invoice = true;

        return view('pages.registersuccess', compact('registration', 'invoice'));
    }

    public function registerWristband(): View
    {
        return view('pages.wristband');
    }

    public function registerSaveWristband(Request $request): View
    {
        $this->validate($request, [
            'invoice' => 'required|exists:registrants',
            'wristband' => 'required',
            'cell' => 'nullable|string|max:20',
        ]);

        Registrant::where('invoice', $request->invoice)->where(function ($query) {
            $query->whereNull('wristband')->orWhere('wristband', '=', '');
        })->update(['wristband' => $request->wristband, 'cell' => $request->cell]);

        return view('pages.wristbandconfirm');
    }

    public function paymentRequest($invoiceEncrypted): View
    {
        try {
            $invoice = decrypt($invoiceEncrypted);
        } catch (\Exception $e) {
            return view('pages.payment-notfound');
        }

        $registrant = Registrant::where('invoice', $invoice)->where('payid', '=', '0')->first();

        if ($registrant) {
            return view('pages.payment', compact('registrant', 'invoiceEncrypted'));
        } else {
            return view('pages.payment-notfound');
        }
    }

    public function payment(Request $request)
    {
        try {
            $registrant = Registrant::where('invoice', decrypt($request->invoice))->where('payid', '=', '0')->first();
        } catch (\Exception $e) {
            return view('pages.payment-notfound');
        }

        if ($registrant) {
            $registrantary = Registrant::where('invoice', decrypt($request->invoice))->where('payid', '=', '0')->first()->toArray();
            $stripe_token = (isset($request->stripeToken)) ? $request->stripeToken : '';

            if (isset($request->stripeToken) && ! empty($request->stripeToken) && $registrant->payid == '0') {
                \Stripe\Stripe::setApiKey(((env('STRIPE_MODE', 'test') == 'live') ? env('STRIPE_SK') : env('STRIPE_TEST_SK')));
                try {
                    \Stripe\Charge::create([
                        'amount' => $registrant['paid'] * 100,
                        'currency' => 'usd',
                        'source' => $request->stripeToken,
                        'description' => 'Option: '.$registrant->option,
                        'statement_descriptor' => 'Brancel Charters',
                        'metadata' => ['name' => $request->cardname, 'e-mail' => $registrant->email],
                    ]);

                    $registrant->payid = $request->stripeToken;
                    $registrant->paytype = 'online';
                    $registrant->save();

                } catch (\Exception $e) {
                    $message = $e->getMessage();

                    // dd($message);
                    return back()->with('registrant', $registrant)->with('message', $message);
                }
            }

            return view('pages.registersuccess', ['registration' => $registrant]);
        } else {
            return view('pages.payment-notfound');
        }
    }

    public function test()
    {
        // $registrant = Registrant::where('fname','=','Test')->where('payid','=','0')->first()->invoice;
        // print '<a target="_blank" href="'.config('app.url').'/payment-request/'.encrypt($registrant).'">Click</a>';
        // print \Hash::make('demo123');
    }

    public function paymentCancel()
    {
        session()->forget('registration');
        session()->forget('registrationoptions');

        return \Redirect::route('front');
    }
}
