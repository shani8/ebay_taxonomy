<?php
include 'connection.php';
include 'crl_response.php';

$sql = "SELECT * FROM ebay_taxonomy_oauth";
$result = mysqli_query($conn, $sql);
$rec = mysqli_fetch_array($result);


$random_string_tokken = $access_token;
$currentDate = date('Y-m-d h:i:s');
$currentDate = date('Y-m-d H:i:s',strtotime('+'.$expiry_seconds.' seconds',strtotime($currentDate)));

// die($currentDate);

if(mysqli_num_rows($result) > 0)
{

    $sql = "UPDATE `ebay_taxonomy_oauth` SET `access_tokken`='".$random_string_tokken."',`expiration`='".$currentDate."' WHERE client_id = '".$uname."'"; 
}
else
{

	$sql = "INSERT INTO `ebay_taxonomy_oauth` (`client_id`, `secret_key`, `access_tokken`, `expiration`) VALUES ('".$uname."','".$pass."','".$random_string_tokken."','".$currentDate."')"; 
}

if($conn->query($sql))
{
   echo true;
}
else
{
   echo false;
}



?>