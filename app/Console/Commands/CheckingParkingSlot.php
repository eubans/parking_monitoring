<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\GlobalController;

class CheckingParkingSlot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:parkingslot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking parking slot every minute.';

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
        $this->global_c->Check_Parking_Slot_Availability();
        $this->global_c->Cancel_Exceeded_Reservation_On_Time_Limit();
    }
}
