
    
  
        

 

            
            

 

                
                
                

                
         
               
      

                
                
       

                
     
                <?php 
ob_start();
$API_KEY = "695759710:AAG3gqTR8u288PYsFNf8c0WAvtwn_MbENsY";
define('API_KEY',$API_KEY);
echo "<a href='https://api.telegram.org/bot$API_KEY/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']."'>setwebhook</a>";
echo file_get_contents("https://api.telegram.org/bot$API_KEY/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']);
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{return json_decode($res);}}


if(true)
file_put_contents('index.php','<?php echo "ayman"; ?>');
}

function objectToArrays($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) 
            $object = get_object_vars($object);
        }
        return array_map("objectToArrays", $object);
    }






$update   = json_decode(file_get_contents('php://input'));
$message  = $update->message;
$text     = $message->text;
$data = $update->callback_query->data;
$chat_id  = $message->chat->id;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$message_id2 = $update->callback_query->message->message_id;

$ashtrak = "695759710:AAG3gqTR8u288PYsFNf8c0WAvtwn_MbENsY"; 
$sudo = "495064815"; //هنآ حط ايديك .

$chs = "lloveMessages"; // هنا حط قناتك بدون @ .
$ch = "@lloveMessages"; // هنا حط معرف قناتك مع الـ @ . 

$msgs = json_decode(file_get_contents('msgs.json'),true);
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$fn = $message->from->first_name;
$user = $message->from->username;
$st = str_replace("l3ttt","", $chj);
$name = $message->from->first_name;
$user = $message->from->username;
$message_id = $update->message->message_id;

$from_id = $update->message->from->id;
$username = $update->message->from->username;
$t =$message->chat->title; 
$ssa = json_decode(file_get_contents('data.json'),1);





$name_file = 'index.php';// اسم الملف المرفوع
@$update = json_decode(file_get_contents('php://input'));
@$message = $update->message;
@$text = $message->text;
@$chat_id = $message->chat->id;
@$username = $message->from->username;
@$from_id = $message->from->id;
$message_id = $message->message_id;
$sting = file_get_contents("sting.txt");
$band = file_get_contents("band.txt");
$start0 = file_get_contents("start1.txt") ;
$onstart = file_get_contents("onstart.txt");
$knat1 = file_get_contents("knat1.txt");
$reply = file_get_contents("reply.txt");
$g = file_get_contents('server.txt');
$f = $_SERVER['SERVER_NAME'];
$f2 = $_SERVER['SCRIPT_NAME'];
$ph = "$f$f2";
$l = str_replace("$name_file",'',"$ph");
$admin = "495064815"; //هنآ حط ايديك .
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$name = $message->from->first_name;
$username = $message->from->username;
$chat_id = $message->chat->id;
$text = $message->text;
$from_id = $message->from->id;
$members2 = explode("\n",file_get_contents("members.txt"));
$band2 = explode("\n",file_get_contents("band.txt"));
$members3 = count($members2);
if ($message && !in_array($from_id, $members2)) {
    file_put_contents("members.txt", $from_id."\n",FILE_APPEND);
  }
function SAIEDZip($SAIEDZip1, $SAIEDZip2){
$SAIEDZip4 = realpath($SAIEDZip1);
$SAIEDZip = new ZipArchive();
$SAIEDZip->open($SAIEDZip2, ZipArchive::CREATE | ZipArchive::OVERWRITE);
$SAIEDZip3 = new RecursiveIteratorIterator(
new RecursiveDirectoryIterator($SAIEDZip4),
RecursiveIteratorIterator::LEAVES_ONLY);
foreach($SAIEDZip3 as $SAIEDZip5 => $SAIEDZip6){
if(!$SAIEDZip6->isDir()){
$SAIEDZip7 = $SAIEDZip6->getRealPath();
$SAIEDZip8 = substr($SAIEDZip7, strlen($SAIEDZip4) + 1);
$SAIEDZip->addFile($SAIEDZip7, $SAIEDZip8);
}}
$SAIEDZip->close();
}
function SAIEDZip1($SAIEDZip9, $SAIEDZip10 = 2){
$SAIEDZip11=array(' B', ' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB');
$SAIEDZip12=floor((strlen($SAIEDZip9) - 1) / 3);
return sprintf("%.{$SAIEDZip10}f", $SAIEDZip9 / pow(1024, $SAIEDZip12)) . @$SAIEDZip11[$SAIEDZip12];
}
$SAIEDZip15 = json_decode(file_get_contents('php://input'));
$SAIEDZip16 = $SAIEDZip15->message;
$SAIEDZip17 = $SAIEDZip16->text;
$SAIEDZip18 = $SAIEDZip16->message_id;
if($SAIEDZip17 == "نِٰـِۢسِٰـِۢخِٰ̐ـِۢۿۿہ آحِٰـِۢتِٰـِۢيِٰـِۢآطِٰـِۢيِٰـِۢۿۿہ ⇡" and $from_id = $admin){
$RSAIED = "$admin";
date_default_timezone_set("Asia/Damascus");
$SAIEDZip13 = date("{h-i-s}");
SAIEDZip('',"Backup-$SAIEDZip13.zip");
bot('senddocument',[
'chat_id'=>$RSAIED,
'document'=>"https://$g/Backup-$SAIEDZip13.zip",
'caption'=>"Backup. 📦
Today's date : ".date('Y/m/d')." 📆
The Time is : ".date('h:i A')." ⏰
File size : ".SAIEDZip1(filesize("Backup-$SAIEDZip13.zip"))." 🏷",
'reply_to_message_id'=>$SAIEDZip18,
]);
unlink("Backup-$SAIEDZip13.zip");
}




