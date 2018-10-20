<?php

   $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('xfdtD+noG4mK+lCu8TZMzSN2HS785dNvsejSBYNcPDJAJroO1CthWkWipqkuJ4aKQI8i4iwubJQF/EcoIcjEYfFc64KgAr4iswIr14Ijyg6olIVvP21VVEExKDY9fCqstZL+3Sd9BBTaWiBZcg6SJgdB04t89/1O/w1cDnyilFU=');
   $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'c5a345849ccfdef0cc027ee11252aa7c']);

   $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
   $response = $bot->pushMessage('<to>', $textMessageBuilder);

   echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

?>
