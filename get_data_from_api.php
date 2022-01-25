<?php
// var_dump($_POST);
// include 'connection.php';

$uname = "SaleemKh-Sqwigl-SBX-f500f24f5-471a9b31";
$sql = "SELECT * FROM ebay_taxonomy_oauth WHERE client_id = '".$uname."'";
$result = mysqli_query($conn, $sql);
$rec = mysqli_fetch_array($result);

$token = $rec['access_token'];

$urlMode = $rec['mode'];
$catID = $_GET['catID'];

  if($urlMode == 0)
  {
    $url ='https://api.sandbox.ebay.com/commerce/taxonomy/v1/category_tree/0/get_item_aspects_for_category?category_id='.$catID;
  }
  else if($urlMode == 1)
  {

   $url ='https://api.ebay.com/commerce/taxonomy/v1/category_tree/0/get_item_aspects_for_category?category_id='.$catID;
  }


echo $url;

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Authorization: Bearer $token",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);

// print_r($resp);

?>


