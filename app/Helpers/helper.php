<?php
use Illuminate\Support\Facades\App;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Services\SettingService;
use App\Models\SiteSetting;
use App\Models\Seo;

function seo($key){
    return Seo::where('key' , $key)->first() ;
}

function appInformations(){
    $result = SiteSetting::pluck('value', 'key');
    return $result;
}

function convert2english( $string )
{
    $newNumbers = range( 0, 9 );
    $arabic     = array( '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' );
    $string     = str_replace( $arabic, $newNumbers, $string );
    return $string;
}

function Translate($text,$lang){

    $api  = 'trnsl.1.1.20190807T134850Z.8bb6a23ccc48e664.a19f759906f9bb12508c3f0db1c742f281aa8468';

    $url = file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key='.$api
        .'&lang=ar' . '-' . $lang . '&text=' . urlencode($text));
    $json = json_decode($url);
    return $json->text[0];

}

function getYoutubeVideoId( $youtubeUrl )
{
    preg_match( "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/",
        $youtubeUrl, $videoId );
    return $youtubeVideoId = isset( $videoId[ 1 ] ) ? $videoId[ 1 ] : "";
}

function uploadFile($fileAttr, $path = ""){

    $imgName = mt_rand(1000, 9999).microtime(true).'.'.$fileAttr->getClientOriginalExtension();
    $fileAttr->move(('storage/images/'.$path),$imgName);
    return $imgName;
}

function generateQr($user){

    $qr_name = 'qr_'.microtime(true).'.png';
    $data    = $user->phone . PHP_EOL;
    $data   .= url('broker-details/'. $user->uuid);

    QrCode::size(100)->format('png')
             ->generate($data, public_path('storage/images/qr_codes/'.$qr_name));

    return $qr_name;
}

function lang(){
    return App() -> getLocale();
}

function getDistanceHaving($result, $latitude, $longitude ,$range){

//  $range = setting()->distance_range;
    $raw   = DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) *cos( radians( lat ) )
           * cos( radians( lng ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') )
           * sin( radians( lat ) ) ) )  AS distance');

    $results = $result->select('*', $raw)->addSelect($raw)->orderBy('distance' ,'asc')->having('distance', '<=', $range)->get();

    return $results;
}

function getDistance($result, $latitude, $longitude){

    $raw   = DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) *cos( radians( lat ) )
           * cos( radians( lng ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') )
           * sin( radians( lat ) ) ) )  AS distance');

    $results = $result->select('*', $raw)->addSelect($raw)->orderBy('distance' ,'asc')->get();

    return $results;
}

function setting(){

    $data = SettingService::appInformations(SiteSetting::pluck('value', 'key'));

    return $data;
}

function jsValidation($request, $form){

    return JsValidator::formRequest('App\Http\Requests\\' . $request, $form);
}




