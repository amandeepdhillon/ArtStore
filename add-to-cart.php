<?php 
include('includes/art-setup.inc.php');


if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else {
    $id = $_SESSION['painting'];
}

$item = new CartItem($id);

// Assign values for cart item
if(isset($_GET['quantity'])) {
    $item->quantity = $_GET['quantity'];
}
if(isset($_GET['frame'])) {
    $item->frameID = $_GET['frame'];
}
if(isset($_GET['glass'])) {
    $item->glassID = $_GET['glass'];
}
if(isset($_GET['matt'])) {
    $item->mattID = $_GET['matt'];
}

// Assign cart item to cart
$_SESSION['cart'][$id] = $item;

// Automatically redirect to cart page
header("Location: cart.php");

die();

?>