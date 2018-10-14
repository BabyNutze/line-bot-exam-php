<?php



require "vendor/autoload.php";

$access_token = 'xfdtD+noG4mK+lCu8TZMzSN2HS785dNvsejSBYNcPDJAJroO1CthWkWipqkuJ4aKQI8i4iwubJQF/EcoIcjEYfFc64KgAr4iswIr14Ijyg6olIVvP21VVEExKDY9fCqstZL+3Sd9BBTaWiBZcg6SJgdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'c5a345849ccfdef0cc027ee11252aa7c';


//$pushID = 'U102d2918d61a46fb9e5b0ce72efd3c5d';

$pushID = array('U102d2918d61a46fb9e5b0ce72efd3c5d','Uea0b6f3a1111d357fc0e7b2fb013db22');


$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$messagetext = isset($_POST['txtmsg']) ? $_POST['txtmsg'] : "ขอบคุณครับ";
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($messagetext);


$arrlength = count($pushID);

for($x = 0; $x < $arrlength; $x++) {
    echo $arrlength;
   echo $pushID;
   $response = $bot->pushMessage($pushID[$x], $textMessageBuilder);
   echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
}
