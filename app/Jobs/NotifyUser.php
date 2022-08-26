<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\Firebase;
use App\Notifications\NotifyUser as Notify ;

class NotifyUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Firebase;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $users  , $data , $type;


    public function __construct($users , $request , $type )
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
        $this->type  = $type;
        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->users instanceof \Illuminate\Database\Eloquent\Collection){
            foreach ($this->users as $user){
                if ($this->type == 'email') {
                    \Mail::to($user->email)->send(new \App\Mail\SendMail($this->data));
                }else{
                    $this->sendNotification($user  , $this->data) ;
                    $user->notify(new Notify($this->data));
                }
            }
        }else{
            if ($this->type == 'email') {
                \Mail::to($this->users->email)->send(new \App\Mail\SendMail($this->data));
            }else{
                $this->sendNotification($this->users  , $this->data) ;
                $this->users->notify(new Notify($this->data));
            }
        }

    }
}
