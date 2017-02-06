<?php

$access_token = 'EocVKs2o8oTb99Rlb7iVrfHXVAoH+i9u3Zs87YE66EJ/bVcxJDDEOIpwUuEP4UUaVCDjPqaIhN93KR3kTX6UBQU+U+8PM3BlA1sAH2KMb77mMWT96Th69Volm9gfR5YPs0g5QIjN1k/TAVBnKL4scwdB04t89/1O/w1cDnyilFU=';

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
			// Get user id
			$user_id = $event['source']['userId'];
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Build message to reply back
			if (strcmp($text,'get userid') == 0) {
				$messages = [
					'type' => 'text',
					'text' => $user_id
				];
			}

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
echo "OK2";