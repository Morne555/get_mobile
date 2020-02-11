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

    $sql = "SELECT * FROM checkout";

    if($stmt = mysqli_prepare($link, $sql))
    {
        $dbdata = array();
        if(mysqli_stmt_execute($stmt))
        {
            $result = mysqli_stmt_get_result($stmt);
            echo '<table>';
            echo '<tr>';
            echo '<th>', 'checkout_id', '</th>';
            echo '<th>', 'user_id', '</th>';
            echo '<th>', 'checkout_list', '</th>';
            echo '<th>', 'checkout_total', '</th>';
            echo '<th>', 'checkout_shipping', '</th>';
            echo '<th>', 'checkout_grand_total', '</th>';
            echo '<th>', 'checkout_date', '</th>';
            echo '</tr>';

            while ( $row = mysqli_fetch_assoc($result))  
            {
                echo '<tr>';
                echo '<td>', htmlspecialchars($row["checkout_id"]), '</td>';
                echo '<td>', htmlspecialchars($row["user_id"]), '</td>';
                echo '<td>', htmlspecialchars($row["checkout_list"]), '</td>';
                echo '<td>', htmlspecialchars($row["checkout_total"]), '</td>';
                echo '<td>', htmlspecialchars($row["checkout_shipping"]), '</td>';
                echo '<td>', htmlspecialchars($row["checkout_grand_total"]), '</td>';
                echo '<td>', htmlspecialchars($row["checkout_date"]), '</td>';
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