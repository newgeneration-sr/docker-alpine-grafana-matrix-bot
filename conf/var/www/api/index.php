<?php
/*
Exemple
{
  "dashboardId":1,
  "evalMatches":[
    {
      "value":1,
      "metric":"Count",
      "tags":{}
    }
  ],
  "imageUrl":"https://grafana.com/assets/img/blog/mixed_styles.png",
  "message":"Notification Message",
  "orgId":1,
  "panelId":2,
  "ruleId":1,
  "ruleName":"Panel Title alert",
  "ruleUrl":"http://localhost:3000/d/hZ7BuVbWz/test-dashboard?fullscreen\u0026edit\u0026tab=alert\u0026panelId=2\u0026orgId=1",
  "state":"alerting",
  "tags":{
    "tag name":"tag value"
  },
  "title":"[Alerting] Panel Title alert"
}

*/

$access_token = "{ACCESS_TOKEN}";
if(isset($_GET['access_token']) && $_GET['access_token'] == $access_token){

  $MESSAGE = "⚠️ : " . $_POST["title"];
	$MESSAGE .= "\n";
	$MESSAGE .= $_POST["evalMatches"]["value"];
	$MESSAGE .= "\n";
	$MESSAGE = $_POST["message"];
	    
  $URL = "https://{SYNAPSE_SERVER}/_matrix/client/r0/rooms/{ROOM_ID}:{SYNAPSE_SERVER}/send/m.room.message?access_token={BOT_TOKEN}";
	
	$data = array(
		'msgtype'=>'m.text',
		'body'=>$MESSAGE
	);
	
	$post_data = json_encode($data);
	$crl = curl_init($URL);
	curl_setopt($crl, CURLOPT_RETURNTRANFERT, true);
	curl_setopt($crl, CURLINFO_HEADER_OUT, true);
	curl_setopt($crl, CURLOPT_POST, true);
	curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	
	echo curl_exec($crl);
	curl_close($crl);
}else{
	echo "Only post requests are allowed";
}
?>
