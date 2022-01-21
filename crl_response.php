<?php

  $url = 'https://api.sandbox.ebay.com/identity/v1/oauth2/token';

  $uname = "SaleemKh-Sqwigl-SBX-f500f24f5-471a9b31";
  $pass = "SBX-500f24f593fa-3cd2-4ced-bf6a-9cf9";

  $headers = array(
    "cache-control: no-cache",
    'application/x-www-form-urlencoded',
    'Authorization: Basic '. base64_encode($uname . ":" . $pass) 
  ); 

  $post_data = 'grant_type=client_credentials&scope=https://api.ebay.com/oauth/api_scope';

  $crl = curl_init($url);
  curl_setopt($crl, CURLOPT_POST, 1);
  curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
  curl_setopt($crl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec($crl);

 $resultArray = json_decode($result, true);

 $access_token = $resultArray["access_token"];
 $expiry_seconds = $resultArray["expires_in"];
 $token_type = $resultArray["token_type"];

?>


