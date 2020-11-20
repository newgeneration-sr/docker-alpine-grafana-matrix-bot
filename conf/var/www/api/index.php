<?php

$access_token = "{ACCESS_TOKEN}";
if($_POST['access_token'] == $access_token){
	$MESSAGE = "TEST !";
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
