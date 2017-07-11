<?php
$access_token = 'niqtMxsHB7JmZr4A6gVWTU0n1e+Q1gYjeqD7F/dMfFpq7AATRdCB4ykf+98d6YrvwoER6NOQsYScpqViOIy+4nImOcJ1oFvXq6+JR7MkHvPcap7VtIUjVgzYBEdhPaZRhjIpGzx7y5ND2RP01FYxmQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;