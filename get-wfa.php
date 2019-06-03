<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$service_url = 'https://api.webflow.com/collections/5cf14e3321b2ce688ee7ee60/items?api_version=1.0.0&access_token=a6bb5ed5a1d1a88a0ef1a37be52f58c12892c489981aff5f8db49d8a37cf3e07';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);

if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additional info: ' . var_export($info));
}
curl_close($curl);

$decoded = json_decode($curl_response,true);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}

echo json_encode($decoded);
?>