<!DOCTYPE html>
<?php session_start();
require_once 'functions/functions.php'
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Online Shop</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <style>
      .main_wrapper {
        background-color: pink;
      }
      .cats a {
        color: orange;
      }
      .cats  a:hover {
        color: white;
      }
    </style>

  </head>
  <body>
    <div class="main_wrapper">
      <div class="header_wrapper">
        <a href="index.php"><img id="logo" src="images/logo.jpg"></a>
        <img id="banner" src="images/banner.gif" alt="">
      </div>
      <div class="menubar">
        <ul id="menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="all_products.php">All Products</a></li>
          <li><a href="my_account.php">My Account</a></li>
          <li><a href="sign_up.php">Sign Up</a></li>
          <li><a href="cart.php">Cart</a></li>
          <li><a href="contact_us.php">Contact Us</a></li>
        </ul>
        <div id="form">
          <form class="" action="results.php" method="get">
            <input type="text" name="user_query"  placeholder="Search Products" value="">
            <input type="submit" name="seacrh" value="Search">
          </form>
        </div>
      </div>
      <div class="content_wrapper">
        <div id="sidebar">
          <div class="sidebar_title">My Account</div>
          <ul class="cats">
            <?php
            $user = $_SESSION['customer_email'];
            $get_img = "select * from customers where cust_email = '$user'";
            $run_img = mysqli_query($con, $get_img);
            $row_img  = mysqli_fetch_array($run_img);
            $c_img = $row_img['cust_img'];
            $c_name = $row_img['cust_name'];
            echo "<img src='customer/customer_images/$c_image' width= '150' height='150' style='border: 2px solid white; border-radius: 50%; ' >"
            ?>
            <li><a href="my_account.php?my_orders">My Orders</a></li>
            <li><a href="my_account.php?edit_account">Edit Account</a></li>
            <li><a href="my_account.php?change_pass">Change Password</a></li>
            <li><a href="my_account.php?del_account">Delete Account</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
        <div class="content_area">
          <div class="shopping_cart">
            <?php cart(); ?>
            <span id="span_for_account">
              <?php
              if(isset($_SESSION['customer_email'])){
                echo "Welcome ". $_SESSION['customer_email'];
              } else {
                header('location: index.php');
              }
              ?>
            </span>
          </div>
          <div class="products_box">
            <?php
            if(!isset($_GET['my_orders'])){
              if(!isset($_GET['edit_account'])){
                if(!isset($_GET['change_pass'])){
                  if(!isset($_GET['del_account'])){
                    echo "<h2 style='padding: 20px;'>Welcome: $c_name </h2>";
                    echo "<b> You can see your oders' progress by clicking this <a href='my_account.php?my_orders'>Link</a></b>";
                  }
                }
              }
            }
            ?>
            <?php
            if(isset($_GET['edit_account'])){
              include ('edit_account.php');
            }else
              if(isset($_GET['change_pass'])){
                include ('change_pass.php');
            }else
              if(isset($_GET['del_account'])){
                include ('del_account.php');
              }
            ?>
          </div>

        </div>

      </div>
      <div id="footer">
        <h2>&copy; E-Commerce Site Frank</h2>
      </div>
    </div>
  </body>
</html>
