<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

   
          
           
                if(isset($user))
                if(count($user)>0){
                    foreach ($user as $string) {
                        $arrayUser = explode(',', $string);
                    }
                    $fcmTokens = User::whereNotNull('fcm_token')->whereIn('id',$arrayUser)->pluck('fcm_token')->toArray();
                }
         
                if(isset($event))
                if(count($event)>0){
                    foreach ($event as $string) {
                        $arrayEvent = explode(',', $string);
                    }
                    //$brand_ids= Event::whereIn('id',$arrayEvent)->pluck('brand_id')->toArray();
    
                    //$user_ids= Brand::whereIn('id',  $brand_ids )->pluck('user_id');
                 
                    //$fcmTokens = User::whereNotNull('fcm_token')->whereIn('id',$user_ids)->pluck('fcm_token')->toArray();
    
                    $user_ids= Ticket::whereIn('event_id',  $arrayEvent )->pluck('user_id');
                   
                 
                    $fcmTokens = User::whereNotNull('fcm_token')->whereIn('id',$user_ids)->pluck('fcm_token')->toArray();
    
                 
    
    
                }
    
                if(isset($fcmTokens)){
                    $firebaseToken=$fcmTokens;
                }else
                $firebaseToken = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();
                    
                $SERVER_API_KEY = env('FCM_SERVER_KEY');
         
                $data = [
                    "registration_ids" => $firebaseToken,
                    "notification" => [
                        "title" => $request->title,
                        "body" => $request->body,  
                    ]
                ];
             $dataString = json_encode($data);
           
             $headers = [
                 'Authorization: key=' . $SERVER_API_KEY,
                 'Content-Type: application/json',
             ];
           
             $ch = curl_init();
             
             curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                      
             $response = curl_exec($ch);
         
        })->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
