<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\GlobalController;

class DeactivatingAllGuest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deactivate:allguest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivating All Guest every 11:59PM';

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
        $this->global_c->Disabling_All_Guest_Account();
    }
}
