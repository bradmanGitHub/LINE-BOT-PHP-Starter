<?php
require_once __DIR__.'/vendor/autoload.php';
use Wit\Wit;
$app = new Wit(array(
    'default_access_token' => 'VTNKPHFNIEYJVKPR3QPVXU3XG43PDHYK')
);

$access_token = 'niqtMxsHB7JmZr4A6gVWTU0n1e+Q1gYjeqD7F/dMfFpq7AATRdCB4ykf+98d6YrvwoER6NOQsYScpqViOIy+4nImOcJ1oFvXq6+JR7MkHvPcap7VtIUjVgzYBEdhPaZRhjIpGzx7y5ND2RP01FYxmQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];


			//--invoke wit.ai --------------- START
			//$response = $app->get('/intents');
			//var_dump($response->getDecodedBody());
			
			$data = [
			    "name" => "food_request",
			    "doc"  => "detect food request",
			    "expressions" => [
			        ["body" => $text]
			        //,
			        //["body" => "I want to fly from london to sfo"],
			        //["body" => "need a flight from paris to tokyo"],
			    ]
			];
			
			$response = $app->post('/intents', $data);
			//$messageStr = var_dump($response->getDecodedBody());
			//$messageStr = $response->getDecodedBody();
			//--invoke wit.ai --------------- END


			// Build message to reply back
			$messages = [
				'type' => 'text',
				//'text' =>  'OK Boss..'. $text
				'text' => $response . '_kk'
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";