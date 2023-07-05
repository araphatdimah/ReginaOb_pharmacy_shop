<?php
session_start();
if(!isset($_SESSION['adminPassword']))
{
    header("location:login.php");
} 

if($_SERVER['REQUEST_METHOD']=='POST')
{

    include "connection.php";
    $drugName = $_POST['drugName'];
    $qty = $_POST['qty'];
    $expiryDate = $_POST['expiryDate'];
    $unitCost = $_POST['unitCost'];
    $unitPrice = $_POST['unitPrice'];

    $random_count = "";

    $num = rand(7, 15);
    for($i=0; $i<$num; $i++)
    {
       $random_count .=rand(0,9);  
    }
    $drugID =$random_count;

    $salesTodayQtySold = 0;
    $salesTodayAmtSold = 0;

    if(is_numeric($unitPrice) && !is_numeric($drugName) && !empty($drugName)
        && !empty($expiryDate) && !empty($unitPrice))
        {
        $sql = mysqli_prepare($con, "SELECT * from stock where drugName = ?");
        mysqli_stmt_bind_param($sql, "s", $drugName);
        mysqli_stmt_execute($sql);
        $result = mysqli_stmt_get_result($sql);

        if(mysqli_num_rows($result)>0)
        {
            $stockRow = mysqli_fetch_assoc($result);
            $newQty = $qty + $stockRow['qty'];

            $stmt11 = mysqli_prepare($con, "UPDATE stock SET qty = ?, expiryDate = ?, unitCost = ?, unitPrice = ? WHERE drugName = ?");
            mysqli_stmt_bind_param($stmt11, "issss", $newQty, $expiryDate, $unitCost, $unitPrice, $drugName);
            
            if(mysqli_stmt_execute($stmt11))
            {
                $stmt13 = mysqli_prepare($con, "SELECT * FROM salestoday WHERE drugName = ?");
                mysqli_stmt_bind_param($stmt13, "s", $drugName);
                mysqli_stmt_execute($stmt13);
                $salesTodayResults = mysqli_stmt_get_result($stmt13);
                while($salesTodayRow = mysqli_fetch_assoc($salesTodayResults))
                {
                $stmt12 = mysqli_prepare($con, "UPDATE salestoday set qtySold = ?, soldAmt = ? WHERE drugName = ?");
                mysqli_stmt_bind_param($stmt12, "iis", $salesTodayQtySold, $salesTodayAmtSold, $salesTodayRow['drugName']);
                mysqli_stmt_execute($stmt12);
                }
    
                $stmt14 = mysqli_prepare($con, "SELECT * FROM salestemp WHERE drugName = ?");
                mysqli_stmt_bind_param($stmt14, "s", $drugName);
                mysqli_stmt_execute($stmt14);
                $salesTempResults = mysqli_stmt_get_result($stmt14);
                while($salesTempRow = mysqli_fetch_assoc($salesTempResults))
                {
                $stmt15 = mysqli_prepare($con, "UPDATE salestemp set qtySold = ?, soldAmt = ? WHERE drugName = ?");
                mysqli_stmt_bind_param($stmt15, "iis", $salesTodayQtySold, $salesTodayAmtSold, $salesTempRow['drugName']);
                mysqli_stmt_execute($stmt15);
                }
                echo "<script>alert('New quantity for $drugName has been added successfully.');</script>";
            }
        }
        else
        {
        $stmt = mysqli_prepare($con, "INSERT INTO stock (drugID, drugName, qty, expiryDate, unitCost, unitPrice) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssss", $drugID, $drugName, $qty, $expiryDate, $unitCost, $unitPrice);
      
        if (mysqli_stmt_execute($stmt)) {
            
            echo "<script>alert('$drugName has been added successfully.');</script>";
          } else {
              //echo "MySQL Error: " . mysqli_error($con);
              //die;
            echo "<script>alert('Error! Unsuccessful. Please cross-check the data.');</script>";
            
            }
        }
    }
    else
    {
        echo "<script>alert('Please, cross-check and provide the appropriate data.');</script>";
        
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
 	
    <style>
		body {
        background: url(pharmacy.jpg) no-repeat center  center/cover;
        position: relative;
        height:95vh;
      }
        .form-control
        {
            max-width:80%;
            min-width:80%;
        }
        #Wholecenter{
            width: 80%;
            height: 55vh;
            background-color: whitesmoke;
            margin-top: 150px;
        }
        #linN{
            text-decoration: none;
            font-weight:500;
            padding: 7px;
            font-size: small;
            color:black;
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
       
        #specialBtn{
            text-decoration: none;
            color: black;
            
        }

        h5{ 
            font-family:Verdana, Geneva, Tahoma, sans-serif;  
            color:rgba(138, 10, 48, 0.932);
            font-weight: 550;
            padding-right: 25px;
            margin-top:-12.2%;
            margin-left:20%;
        }  
        
        #AddPoll, #dashBtn{
            background-color: ghostwhite;
            font-size: 0.9rem;
            font-weight:bold;
            color: black;
            text-decoration: none;
            margin-top:10px;
            max-width:95px;
            min-width:50%;
            min-height: 70%;
            border:1.7px solid;
            border-radius:5px;
            border-color:black;
        }
        #dashBtn:hover, #AddPoll:hover{
            background-color: rgb(228,22,29);
        }
        #linN:hover{
            background-color: red;
        }
       
        #btns-container{
            text-align: center;
            background-color: rgba(138, 10, 48, 0.932);
            height: 47vh;
            padding:10px;
            flex:3px;
        }
        #submit
        {
            margin-left:-350px;
            background-color:darkblue;
            color:white;
        }
        #submit:hover
        {
            background-color:black;
        }

	#Add-container1 {
		margin-top: 10px;
		max-width: 20%;
		min-width: 30%;
		height: 100px;
		padding: 5px;
		margin-left: 4px;
		background-color: blue;
		border-radius: 10px;
		box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
	}
	
	#Add-container2 {
		margin-top: 10px;
		max-width: 17%;
		min-width: 30%;
		height: 100px;
		padding: 5px;
		margin-left: 4px;
		background-color: blue;
		border-radius: 10px;
		box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
	}
	
	#Add-container3 {
		margin-top: 10px;
		max-width: 17%;
		min-width: 30%;
		height: 100px;
		padding: 5px;
		margin-left: 4px;
		background-color: blue;
		border-radius: 10px;
		box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
	}
	
	#Add-container4 {
		margin-top: 10px;
		max-width: 20%;
		min-width: 30%;
		height: 100px;
		padding: 5px;
		margin-left: 4px;
		background-color: blue;
		border-radius: 10px;
		box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
	}
	
	#Add-container5 {
		margin-top: 10px;
		max-width: 17%;
		min-width: 30%;
		height: 100px;
		padding: 5px;
		margin-left: 4px;
		background-color: blue;
		border-radius: 10px;
		box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
	}
	
	#Add-container6 {
		margin-top: 10px;
		max-width: 17%;
		min-width: 30%;
		height: 100px;
		padding: 5px;
		margin-left: 4px;
		background-color: blue;
		border-radius: 10px;
		box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
	}
	
	.row {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		align-items: center;
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
    <a href="Home.php" class="navbar-brand"><img style="width: 100px; margin-left:-19px;" src="medical-symbol.jpg"><h5>REGINA OBENG LICENCED</h5></a><br>
    </div>
    <div>
      <button id="btns"><a id="lin" href="adminLogoff.php">Log Off</a></button><br>    
    </div>
    </nav><br>
   
         <div id="Wholecenter" class="container">
                <h4 style="text-align: center; background-color:
                 darkorange;  font-family:Verdana, Geneva, Tahoma, sans-serif;  
                color:rgba(138, 10, 48, 0.932);  padding: 7px; font-weight:;">ADMINISTRATOR DASHBOARD</h4>
                <div id="btns-container" class="container">
                <div class="row">
                <div class="container" id="Add-container1">
                <button id="AddPoll"
                 class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#launch">
                 <i style="color:black; font-size:1.2rem; margin-left:-15px; margin-top:3px;" class="fa fa-first-aid"></i>  Add New Stock</button>
                 <div class="modal fade" id="launch">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div style="color: black; font-size: 1.1rem; font-weight: bold;" class="modal-header">Capturing New Stock:
                                <button style="color: red" class="btn-close btn-danger" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="adminPage.php" method="post">
                                    <div class="form-group">
                                        <label>Name of Drug <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="drugName" placeholder="Enter name of drug" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="Agent-ID">Quantity. <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" name="qty" placeholder="Enter quantity" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="phone">Pick Expiry Date <span style="color:red;">*</span></label>
                                            <input type="date" class="form-control" name="expiryDate" placeholder="Enter expiry date" required>
                                        </div><br>
                                        <div class="form-group">
                                        <input type="number" class="form-control" name="unitCost" placeholder="Enter per unit cost" step="any" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="phone">Per unit price <span style="color:red;">*</span></label>
                                            <input type="number" class="form-control" name="unitPrice" placeholder="Enter per unit price" step="any" required>
                                        </div><br>
                                        <input id="submit" type="submit" value="Add Stock" class="btn btn-primary">
                                    </form><br>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button style="background-color: red;" type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
	</div> 
	<div class="container" id="Add-container2">
		<button id="dashBtn"><a id="specialBtn" href="expiryDate.php">
        <i style="color:black; font-size:1.2rem; margin-left:-6px; margin-top:3px;" class="fa fa-calendar-alt"></i> Check Expiry Dates</a></button>
	</div>
    <div class="container" id="Add-container3">
    <button id="dashBtn"><a id="specialBtn" href="salesReport.php">
        <i style="color:black; font-size:1.2rem; margin-left:-6px; margin-top:3px;" class="fa fa-notes-medical"></i> Sales Report</a></button><br>
       </div>
    </div><br><br>
    <div class="row">
        <div class="container" id="Add-container4">
                <button id="dashBtn"><a id="specialBtn" href="inStock.php">
                <i style="color:black; font-size:1.2rem; margin-left:-6px; margin-top:3px;" class="fa fa-table"></i> Drugs in Stock</a></button><br>
        </div>
        <div class="container" id="Add-container5">
                <button id="dashBtn"><a id="specialBtn" href="salesToday.php">
                    <i style="color:black; font-size:1.2rem; margin-left:-6px; margin-top:3px;" class="fa fa-eye"></i> Today Sales</a></button><br>
        </div>
        <div class="container" id="Add-container6">
                <button id="dashBtn"><a id="specialBtn" href="demandRate.php">
                <i style="color:black; font-size:1.25rem; margin-left:-6px; margin-top:3px;" class="fa fa-search "></i> Drugs' Stats</a></button>
        </div>    
            </div>
        </div>
</div>

</body>
</html>