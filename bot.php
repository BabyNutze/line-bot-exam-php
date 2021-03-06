<?php
// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// include composer autoload
require_once 'vendor/autoload.php';

// การตั้งเกี่ยวกับ bot
require_once 'bot_settings.php';

// กรณีมีการเชื่อมต่อกับฐานข้อมูล
//require_once("dbconnect.php");

///////////// ส่วนของการเรียกใช้งาน class ผ่าน namespace
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
//use LINE\LINEBot\Event;
//use LINE\LINEBot\Event\BaseEvent;
//use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;


$httpClient = new CurlHTTPClient(LINE_MESSAGE_ACCESS_TOKEN);
$bot = new LINEBot($httpClient, array('channelSecret' => LINE_MESSAGE_CHANNEL_SECRET));

// คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
$content = file_get_contents('php://input');

// แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
$events = json_decode($content, true);
{
  "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
  "type": "join",
  "timestamp": 1462629479859,
  "source": {
    "type": "group",
    "groupId": "C4af4980629..."
  }
}
if(!is_null($events)){
    // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
    $replyToken = $events['events'][0]['replyToken'];
    $userID = $events['events'][0]['source']['userId'];
    $sourceType = $events['events'][0]['source']['type'];
    $is_postback = NULL;
    $is_message = NULL;
    if(isset($events['events'][0]) && array_key_exists('message',$events['events'][0])){
        $is_message = true;
        $typeMessage = $events['events'][0]['message']['type'];
        $userMessage = $events['events'][0]['message']['text'];
        $idMessage = $events['events'][0]['message']['id'];
    }
    if(isset($events['events'][0]) && array_key_exists('postback',$events['events'][0])){
        $is_postback = true;
        $dataPostback = NULL;
        parse_str($events['events'][0]['postback']['data'],$dataPostback);;
        $paramPostback = NULL;
        if(array_key_exists('params',$events['events'][0]['postback'])){
            if(array_key_exists('date',$events['events'][0]['postback']['params'])){
                $paramPostback = $events['events'][0]['postback']['params']['date'];
            }
            if(array_key_exists('time',$events['events'][0]['postback']['params'])){
                $paramPostback = $events['events'][0]['postback']['params']['time'];
            }
            if(array_key_exists('datetime',$events['events'][0]['postback']['params'])){
                $paramPostback = $events['events'][0]['postback']['params']['datetime'];
            }
        }
    }
    if(!is_null($is_postback)){
        $textReplyMessage = "ข้อความจาก Postback Event Data = ";
        if(is_array($dataPostback)){
            $textReplyMessage.= json_encode($dataPostback);
        }
        if(!is_null($paramPostback)){
            $textReplyMessage.= " \r\nParams = ".$paramPostback;
        }
        $replyData = new TextMessageBuilder($textReplyMessage);
    }
    if(!is_null($is_message)){
        switch ($typeMessage){
            case 'text':
                $userMessage = strtolower($userMessage); // แปลงเป็นตัวเล็ก สำหรับทดสอบ
                switch ($userMessage) {
                    case "hi" || "สวัสดี" || "ดีจ้า" || "ดีจ้าา":
                        $textReplyMessage = "สวัสดีครับ";
                        $replyData = new TextMessageBuilder($textReplyMessage);
                        break;
                    case "i":
                    $picFullSize = 'https://enigmatic-scrubland-34657.herokuapp.com/images/COELOGO-edit.gif';
                    $picThumbnail = 'https://enigmatic-scrubland-34657.herokuapp.com/images/COELOGO-edit_tn.jpg';
                        $replyData = new ImageMessageBuilder($picFullSize,$picThumbnail);
                        break;
                    case "v":
                        $picThumbnail = 'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/240';
                        $videoUrl = "https://www.ninenik.com/line/simplevideo.mp4";
                        $replyData = new VideoMessageBuilder($videoUrl,$picThumbnail);
                        break;
                    case "a":
                        $audioUrl = "https://www.ninenik.com/line/S_6988827932080.wav";
                        $replyData = new AudioMessageBuilder($audioUrl,20000);
                        break;
                    case "l" || "location" || "ที่ตั้ง":
                        $placeName = "ตำแหน่งที่ตั้งสภาวิศวกร";
                        $placeAddress = "487/1 ซอยรามคำแหง 39 แขวงพลับพลา เขตวังทองหลาง กรุงเทพมหานคร ประเทศไทย";
                        $latitude = 13.76363767;
                        $longitude = 100.60656106;
                        $replyData = new LocationMessageBuilder($placeName, $placeAddress, $latitude ,$longitude);
                        break;
                    case "m" || "ตำแหน่ง"  || "ทางไป":
                        $textReplyMessage = "ขอบคุณครับ";
                        $textMessage = new TextMessageBuilder($textReplyMessage);

                        $picFullSize = 'https://enigmatic-scrubland-34657.herokuapp.com/images/COELOGO-edit.gif';
                        $picThumbnail = 'https://enigmatic-scrubland-34657.herokuapp.com/images/COELOGO-edit_tn.jpg';
                        $imageMessage = new ImageMessageBuilder($picFullSize,$picThumbnail);

                        $placeName = "แผนที่สภาวิศวกร";
                        $placeAddress = "แขวง พลับพลา เขต วังทองหลาง กรุงเทพมหานคร ประเทศไทย";
                        $latitude = 13.76363767;
                        $longitude = 100.60656106;
                        $locationMessage = new LocationMessageBuilder($placeName, $placeAddress, $latitude ,$longitude);

                        $multiMessage =     new MultiMessageBuilder;
                        $multiMessage->add($textMessage);
                        $multiMessage->add($imageMessage);
                        $multiMessage->add($locationMessage);
                        $replyData = $multiMessage;
                        break;
                    case "s":
                        $stickerID = 22;
                        $packageID = 2;
                        $replyData = new StickerMessageBuilder($packageID,$stickerID);
                        break;
                    case "im":
                        $imageMapUrl = 'https://enigmatic-scrubland-34657.herokuapp.com/images/COELOGO-edit.gif';
                        $replyData = new ImagemapMessageBuilder(
                            $imageMapUrl,
                            'This is Title',
                            new BaseSizeBuilder(699,1040),
                            array(
                                new ImagemapMessageActionBuilder(
                                    'test image map',
                                    new AreaBuilder(0,0,520,699)
                                    ),
                                new ImagemapUriActionBuilder(
                                    'https://www.coe.or.th',
                                    new AreaBuilder(520,0,520,699)
                                    )
                            ));
                        break;
                    case "tm":
                        $replyData = new TemplateMessageBuilder('คุณเป็นสมาชิกสภาวิศวกรใช่ไหม',
                            new ConfirmTemplateBuilder(
                                    'Confirm template builder',
                                    array(
                                        new MessageTemplateActionBuilder(
                                            'ใช่',
                                            'ขอบคุณครับ'
                                        ),
                                        new MessageTemplateActionBuilder(
                                            'ไม่ใช่',
                                            'คุณสามารถรับข่าวสารสภาวิศวกรที่ line @coethai'
                                        )
                                    )
                            )
                        );
                        break;
                    case "t_b":
                        // กำหนด action 4 ปุ่ม 4 ประเภท
                        $actionBuilder = array(
                            new MessageTemplateActionBuilder(
                                'Message Template',// ข้อความแสดงในปุ่ม
                                'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                            new UriTemplateActionBuilder(
                                'เว็บไซต์สภาวิศวกร', // ข้อความแสดงในปุ่ม
                                'https://www.coe.or.th'
                            ),
                            new DatetimePickerTemplateActionBuilder(
                                'เลือกวันและเวลา', // ข้อความแสดงในปุ่ม
                                http_build_query(array(
                                    'action'=>'reservation',
                                    'person'=>5
                                )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
                                'datetime', // date | time | datetime รูปแบบข้อมูลที่จะส่ง ในที่นี้ใช้ datatime
                                substr_replace(date("Y-m-d H:i"),'T',10,1), // วันที่ เวลา ค่าเริ่มต้นที่ถูกเลือก
                                substr_replace(date("Y-m-d H:i",strtotime("+5 day")),'T',10,1), //วันที่ เวลา มากสุดที่เลือกได้
                                substr_replace(date("Y-m-d H:i"),'T',10,1) //วันที่ เวลา น้อยสุดที่เลือกได้
                            ),
                            new PostbackTemplateActionBuilder(
                                'ยืนยัน', // ข้อความแสดงในปุ่ม
                                http_build_query(array(
                                    'action'=>'buy',
                                    'item'=>100
                                )) // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
    //                          'Postback Text'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                        );
                        $imageUrl = 'https://enigmatic-scrubland-34657.herokuapp.com/images/COELOGO-edit.gif';
                        $replyData = new TemplateMessageBuilder('Button Template',
                            new ButtonTemplateBuilder(
                                    'สภาวิศวกร', // กำหนดหัวเรื่อง
                                    'กรุณาเลือก', // กำหนดรายละเอียด
                                    $imageUrl, // กำหนด url รุปภาพ
                                    $actionBuilder  // กำหนด action object
                            )
                        );
                        break;
                    case "t_f":
                        $replyData = new TemplateMessageBuilder('ยืนยัน',
                            new ConfirmTemplateBuilder(
                                    'คุณเป็นสมาชิกสภาวิศวกรใช่ไหม', // ข้อความแนะนหรือบอกวิธีการ หรือคำอธิบาย
                                    array(
                                        new MessageTemplateActionBuilder(
                                            'ใช่', // ข้อความสำหรับปุ่มแรก
                                            'กรุณาระบุเลขที่สมาชิก'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                        ),
                                        new MessageTemplateActionBuilder(
                                            'ไม่ใช่', // ข้อความสำหรับปุ่มแรก
                                            'ติดตามข่าวสารจากสภาวิศวกรได้ที่ official line: @coethai' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                        )
                                    )
                            )
                        );
                        break;
                    case "t_c":
                        // กำหนด action 4 ปุ่ม 4 ประเภท
                        $actionBuilder = array(
                            new MessageTemplateActionBuilder(
                                'สภาวิศวกร',// ข้อความแสดงในปุ่ม
                                'ขอบคุณ' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                            new UriTemplateActionBuilder(
                                'เว็บไซต์สภาวิศวกร', // ข้อความแสดงในปุ่ม
                                'https://www.coe.or.th'
                            ),
                            new PostbackTemplateActionBuilder(
                                'Postback', // ข้อความแสดงในปุ่ม
                                http_build_query(array(
                                    'action'=>'buy',
                                    'item'=>100
                                )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
                                'ขอบคุณ'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                        );
                        $replyData = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(
                                    new CarouselColumnTemplateBuilder(
                                        'Title Carousel',
                                        'Description Carousel',
                                        'https://enigmatic-scrubland-34657.herokuapp.com/images/COELOGO-edit.gif',
                                        $actionBuilder
                                    ),
                                    new CarouselColumnTemplateBuilder(
                                        'Title Carousel',
                                        'Description Carousel',
                                        'https://enigmatic-scrubland-34657.herokuapp.com/images/COELOGO-edit.gif',
                                        $actionBuilder
                                    ),
                                    new CarouselColumnTemplateBuilder(
                                        'Title Carousel',
                                        'Description Carousel',
                                        'https://enigmatic-scrubland-34657.herokuapp.com/images/COELOGO-edit.gif',
                                        $actionBuilder
                                    ),
                                )
                            )
                        );
                        break;
                    case "t_ic":
                        $replyData = new TemplateMessageBuilder('Image Carousel',
                            new ImageCarouselTemplateBuilder(
                                array(
                                    new ImageCarouselColumnTemplateBuilder(
                                        'https://enigmatic-scrubland-34657.herokuapp.com/images/COELOGO-edit.gif',
                                        new UriTemplateActionBuilder(
                                            'เว็บไซต์สภาวิศวกร', // ข้อความแสดงในปุ่ม
                                            'https://www.coe.or.th'
                                        )
                                    ),
                                    new ImageCarouselColumnTemplateBuilder(
                                        'https://enigmatic-scrubland-34657.herokuapp.com/images/fb.jpg';
                                        new UriTemplateActionBuilder(
                                            'เฟซบุคสภาวิศวกร', // ข้อความแสดงในปุ่ม
                                            'https://facebook.com/coethai'
                                        )
                                    )
                                )
                            )
                        );
                        break;
                    case 'help' || 'ช่วยเหลือ':
                      // code...

                      break;
                    default:
                        $textReplyMessage = "พิมพ์ help เพื่อดูคำสั่งที่ใช้ได้";
                        $replyData = new TextMessageBuilder($textReplyMessage);
                        break;
                }
                break;
            default:
                $textReplyMessage = json_encode($events);
                $replyData = new TextMessageBuilder($textReplyMessage);
                break;
        }
    }
}
$response = $bot->replyMessage(@$replyToken,@$replyData);
if ($response->isSucceeded()) {
    echo 'Succeeded!';
    return;
}

// Failed
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>
