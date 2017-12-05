<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$username             = '';
$apiKey               = '';

echo $data = batchInvoeren();

$curlSettings = [
    CURLOPT_URL => 'https://YOUR_URL.api.mailchimp.com/3.0/batches',
    CURLOPT_RETURNTRANSFER =>  1,
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS =>  $data,
    CURLOPT_USERPWD =>  $username.':'.$apiKey
];

$ch = curl_init();
curl_setopt_array($ch, $curlSettings);
$response = curl_exec($ch);
curl_close($ch);

echo $response;

function batchInvoeren() {

    $body = array('email_address' => 'piet@home.nl', 'status' => 'subscribed', 'merge_fields' => ['FNAME'=> 'pieteke', 'LNAME' => 'paulus']);
    $path = 'lists/9c551cde77/members';
    $operation[]    = array
    (
        'body'      => json_encode($body),
        'method'    => 'POST',
        'path'      => $path
    );
    return $request = json_encode(array('operations' => $operation));
}