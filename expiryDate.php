<?php
session_start();
/* if(!isset($_SESSION['adminPassword']))
{
    header("location:login.php");
} */ 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Expiry Dates</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function(){
      $("#mySearch").on("keyup",function(){
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function(){
          $(this).toggle($(this).text().toLowerCase().indexOf(value)>-1)
        });
      });
    });
    </script>
</head>
 	
    <style>
		body {
			background: url() no-repeat center center/cover;
			
		}

        @media (max-width: 767px) {
        ul.navbar-nav {
        background-color: green !important;
            }
        }
        @media (min-width: 768px) {
        ul.navbar-nav {
            background-color: #ffffff !important;
           }
        }

        h5{ 
            font-family:Verdana, Geneva, Tahoma, sans-serif;  
            color:rgba(138, 10, 48, 0.932);
            font-weight: 550;
            padding-right: 10px;
            margin-top:-12.5%;
            margin-left:21%;
    
        } 

        #h7{ 
            font-family:Verdana, Geneva, Tahoma, sans-serif;  
            color:rgba(138, 10, 48, 0.932);
            font-weight: 550;
            padding-right: 10px;
            text-align: center;  
    
        } 

    table {
      border-collapse: collapse;
      width: 90%;
      margin-left:5%;
    }
    th, td {
      text-align: left;
      padding: 8px;
    }
    th {
      background-color: blue;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:nth-child(odd) {
      background-color: darkorange;
    }
    .print-button {
      margin-top: 20px;
      margin-left:35%;
    }

    #picDisplay{
        width:15px;
        height:15px;
    }
</style>

<body>

<div style="background-color: blue; width: 100%; height: 38px;" class="fixed-position fixed-top">
  
  </div>

<nav style="margin-top: 25px; background-color: white; border-bottom:1px solid; border-color:rgba(138, 10, 48, 0.932);" class="navbar navbar-expand-lg navbar-expand-xl fixed-top">
    
    <div style = "margin-left:-8px;" class="container">
      <a href="Home.php" class="navbar-brand"><img style="width: 100px; margin-left:-20px;" src="medical-symbol.jpg"> <h5>REGINA OBENG LICENCED</h5></a>
     <br>
    </div>
    </nav><br><br><br><br><br><br>


           <div>
           <input style="width:70%; height:35px; border:0.1px solid; margin-left:15%;" 
            type="search" id="mySearch" class="form-control" placeholder="Search here..."><br>

            <div id="h7" >EXPIRY DATES OF DRUGS IN STOCK</div><br><br>

  <table id="myTable">
    <tr>
      <th>Name of Drug</th>
      <th>Quantity</th>
      <th>Expiry Date</th>
      <th>Days Left</th>
      <th>D/T Added</th>
    </tr>

    <?php
     include "connection.php";

      $stmt = mysqli_prepare($con, "SELECT * FROM stock");
      mysqli_stmt_execute($stmt);
      $results = mysqli_stmt_get_result($stmt);
      
      $count = 1;
      while ($row = mysqli_fetch_assoc($results)) {
        $currentDate = new DateTime();  // Current date and time
        $expiryDate = new DateTime($row['expiryDate']);
  
        $interval = $currentDate->diff($expiryDate);
        $daysDifference = $interval->format('%a');  // %a represents the total number of days
        
        echo "<tr>";
        echo "<td>" ."<span style='color:red;'>".$count."</span>".". ". $row['drugName'] . "</td>";
        echo "<td>" . $row['qty'] . "</td>";
        echo "<td>" . $row['expiryDate']. "</td>";
        echo "<td>". $daysDifference ."</td>";
        echo "<td>" . $row['addedDate'] . "</td>";
        echo "</tr>";

        $count++;
        
      } 
    ?>

  </table><br><br>
       <div class="print-button">
        <div class="row">
        <div class="col-sm-4">
            <button class="btn btn-danger" onclick="window.print()">Print Report</button>
        </div>
    </div>
    </div>