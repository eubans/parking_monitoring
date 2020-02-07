<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\GlobalController;

class ClosingSMSBlast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:closingtime';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SMS Blast for occupants before the closing time';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $global_c;

    public function __construct(GlobalController $global_c)
    {
        parent::__construct();
        $this->global_c =  $global_c;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->global_c->Trigger_Closing_SMS_Blast();
    }
}
