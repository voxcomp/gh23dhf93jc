<?php

namespace App\Exports;

use App\Models\Registrant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RegistrationExportLast implements FromView
{
    public function view(): View
    {
        $options = new \App\Http\Repositories\SiteOptions;

        $last = $options->get('lastexport');
        if ($last === false || is_null($last)) {
            $last = '1970-01-01 00:00';
        }
        $registrations = Registrant::where('created_at', '>', $last)->orderBy('id')->get();

        $options->set('lastexport', date('Y-m-d G:i:s'));

        return view('reports.registrants', ['registrants' => $registrations]);
    }
}
