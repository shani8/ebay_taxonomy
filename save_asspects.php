<?php
ini_set('max_execution_time', 0);
include 'connection.php';
include 'get_data_from_api.php';

$data = $resp; 
$json = json_decode($data, true);
$status = false;

$sql = "SELECT * FROM ebay_taxonomy_category_fields where cat_id =".$catID."";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0)
  {
    $del_category_fields ="DELETE FROM ebay_taxonomy_category_fields where cat_id =".$catID."";
    $conn->query($del_category_fields);
  } 

$sql = "SELECT * FROM ebay_taxonomy_category_field_values where cat_id =".$catID."";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0)
  {
    $del_category_field_values ="DELETE FROM ebay_taxonomy_category_field_values where cat_id =".$catID."";
    $conn->query($del_category_field_values);
  }

for($i=0; $i<count($json["aspects"]); $i++)
{
  $aspectRequired = 0;
  $aspectEnabledForVariations = 0;
  $id =0;

  if($json ["aspects"][$i]["aspectConstraint"]["aspectRequired"])
  {
     $aspectRequired = 1;
  }
  if($json ["aspects"][$i]["aspectConstraint"]["aspectEnabledForVariations"])
  {
     $aspectEnabledForVariations = 1;
  }
    $sql = "INSERT INTO `ebay_taxonomy_category_fields` (
      `cat_id`,
      `localizedAspectName`,
      `aspectDataType`,
      `itemToAspectCardinality`,
      `aspectMode`,
      `aspectRequired`,
      `aspectUsage`, 
      `aspectEnabledForVariations`)
       VALUES ('".$catID."','".$json ["aspects"][$i]["localizedAspectName"]."',
              '".$json ["aspects"][$i]["aspectConstraint"]["aspectDataType"]."',
              '".$json ["aspects"][$i]["aspectConstraint"]["itemToAspectCardinality"]."',
              '".$json ["aspects"][$i]["aspectConstraint"]["aspectMode"]."',
              '".$aspectRequired."',
              '".$json ["aspects"][$i]["aspectConstraint"]["aspectUsage"]."',
              '".$aspectEnabledForVariations."')";
       
       if ($conn->query($sql) === TRUE) 
       {
          $id = $conn->insert_id;
       }

    if(isset($json ["aspects"][$i]["aspectValues"]))
    {

      foreach ($json ["aspects"][$i]["aspectValues"] as $key => $value) 
      {
         
          $sql = "INSERT INTO `ebay_taxonomy_category_field_values`(`cat_id`,`ebay_taxonomy_category_fields_id`, `localizedValue`) VALUES ('".$catID."','".$id."','".$value["localizedValue"]."')"; 
          $conn->query($sql);

          $status = true;

      }

       
    }

}

 echo $status;

?>