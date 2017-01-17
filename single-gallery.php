<?php 
    include 'includes/art-setup.inc.php';
    if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
        header('Location: single-gallery.php?id=51');
    }

    $galleryGate = new GalleryTableGateway($db);
    $gallery = $galleryGate->findById($_GET['id']);

    $paintingGate = new PaintingTableGateway($db);
    $paintings = $paintingGate->findBy("GalleryID = ?", $_GET['id'], "YearOfWork");
    
    include 'includes/head.inc.php';
?>
<link href="css/popover.css" rel="stylesheet">
<script src="js/painting-preview.js"></script>

<body>

<?php
    include 'includes/header.inc.php';
?>
<!-- Styles need to be moved somewhere else... -->
<style> 
 #map {
   margin: 20px 0px 50px 0px;
   width: 50%;
   height: 400px;
   background-color: grey;
 }
</style>
<script src="js/map.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCMhulKGxM5PSTNMRxvR5QKapDPsPzQh4Q"></script>


    <main class="ui container">
        <div class="ui secondary segment">
            <h1>
                <a href=<?php echo $gallery->GalleryWebSite; ?> class="ui black header">
                    <?php echo utf8_encode($gallery->GalleryName); ?>
                </a>
            </h1>
            <p class="meta"><?php echo utf8_encode($gallery->GalleryCity.", ".$gallery->GalleryCountry); ?></p>
        </div>
        <div>
            <div id="map"></div>
        </div>
        
        <div class="ui container">
            <h2 class="ui dividing header">Paintings</h2>
            <div class="ui six doubling cards">
                <?php foreach ($paintings as $painting) { ?>
                    <div class="card">
                        <a href=<?php echo "single-painting.php?id=".$painting->PaintingID; ?> class="image">
                            <img src=<?php echo "images/art/works/square-medium/".$painting->ImageFileName.".jpg"; ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <?php include("includes/footer.inc.php"); ?>
</body>
    
    <?php echo "<script>initMap($gallery->Latitude, $gallery->Longitude); </script>"; ?>

</html>