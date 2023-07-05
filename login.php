<?php
session_start();

if(isset($_POST['adminLogin']))
{
    include "connection.php";
    $email=$_POST['email'];
	$password=$_POST['password'];

    if(!empty($email) && !empty($password))
	{
        $stmt = mysqli_prepare($con, "SELECT * FROM adminlogin WHERE email = ? AND password = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($results);

         if(mysqli_num_rows($results)>0)
        {		
         $_SESSION['adminPassword']=$data['password'];
		 header("location:adminPage.php");
			die;
		}
		else
		{
			echo "<script>alert('Wrong email or password');</script>";
            
		}
	}
    else
    {
        echo "Error: " . mysqli_error($con);
    }
      
}
elseif(isset($_POST['attendantLogin']))
{
    include "connection.php";
    $email=$_POST['email'];
	$password=$_POST['password'];

    if(!empty($email) && !empty($password))
	{
        $stmt1 = mysqli_prepare($con, "SELECT * FROM attendantlogin WHERE email = ? AND password = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt1, "ss", $email, $password);
        mysqli_execute($stmt1);
        $results1 = mysqli_stmt_get_result($stmt1);
        $data1 = mysqli_fetch_assoc($results1);

         if(mysqli_num_rows($results1)>0)
        {		
         $_SESSION['attendantPassword']=$data1['password'];
		 header("location:Home.php");
			die;
		}
		else
		{
			echo "<script>alert('Wrong email or password');</script>";
            
		}
	}
    else
    {
        echo "Error: " . mysqli_error($con);
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging in</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<style>
      body 
      {
        background: url(pharmacy.jpg) no-repeat center  center/cover;
        position: relative;
        height:auto;
      }
      @media (max-width:778px){
        body{
            height: 95vh;
        }
      }

      @media (max-width: 390px){
  body {
    height: 140vh;
  }
}


@media (max-width: 375px){
  body {
    height: 170vh;
  }

  #login-container {
    margin-top: 120px;
    width: 405px;
    padding: 40px;
    background-color: rgba(138, 10, 48, 0.932);
    border-radius: 10px;
    box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
  }

  #login-container2 {
    margin-top: 120px;
    width: 405px;
    padding: 40px;
    background-color: rgba(138, 10, 48, 0.932);
    border-radius: 10px;
    box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
    
  }
  #login-container,
#login-container2 {
  flex: 0.6 0 calc(50% - 20px); 
  margin: 10px;
}

}

@media (max-width: 390px){
  body {
    height: 140vh;
  }

  #login-container {
    margin-top: 120px;
    width: 405px;
    padding: 40px;
    background-color: rgba(138, 10, 48, 0.932);
    border-radius: 10px;
    box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
  }

  #login-container2 {
    margin-top: 120px;
    width: 405px;
    padding: 40px;
    background-color: rgba(138, 10, 48, 0.932);
    border-radius: 10px;
    box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
    
  }
  #login-container,
#login-container2 {
  flex: 0.6 0 calc(50% - 20px);
  margin: 10px; 
}

}

@media (max-width:393px){
  body {
    height: 140vh;
  }

  #login-container {
    margin-top: 120px;
    width: 405px;
    padding: 40px;
    background-color: rgba(138, 10, 48, 0.932);
    border-radius: 10px;
    box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
  }

  #login-container2 {
    margin-top: 120px;
    width: 405px;
    padding: 40px;
    background-color: rgba(138, 10, 48, 0.932);
    border-radius: 10px;
    box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
    
  }
  #login-container,
#login-container2 {
  flex: 0.6 0 calc(50% - 20px); /* Adjust the margin value to control the gap */
  margin: 10px; /* Adjust the margin value to control the gap */
}

}

 #login-container 
       {
			margin-top: 120px;
			width: 305px;
			padding: 40px;
			background-color: rgba(138, 10, 48, 0.932);
			border-radius: 10px;
			box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
            margin-left: 4%;
		}

        #login-container2 
       {
			margin-top: 120px;
			width: 305px;
			padding: 40px;
			background-color: rgba(138, 10, 48, 0.932);
			border-radius: 10px;
			box-shadow: 0px 10px 50px rgba(0, 0, 0, 0.3);
            margin-left: 3%;
		}


		.form-group 
        {
			margin-bottom: 20px;
		}
		.form-control {
			border-radius: 0px;
		}

		#btns-container{
            text-align: center;
            background-color: ;
            height: 35vh;
            
        }

        label
        {
		color:black;
		font-size:1.0rem;
        font-weight:bold;		
	    }

      .content {
        position: relative;
        z-index: 1;   
      }

      @media (max-width: 767px) {
        ul.navbar-nav {
        background-color: rgb(247, 204, 31) !important;
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
            padding-right: 25px;
            margin-top:-12.2%;
            margin-left:20%;
        } 

      #AdminLoginBtn
      {
        background-color:blue;
        color:white;
      }
      
      #AdminLoginBtn:hover {
        background-color:black;
      }

      .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        height: 80%;
        width: 100%;
        }

        .container {
  flex-basis: 45%; /* Set the initial width to 50% */
  padding: 10px; /* Adjust the padding as needed */
}

     @media screen and (min-width: 992px) {
  /* Apply styles only when the screen is on large or extra-large form */
  .container {
    flex-basis: 35%; /* Reduce the width to 45% */
  }
}
     

</style>

<body style="background-color:ghostwhite;">
<div style="background-color: blue; width: 100%; height: 38px;" class="fixed-position fixed-top">
  
  </div>

<nav style="margin-top: 25px; background-color: white; border-bottom:1px solid; border-color:rgba(138, 10, 48, 0.932);" class="navbar navbar-expand-lg navbar-expand-xl fixed-top">
    
<div style = "margin-left:-8px;" class="container">
    <a href="Home.php" class="navbar-brand"><img style="width: 100px; margin-left:-19px;" src="medical-symbol.jpg"><h5>REGINA OBENG LICENCED</h5></a><br>
        <button style=" border: none;" type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-label="Expand Navigation">
            <div><span class="navbar-toggler-icon bg-light navbar-nav-scroll"></span></div>
        </button>
        
        <div class="collapse navbar-collapse" id="nav">
            
        </div>
    </div>
</nav><br><br>
<div class = "row">
<div class="container" id="login-container">
		<h4 style="text-align: center; background-color:
		black; color: white; padding: 2px; font-weight: bold;" class="mb-4">Admin Log in</h4>
		<div id="btns-container" class="container">
		<form action="logIn.php" method="post">
			<div class="form-group">
				<label for="username">EMAIL</label>
				<input type="email" class="form-control" name="email" placeholder="Enter email address" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label for="password">PASSWORD</label>
				<input type="password" class="form-control" name="password" placeholder="Enter password" autocomplete="new-password" required>
			</div><br>
			<input id = "AdminLoginBtn" name = "adminLogin" type="submit" value="Log in" class="btn">
		</form>
		</div>
    </div>

        <div class="container" id="login-container2">
		<h4 style="text-align: center; background-color:
		black; color: white; padding: 2px; font-weight: bold;" class="mb-4">Attendant Log in</h4>
		<div id="btns-container" class="container">
		<form action="logIn.php" method="post">
			<div class="form-group">
				<label for="username">EMAIL</label>
				<input type="email" class="form-control" name="email" placeholder="Enter email address" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label for="password">PASSWORD</label>
				<input type="password" class="form-control" name="password" placeholder="Enter password" autocomplete="new-password" required>
			</div><br>
			<input id = "AdminLoginBtn" name = "attendantLogin" type="submit" value="Log in" class="btn">
		</form>
		</div>
    </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
