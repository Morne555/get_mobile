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

    $sql = "SELECT * FROM user";

    if($stmt = mysqli_prepare($link, $sql))
    {
        $dbdata = array();
        if(mysqli_stmt_execute($stmt))
        {
            $result = mysqli_stmt_get_result($stmt);
            echo '<table>';
            echo '<tr>';
            echo '<th>', 'user_id', '</th>';
            echo '<th>', 'username', '</th>';
            echo '<th>', 'email', '</th>';
            echo '<th>', 'name', '</th>';
            echo '<th>', 'address', '</th>';
            echo '</tr>';

            while ( $row = mysqli_fetch_assoc($result))  
            {
                echo '<tr>';
                echo '<td>', htmlspecialchars($row["user_id"]), '</td>';
                echo '<td>', htmlspecialchars($row["username"]), '</td>';
                echo '<td>', htmlspecialchars($row["email"]), '</td>';
                echo '<td>', htmlspecialchars($row["name"]), '</td>';
                echo '<td>', htmlspecialchars($row["address"]), '</td>';
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