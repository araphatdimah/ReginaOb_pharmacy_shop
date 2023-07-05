<?php

include "connection.php";

if(isset($_GET['deleteid'])){

    $itemID = $_GET['deleteid'];

        $stmt = mysqli_prepare($con, "DELETE FROM salestemp WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $itemID);

        $stmt1 = mysqli_prepare($con, "DELETE FROM tempBackup WHERE id = ?");
        mysqli_stmt_bind_param($stmt1, "i", $itemID);

        if(mysqli_stmt_execute($stmt) && mysqli_stmt_execute($stmt1))
        {
            echo "<script>
            alert('Item deleted successfully.');
            window.location.href = 'Home.php';
        </script>";
        }else{
            echo "<script>alert('Unsuccessful');</script>";
        }

        
}
?>
