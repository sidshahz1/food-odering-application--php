<?php

// session start and database connection
include('../utilities/dbConnection.php');

// order item route controller
if(isset($_POST['orderItem'])){

    //check user loged in or not
    if(isset($_SESSION['user']) and !$_SESSION['isRestro']){
            //create variables for all user input
            $itemId=mysqli_real_escape_string($conn, $_POST['itemId']);
            $userId=mysqli_real_escape_string($conn, $_POST['userId']);
            $restroId=mysqli_real_escape_string($conn, $_POST['restroId']);
        
            //save data
            $query="insert into orders (buyerId,sellerId,itemId) values ('$userId','$restroId','$itemId')";
            mysqli_query($conn,$query);
            $_SESSION['msg']="Item ordered";
            $_SESSION['type']='success';
            header('location:../front-end/userHome.php?view='.$restroId);
    }
    // display error messages
    else{
        array_push($errors,"Login to order items");
        $_SESSION['msg']=$errors;
        $_SESSION['type']="danger";
        header("location:../front-end/userLogin.php");
    }
    
}

// user logout route controller
if(isset($_GET['logout'])){
    // unset all session variables
    session_unset();
    $_SESSION['msg']="logout successfull";
    $_SESSION['type']="success";
    header('location:../front-end/userLogin.php');
}

?>