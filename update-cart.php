<?php 
include ("includes/art-setup.inc.php");

// Check to see if cart needs to be cleared
if($_POST['clear'] == "clear") {
    $_SESSION['cart'] = array();
    header("Location: cart.php");
    die();
}
else{ 
    $cart = $_SESSION['cart'];
    $newData = $_POST;
    
    // For each item in the old cart, update with the values in the new cart
    foreach($cart as $item){
        if($newData['delete'][$item->paintingID] == "on") {
            unset($cart[$item->paintingID]);
            break;
        }
        $item->quantity = $newData['quantity'][$item->paintingID];
        $item->frameID = $newData['frame'][$item->paintingID];
        $item->glassID = $newData['glass'][$item->paintingID];
        $item->mattID = $newData['matt'][$item->paintingID];
    }
    
    // Set session variables with submitted form elements
    $_SESSION['cart'] = $cart;
    $_SESSION['shipping'] = $_POST['shipping'];
}

// Redirect user to home page
if($_POST['shop'] == "shop") {
    header("Location: index.php");
    die();
}

die();
?>