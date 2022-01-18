<?php
include 'connection.php';

$sql = "SELECT * FROM ebay_taxonomy_oauth";
$result = mysqli_query($conn, $sql);
$rec = mysqli_fetch_array($result);
$random_string_tokken = substr(md5(mt_rand()), 0, 7);

if(mysqli_num_rows($result) > 0)
{

$expiration = $rec['expiration'];
$expiration = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($expiration)));
$sql = "UPDATE `ebay_taxonomy_oauth` SET `access_tokken`='".$random_string_tokken."',`expiration`='".$expiration."' WHERE client_id = '0'"; 
}
else
{
	$currentDate = date('Y-m-d h:i:s');
	$currentDate = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($currentDate)));
	$sql = "INSERT INTO `ebay_taxonomy_oauth` (`client_id`, `secret_key`, `access_tokken`, `expiration`) VALUES ('0','kjlieahjaldlal','".$random_string_tokken."','".$currentDate."')"; 
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