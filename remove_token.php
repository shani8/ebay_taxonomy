<?php
include 'connection.php';

    $uname = "SaleemKh-Sqwigl-SBX-f500f24f5-471a9b31";
    $del_token ="DELETE FROM ebay_taxonomy_oauth  WHERE client_id = '".$uname."'";
    
    if($conn->query($del_token))
    {
    	echo "1";
    }
    else
    {
    	echo "0";
    }


?>