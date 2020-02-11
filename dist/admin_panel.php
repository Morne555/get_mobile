<?php require 'include/session.php' ?>
<?php require 'include/database_config.php' ?>

<?php 

    if(!isset($_SESSION["admin"])){
        header("location: admin.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate username
        $id;
        $sql;
        if(isset($_POST["addProduct"])){
                $productName = $_POST["productName"];
                $productImage = $_POST["productImage"];
                $productDescription = $_POST["productDescription"];
                $productCategory = $_POST["productCategory"];
                $productSubCategory = $_POST["productSubCategory"];
                $productPrice = $_POST["productPrice"];
                $sql = "INSERT INTO product (product_name, product_image, product_description, 
                    product_category, product_sub_category, product_price)  VALUES (?, ?, ?, ?, ?, ?)";
                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "ssssss", $productName, $productImage, $productDescription, $productCategory, $productSubCategory, $productPrice);
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        header("location: admin_success.php");
                    mysqli_stmt_close($stmt);
                    } else{
                        header("location: admin_failed.php");
                    }
                }
                 // Close statement
                
        }
        if(isset($_POST["addAdmin"])) {
            $adminUsername = $_POST["adminUsername"];
            $adminPassword = $_POST["adminPassword"];

            $sql = "INSERT INTO admin (admin_username, admin_password)  VALUES (?, ?)";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss",  $adminUsername, password_hash($adminPassword, PASSWORD_DEFAULT));
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    header("location: admin_success.php");
                mysqli_stmt_close($stmt);
                } else{
                    header("location: admin_failed.php");
                }
            }
        }
        if(isset($_POST["delete"])) {
            $id;
            $sql;
            if (isset($_POST["checkoutID"])) {
                $id = $_POST["checkoutID"];
                $sql = "DELETE FROM checkout WHERE checkout_id = ?";
            }
            else if (isset($_POST["userID"])) {
                $id = $_POST["userID"];
                $sql = "DELETE FROM user WHERE user_id = ?";
            }
            else if (isset($_POST["cartID"])) {
                $id = $_POST["cartID"];
                $sql = "DELETE FROM cart WHERE cart_id = ?";
            }
            else if (isset($_POST["productID"])) {
                $id = $_POST["productID"];
                $sql = "DELETE FROM product WHERE product_id = ?";
            }
            else if (isset($_POST["adminID"])) {
                $id = $_POST["adminID"];
                $sql = "DELETE FROM admin WHERE admin_id = ?";
            }

            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s",  $id);
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    header("location: admin_success.php");
                mysqli_stmt_close($stmt);
                } else{
                    header("location: admin_failed.php");
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require 'include/link.php' ?>

    <title>Admin Panel</title>
</head>
<body>
    <div class="mainContainer">
        <?php require 'include/nav.php' ?>

        <header class="adminHeader spaceTop">
            <h2>Admin Panel</h2>
            <hr>
        </header>

        <div class="tableContainer spaceTop">
            <h3>Checkout</h3>
            <div class="table">
                <?php require 'include/load_table_checkout.php' ?>
            </div>
            <div class="formContainer">
                <form class="adminForm" name="checkoutForm" onsubmit="true" method="post">
                    <h4>Delete</h4>
                    <input type="hidden" name="delete" value="">
                    <input name="checkoutID" class="id" type="text" placeholder="id..."><button class="button button--warning">Remove</button>
                </form>
            </div>
        </div>

        <div class="tableContainer spaceTop">
            <h3>Users</h3>
            <div class="table">
                <?php require 'include/load_table_user.php' ?>
            </div>
            <div class="formContainer">
                <form class="adminForm" name="checkoutForm" onsubmit="true" method="post">
                    <h4>Delete</h4>
                    <input type="hidden" name="delete" value="">
                    <input name="userID" class="id" type="text" placeholder="id..."><button class="button button--warning">Remove</button>
                </form>
            </div>
        </div>

        <div class="tableContainer spaceTop">
            <h3>Cart</h3>
            <div class="table">
                <?php require 'include/load_table_cart.php' ?>
            </div>
            <div class="formContainer">
                <form class="adminForm" name="checkoutForm" onsubmit="true" method="post">
                    <h4>Delete</h4>
                    <input type="hidden" name="delete" value="">
                    <input name="cartID" class="id" type="text" placeholder="id..."><button class="button button--warning">Remove</button>
                </form>
            </div>
        </div>

        <div class="tableContainer spaceTop">
            <h3>Products</h3>
            <div class="table">
                <?php require 'include/load_table_product.php' ?>
            </div>
            <div class="formContainer">
                <form class="adminForm" name="productForm" onsubmit="true" method="post">
                    <h4>Delete</h4>
                    <input type="hidden" name="delete" value="">
                    <input name="productID" class="id" type="text" placeholder="id..."><button class="button button--warning">Remove</button>
                </form>
                <form class="adminForm" name="productForm" onsubmit="true" method="post">
                    <h4>Add</h4>
                    <input type="hidden" name="addProduct" value="">
                    <input name="productName" class="id" type="text" placeholder="product name...">
                    <input name="productImage" class="id" type="text" placeholder="product image...">
                    <input name="productDescription" class="id" type="text" placeholder="product description...">
                    <input name="productCategory" class="id" type="text" placeholder="product category...">
                    <input name="productSubCategory" class="id" type="text" placeholder="product sub-category...">
                    <input name="productPrice" class="id" type="text" placeholder="product price...">
                    <button class="button button--success">Add</button>
                </form>
            </div>
        </div>

        <div class="tableContainer spaceTop">
            <h3>Admins</h3>
            <div class="table">
                <?php require 'include/load_table_admin.php' ?>
            </div>
            <div class="formContainer">
                <form class="adminForm" name="checkoutForm" onsubmit="true" method="post">
                    <h4>Delete</h4>
                    <input type="hidden" name="delete" value="">
                    <input name="adminID" class="id" type="text" placeholder="id..."><button class="button button--warning">Remove</button>
                </form>
                <form class="adminForm" name="adminForm" onsubmit="true" method="post">
                    <h4>Add</h4>
                    <input type="hidden" name="addAdmin" value="addAdmin">
                    <input name="adminUsername" class="id" type="text" placeholder="username...">
                    <input name="adminPassword" class="id" type="password" placeholder="password...">
                    <button class="button button--success">Add</button>
                </form>
            </div>
        </div>

    
        <?php require 'include/footer.php' ?>
    </div>
    
    <?php require 'include/script.php' ?>
</body>
</html>