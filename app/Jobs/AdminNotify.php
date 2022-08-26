<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Notifications\NotifyUser;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AdminNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $admins , $data ; 

    public function __construct($admins , $request)
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
        $this->admins = $admins;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->admins, new NotifyUser($this->data));
    }
}
