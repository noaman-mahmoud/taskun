<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use App\Notifications\SendNotification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\UserToken;
use App\Traits\Firebase;
use Notification;

class ApiNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Firebase;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user  , $data , $type;

    public function __construct($user , $request , $type )
    {
        $this->data = [
            'reservation'   => $request['reservation'],
            'title_ar'      => $request['title_ar'],
            'title_en'      => $request['title_en'],
            'message_ar'    => $request['message_ar'],
            'message_en'    => $request['message_en'],
            'type'          => $type,
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
        $tokens = UserToken::where(['user_id'=>$this->user->id])->pluck('device_id','device_id')->toArray();
        $this->sendNotification($tokens,$this->data);

        Notification::send($this->user, new SendNotification($this->data));
    }
}
