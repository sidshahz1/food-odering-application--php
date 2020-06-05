<?php 

// session start
include('dbConnection.php');

// if user is loged in do nothing
if(isset($_SESSION['user']) and !$_SESSION['isRestro']){
}
//else redirect to login page
else{
    array_push($errors,"Login to view this page");
    $_SESSION['msg']=$errors;
    $_SESSION['type']="danger";
    header("location:userLogin.php");
    exit;
}
  
?>