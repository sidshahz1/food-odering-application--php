<?php 

// connect database and start the session
include("../utilities/dbConnection.php");

// add menu item route
if(isset($_POST['additem'])){

    //create variables for all user input
    $itemname=mysqli_real_escape_string($conn, $_POST['itemname']);
    $itemdetail=mysqli_real_escape_string($conn, $_POST['itemdetail']);
    $itemcost=mysqli_real_escape_string($conn, $_POST['itemcost']);
    $itemtype=mysqli_real_escape_string($conn, $_POST['type']);
    $restroid=$_SESSION['id'];

    
    //user input validation
    if(empty($itemname)) {array_push($errors,"item name is required");}
    if(empty($itemcost)) {array_push($errors,"item cost is required");}

    //add item to our database
    if(count($errors)==0){
        //save items data
        $query= "insert into menu (itemName, itemDetail , itemCost, itemType, restroId) values ('$itemname','$itemdetail','$itemcost','$itemtype','$restroid')";
        mysqli_query($conn,$query);
        $_SESSION['msg']="Item added to your menu";
        $_SESSION['type']='success';
        header('location:../front-end/restroHome.php');
    }
    // alert for any errors
    else{
        $_SESSION['msg']=$errors;
        $_SESSION['type']='danger';
        header('location:../front-end/restroHome.php');
    }

}

// delete menu item route controller
if(isset($_GET['delete'])){
    // get the item id
    $id=$_GET['delete'];
    
    // find and delete the item
    $query="delete from menu where id='$id'";
    mysqli_query($conn,$query);

    // alert user for item deleted
    $_SESSION['msg']="Item deleted from your menu";
    $_SESSION['type']='danger';
    header('location:../front-end/restroHome.php');
}

// update menu item route handler
if(isset($_POST['updateitem'])){
    //create variables for all user input
    $itemid=$_POST['itemId'];
    $itemname=mysqli_real_escape_string($conn, $_POST['itemname']);
    $itemdetail=mysqli_real_escape_string($conn, $_POST['itemdetail']);
    $itemcost=mysqli_real_escape_string($conn, $_POST['itemcost']);
    $itemtype=mysqli_real_escape_string($conn, $_POST['type']);

    
    //user input validation
    if(empty($itemname)) {array_push($errors,"item name is required");}
    if(empty($itemcost)) {array_push($errors,"item cost is required");}

    //update item details in our database
    if(count($errors)==0){
        //update item data
        $query= "update menu set itemName='$itemname',itemDetail='$itemdetail' ,itemCost='$itemcost', itemType='$itemtype' where id='$itemid'";
        mysqli_query($conn,$query);
        $_SESSION['msg']="Item updated";
        $_SESSION['type']='success';
        header('location:../front-end/restroHome.php');
    }
    // alert for any error
    else{
        $_SESSION['msg']=$errors;
        $_SESSION['type']='danger';
        header('location:../front-end/restroHome.php');
    }
}

// deliver item route controller
if((isset($_GET['deliver']))){

    // get item id
    $orderId=$_GET['deliver'];

    // update the status of item to delivered
    $query="update orders set status='delivered' where orderId='$orderId'";
    mysqli_query($conn,$query);
    $_SESSION['msg']="item delivered";
    $_SESSION['type']='success';
    header('location:../front-end/restroOrders.php');
}