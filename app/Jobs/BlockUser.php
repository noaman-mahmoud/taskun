<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\Firebase;
use App\Notifications\NotifyUser as Notify ;

class BlockUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Firebase;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user  , $data ;


    public function __construct($user)
    {
        $this->data = [
            'sender'        => auth('admin')->id(),
            'sender_name'   => auth('admin')->user()->name,
            'sender_avatar' => auth('admin')->user()->avatar,
            'title_ar'      => 'تنبيه اداري',
            'title_en'      => 'Administrative Notify',
            'message_ar'    => 'تم حظرك من قبل الادراة',
            'message_en'    => 'You are Blocked from Administration of App',
            'type'          => 'block_notify' ,
        ];
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendNotification($this->user  , $this->data) ;
        $this->user->notify(new Notify($this->data));
    }
}
