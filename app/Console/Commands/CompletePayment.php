<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Registrant;

class CompletePayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:complete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends email with pay link to registrations with incomplete payment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$registrations = Registrant::where("paytype","online")->where('payid','0')->get();
		
		foreach($registrations as $registration) {
			\Mail::to($registration->email)->send(new \App\Mail\PayRequest($registration));
		}
		
		echo $registrations->count()." payment request e-mails sent.";
    }
}
