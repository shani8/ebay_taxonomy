<?php
include 'connection.php';
$sql = "SELECT * FROM ebay_taxonomy_oauth";
$result = mysqli_query($conn, $sql);
$rec = mysqli_fetch_array($result);

$access_token = $rec['access_token'];
$expiration = $rec['expiration'];

  if($rec['mode'] == 1)
  {
   $mode = "Live";
  }
  else
  {
   $mode = "SandBox";
  }

$currentDate = date('Y-m-d h:i:s');
$tokkenDate = $expiration;
// echo $currentDate;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ebay Taxonomy</title>

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
    <h1 class="h3 mb-2 text-gray-800 text-center">Ebay Taxonomy</h1>

      <?php if($access_token == "" || $access_token == null || ($currentDate >= $tokkenDate))
      {
      ?>        
        <!-- <div class="container"> -->
          <div class="container">
           <div class="row justify-content-center pt-2">
            <div class="form-group col-md-4 col-md-offset-5 align-center ">
                <select id="urlMode" name="urlMode" class="form-control">
                <option value="">---Select---</option>  
                <option value='1'>Live</option>  
                <option value='0'>SandBox</option>  
                </select>
            </div>
            </div>


            <div class="row justify-content-center pt-2">
            <div class="form-group col-md-4 col-md-offset-5 align-center ">

                <button id="generate_token_btn" class="btn btn-outline-danger">Generate Tokken</button>

            </div>
            </div>


           </div> 
     <?php 
        }
        else
        {
        ?>
        <div style="margin: 05px;color:green;font-size: 16px; font-weight: bold;font-style: italic;" class="d-flex justify-content-center"><span style="color: red; margin-right: 4px">Mode:</span> <?php echo $mode; ?></div>
        <div style="margin: 05px;color:green;font-size: 16px; font-weight: bold;font-style: italic;" class="d-flex justify-content-center"><span style="color: red; margin-right: 4px">Expiration:</span> <?php echo $expiration; ?></div>
        <!-- <div class="container"> -->
          <div class="container">

            <div class="row justify-content-center pt-2">
            <div class="form-group col-md-4 col-md-offset-5 align-center ">
               <input type="text" name="cat_id" id="cat_id" placeholder="Category ID" class="form-control" />
            </div>
            </div>
            <div class="row justify-content-center pt-2">
            <div class="form-group col-md-4 col-md-offset-5 align-center ">
                <button id="btn" class="btn btn-outline-primary">Fetch Aspects</button>
            </div>
            </div>


           </div> 


        <?php
        }
        ?>     

        

        

        <!-- </div> -->
        
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
        
        $('#btn').attr("disabled", true);

        var catID = $("#cat_id").val();

        if(catID == "")
        {
           $("#result").css("color", "red");
           $("#result").text("Please enter Category ID");
           $("#cat_id").focus();
           $("#btn").removeAttr("disabled");
           return false; 
        }

        $("#result").text("");
        $("#loading_gif").show();

        var data = 'catID='+catID;
        
        $.ajax({
        type:"GET",
        cache:false,
        url: "save_asspects.php",
        data: data,
        success: function (response) {

            if(response)
             {
                $("#loading_gif").hide();
                $("#result").css("color", "green");
                $("#result").text("Data is inserted Successfully..");
                $("#btn").removeAttr("disabled");
             }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           // console.log(textStatus, errorThrown);
             $("#loading_gif").hide();
             $("#result").css("color", "red");
             $("#result").text("Error: Something went wrong..");
             $("#btn").removeAttr("disabled");
             // alert("error"+xhr.status);
        }
        });

     });

    $('#generate_token_btn').click(function(event) {
        event.preventDefault();
        
        $('#generate_token_btn').attr("disabled", true);

        var urlMode = $("#urlMode").val();
        
        if(urlMode == "")
        {
           $("#result").css("color", "red");
           $("#result").text("Please select url");
           $("#url").focus();
           $("#generate_token_btn").removeAttr("disabled");
           return false; 
        }

        $("#result").text("");
        $("#loading_gif").show();
        
        var data = 'urlMode='+ urlMode;
        
        $.ajax({
        type:"GET",
        cache:false,
        url: "generate_tokken.php",
        data: data,
        success: function (response) {
           // alert(response);
            if(response == 1)
             {
              
                $("#loading_gif").hide();
                $("#result").css("color", "green");
                $("#result").text("Token is generated Successfully..");
                // $("#generate_token_btn").removeAttr("disabled");
                location.reload();
             }
             else
             {
               $("#loading_gif").hide();
               $("#result").css("color", "red");
               $("#result").text("Error: Something went wrong..");
               $("#generate_token_btn").removeAttr("disabled");
             }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           // console.log(textStatus, errorThrown);
             $("#loading_gif").hide();
             $("#result").css("color", "red");
             $("#result").text("Error: Something went wrong..");
             $("#generate_token_btn").removeAttr("disabled");
             // alert("error"+xhr.status);
        }
        });

     });
});


</script>