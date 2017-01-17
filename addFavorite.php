<?php
include_once('FavoriteItem.class.php');
include('CartItem.class.php');

if(!isset($_SESSION)) session_start();

if(isset($_GET['action']) && !empty($_GET['action'])) $action = $_GET['action'];
if(!isset($_SESSION['favorite'])) $_SESSION['favorite'] = new FavoriteItem();
if(isset($_GET['id']) && !empty($_GET['id'])) $id = $_GET['id'];
if(isset($_GET['type']) && !empty($_GET['type'])) $type = $_GET['type'];
if(isset($_GET['name']) && !empty($_GET['name'])) $name = $_GET['name'];

$fav = $_SESSION['favorite'];

if($action == 'add')
{
    if($type == 'painting')
        $fav->addPainting($id);
    else if($type == 'artist')
        $fav->addArtist($id);
}

$_SESSION['favorite'] = $fav; // 
header("Location: favorites.php");
?>