<?php
session_start();

// Include config file
require "../include/database_config.php";

$msg = -1;

// Check to see if logged in
if(!isset($_SESSION["id"]) || $_SESSION["loggedin"] !== true) 
{
    $msg = 0;
}
else
{
    $user_id = $_SESSION["id"];
    $product_id = $_GET["product_id"];
    // Prepare an insert statement
    $sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ? LIMIT 1";

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_user_id, $param_product_id);

        // Set parameters
        $param_user_id = $user_id;
        $param_product_id = $product_id;

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
        // Redirect to login page
            $msg = 1;
        } else{
         $msg = -1;
        }
    }

    
    // Close statement
    mysqli_stmt_close($stmt);

        
}
echo $msg;
// Close connection
mysqli_close($link);
?>