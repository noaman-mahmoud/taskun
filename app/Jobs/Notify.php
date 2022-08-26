<?php

namespace App\Jobs;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\NotifyUser ;

class Notify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Firebase;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $users  , $data;

    public function __construct($users , $request)
    {
        $this->data = [
            'sender'        => auth('admin')->id(),
            'sender_name'   => auth('admin')->user()->name,
            'sender_avatar' => auth('admin')->user()->avatar,
            'title_ar'      => $request->title_ar ,
            'title_en'      => $request->title_en ,
            'message_ar'    => $request->message_ar,
            'message_en'    => $request->message_en,
            'type'          => 'admin_notify' ,
        ];
        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tokens = [];
        foreach ($this->users as $user) {
            foreach ($user->devices as $device) {
               $tokens[] = $device->device_id ; 
            }
        }
        
        $this->sendNotification($tokens , $this->data) ;
        Notification::send($this->users, new NotifyUser($this->data));
    }
}
