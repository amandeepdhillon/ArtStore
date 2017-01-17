<?php 
include ("includes/art-setup.inc.php");

$fav = $_SESSION['favorite'];
$newData = $_POST; 

if ($_POST['clearA'] == 'clear') {
    $fav->emptyArtist();
}
else {
    foreach ($fav->getArtist() as $artist) {
        if ($newData['remArtist'][$artist] == "on") {
            $fav->removeArtist($artist);
        }
    }
}

if ($_POST['clearP'] == 'clear') {
    $fav->emptyPainting();
}
else {
    foreach ($fav->getPainting() as $painting) {
        if ($newData['remPainting'][$painting] == "on") {
            $fav->removePainting($painting);
        }
    }
}

$_SESSION['favorite'] = $fav;

header('Location: favorites.php');
die();
?>