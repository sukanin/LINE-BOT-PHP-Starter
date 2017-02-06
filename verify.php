<?php

$access_token = 'EocVKs2o8oTb99Rlb7iVrfHXVAoH+i9u3Zs87YE66EJ/bVcxJDDEOIpwUuEP4UUaVCDjPqaIhN93KR3kTX6UBQU+U+8PM3BlA1sAH2KMb77mMWT96Th69Volm9gfR5YPs0g5QIjN1k/TAVBnKL4scwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;