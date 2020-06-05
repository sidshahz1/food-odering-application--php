<?php 

//session start
include('dbConnection.php');

// if user is logged in do nothing
if(isset($_SESSION['user']) and $_SESSION['isRestro']){
}
// else redirect to login page
else{
    array_push($errors,"Login to access this page");
    $_SESSION['msg']=$errors;
    $_SESSION['type']="danger";
    header("location:restroLogin.php");
    exit;
}

// restro logout, unset all session variables and resdirect to login page
if(isset($_GET['logout'])){
    session_unset();
    $_SESSION['msg']="logout successfull";
    $_SESSION['type']="success";
    header('location:restroLogin.php');
    exit;
}
    
?>