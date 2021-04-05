<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Carbon\Carbon;

class ChangeStatusSerialnumberToExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ChangeStatusSerialnumberToExpire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change Status Serialnumber To Expire database serialnumber';

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
        $date_product_outs = DB::table('product_outs')->get();
        $date_now = Carbon::now()->format('Y-m-d');

        foreach($date_product_outs as $date_product_out => $value) {
            $status = DB::table('serialnumbers')->where('id',$value->film_model_id)->value('status');
            $date = $value->date;
            $date_expire = date('Y-m-d', strtotime($value->date. ' + 7 days'));
                if($date_now > $date_expire) {
                    if($status == 'พร้อมใช้งาน') {
                        DB::table('serialnumbers')->where('id',$value->film_model_id)->update(['status' => 'หมายเลขหมดอายุ']);
                    }
                }
        }

    }
}
