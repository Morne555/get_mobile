<?php require 'include/session.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require 'include/link.php' ?>

    <title>Login</title>
</head>


<?php
  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
  }

  // Include config file
  require 'include/database_config.php';

  // Define variables and initialize with empty values
  $validLogin = true;
  $username = $password = "";
  $InvalidLogin = "";

  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
      $validLogin = false;
    } else{
      $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
      $validLogin = false;
    } else{
      $password = trim($_POST["password"]);
    }

    // Validate credentials
    if($validLogin){
      // Prepare a select statement
      $sql = "SELECT admin_id, admin_username, admin_password FROM admin WHERE admin_username = ?";

      if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        // Set parameters
        $param_username = $username;

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
          // Store result
          mysqli_stmt_store_result($stmt);

          // Check if username exists, if yes then verify password
          if(mysqli_stmt_num_rows($stmt) == 1){
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
            if(mysqli_stmt_fetch($stmt)){
              if(password_verify($password, $hashed_password)){
                // Password is correct, so start a new session
                session_start();

                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                $_SESSION["admin"] = true;

                // Redirect user to index page
                header("location: index.php");
              } else {
                // Display an error message if password is not valid
                $InvalidLogin = "Invalid login! Username/password was incorrect.";
              }
            }
          } else{
            $InvalidLogin = "Invalid login! Username/password was incorrect.";
            // Display an error message if username doesn't exist
            // $username_err = "No account found with that username.";
          }
        } else{
          echo "Oops! Something went wrong. Please try again later.";
        }
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
  }
  ?>

<body>
    <div class="mainContainer">
        <?php require 'include/nav.php' ?>

        <div class="form spaceTop">
            <div class="info">
                <h2>Admin Login</h2>
                <p>Login to begin shopping!</p>
                <p>Items that you add will be stored to your shopping cart.</p>
                <p>You can find your shopping cart at the top beside your username.</p>
            </div>

            <form id="loginForm" name="loginForm" onsubmit="return validateForm()" method="post">
                <input name="username" onfocusout="hasInput(this)" type="text" placeholder="username...">
                <span></span>
                <input name="password" onfocusout="hasInput(this)" type="password" placeholder="password...">
                <span><?php echo $InvalidLogin ?></span>
                <button class="submit hvr-fade" type="submit" name="submit">Submit</button>
                <a href="register.php">Register</a>
            </form>
        </div>

        <img class="spaceTop" style="width: 100%" src="img/login.jpg" alt="">
        
        <?php require 'include/footer.php' ?>
    </div>


    <script type="text/javascript">

    var myForm = document.getElementById("loginForm");

    function hasInput(input)
    {
    if(isEmpty(input.value))
    {
        input.setAttribute("style", "background-color:#ffabab; border-color:#ffabab;");
        input.nextElementSibling.innerHTML = capitalizeFirstLetter(input.name) + " is required!";
        return false;
    }
    else
    {
        input.setAttribute("style", "background-color:#fafafa; border-color:#ccc")
        input.nextElementSibling.innerHTML = '';
        return true;
    }
    }

    function validateForm()
    {
    var valid = false;
    var username = document["loginForm"]["username"];
    var password = document["loginForm"]["password"];

    if(hasInput(username) & hasInput(password))
    {
        valid = true;
    }
    else 
    {
        
    }
    return valid;
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function isEmpty(str)
    {
    return !str.replace(/\s+/, '').length;
    }

    </script>
    <?php require 'include/script.php' ?>

</body>
</html>