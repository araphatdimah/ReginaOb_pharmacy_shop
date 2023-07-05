<?php
session_start();
if(!isset($_SESSION['adminPassword']))
{
    header("location:login.php");
} 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Stock of Drugs</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function(){
      $("#searchBtn").on("keyup",function(){
        var value = $(this).val().toLowerCase();
        $("#salesTable tr").filter(function(){
          $(this).toggle($(this).text().toLowerCase().indexOf(value)>-1)
        });
      });
    });
    </script>
</head>
 	
    <style>
		body {
			background: url(ndc\ flag.jpeg) no-repeat center center/cover;
			
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
      width: 93%;
      margin-left: 3%;
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

    #btns{
        background-color: darkorange;
        border: 1px solid;
        border-radius: 3px;
        margin-top: 10px;
        margin-left:-10%;
        
    }

    #btns:hover {
        background-color:black;
      }

      #lin{
        text-decoration: none;
        font-weight:500;
        padding: 7px;
        color:white;
        
      }
</style>

<body>

<div style="background-color: blue; width: 100%; height: 38px;" class="fixed-position fixed-top">
  
  </div>

<nav style="margin-top: 25px; background-color: white; border-bottom:1px solid; border-color:rgba(138, 10, 48, 0.932);" class="navbar navbar-expand-lg navbar-expand-xl fixed-top">
    
    <div style = "margin-left:-8px;" class="container">
      <a href="Home.php" class="navbar-brand"><img style="width: 100px; margin-left:-20px;" src="medical-symbol.jpg"> <h5>REGINA OBENG LICENCED</h5></a>
    </div>
    <div>
      <button id="btns"><a id="lin" href="adminLogoff.php">Log Off</a></button><br>
              
    </div>
    </nav><br><br><br><br><br><br>

           <input style="width:70%; height:35px; border:0.1px solid; margin-left:15%;" 
            type="search" id="searchBtn" class="form-control" placeholder="Search..."><br>
            
            <div id="h7">SALES REPORT & STATISTICS</div>
           <div><br>       
  <table id="salesTable">
    <tr>
      <th>Drug Name</th>
      <th>Amt Sold</th>
      <th>Qty sold</th>
      <th>Qty Left</th>
      <th>Profit</th>
    </tr>

    <?php
      
      include "connection.php";

    $stmt7 = mysqli_prepare($con, "SELECT * FROM salestoday");
    mysqli_stmt_execute($stmt7);
    $queryResults = mysqli_stmt_get_result($stmt7);


    $salesTotalContainer = array();

    while ($rowForSales = mysqli_fetch_assoc($queryResults)) {
        $forDrugName = $rowForSales['drugName'];
        $salesAmtTotal = $rowForSales['soldAmt'];
        $salesQtyTotal = $rowForSales['qtySold'];
    
        if (array_key_exists($forDrugName, $salesTotalContainer)) {
            $salesTotalContainer[$forDrugName]['amtTotal'] += $salesAmtTotal;
            $salesTotalContainer[$forDrugName]['qtyTotal'] += $salesQtyTotal;
        } else {
            $salesTotalContainer[$forDrugName] = array(
                'amtTotal' => $salesAmtTotal,
                'qtyTotal' => $salesQtyTotal
            );
        }
        }
    
   

    foreach ($salesTotalContainer as $forDrugName => $salesData) {
      $stmt8 = mysqli_prepare($con, "SELECT * FROM stock WHERE drugName = ?");
      mysqli_stmt_bind_param($stmt8, "s", $forDrugName);
      mysqli_stmt_execute($stmt8);
      $stockResults = mysqli_stmt_get_result($stmt8);
      $stockArray = mysqli_fetch_assoc($stockResults);

      $stmt9 = mysqli_prepare($con, "SELECT * FROM tempBackup WHERE drugName = ?");
      mysqli_stmt_bind_param($stmt9, "s", $forDrugName);
      mysqli_stmt_execute($stmt9);
      $diffResults = mysqli_stmt_get_result($stmt9); 

      $qtyLeft = 0;
      while($diffRow = mysqli_fetch_assoc($diffResults))
      {
        $qtyLeft += $diffRow['qtySold'];
      }
      $TotalLeft = $stockArray['qty'] - $qtyLeft; 
      
      $totalCostNow = $salesTotalContainer[$forDrugName]['qtyTotal'] * $stockArray['unitCost'];
 
        echo "<tr>";
        echo "<td>" . $forDrugName . "</td>";
        echo "<td><span>GHS</span> ". number_format($salesData['amtTotal'], 2) . "</td>";
        echo "<td>" . $salesData['qtyTotal'] . "</td>";
        echo "<td>". $TotalLeft . "</td>";
        echo "<td><span>GHS</span> ". number_format($salesTotalContainer[$forDrugName]['amtTotal'] - $totalCostNow, 2) ."</td>";
        echo "</tr>";
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
    </body>
</html>