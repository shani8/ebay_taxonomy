<?php
ini_set('max_execution_time', 0);
include 'connection.php';

$data = file_get_contents ("item_file.json"); 
$json = json_decode($data, true);
$status = false;
// echo count($json["aspects"]);
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
    $sql = "INSERT INTO `ebay_taxonomy_category_fields` (`localizedAspectName`,
      `aspectDataType`,
      `itemToAspectCardinality`,
      `aspectMode`,
      `aspectRequired`,
      `aspectUsage`, 
      `aspectEnabledForVariations`)
       VALUES ('".$json ["aspects"][$i]["localizedAspectName"]."',
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
         
          $sql = "INSERT INTO `ebay_taxonomy_category_field_values`(`ebay_taxonomy_category_fields_id`, `localizedValue`) VALUES ('".$id."','".$value["localizedValue"]."')"; 
          $conn->query($sql);

          $status = true;

      }

       
    }

}

 echo $status;

?>