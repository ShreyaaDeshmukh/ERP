<?php 
/*function iosSend($deviceToken,$Data,$appType=''){
	
	$passphrase = 'abc123';
	$ctx = stream_context_create();
	stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/mindcrew/public_html/Streattag/includes/Streettags.pem');
	
	stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
	$fp = stream_socket_client(
	'ssl://gateway.sandbox.push.apple.com:2195', $err,
	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
	
	if (!$fp)
	exit("Failed to connect: $err $errstr" . PHP_EOL);
	
	$body['aps'] = $Data;
	$payload = json_encode($body);
	$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
	$result = fwrite($fp, $msg, strlen($msg));
	print_r($result);die;
	fclose($fp);
     
	if (!$result)
	 return false;
	
	else
	return true;
	
}
*/

function send_ios_notification($deviceToken,$message,$type){
$passphrase = 'abc123';
$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', '/var/www/html/streattag/includes/Streettagsdevlop.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
// Open a connection to the APNS server
$fp = stream_socket_client(
'ssl://gateway.sandbox.push.apple.com:2195', $err,  // For development
// 'ssl://gateway.push.apple.com:2195', $err, // for production
$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
if (!$fp)
exit("Failed to connect: $err $errstr" . PHP_EOL);
//echo 'Connected to APNS' . PHP_EOL;
// Create the payload body
$body['aps'] = array(
'alert' => trim($message),
'sound' => 'default',
'type'	=> $type
);
// Encode the payload as JSON
$payload = json_encode($body);
// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', trim($deviceToken)) . pack('n', strlen($payload)) . $payload;
// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));
if (!$result){
//echo 'Message not delivered' . PHP_EOL;
}
else
{
//echo 'Message successfully delivered' . PHP_EOL;
return $result;
}
// Close the connection to the server
fclose($fp);
}


//  Now you can use bellow php function to send IOS push notification
// My device token
#$deviceToken = '439bed8939d5de251f36b0e487c1393840da3561b5a87bf8bc1eed838b5edab0';
// My message
#$message = 'My first push notification!';
#$result = send_ios_notification($deviceToken,$message, "test");
// Debug your resul
#var_dump($result);


