<?php

$access_token = 'xfdtD+noG4mK+lCu8TZMzSN2HS785dNvsejSBYNcPDJAJroO1CthWkWipqkuJ4aKQI8i4iwubJQF/EcoIcjEYfFc64KgAr4iswIr14Ijyg6olIVvP21VVEExKDY9fCqstZL+3Sd9BBTaWiBZcg6SJgdB04t89/1O/w1cDnyilFU=';

$url = "https://api.line.me/v2/bot/message/push";

$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$access_token}";

$arrPostData = array();
$arrPostData['to'] = "Uea0b6f3a1111d357fc0e7b2fb013db22";
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][1]['text'] = "Bienvenue";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
print $result;
?>
