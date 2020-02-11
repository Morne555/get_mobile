<?php
session_start();

// Include config file
require "../include/database_config.php";

$msg = -1;
$checkout_list = '';
$checkout_total = 0.0;

// Check to see if logged in
if(!isset($_SESSION["id"]) || $_SESSION["loggedin"] !== true) 
{
    $msg = 0;
}
else
{
    $user_id = $_SESSION["id"];

    $sql = "SELECT product_name, product_price FROM cart INNER JOIN product ON cart.product_id = product.product_id WHERE cart.user_id = ?";

    if($stmt = mysqli_prepare($link, $sql))
    {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $user_id);
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt))
        {
            $result = mysqli_stmt_get_result($stmt);
            
            while ( $row = mysqli_fetch_assoc($result))  
            {
                $checkout_list .= $row["product_name"];
                $checkout_list .= ", ";
                

                $checkout_total += $row["product_price"];
            }
            
            mysqli_stmt_close($stmt);
            $shipping = 0.0;
            $shipping = round($checkout_total * 0.02, 2);
            $checkout_grand_total = 0.0;
            $checkout_grand_total = round($shipping + $checkout_total, 2);
            
            $sql = "INSERT INTO checkout (user_id, checkout_list, checkout_total, checkout_shipping, checkout_grand_total) VALUES (?, ?, ?, ?, ?)";

            if($stmt = mysqli_prepare($link, $sql))
            {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssss", $user_id, $checkout_list, $checkout_total, $shipping, $checkout_grand_total);
                // Attempt to execute the prepared statement
                $dbdata = array();
                if(mysqli_stmt_execute($stmt))
                {
                    mysqli_stmt_close($stmt);
                    $user_id = $_SESSION["id"];

                    $sql = "DELETE FROM cart WHERE user_id = ?";

                    // $sql = "SELECT * FROM product WHERE product_category = ?";
                    
                    if($stmt = mysqli_prepare($link, $sql))
                    {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $user_id);
                        // Attempt to execute the prepared statement
                        $dbdata = array();
                        if(mysqli_stmt_execute($stmt))
                        {
                            $msg = 1;
                        }
                    }
                }
            }
        }
    }
}

echo $msg;
?>