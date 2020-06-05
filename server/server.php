<?php

//connect to database and start session
include('../utilities/dbConnection.php');

//user registration route controller
if(isset($_POST['register_user']))
{
    //create variables for all user input
    $name=mysqli_real_escape_string($conn, $_POST['name']);
    $email=mysqli_real_escape_string($conn, $_POST['email']);
    $pass1=mysqli_real_escape_string($conn, $_POST['pass1']);
    $pass2=mysqli_real_escape_string($conn, $_POST['pass2']);
    $preference=mysqli_real_escape_string($conn, $_POST['preference']);
    
    //user input validation
    if(empty($name) || empty(trim($name))) {array_push($errors,"name is required");}
    if (strpos($email,' ') !== false || strpos($pass1,' ') !== false) {array_push($errors,"no blank sapces in email or password");}
    if(empty($email)) {array_push($errors,"email is required");}
    if(empty($pass1)) {array_push($errors,"password is required");}
    if(empty($preference)) {array_push($errors,"preference cannot be empty");}
    if($pass1 != $pass2 ) {array_push($errors,"passwords do not match");}
    
    //check uniqueness
    $query= "select * from users where name='$name' or email='$email' limit 1 ";
    $result= mysqli_query($conn,$query);
    $user= mysqli_fetch_assoc($result);
    if($user){
        if($user['email']===$email) {array_push($errors,"email is already registered");}
    }
    
    //register user
    if(count($errors)==0){
        $password= md5($pass1);
        //save user data
        $query= "insert into users (name,email,password,preference) values ('$name','$email','$password','$preference')";
        if(mysqli_query($conn,$query)){
            //database updated succesfully
            $_SESSION["msg"]="successfully registered, login to continue";
            $_SESSION['type']="success";
            header("location:../front-end/userLogin.php");
        }else{
            //database related error
            $_SESSION["msg"]= "database error- ". mysqli_error($conn);
            $_SESSION['type']="danger";
            header("location:../front-end/userRegistration.php");
        }
    }
    else{
        $_SESSION["msg"]=$errors;
        $_SESSION['type']="danger";
        header("location:../front-end/userRegistration.php");
    }
}

//restro registration route controller
if(isset($_POST['register_restro']))
{
    //create variables for all user input
    $name=mysqli_real_escape_string($conn, $_POST['name']);
    $email=mysqli_real_escape_string($conn, $_POST['email']);
    $pass1=mysqli_real_escape_string($conn, $_POST['pass1']);
    $pass2=mysqli_real_escape_string($conn, $_POST['pass2']);
    $isPureVeg = $_POST['pureVeg'];
    
    //user input validation
    if(empty($name) || empty(trim($name))) {array_push($errors,"name is required");}
    if (strpos($email,' ') !== false || strpos($pass1,' ') !== false) {array_push($errors,"no blank sapces in email or password");}
    if(empty($email)) {array_push($errors,"email is required");}
    if(empty($pass1)) {array_push($errors,"password is required");}
    if($pass1 != $pass2 ) {array_push($errors,"passwords do not match");}
    
    //check uniqueness
    $query= "select * from restro where email='$email' limit 1 ";
    $result= mysqli_query($conn,$query);
    $user= mysqli_fetch_assoc($result);
    if($user){
        if($user['email']===$email) {array_push($errors,"email is already registered");}
    }
    
    //register user
    if(count($errors)==0){
        $password= md5($pass1);
        //save user data
        $query= "insert into restro (name,email,password,isPureVeg) values ('$name','$email','$password','$isPureVeg')";
        if(mysqli_query($conn,$query)){
            //database updated succesfully
            $_SESSION["msg"]="successfully registered, login to continue";
            $_SESSION['type']="success";
            header("location:../front-end/restroLogin.php");
        }else{
            //database related error
            $_SESSION["msg"]= "database error- ". mysqli_error($conn);
            $_SESSION['type']="danger";
            header("location:../front-end/restroRegistration.php");
        }
    }
    //alert errors
    else{
        $_SESSION["msg"]=$errors;
        $_SESSION['type']="danger";
        header("location:../front-end/restroRegistration.php");
    }
}

//user login route controller
if(isset($_POST['login_user']))
{
    //create variables for all user input
    $email=mysqli_real_escape_string($conn, $_POST['email']);
    $password=mysqli_real_escape_string($conn, $_POST['password']);
    
    //user input validation
    if(empty($email)) {array_push($errors,"email is required");}
    if(empty($password)) {array_push($errors,"password is required");}
    
    //login user
    if(count($errors)==0){
        $passwordHash= md5($password);
        //save user data
        $query= "select * from users where email='$email' and password='$passwordHash' limit 1";
        $result=mysqli_query($conn,$query);
        $user=mysqli_fetch_assoc($result);
        //if user found
        if(mysqli_num_rows($result)==1){
            $_SESSION['user']=$user['name'];
            $_SESSION['id']=$user['id'];
            $_SESSION['preference']=$user['preference'];
            $_SESSION['isRestro']=false;
            header("location:../front-end/userHome.php");
        }
        //if user not found
        else{
            array_push($errors,"incorrect email or password");
            $_SESSION['msg']=$errors;
            $_SESSION['type']="danger";
            header("location:../front-end/userLogin.php");
        }
    }
    //alert errors
    else{
        $_SESSION['msg']=$errors;
        $_SESSION['type']="danger";
        header("location:../front-end/userLogin.php");
    }
}

//restro login
if(isset($_POST['login_restro']))
{
    //create variables for all user input
    $email=mysqli_real_escape_string($conn, $_POST['email']);
    $password=mysqli_real_escape_string($conn, $_POST['password']);
    
    //user input validation
    if(empty($email)) {array_push($errors,"email is required");}
    if(empty($password)) {array_push($errors,"password is required");}
    
    //login restro
    if(count($errors)==0){
        $passwordHash= md5($password);
        //save user data
        $query= "select * from restro where email='$email' and password='$passwordHash'";
        $result=mysqli_query($conn,$query);
        $user=mysqli_fetch_assoc($result);
        // if user found
        if(mysqli_num_rows($result)==1){
            $_SESSION['user']=$user['name'];
            $_SESSION['id']=$user['id'];
            $_SESSION['isRestro']=true;
            $_SESSION['isPureVeg']=$user['isPureVeg'];
            header("location:../front-end/restroHome.php");
        }
        // if user not found
        else{
            array_push($errors,"incorrect email or password");
            $_SESSION['msg']=$errors;
            $_SESSION['type']="danger";
            header("location:../front-end/restroLogin.php");
        }
    }
    //alert errors
    else{
        $_SESSION['msg']=$errors;
        $_SESSION['type']="danger";
        header("location:../front-end/restroLogin.php");
    }
}

?>