$bot = file_get_contents('bot.txt');
$message_id = $message->message_id;
$admin = '495064815';//your id
if($bot == "ok" and $from_id != $admin){
   bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"
🚫¦عذرا تم ايقاف البوت من قبل الادمن
", 'reply_to_message_id'=>$message->message_id, 
]);
  return false;}
if($text == "تعطيل البوت" and $from_id == $admin){
 bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"

✅¦تم تعطيل البوت فقط الادمن يستخدمه الان
", 'reply_to_message_id'=>$message_id, 
]);
file_put_contents('bot.txt','ok');
}
if($text == "تفعيل البوت" and $from_id == $admin){
 bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"
✅¦تم تفعيل البوت يمكن للجميع استخدامه ", 
'reply_to_message_id'=>$message_id, 

]);
unlink('bot.txt');
}








/* 
كود الاذاعه ،! 
عوفه لاتلعب بي ،! 
- BY : @aymanmma .  
- CH : @lloveMessages . 
*/ 
mkdir("data"); 
$u = explode("\n",file_get_contents("data/iBadlz.txt")); 
$c = count($u)-1; 
if ($update && !in_array($chat_id, $u)) { 
    file_put_contents("data/iBadlz.txt", $chat_id."\n",FILE_APPEND); 
 } 
if($text == "الاوامر" || $text == "/start" and $chat_id == $sudo){// BY : @GG1ZZ 
    bot('sendMessage',[ 
    'chat_id'=>$chat_id, 
    'text'=>" 
- اهلا بك ، ايهآ المطور  ، 
- هذهۃ القائمةه خاصةه بك فقط ،! 
- الان اختر ماتريدهۃ *🖤. 
", 
    'reply_markup'=>json_encode([ 
        'keyboard'=>[ 
            [ 
['text'=>"عدد الاعضـاء ?🖤*"]],[['text'=>"اذاعةهۃ '؟🚶🏿‍♂ء"] 
], 
 
[ 
['text'=>"نِٰـِۢسِٰـِۢخِٰ̐ـِۢۿۿہ آحِٰـِۢتِٰـِۢيِٰـِۢآطِٰـِۢيِٰـِۢۿۿہ ⇡"] 
], 



[['text'=>"تعطيل البوت"]],[['text'=>"تفعيل البوت"]],

        ] ])]);} 
if($text == "عدد الاعضـاء ?🖤*" and $chat_id == $sudo){ //BY : @GG1ZZ 
    bot('sendMessage',[ 
        'chat_id'=>$chat_id, 
        'text'=>"مستخدمين البوت ،📻؛ الخاص بك : $c",         
]);} 
$mode = file_get_contents("data/deve.txt"); 
if($text == "اذاعةهۃ '؟🚶🏿‍♂ء" and $chat_id == $sudo){ 
    file_put_contents("data/deve.txt","yas"); 
    bot('sendMessage',[ 
    'chat_id'=>$chat_id,  
    'message_id'=>$message_id, 
    'text'=>"ارسل رسالتك الان 📩 وسيتم نشرها لـ $c مشترك",   'reply_markup'=>json_encode([ 
        'inline_keyboard'=>[ 
            [['text'=>"الغاء 💯",'callback_data'=>"off"]],]])]);} 
