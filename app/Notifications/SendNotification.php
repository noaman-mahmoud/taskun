<?php

namespace App\Notifications;
use App\Libraries\Firebase;
use App\Services\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SendNotification extends Notification
{
    use Queueable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return  $this->data;
    }


}
