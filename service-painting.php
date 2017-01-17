<?php 
    
    include 'includes/art-setup.inc.php';
    
    $gate = new PaintingTableGateway($db);
    $artistGate = new ArtistTableGateway($db);
    
    header('Content_Type: application/json');

    // Filter by type, make appropriate DB query
    if($_GET['type'] == "artist") { 
        $list = $gate->findBy("ArtistID=?", $_GET['id'], true);
    }
    else if ($_GET['type'] == "gallery") { 
        $list = $gate->findBy("GalleryID=?", $_GET['id'], true);
    }
    else if ($_GET['type'] == "shape") { 
        $list = $gate->findBy("ShapeID=?", $_GET['id'], true);
    }
    else { 
        $list = $gate->findAllSorted(true);
    }
    
    // Match artist names to paintings
    foreach($list as $key => $value) {
        $artist = $artistGate->findByID($value->ArtistID);
        $value->ArtistName = $artist->FirstName." ".$artist->LastName;
    }

    echo json_encode($list);
?>
