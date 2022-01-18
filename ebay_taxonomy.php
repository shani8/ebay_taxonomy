<?php
include 'connection.php';
$sql = "SELECT * FROM ebay_taxonomy_oauth";
$result = mysqli_query($conn, $sql);
$rec = mysqli_fetch_array($result);

$access_tokken = $rec['access_tokken'];
$expiration = $rec['expiration'];

$currentDate = date('Y-m-d h:i:s');
$tokkenDate = $expiration;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Searching With Different Algo's</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>

        <!-- Font Awesome -->
        <link
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          rel="stylesheet"
        />
        <!-- Google Fonts -->
        <link
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
          rel="stylesheet"
        />
        <!-- MDB -->
        <link
          href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
          rel="stylesheet"
        />

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                margin: 40px;
            }
        </style>
    </head>
    <body class="antialiased">
        <form id="form">
          
   <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 text-center">Save Json to Database</h1>
        
        <div class="d-flex justify-content-center" style="margin:20px 0px">
          
          <?php if($access_tokken == "" || $access_tokken == null || ($currentDate >= $tokkenDate))
          {
          ?>
          <button id="update_btn" class="btn btn-outline-danger">Update Tokken</button>
          &ensp;
          <?php 
          }
          ?>

          <button id="btn" class="btn btn-outline-primary">Save</button>
        </div>
        
        <div style="margin: 05px;color:green;font-size: 16px; font-weight: bold;font-style: italic;" class="d-flex justify-content-center" id="result"></div>
       
        <div class="d-flex justify-content-center" style="margin:20px 0px">
          
          <img src="loading.gif" id="loading_gif" class="h-25 w-25" alt="Loading..">

        </div>

        
       
    </body>
</html>

<script src="https://www.w3schools.com/js/myScript.js"></script> 
<script type="text/javascript">


$(document).ready(function() {
     
    $("#loading_gif").hide();

    $('#btn').click(function(event) {
        event.preventDefault();
        $("#result").text("");
        $("#loading_gif").show();

        $.ajax({
           url: 'add_data.php',
           error: function(xhr, statusText, err) 
           {
             $("#loading_gif").hide();
             $("#result").css("color", "red");
             $("#result").text("error"+xhr.status);
             // alert("error"+xhr.status);
           },

           success: function(data) {
    
             if(data)
             {
                $("#loading_gif").hide();
                $("#result").text("Data is inserted Successfully..");
             }
           },
           type: 'GET'
        });

     });

    $('#update_btn').click(function(event) {
        event.preventDefault();

        $.ajax({
           url: 'update_tokken.php',
           error: function(xhr, statusText, err) 
           {
             $("#result").css("color", "red");
             $("#result").text("error"+xhr.status);

           },

           success: function(data) {
            
             if(data)
             {
               $('#update_btn').hide();
             }

           },
           type: 'GET'
        });

     });
});


</script>
