<?php

namespace App\Http\Controllers;

use App\Exports\RegistrationExport;
use App\Exports\RegistrationExportLast;
use App\Models\Registrant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
    }

    public function index(): View
    {
        $options = $this->options->all();

        return view('admin.home', compact('options'));
    }

    public function changeStatus(Request $request)
    {
        $this->options->set('statusmessage', $request->statusmessage);
        $this->options->set('sitestatus', $request->status);

        return $this->index();
    }

    public function saveOptions(Request $request): View
    {
        $results = $request->all();
        unset($results['_token']);
        /*
                $this->options->set('option1reserve',0);
                $this->options->set('option2reserve',0);
                $this->options->set('option3reserve',0);
                $this->options->set('option4reserve',0);
        */
        foreach ($results as $key => $value) {
            $this->options->set($key, (string) $value);
        }

        $options = $this->options->all();

        return view('admin.home', compact('options'))->with('message', 'The site options have been saved.');
    }

    public function downloadData()
    {
        return \Excel::download(new RegistrationExport, 'registrants-'.uniqid().'.xlsx');
    }

    public function downloadDataLast()
    {
        return \Excel::download(new RegistrationExportLast, 'registrants-'.uniqid().'.xlsx');
    }

    public function paymentRequest()
    {
        $registrations = Registrant::where('paytype', 'reserve')->get();

        foreach ($registrations as $registration) {
            \Mail::to($registration->email)->send(new \App\Mail\PayRequest($registration));
        }

        echo $registrations->count().' payment request e-mails sent.';
    }

    public function sendPaymentRequest(Request $request): RedirectResponse
    {
        $list = explode(',', $request->requestlist);

        $notfound = [];
        foreach ($list as $item) {
            $registration = Registrant::where('invoice', trim($item))->first();
            if (! is_null($registration)) {
                \Mail::to($registration->email)->send(new \App\Mail\PayRequest($registration));
            } else {
                $notfound[] = $item;
            }
        }

        return redirect('admin')->with('message', 'A payment request email has been sent to the list provided.'.((! empty($notfound)) ? '<br><br><strong>The following invoices could not be found:</strong> '.implode(',', $notfound) : ''));
    }
}
