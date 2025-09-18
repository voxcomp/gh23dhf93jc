<?php

namespace App\Exports;

use App\Models\Registrant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RegistrationExport implements FromView
{
    public function view(): View
    {
        $options = new \App\Http\Repositories\SiteOptions;
        $options->set('lastexport', date('Y-m-d G:i:s'));

        return view('reports.registrants', ['registrants' => Registrant::orderBy('id')->get()]);
    }
}
