<?php
session_start();

// Include config file
require "../include/database_config.php";

// Check to see if logged in
if(!isset($_SESSION["id"]) || $_SESSION["loggedin"] !== true) 
{
    echo -1;
    kill();
}
else
{
    $user_id = $_SESSION["id"];

    $sql = "SELECT * FROM cart INNER JOIN product ON cart.product_id = product.product_id WHERE cart.user_id = ?";

    // $sql = "SELECT * FROM product WHERE product_category = ?";

    if($stmt = mysqli_prepare($link, $sql))
    {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_user_id);
        $param_user_id = $user_id;
        // Attempt to execute the prepared statement
        $dbdata = array();
        if(mysqli_stmt_execute($stmt))
        {
            $result = mysqli_stmt_get_result($stmt);
            
            while ( $row = mysqli_fetch_assoc($result))  
            {
                $dbdata[]=$row;
            }

            if (!empty($dbdata))
                echo '{"products": ', json_encode($dbdata), '}';
            else echo 0;
        }
        else
        {
            echo -1;
            exit();
        }
    }
}
?>