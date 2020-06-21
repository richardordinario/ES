<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\School_Year;

class Sy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:sy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for school year update';

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
        date_default_timezone_set("Asia/Manila");

        $y = date('Y');
        $m = date('m');
        $sy = "";

        if( $m > 4 )
        {
            $add = $y + 1;
            $sy = $y . "-" . $add;
        }
        else
        {
            $add = $y - 1;
            $sy = $add . "-" . $y;
        }
        // $form = array('sy' => "2021-2022");
        // School_Year::create($form);
        
        $check = DB::table('school_years')->where('sy', $sy)->first();

        if($check){ }
        else
        {
            $getLatest = DB::table('school_years')->latest()->value('sy');
            DB::table('schedules')->where('sy',$getLatest)->update(['status' => "Deactive"]);
            
            $form = array('sy' => $sy);
            School_Year::create($form);
        }
    }
}
