<?php
$userInputURL = readline("Enter URL (long form): ");
$ch = curl_init("https://cleanuri.com/api/v1/shorten");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "url=$userInputURL");

$serverOutput = curl_exec($ch);
curl_close($ch);

echo $serverOutput . PHP_EOL;