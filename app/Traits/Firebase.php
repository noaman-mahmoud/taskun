<?php

namespace App\Traits;
use FCM;
use App\Models\UserToken ;
use App\Models\SiteSetting;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use Illuminate\Http\Exceptions\HttpResponseException;

trait  Firebase
{
    public function sendNotification($tokens , $data)
    {
        // $firebaseToken = UserToken::where('user_id' , $user->id)->pluck('device_id')->all();
        $SERVER_API_KEY = SiteSetting::where('key' , 'firebase_key')->first()->value ;
        $data = [
            "registration_ids" => $tokens,
            "notification" => [
                "title" => 'DHA',
                "body"  => $data['message_'.lang()],
                'sound' => true,
            ],
            'data'  => $data
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
    }
}

