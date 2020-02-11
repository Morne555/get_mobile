<?php
require "../include/database_config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = $address = $name = "";
$username_err = $password_err = $confirm_password_err = $email_err = $address_err = $name_err = "";

//some basic validation
if(empty(trim($_POST["email"]))){
  echo '0'; exit();
}
else {
  // Prepare a select statement
  $sql = "SELECT user_id FROM user WHERE email = ?";

  if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_email);

    // Set parameters
    $param_email = trim($_POST["email"]);

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
      /* store result */
      mysqli_stmt_store_result($stmt);

      if(mysqli_stmt_num_rows($stmt) == 1){
        $email_err = "This email is already taken.";
        echo '0'; exit();
      } else{
        $email = trim($_POST["email"]);
        echo '1'; exit();
      }
    }
    else
    {
      echo '0'; exit();
    }
  }
}
?>
