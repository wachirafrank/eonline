<?php
$con = mysqli_connect("localhost", "root","","store_db");
// mysqli_connect( [$host, $user, $password, $database, $port, $socket])
if(!$con){
  die("Connection failed ...");
}
