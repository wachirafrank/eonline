<?php
if(isset($_GET['login'])){
  global $con;
  $ip = getIp();
  $c_email = $_POST['email'];
  $_pass = $_POST['pass'];

  $sel_c  = "select * from customers where cust_pass = '$c_pass' AND cust_email ='$c_email'";
  $run_c = mysqli_query($con , $sel_c);
  $check_c = mysqli_num_rows($run_c);
  if($check_c == 0){
    header('location: '$_SERVER['PHP_SELF']);
    exit(); //terminate application
  }
  $sel_cart = "select * from cart where ip_add = '$ip'";
  $run_cart = mysqli_query($con, $sel_c);
  $check_cart = mysqli_fetch_array($run_cart);
  if($check_c > 0 && $check_cart == 0){
    $_SESSION['customer_email'] == $c_email;
    header('location: my_account.php');
  }else {
    $_SESSION['customer_email'] == $c_email;
    header('location: checkout.php');
  }
}  //if(isset($_GET['login']))
?>

<!-- Form -->
<!-- set form action to "" if we'r referring to the current script -->
<form class="" action="" method="post">
  <table id="table">
    <tr align="center">
      <td colspan="2"><h2>Login/Register To Buy</h2></td>
    </tr>
    <tr>
      <td align="right"><b>Email: </b></td>
      <td><input type="text" name="email" placeholder="Enter Passoword" required value=""></td>
    </tr>
    <tr>
      <td align="right"><b>Password: </b></td>
      <td><input type="password" name="pass" placeholder="Enter Email" required value=""></td>
    </tr>
    <tr align="center">
      <td colspan="2"> <a href="checkout.php>forgot_pass">Forgot Pasword?</a></td>
    </tr>
    <tr align="center">
      <td colspan="2"> <input type="submit" name="login" value="Login"></td>
    </tr>
  </table>
  <h2 class="form_h2"><a style="text-decoration:none;" href="customer_register.php">Register Now</a></h2>
</form>
