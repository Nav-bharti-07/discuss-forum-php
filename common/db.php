<?php

$host = "localhost:3307";
$username = "root";  //bydefault
$password = "";
$database = "discuss";

$con = new mysqli($host,$username,$password,$database);

if($con -> connect_error){
  die("not connected with DB".$con -> connect_error);
}

?>