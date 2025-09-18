<?php

namespace App\Http\Controllers;


class Controller
{

    protected $options;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->options = new \App\Http\Repositories\SiteOptions;
    }
}
