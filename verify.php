<?php
require_once 'connent/db.php';
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.slipmate.ai/open-api/v1/verify',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('file' => new CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: multipart/form-data',
        'X-API-KEY: ' . $apikey
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
