<?php require 'include/session.php' ?>
<!DOCTYPE html>
<html lang="en">

<?php
    // Include config file
    require "include/database_config.php";

    // Define variables and initialize with empty values
    $username = $password = $confirm_password = $email = $address = $name = "";
    $username_err = $password_err = $confirm_password_err = $email_err = $address_err = $name_err = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT user_id FROM user WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        // Set parameters
        $param_username = trim($_POST["username"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
            $username_err = "This username is already taken.";
            } else{
            $username = trim($_POST["username"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        }


        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email address";
    } else{
        // Prepare a select statement
        $sql = "SELECT email FROM user WHERE email = ?";

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
            } else{
            $email = trim($_POST["email"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }


    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 7){
        $password_err = "Password must have atleast 7 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirmPassword"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirmPassword"]);
        if(empty($password_err) && ($password != $confirm_password)){
        $confirm_password_err = "Password did not match.";
        }
    }

    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name.";
    } else{
        $name = $_POST["name"];
    }

    // Validate address
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter an address.";
    } else{
        $address = $_POST["address"];
    }


    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($name_err) && empty($email_err) && empty($address_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO user (username, password, email, name, address) VALUES (?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_email, $param_name, $param_address);

          // Set parameters
          $param_username = $username;
          $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
          $param_email = $email;
          $param_name = $name;
          $param_address = $address;

          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              // Redirect to login page
              header("location: login.php");
          } else{
              echo "Something went wrong. Please try again later.";
          }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require 'include/link.php' ?>

    <title>Register</title>
</head>
<body>
    <div class="mainContainer">
        <?php require 'include/nav.php' ?>

        <div class="form spaceTop">
            <div class="info">
                <h2>Register</h2>
                <p>Registering a new account will allow you to add items from our store into a cart.</p>
                <p>Note that you cannot purchase items without having an account.</p>
            </div>

            <form id="registerForm" name="registerForm" onsubmit="return validateForm()" method="post">
                <input name="username" id="username" onfocusout="validInput(this)" type="text" placeholder="username...">
                <span><?php echo  $username_err ?></span>
                <input name="password" onfocusout="validInput(this)" type="password" placeholder="password...">
                <span></span>
                <input name="confirmPassword" onfocusout="validInput(this)" type="password" placeholder="confirm password...">
                <span></span>
                <input name="name" onfocusout="validInput(this)" type="text" placeholder="name...">
                <span></span>
                <input name="email" id="email" onfocusout="validInput(this)" type="text" placeholder="email...">
                <span></span>
                <input name="address" onfocusout="validInput(this)" type="text" placeholder="address...">
                <span></span>
                <button class="submit" type="submit" name="submit">Submit</button>
            </form>
        </div>

        <img class="spaceTop" style="width: 100%" src="img/login.jpg" alt="">
        <?php require 'include/footer.php' ?>
    </div>

    <script type="text/javascript">

var myForm = document.getElementById("registerForm");
var usernameCheck = false;
var emailCheck = false;

function validInput(input)
{
  var valid = true;
  var errorMessage = '';
  input.nextElementSibling.setAttribute("style", "");
  if(isEmpty(input.value))
  {
    input.setAttribute("style", "background-color:#ffabab; border-color:#ffabab;");
    if(input.name != 'confirmPassword')
    input.nextElementSibling.innerHTML = capitalizeFirstLetter(input.name) + " is required!";
    else
    input.nextElementSibling.innerHTML = "Password is required!";
    return false;
  }
  else
  {
    switch (input.name)
    {
      case 'username':
      {
        $.post( "request/check_username.php", { username: $("#username").val() }, function (isAvailable)
        {
          if(isAvailable=='1')
          {
            if (input.value.length > 15)
            {
              input.nextElementSibling.innerHTML = capitalizeFirstLetter(input.name) + " must be less than 16 characters";
                input.setAttribute("style", "background-color:#ffabab; border-color:#ffabab;");
                input.nextElementSibling.setAttribute("style", "");
                valid = false;
            }
            else
            {
              input.nextElementSibling.innerHTML = "Username is available!";
            input.nextElementSibling.setAttribute("style", "color: lightgreen;");
            usernameCheck = true;
            }
            
          }
          else if(isAvailable=='0')
          {
            input.nextElementSibling.innerHTML = capitalizeFirstLetter(input.name) + " is taken!";
            input.setAttribute("style", "background-color:#ffabab; border-color:#ffabab;");
            input.nextElementSibling.setAttribute("style", "");
            valid = false;
            usernameCheck = false;
          }
        });

        
      } break;
      case 'password':
      {
        errorMessage = 'Password must contain: '
        if (input.value == input.value.toUpperCase())
        {
          errorMessage += ' lowercase,';
          valid = false;
        }

        if (input.value == input.value.toLowerCase())
        {
          errorMessage += ' uppercase,';
          valid = false;
        }

        if (input.value.length < 7)
        {
          errorMessage += ' atleast 7 characters,';
          valid = false;
        }
        if (!(/[ !"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]/.test(input.value)))
        {
          errorMessage += ' special character';
          valid = false;
        }

      } break;
      case 'confirmPassword':
      {
        if (document["registerForm"]["password"].value != input.value)
        {
          errorMessage = 'Passwords do not match!';
          valid = false;
        }
      } break;
      case 'email':
      {        
        var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (!regex.test(input.value))
        {
          errorMessage = 'Invalid email!';
          valid = false;
        }
        else
        {
            $.post( "request/check_email.php", { email: $("#email").val() }, function (isAvailable)
                {
                    if(isAvailable=='1')
                    {
                        input.nextElementSibling.innerHTML = "Email is available!";
                        input.nextElementSibling.setAttribute("style", "color: lightgreen;");
                        emailCheck = true;
                    }
                    else if(isAvailable=='0')
                    {
                        input.nextElementSibling.innerHTML = capitalizeFirstLetter(input.name) + " is taken!";
                        input.setAttribute("style", "background-color:#ffabab; border-color:#ffabab;");
                        input.nextElementSibling.setAttribute("style", "");   
                        valid = false;   
                        emailCheck = false;               
                    }
                });
        }
      }
    }

    if (!valid)
    {
      input.setAttribute("style", "background-color:#ffabab; border-color:#ffabab;");
      input.nextElementSibling.innerHTML = errorMessage;
      return valid;
    }
    else
    {
      input.setAttribute("style", "background-color:#fafafa; border-color:#ccc");
      input.nextElementSibling.innerHTML = '';
      return valid
    }
  }


}


function validateForm()
{
  var valid = false;
  var username = document["registerForm"]["username"];
  var password = document["registerForm"]["password"];
  var confirmPassword = document["registerForm"]["confirmPassword"];
  var name = document["registerForm"]["name"];
  var email = document["registerForm"]["email"];
  var address = document["registerForm"]["address"];

  if(validInput(username)
  & validInput(password)
  & validInput(confirmPassword)
  & validInput(name)
  & validInput(email)
  & validInput(address)
  & usernameCheck
  & emailCheck)
  {
    valid = true;
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