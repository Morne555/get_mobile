<?php

// Include config file

$msg = -1;

// Check to see if logged in
if(!isset($_SESSION["admin"]) && !isset($_SESSION["id"]) || $_SESSION["loggedin"] !== true) 
{
    $msg = 0;
}
else
{
    $user_id = $_SESSION["id"];

    $sql = "SELECT * FROM cart";

    if($stmt = mysqli_prepare($link, $sql))
    {
        $dbdata = array();
        if(mysqli_stmt_execute($stmt))
        {
            $result = mysqli_stmt_get_result($stmt);
            echo '<table>';
            echo '<tr>';
            echo '<th>', 'cart_id', '</th>';
            echo '<th>', 'user_id', '</th>';
            echo '<th>', 'product_id', '</th>';
            echo '</tr>';

            while ( $row = mysqli_fetch_assoc($result))  
            {
                echo '<tr>';
                echo '<td>', htmlspecialchars($row["cart_id"]), '</td>';
                echo '<td>', htmlspecialchars($row["user_id"]), '</td>';
                echo '<td>', htmlspecialchars($row["product_id"]), '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        else
        {
            exit();
        }
    }
}
?>