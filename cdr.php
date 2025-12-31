<?php
// ---- WAMP SAFE ENV SETUP ----
putenv("VOBIZ_AUTH_ID=MA_HBHNNLV7");
putenv("VOBIZ_AUTH_TOKEN=xfqiPaeTk6KIiZWVLXfbNWaQSvRRjrCurLn8jPcPStk4XehzHesP8SjoThlJqB2c");

// ---- READ ENV ----
$authId = getenv('VOBIZ_AUTH_ID');
$authToken = getenv('VOBIZ_AUTH_TOKEN');

if (!$authId || !$authToken) {
  http_response_code(500);
  header("Content-Type: application/json");
  echo json_encode(["error" => "Server misconfiguration"]);
  exit;
}

// ---- API CALL ----
$ch = curl_init();

curl_setopt_array($ch, [
  CURLOPT_URL => "https://api.vobiz.ai/api/v1/account/$authId/cdr",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "X-Auth-ID: $authId",
    "X-Auth-Token: $authToken"
  ]
]);

$response = curl_exec($ch);
curl_close($ch);

// ---- OUTPUT ----
header("Content-Type: application/json");
echo $response;
