<!DOCTYPE html>
<?php
session_start();
require_once "functions/functions.php";
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>E-Commerce Site</title>
    <link rel="stylesheet" type="text/css"  href="css/mystyle.css">
  </head>
  <body>
    <div class="main_wrapper">
      <div class="header_wrapper">
        <a href="index.php"><img id="logo" src="images/logo.jpg"></a>
        <img id="banner" src="images/banner.gif" alt="">
      </div>
      <div class="menubar">
        <ul id="menu">
          <li><a href="index.html.php">Home</a></li>
          <li><a href="all_products.php">All Products</a></li>
          <li><a href="my_account.php">My Account</a></li>
          <li><a href="#">Sign Up</a></li>
          <li><a href="cart.php">Cart</a></li>
          <li><a href="contact.php">Contact Us</a></li>
        </ul>
        <!--search form  -->
        <div id="form">
          <form class="" action="results.php" method="get">
            <input type="text" name="user_query" value="" placeholder="Search Products">
            <input type="submit" name="search" value="Search">
          </form>
        </div>
      </div>
      <div class="content-wrapper">
        <div id="sidebar">
          <div class="sidebar_title">Categories</div>
          <ul class="cats">
            <?php getCats(); ?>
          </ul>
          <div class="sidebar_title">Brands</div>
          <ul class="cats">
            <?php getBrands(); ?>
          </ul>
        </div>
        <div id="content_area">
          <div class="shopping-cart">
            <?php cart(); ?>
            <span style="float: right; font-size: 18px; padding: 5px; line-height: 40px;">
              <?php if(!isset($_SESSION['customer_email'])){
                echo "Welcome Guest";
              } else {
              echo "Welcome ". $_SESSION['customer_email'];
            }?>
            <b style="color: blue">Shopping Cart -</b>
            Total Items: <?php total_items(); ?>
            Total Price: <?php total_price(); ?>
            <a style="color: blue" href="cart.php">Go To Cart</a>
            <?php
            if(!isset($_SESSION['customer_email'])){ //if we'r not logged-in ...
              echo "<a style='color: orange' href='checkout.php'>Login</a> ";
            } else {
              echo "<a style='color: orange' href='logout.php'>Logout</a> ";
            }
            ?>
            </span>
          </div>
          <div class="products_box">
            <?php getPro(); ?>
          </div>
        </div>
      </div>
      <div id="footer">
        <h2>&copy; 2019 This website is build By Frank.</h2>
      </div>
    </div>


  </body>
</html>
