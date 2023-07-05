<?php
  session_start();

  if(!isset($_SESSION['adminPassword']) && !isset($_SESSION['attendantPassword']))
  {
    header("location: login.php");
    die;
  }
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<style>
      body {
        background: url(pharmacy.jpg) no-repeat center  center/cover;
        position: relative;
        height:auto;
      }
      
      .content {
        position: relative;
        z-index: 1;
        
      }
      @media (max-width: 767px) {
        ul.navbar-nav {
        background-color: blue !important;
            }
        }
        @media (min-width: 768px) {
        ul.navbar-nav {
            background-color: #ffffff !important;
           }
        }

        @media screen and (max-width: 768px) {
  body {
    margin-top:; /* Adjusted margin for smaller screens */
    width:95%;
    margin-left: 3%;
  }
}

@media screen and (max-width: 480px) {
  body {
    margin-top:;
    width:97%;
    margin-left: 3%;
    height:auto;
  }
}

    h5{ 
       font-family:Verdana, Geneva, Tahoma, sans-serif;  
       color:rgba(138, 10, 48, 0.932);
       font-weight: 550;
       padding-right: 25px;
       margin-top:-12.2%;
     margin-left:20%;
        } 
h6 { 
    font-family:Verdana, Geneva, Tahoma, sans-serif;  
    color:darkblue;
    font-weight: 550;
    padding-right: 10px;
    margin-top:15px;
} 

  #lin{
        text-decoration: none;
        font-weight:500;
        padding: 7px;
        color:white;
      }

      a{
        text-decoration: none;
        color:white;
      }

      #delBtn
      {
        width:50px;

      }
    
      #delBtn:hover
      {
        background-color: black;
      }
      #AddPoll{
            background-color: rgb(247, 204, 31);
            font-size: small;
            font-weight:bold;
            text-decoration: none;
        }
        #AddPoll:hover{
            background-color: red;
        }

        .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: stretch;
        height: 90%;
        width: 100%;
        }

#dueForSale {
  max-width: 40%;
  min-width: 20%;
  min-height: 500px;
  padding: 5px;
  margin-left: 28px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
  flex-basis: 50%;
}

#soldDisplay {
  max-width: 45%;
  min-width: 35%;
  min-height: 500px;
  padding: 3px;
  margin-left: 10px;
  margin-right: 30px;
  background-color: blue;
  border-radius: 10px;
  box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
  flex-basis: 50%;
}

    #btns{
        background-color: rgba(138, 10, 48, 0.932);
        border: 1px solid;
        border-radius: 3px;
        margin-left: 20px;
        
    }

    #btns:hover {
        background-color:black;
      }

      label{
        font-weight: bold;
        color:darkorange;
      }

      #calculateSalesBtn, #signOffBtn{
        background-color: black;
        color: wheat;
        font-weight:bold;
        font-size: 1rem;
        border: 1px;
        border-radius: 5px;
        height: 35px;
      }

      #calculateSalesBtn:hover, #signOffBtn:hover{
        background-color: red;
      }

      #addSalesBtn
      {
        background-color:rgba(138, 10, 48, 0.932);
        color:white;
        font-weight: bold;
        border:1px solid;
        border-radius:5px;
        font-size: 1.1rem;
        height: 50px;
        margin-left: 28%;
        margin-top: -10px;
        
      }

      #addSalesBtn:hover
      {
        background-color: black;
      }

      #table-scrollable {
      max-height: 350px; 
      overflow-y: auto;
        }

      table {
      border-collapse: collapse;
      width: 90%;
      margin-left: 5%;
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
      background-color: darkorange;
    }
    tr:nth-child(odd) {
      background-color: #f2f2f2;
    }
</style>
<body>
  <div style="background-color: blue; width: 100%; height: 38px;" class="fixed-position fixed-top">
  
  </div>

