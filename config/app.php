<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'timezone' => 'America/Chicago',


    'aliases' => Facade::defaultAliases()->merge([
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,
        'Mailchimp' => NZTim\Mailchimp\MailchimpFacade::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
    ])->toArray(),

];