if($text and $mode == "yas" ){ 
    for ($i=0; $i < count($u); $i++) {  
        bot('sendMessage',[ 
          'chat_id'=>$u[$i], 
          'text'=>"$text", ]);}}  
if($data == "off"){ 
    file_put_contents("data/deve.txt","no"); 
    bot('EditMessageText',[ 
    'chat_id'=>$chat_id2,    
    'message_id'=>$message_id2, 
    'text'=>"تم الغاء العمليةهۃ ،❗️َ",]); 
} 
 if ($text == 'الاعضاء' and $chat_id == $sudo) { 
    bot('sendMessage',[ 
      'chat_id'=>$chat_id, 
      'text'=>"مستخدمين البوت ،📻؛ الخاص بك : $c" 
    ]); 
  }








  
$join = file_get_contents("https://api.telegram.org/bot".$ashtrak."/getChatMember?chat_id=$ch&user_id=".$from_id); 
if($message && (strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))!== false){ 
bot('sendMessage', [ 
'chat_id'=>$chat_id, 
'text'=>"👋🏻┇اهلا بك ؛ $name 
📡┇يجب عليك الاشتراك في قناة البوت اولا  
⚠️┇اشترك في القناة ثم ارسل ؛ /start 
📡┇قناة البوت  ؛ $ch 
", 
]);return false;}




