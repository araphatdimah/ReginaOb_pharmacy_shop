<?php 

$Host = "localhost";
$Name = "root";
$Password = "";
$Database = "chemicalshop";

$con = mysqli_connect($Host, $Name, $Password, $Database);
if(!$con)
{
    echo "Connection unsuccessfull";
}

?>