<nav style="margin-top: 25px; background-color: white; border-bottom:1px solid; border-color:rgba(138, 10, 48, 0.932);" class="navbar navbar-expand-lg navbar-expand-xl fixed-top">
    
    <div style = "margin-left:-8px;" class="container">
    <a href="Home.php" class="navbar-brand"><img style="width: 100px; margin-left:-19px;" src="medical-symbol.jpg"><h5>REGINA OBENG LICENCED</h5></a><br>
        <button style=" border: none;" type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-label="Expand Navigation">
            <div><span class="navbar-toggler-icon bg-light navbar-nav-scroll"></span></div>
        </button>
        
        <div class="collapse navbar-collapse" id="nav">
            
            <ul style="margin-left:25px;" class="navbar-nav bg-success">
            <li style="margin-top: 5px;" class="navbar-link link-dark">
                  <button id="btns"><a id="lin" href="expiryDate.php">CHECK EXPIRY</a></button></li><br>
                <li style="margin-top: 5px;" class="navbar-link link-dark">
                  <button id="btns"><a id="lin" href="inStock.php">STOCK LIST</a></button></li><br>
                  <li style="margin-top: 5px;" class="navbar-link link-dark">
                  <button id="btns"><a id="lin" href="attendantLogoff.php">LOG OFF</a></button></li>
      </ul>
    </div>
    </div>
    </nav><br><br><br><br><br><br>

    <div class="row">

            <div id="dueForSale" class="container">
            <form action = "Home.php" method="post">
              <h6 style = "text-align:center;">SELLING</h6>
                 <label>Name of Drug:</label> <input style="border:2px solid; border-radius:5px; min-width:50%; max-width:80%;" type="text"
                  name="nameOfDrug" list="drugOptions" autocomplete="on" required>
                  <datalist id="drugOptions">
                  <?php
                    include "connection.php";

                    $sql = "SELECT * FROM stock";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        while ($optionsRow = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $optionsRow['drugName'] . "'>";
                        }
                    }
                    ?>

                  </datalist><br><br>

                <label>Quantity:</label> <input style="margin-left:6%; border:2px solid; border-radius:5px; min-width:50%; max-width:80%;" type="number" name="qty" required><br><br>
                <input id="calculateSalesBtn" type="submit" name="calculatePrice" value="Calculate">
              
                <?php
                 include "connection.php";
                  
                 $drugName = @$_POST['nameOfDrug'];
                 $qty = @$_POST['qty'];
 
                   $stmt = mysqli_prepare($con, "SELECT * FROM stock WHERE drugName = ?");
                   mysqli_stmt_bind_param($stmt, "s", $drugName);
                   mysqli_stmt_execute($stmt);
                   $results = mysqli_stmt_get_result($stmt);
                   @$row = mysqli_fetch_assoc($results);

                   $stmt12 = mysqli_prepare($con, "SELECT * FROM tempBackup WHERE drugName = ?");
                   mysqli_stmt_bind_param($stmt12, "s", $drugName);
                   mysqli_stmt_execute($stmt12);
                   $diffResults = mysqli_stmt_get_result($stmt12);

                   $qtyLeft1 = 0;
                   while($diffRow = mysqli_fetch_assoc($diffResults))
                   {
                     $qtyLeft1 += $diffRow['qtySold'];
                   }
                   
                   $TotalLeft1 = @$row['qty'] - $qtyLeft1;

                   if($TotalLeft1 < $qty)
                    {
                      $soldAmt = 0;
                    }
                    else
                    {
                   
                   $soldAmt = @$row['unitPrice'] * $qty;
                 
                echo "<input style='margin-left:4%; border:2px solid; border-radius:5px; min-width:50%; max-width:80%;' type='text' readonly value='GHS " . number_format($soldAmt, 2) . "'>";
                  }
                ?>
                </form><br><br>

                <form action = "Home.php" method = "post">
                <input id="addSalesBtn" type = "submit" name = "addToSales" value = "Add to Sales">
              </form><br><br>

                <div style="background-color:black; width:95%; height:125px; margin-top: -1px;">
                    <div style="color:white; font-size:1.1rem; text-align: center; font-weight:bold;">DRUG DETAILS</div>
                    
              <?php

                if (isset($_POST['calculatePrice']))
                { 
                  include "connection.php";
                  
                $drugName = $_POST['nameOfDrug'];
                $qty = $_POST['qty'];
                $_SESSION['drugName'] = $drugName;
                $_SESSION['qty'] = $qty;
                $_SESSION['soldAmt'] = $soldAmt;

                  $stmt = mysqli_prepare($con, "SELECT * FROM stock WHERE drugName = ?");
                  mysqli_stmt_bind_param($stmt, "s", $drugName);
                  mysqli_stmt_execute($stmt);
                  $results = mysqli_stmt_get_result($stmt);
                  $row = mysqli_fetch_assoc($results);
                  

                  if(mysqli_num_rows($results)>0)
                  {
                    $stmt6 = mysqli_prepare($con, "SELECT * FROM tempBackup WHERE drugName = ?");
                    mysqli_stmt_bind_param($stmt6, "s", $drugName);
                    mysqli_stmt_execute($stmt6);
                    $diffResults = mysqli_stmt_get_result($stmt6); 
  
                    $qtyLeft = 0;
                    while($diffRow = mysqli_fetch_assoc($diffResults))
                    {
                      $qtyLeft += $diffRow['qtySold'];
                    }
                    
                    $TotalLeft = $row['qty'] - $qtyLeft;

                    if($TotalLeft <= 0)
                    {
                      echo "<script>alert('The drug, \'$drugName\' is finished');</script>";
                    }
                    elseif($TotalLeft < $qty)
                    {
                      echo "<script>alert('$qty quantity of $drugName being ordered is more the total quantity of $TotalLeft left.');</script>";
                    }
                    else{
                    $currentDate = new DateTime(); 
                    $expiryDate = new DateTime(@$row['expiryDate']);
              
                    $interval = $currentDate->diff($expiryDate);
                    $daysDifference = $interval->format('%a');
                    
                    echo "<label style = 'margin-left:5%; font-weight:bold; font-size:1.1rem;'>Drug's name:</label> "; echo "<span style = 'font-weight:bold; color:wheat; margin-left:5%;'>". $drugName."</span><br>";
                    echo "<label style = 'margin-left:5%; font-weight:bold; font-size:1.1rem'>Quantity Left:</label> "; echo "<span style = 'font-weight:bold; color:wheat; margin-left:5%'>". $TotalLeft. "</span><br>";
                     echo "<label style = 'margin-left:5%; font-weight:bold; font-size:1.1rem'>Days to expiry:</label> "; echo "<span style = 'font-weight:bold; color:wheat; margin-left:3%'>". $daysDifference ."</span>";
                  }
                }
                  else
                  {
                    echo "<script>alert('Drug, \'$drugName\' is not available.');</script>";
                  }

                 
                } elseif (isset($_POST['addToSales'])) {

                  include "connection.php";
                  
                  $drugName = @$_SESSION['drugName'];
                  $qty = @$_SESSION['qty'];
                  $soldAmt = @$_SESSION['soldAmt'];

                    $stmt2 = mysqli_prepare($con, "INSERT INTO  salestemp(drugName, qtySold, soldAmt) VALUES (?, ?, ?)");
                    mysqli_stmt_bind_param($stmt2, "sss", $drugName, $qty, $soldAmt);

                     $stmt7 = mysqli_prepare($con, "INSERT INTO  tempBackup(drugName, qtySold, soldAmt) VALUES (?, ?, ?)");
                    mysqli_stmt_bind_param($stmt7, "sss", $drugName, $qty, $soldAmt);
                    if(isset($_SESSION['drugName']) && isset($_SESSION['qty']) && isset($_SESSION['soldAmt']))
                    {
                    if(mysqli_stmt_execute($stmt2) && mysqli_stmt_execute($stmt7)){
                      
                      echo "<script>alert('Successfully added to sales.');</script>";
                    }
                    else{
                      echo "<script>alert('Unsuccessful. Please, cross check the data');</script>";
                    }
                  }
                  else{
                    echo "";
                  }
                  

                    unset($_SESSION['drugName']);
                    unset($_SESSION['qty']);
                    unset($_SESSION['soldAmt']);   
                }
                

              ?>
              </div>

              
            </div>

            <div id="soldDisplay" class="container">
              <button id = "signOffBtn" data-bs-toggle = "modal" data-bs-target="#launch">Sign Off
              </button><br>
              <div class = "modal fade" id = "launch">
                <div class = "modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class = "modal-content">
                  <div class = "modal-header">You're Signing off:
                    <button class = "btn btn-close bg-danger" data-bs-dismiss = "modal"></button>
                  </div>
                  <div class = "modal-body">
                    <form action = "Home.php" method = "post">
                      <input type = "text" name = "attendantName" placeholder = "Enter your full name" required><br><br>
                      <input id = "signOffBtn" type = "submit" name = "signOffBtn">
                    </form>
                  </div>
              </div>
                  </div>
                </div><br>

      
              <h6 style="color:white; text-align:center; margin-top:-1px;">SALES FOR TODAY</h6><br>
               <?php

                if(isset($_POST['signOffBtn'])){
                  include "connection.php";

                  $attendantName = $_POST['attendantName'];

                  $stmt3 = mysqli_prepare($con, "SELECT * FROM  salestemp");
                  mysqli_stmt_execute($stmt3);
                  $salesTempResults = mysqli_stmt_get_result($stmt3);
                  
                  while($tempResults = mysqli_fetch_assoc($salesTempResults)){
                  $stmt1 = mysqli_prepare($con, "INSERT INTO  salestoday(drugName, qtySold, soldAmt, attendantName) VALUES (?, ?, ?, ?)");
                  mysqli_stmt_bind_param($stmt1, "ssss", $tempResults['drugName'], $tempResults['qtySold'], $tempResults['soldAmt'], $attendantName);
                  mysqli_stmt_execute($stmt1);
                  }
                  $stmt3 = mysqli_prepare($con, "DELETE FROM  salestemp");
                  if(mysqli_stmt_execute($stmt3)){
                    echo "<script>alert('Successfully signed off.');</script>";
                  } else
                  {
                    echo "<script>alert('Unsuccessful. Please, try again.');</script>"; 
                  }
                }
                ?>
         <div id = "table-scrollable">
         <table>
         <tr>
            <th>Name of Drug</th>
            <th>Quantity Sold</th>
            <th>Sold Amt</th>
          </tr>

          <?php
            include "connection.php";

            $stmt4 = mysqli_prepare($con, "SELECT * FROM salestemp");
            //mysqli_stmt_bind_param($stmt, "s", $currentDate);
            mysqli_stmt_execute($stmt4);
            $results = mysqli_stmt_get_result($stmt4);
            
            $count = 1;
            while ($row = mysqli_fetch_assoc($results)) {
              $id = $row['id'];

              echo "<tr>";
              echo "<td>" ."<span style='color:red;'>".$count."</span>".". ". $row['drugName'] . "</td>";
              echo "<td>" . $row['qtySold'] ."</td>";
              echo "<td><span>GHS</span> ". $row['soldAmt'] ."</td>";
              echo "<td><button id='delBtn' class='btn btn-danger'><a href='delete.php?deleteid=".$id."'>
              <i style='color:white;' class='fa fa-trash-alt'></i></a></button></td>";
              echo "</tr>";

              $count++;
              
          } 
        ?>

                </table>
        </div><br>

        <?php
                 include "connection.php";

                 $stmt5 = mysqli_prepare($con, "SELECT salestemp.soldAmt FROM salestemp");
                 //mysqli_stmt_bind_param($stmt, "s", $currentDate);
                 mysqli_stmt_execute($stmt5);
                 $results1 = mysqli_stmt_get_result($stmt5);
                 $total = 0;
                 while ($row1 = mysqli_fetch_assoc($results1)) {
                  $total += $row1['soldAmt'];
                 }
                 echo "<span style = 'color:orange; font-size:1rem; font-weight:bold; margin-left:5%;'>TOTAL :</span> ". 
                 "<span style = 'color:wheat; font-weight:bold; font-size:0.9rem'>GHS " .number_format($total, 2)."</span>" ;
                
                ?>
               
            </div>



    </div>
       
</body>
</html>