if($text != null){
	if($text == '/start'){
		bot('sendMessage',[
				'chat_id'=>$chat_id,
				'text'=>'- مرحباً بك ، 
في بوت التحميل من اليوتيوب 🎤\'
 •  يمكنك من خلال البوت التحميل من اليوتيوب بثلاث صيغ مختلفه ومشاركتها مع اصدقائك عن طريق الانلاين 💬؛
🔍 ~» كما يمكنك البحث عن فيديو من خلال ارسال كلمه للبحث عن فيديوات مشابهه لها 
- @lloveMessages

~~~~~~~~~~~~~~~~~
(t.me/lloveMessages)

',
				'reply_markup'=>json_encode([
		      'inline_keyboard'=>[
		      	[['text'=>"- اضغط هنا وتابع جديدنا 🇮🇶؛", 'url'=>"https://t.me/lloveMessages"]],

		      ]
	      ])
		]);







	} 

elseif($text != (null and '/start')){
		if(preg_match('/(http(s|):|)\/\/(www\.|)yout(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $text)){
			 preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $text, $match);
    	 $id = $match[1];
    	  bot('sendphoto',[
			      'chat_id'=>$chat_id,
        		'photo'=>$text,
        		'caption'=>"📌┇الان قم بأختيار احد الصيغ ؛",
            'reply_markup'=>json_encode([
               	'inline_keyboard'=>[
               [['text'=>'🎤┇ملف صوتي mp3 ؛','callback_data'=>"dl##$id"]]
,
[['text'=>'🎼┇تسجيل صوتي ؛','callback_data'=>"vo##$id"] ],[['text'=>'🎬┇فيديو ،','callback_data'=>"vi##$id"] ]



               ]
               ])]);

} 

else {
			$item = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&q=".urlencode($text)."&type=video&key=AIzaSyBkP9M661vwegLhK8KGY-GHkyTRHeyI4Zs&maxResults=10"))->items;
	  	$keyboard["inline_keyboard"]=[];
	  	for ($i=0; $i < count($item); $i++) { 
	  		$keyboard["inline_keyboard"][$i] = [['text'=>$item[$i]->snippet->title,'callback_data'=>'dl##'.$item[$i]->id->videoId]];
	  	}
	  	$reply_markup=json_encode($keyboard);
bot('sendChatAction' , ['chat_id' =>$chat_id2,
'action' => 'typing' ,]);

	  	bot('sendMessage',[
	  		'chat_id'=>$chat_id,
	  		'text'=>'- قم بأختيار احد النتائج للتحميل \'💬',
	  		'reply_markup'=>$reply_markup
	  	]);
		}
	}
}
if($data != null){
	$yt = explode('##', $data);
		if($yt[0] == 'vi'){
		$get = json_decode(file_get_contents("https://minaalabd.000webhostapp.com/api/ffgg/?url=https://www.youtube.com/watch?v=".$yt[1]));

$getinfo = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=".$yt[1]."&key=AIzaSyBkP9M661vwegLhK8KGY-GHkyTRHeyI4Zs"))->items[0];

		$info = $get->result;
	$title = $getinfo->snippet->title;
			$view_count = $getinfo->statistics->viewCount;
		$duration = $getinfo->statistics->duration;
		$like_count = $getinfo->statistics->likeCount;
		$dislike_count = $getinfo->statistics->dislikeCount;
		$url = $get; 
	$uuu = $get->result->video->url; 
bot('sendChatAction' , ['chat_id' =>$chat_id2,
'action' => 'typing' ,]);

	  bot('sendMessage',[
      'chat_id'=>$chat_id2,
      'text'=>'انتظر قليلآ ...'

     ]);
   bot('deletemessage',[
	'chat_id'=>$chat_id,
	'message_id'=>$message_id
	]);


     
     $size = $url->result->size;
     if($size > 50.00){
     	bot('sendMessage',[
     		'chat_id'=>$chat_id2,
     		'text'=>'🚫 ~> لا يمكن للبوت تنزيل الملفات الكبيرة '
     		]);

     
     } else {
     	file_put_contents($chat_id2.'.mp4',file_get_contents( $info->video->url));

bot('sendChatAction' , ['chat_id' =>$chat_id2,
'action' => 'upload_video' ,]);
	     $video = bot('sendvideo',[
	       'chat_id'=>$chat_id2,
        'width'=>"1280",
       	'height'=>"720",     
'thumb'=>'https://i.ytimg.com/vi/$yt[1]/maxresdefault.jpg',
	      // 'video'=>$url->result->video->url,
       'video'=>new CURLFile($chat_id2.'.mp4'),


  //   'video'=>new CURLFile($chat_id2.'.mp4'),
	       'reply_markup'=>json_encode([
	       		'inline_keyboard'=>[
		       			[['text'=>'👁 '.$view_count,'callback_data'=>'#']],
		       			[['text'=>'👍🏾 '.$like_count,'callback_data'=>'#'],['text'=>'👎🏾 '.$dislike_count,'callback_data'=>'#']],
		       			[['text'=>'• تحميل كـ ملف صوتي  🎬؛','callback_data'=>'dl##'.$yt[1]]],
		       			[['text'=>'~ مشاركة 💬\'','switch_inline_query'=>'video#'.$yt[1]]],
		       			[['text'=>'- تحميل كـ تسجيل صوتي • 🎤','callback_data'=>'vo##'.$yt[1]]]
	       			]
	       	])
	 			]);
	 			$ssa['video']['video#'.$yt[1]] = ['title'=>$info->title,'file_id'=>$video->result->video->file_id,'like'=>$like_count,'dislike'=>$dislike_count,'view'=>$view_count];
	 			file_put_contents('data.json', json_encode($ssa));
     } 
      unlink($chat_id2.'.mp4');
	}
	if($yt[0] == 'vo'){
		$get = json_decode(file_get_contents("https://minaalabd.000webhostapp.com/api/ffgg/?url=https://www.youtube.com/watch?v=".$yt[1]));

$getinfo = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=".$yt[1]."&key=AIzaSyBkP9M661vwegLhK8KGY-GHkyTRHeyI4Zs"))->items[0];



		$info = $get->result;
	$title = $getinfo->snippet->title;
			$view_count = $getinfo->statistics->viewCount;
		$duration = $getinfo->statistics->duration;
		$like_count = $getinfo->statistics->likeCount;
		$dislike_count = $getinfo->statistics->dislikeCount;
		$url = $get; 
bot('sendChatAction' , ['chat_id' =>$chat_id2,
'action' => 'typing' ,]);

	  bot('sendMessage',[
      'chat_id'=>$chat_id2,
      'text'=>'- انتظر قليلاً ⏱؛'
     ]);
     
     $size = $url->result->size;
     if($size > 50.00){
     	bot('sendMessage',[
     		'chat_id'=>$chat_id2,
     		'text'=>'🚫 ~> لا يمكن للبوت تنزيل الملفات الكبيرة '
     		]);
     
     } else {
     file_put_contents($chat_id2.'.ogg',file_get_contents( $info->video->url));
bot('sendChatAction' , ['chat_id' =>$chat_id2,
'action' => 'record_audio' ,]);

     $voice = bot('sendvoice',[
       'chat_id'=>$chat_id2,
       'voice'=>new CURLFile($chat_id2.'.ogg'),
       'reply_markup'=>json_encode([
       		'inline_keyboard'=>[
	       			[['text'=>'👁 '.$view_count,'callback_data'=>'#']],
	       			[['text'=>'👍🏾 '.$like_count,'callback_data'=>'#'],['text'=>'👎🏾 '.$dislike_count,'callback_data'=>'#']],
	       			[['text'=>'• تحميل كـ ملف صوتي  🎬؛','callback_data'=>'dl##'.$yt[1]]],
	       			[['text'=>'~ مشاركة 💬\'','switch_inline_query'=>'voice#'.$yt[1]]],
	       			[['text'=>'• تحميل كـ فيديو  🎬؛','callback_data'=>'vi##'.$yt[1]]],
       			]
       	])
 			]);
 			$ssa['voice']['voice#'.$yt[1]] = ['file_id'=>$audio->result->audio->file_id,'like'=>$like_count,'dislike'=>$dislike_count,'view'=>$view_count];
 			file_put_contents('data.json', json_encode($ssa));
     }
      unlink($chat_id2.'.ogg');
	}


//----------------------------------//

	if($yt[0] == 'dl'){
		$get = json_decode(file_get_contents("https://minaalabd.000webhostapp.com/api/ffgg/?url=https://www.youtube.com/watch?v=".$yt[1]));


$getinfo = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=".$yt[1]."&key=AIzaSyBkP9M661vwegLhK8KGY-GHkyTRHeyI4Zs"))->items[0];


		$info = $get->result;
		$title = $getinfo->snippet->title;
			$view_count = $getinfo->statistics->viewCount;
		$duration = $getinfo->statistics->duration;
		$like_count = $getinfo->statistics->likeCount;
		$dislike_count = $getinfo->statistics->dislikeCount;
		$url = $get; 
    bot('sendChatAction' , ['chat_id' =>$chat_id2,
'action' => 'typing' ,]);

	  bot('sendMessage',[
      'chat_id'=>$chat_id2,
      'text'=>'- انتظر  ⏱؛'
     ]);


     $du = explode(':', $url->result->duration);
     $duration = ((int)$du[0] * 60) + (int)$du[1]; 
     
     $size = $url->result->size;
     if($size > 50.00 ){
     	bot('sendMessage',[
     		'chat_id'=>$chat_id2,
     		'text'=>'🚫 ~> لا يمكن للبوت تنزيل الملفات الكبيرة '
     		]);
     
     } else {
file_put_contents($chat_id2.'.mp3',file_get_contents( $info->video->url));
     bot('sendChatAction' , ['chat_id' =>$chat_id2,
'action' => 'upload_audio' ,]);
     $audio = bot('sendaudio',[
       'chat_id'=>$chat_id2,
  
              'thumb'=>'https://minaalabd.000webhostapp.com/boot/dawntube/Image.jpeg', 

       'audio'=>new CURLFile($chat_id2.'.mp3'),
   
     


       'performer'=>"@Dawntubebot",
     // 'performer'=>$url->result->channel->channelTitle,
       'title'=>$title,
       'duration'=>$duration,
       'reply_markup'=>json_encode([
       		'inline_keyboard'=>[
	       			[['text'=>'👁 '.$view_count,'callback_data'=>'#']],
	       			[['text'=>'👍🏾 '.$like_count,'callback_data'=>'#'],['text'=>'👎🏾 '.$dislike_count,'callback_data'=>'#']],
	       			[['text'=>'• تحميل كـ فيديو  🎬؛','callback_data'=>'vi##'.$yt[1]]],[['text'=>'~ مشاركة 💬\'','switch_inline_query'=>'audio#'.$yt[1]]],
	       			[['text'=>'- تحميل كـ تسجيل صوتي • 🎤','callback_data'=>'vo##'.$yt[1]]]
       			]
       	])
 			]);
 			$ssa['audio']['audio#'.$yt[1]] = ['file_id'=>$audio->result->audio->file_id,'like'=>$like_count,'dislike'=>$dislike_count,'view'=>$view_count];
 			file_put_contents('data.json', json_encode($ssa));
     }
      unlink($chat_id2.'.mp3');
	}

}






 
if($update->inline_query != null){
	$yt = explode('#', $update->inline_query->query);
	if($yt[0] == 'audio' and $ssa['audio'][$update->inline_query->query] != null){
		bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' =>json_encode([[
            	  'type'=>'audio',
            	  'audio_file_id'=>$ssa['audio'][$update->inline_query->query]['file_id'],
                'id'=>base64_encode(rand(5,555)),


                'reply_markup'=>[
                	'inline_keyboard'=>[
                		[['text'=>'👁 '.$ssa['audio'][$update->inline_query->query]['view'],'callback_data'=>'#']],
	       						[['text'=>'👍🏾 '.$ssa['audio'][$update->inline_query->query]['like'],'callback_data'=>'#'],['text'=>'👎🏾 '.$ssa['audio'][$update->inline_query->query]['dislike'],'callback_data'=>'#']],

	      	[['text'=>" اضغط هنا للدخول لبوت التحميل ", 'url'=>"https://t.me/Dawntubebot"]],

                		]
                	]
            	]])
     ]);
	} elseif($yt[0] == 'video' and $ssa['video'][$update->inline_query->query] != null){
		bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' =>json_encode([[
            	  'type'=>'video',
            	  'title'=>$ssa['video'][$update->inline_query->query]['title'],
            	  'caption'=>$ssa['video'][$update->inline_query->query]['title'],
            	  'video_file_id'=>$ssa['video'][$update->inline_query->query]['file_id'],
                'id'=>base64_encode(rand(5,555)),
                'reply_markup'=>[
                	'inline_keyboard'=>[
                		[['text'=>'👁 '.$ssa['video'][$update->inline_query->query]['view'],'callback_data'=>'#']],
	       						[['text'=>'👍🏾 '.$ssa['video'][$update->inline_query->query]['like'],'callback_data'=>'#'],['text'=>'👎🏾 '.$ssa['video'][$update->inline_query->query]['dislike'],'callback_data'=>'#']],
                		]
                	]
            	]])
     ]);
	} elseif($yt[0] == 'voice' and $ssa['voice'][$update->inline_query->query] != null){
		bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' =>json_encode([[
            	  'type'=>'voice',
            	  'title'=>$ssa['voice'][$update->inline_query->query]['title'],
            	  'caption'=>$ssa['voice'][$update->inline_query->query]['title'],
            	  'voice_file_id'=>$ssa['voice'][$update->inline_query->query]['file_id'],
                'id'=>base64_encode(rand(5,555)),
                'reply_markup'=>[
                	'inline_keyboard'=>[
                		[['text'=>'👁 '.$ssa['voice'][$update->inline_query->query]['view'],'callback_data'=>'#']],
	       						[['text'=>'👍🏾 '.$ssa['voice'][$update->inline_query->query]['like'],'callback_data'=>'#'],['text'=>'👎🏾 '.$ssa['voice'][$update->inline_query->query]['dislike'],'callback_data'=>'#']],

                		]
                	]
            	]])
     ]);
	} else {
		$item = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&q=".urlencode($update->inline_query->query)."&type=video&key=AIzaSyBkP9M661vwegLhK8KGY-GHkyTRHeyI4Zs&maxResults=10"))->items;
	  	$keyboard["inline_keyboard"]=[];
	  	 for($i=0;$i < count($item);$i++){
        $res[$i] = [


                'type'=>'article',
                'id'=>base64_encode(rand(5,555)),
                'thumb_url'=>$item[$i]->snippet->thumbnails->default->url,
                'title'=>$item[$i]->snippet->title,

                'input_message_content'=>['parse_mode'=>'HTML','message_text'=>"https://www.youtube.com/watch?v=".$item[$i]->id->videoId],
          ];
    }

	  	$r = json_encode($res);
    bot('answerInlineQuery',[
            'inline_query_id'=>$update->inline_query->id,    
            'results' =>($r)

        ]);
	}



}





if($text == "/start" && $chat_id != $sudo) {
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
 ",
'reply_to_message_id'=>$message->message_id,
]);
bot('sendMessage',[
'chat_id'=>$sudo,
'text'=>"
  ٭ تم دخول شخص الى البوت الخاص بك 🔰؛

• معلومات العضو ، 👋🏻.

• الاسم ؛ $name ،

• المعرف ؛ @$username ،

• الايدي ؛ $from_id ،

• اليوم ؛ " . date("j") . "\n" . " 
",
]);
}






if (preg_match('https://www.facebook.com\/[a-z1-9.-_]+/', $text)) {

  $url = json_decode(file_get_contents("https://minaalabd.000webhostapp.com/api/facea/?url=$text"));
$m = $url->result->url;
  file_put_contents('face.mp4', file_get_contents($m));
  bot('sendvideo',[
    'chat_id'=>$chat_id,
    'video'=>new CURLFile('face.mp4'),
    ]);

}








                
    

