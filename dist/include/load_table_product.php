<?php

$msg = -1;

// Check to see if logged in
if(!isset($_SESSION["admin"]) && !isset($_SESSION["id"]) || $_SESSION["loggedin"] !== true) 
{
    $msg = 0;
}
else
{
    $user_id = $_SESSION["id"];

    $sql = "SELECT * FROM product";

    if($stmt = mysqli_prepare($link, $sql))
    {
        $dbdata = array();
        if(mysqli_stmt_execute($stmt))
        {
            $result = mysqli_stmt_get_result($stmt);
            echo '<table>';
            echo '<tr>';
            echo '<th>', 'product_id', '</th>';
            echo '<th>', 'product_name', '</th>';
            echo '<th>', 'product_image', '</th>';
            echo '<th>', 'product_description', '</th>';
            echo '<th>', 'product_category', '</th>';
            echo '<th>', 'product_sub_category', '</th>';
            echo '<th>', 'product_price', '</th>';
            echo '</tr>';

            while ( $row = mysqli_fetch_assoc($result))  
            {
                echo '<tr>';
                echo '<td>', htmlspecialchars($row["product_id"]), '</td>';
                echo '<td>', htmlspecialchars($row["product_name"]), '</td>';
                echo '<td>', htmlspecialchars($row["product_image"]), '</td>';
                echo '<td>', htmlspecialchars($row["product_description"]), '</td>';
                echo '<td>', htmlspecialchars($row["product_category"]), '</td>';
                echo '<td>', htmlspecialchars($row["product_sub_category"]), '</td>';
                echo '<td>', htmlspecialchars($row["product_price"]), '</td>';
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