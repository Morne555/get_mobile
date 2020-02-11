<nav class="nav">
    <a class="nav__brand" href="index.php"><h1>GetMobile</h1></a>
    <ul class="nav__links nav__links--spaceEvenly">
        <li><a class="<?php active(''); active("index.php")?>" href="index.php">Home</a></li>
        <li><a class="<?php active("products.php")?>" href="products.php">Products</a></li>
        <li><a class="<?php active("about.php")?>" href="about.php">About</a></li>
        <li><a class="<?php active("contact.php")?>" href="contact.php">Contact</a></li>
       <?php if(isset($_SESSION["admin"]) && $_SESSION["admin"] === true)
                    echo '<li><a class="',active("admin_panel.php"),'" href="admin_panel.php">Admin</a></li>';
                    ?>  
    </ul>
    <ul class="nav__links nav__links--alignRight">

        <?php
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) 
                {
                    echo '<li><a href="cart.php"><i class="fas fa-shopping-cart"></i></a></li>';
                    echo '<li class="dropdown"><a href="#">', htmlspecialchars($_SESSION["username"]), ' <i class=" fas fa-caret-down"></i></a>';
                    echo '<div class="dropdown__content">
                            <a href="request/logout.php">Logout</a>
                            </div>
                            </li>';
                    
                }
                else
                {
                    echo '<li><a class="dropdown ',active("login.php"); active("register.php"); 
                    echo '" href="login.php">Login/Register</a></li>';
                }
                ?>
    </ul>
</nav>

<?php
function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);
  if($currect_page == $url)
  {
    echo 'active';
  }
}
?>