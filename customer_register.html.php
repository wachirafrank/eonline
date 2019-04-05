<!DOCTYPE html>
<?php
session_start();
include 'functions/functions.php';

if(isset($_POST['register'])){
  global $con;
  $ip  = getIp();
  // fetch form data ...
  $c_name = $_POST['c_name'];
  $c_email = $_POST['c_email'];
  $c_pass = $_POST['c_pass'];
  $c_image = $_FILES['c_image']['name'];
  $c_image_tmp = $_FILES['c_image']['tmp_name'];
  $c_country = $_POST['c_country'];
  $c_city = $_POST['c_city'];
  $c_contact = $_POST['c_contact'];
  $c_address = $_POST['c_address'];

  move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

    $insert_c = "insert into customers (cust_ip,cust_name,cust_email,cust_pass,cust_country,cust_city,cust_contact,cust_address,cust_image)
                  values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
    $run_c = mysqli_query($con,$insert_c);
    $sel_cart = "select * from cart where ip_add='$ip'";
    $run_cart = mysqli_query($con,$sel_cart);
    $check_cart = mysqli_num_rows($run_cart);
    if($check_cart==0){
        $_SESSION['customer_email'] = $c_email;
        header('location: my_account.php');
    }
    else {
        $_SESSION['customer_email'] = $c_email;
        header('location: checkout.php');
    }
}
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Online shop</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
  </head>
  <body>
    <div class="main_wrapper">
      <div class="header_wrapper">
        <a href="index.php"><img id='logo' src="images/logo.jpg"></a>
        <img src="images/banner.gif" id="banner" alt="">
      </div>
      <div class="menubar">
        <ul id="menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="all_products.php">All Products</a></li>
          <li><a href="customer/account.php">My Account</a></li>
          <li><a href="sign.php">Sign Up</a></li>
          <li><a href="cart.php">Cart</a></li>
          <li><a href="contact.php">Contact Us</a></li>
        </ul>
        <div id="form">
          <form class="" action="results.php" method="get">
            <input type="text" name="user_query"  placeholder="Search Products" value="">
            <input type="submit" name="search" value="Search">
          </form>
        </div>
      </div>
      <div class="content_wrapper">
        <div class="sidebar">
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
          <div class="shopping_cart">
            <?php cart(); ?>
            <span id="span_for_account"> Welcome Guest! <b style="color:blue;">Shopping Cart - </b>
              Total Items: <?php total_items(); ?>
              Total Price: <?php total_price(); ?>
              <a style="color:blue;" href="cart.php">Go To Cart</a>
            </span>
          </div>
          <form class="" action="customer_register.php" method="post" enctype="umultipart/form-data">
            <table align="center" width=750>
              <tr align="center">
                <td colspan="3"><h2>Create an Account</h2></td>
              </tr>
              <tr>
                <td align="right">Name: </td>
                <td><input name="c_name" required></td>
              </tr>
              <tr>
                <td align="right">Email: </td>
                <td><input name="c_email" onkeyup="checkEmail(this.value)" required>
                <span id="hint"></span>
              </td>
              </tr>
              <tr>
                <td align="right">Password: </td>
                <td><input type="password" name="c_pass"  required value=""><td>
              </tr>
              <tr>
                <td align="right">Image: </td>
                <td><input type="file" name="c_image" required value=""></td>
              </tr>

              <tr>
                <td align="right">Country: </td>
                <td>
                  <select class="" name="c_coutry">
                    <option value="">Select a Country</option>
                    <option value="">Kenya</option>
                    <option value="">Uganda</option>
                    <option value="">America</option>
                    <option value="">Norway</option>
                  </select>
                </td>
              </tr>

              <tr>
                <td align="right">City: </td>
                <td><input  name="c_city" required value=""></td>
              </tr>

              <tr>
                <td align="right">Contact: </td>
                <td><input pattern=".*" name="c_contact" required value=""></td>
              </tr>

              <tr>
                <td align="right">Address: </td>
                <td><input name="c_address" required value=""></td>
              </tr>
              <tr align="center">
                <td colspan="3"><input type="submit" name="register" value="Create Account"></td>
              </tr>

            </table>

          </form>
        </div>

      </div>
    </div>
  </body>
</html>
