<?php 
    include 'includes/art-setup.inc.php';
    
    $gate = new GalleryTableGateway($db);
    $galleries = $gate->findAllSorted(true);
    
    include 'includes/head.inc.php'; 
?>
<body>
<?php include 'includes/header.inc.php';  ?>
    <main class="ui container">
        <h1>Galleries</h1>
        <div class="ui grid"> 
            <?php 
                foreach ($galleries as $gallery) { ?>
                <div class="four wide column">
                    <div class="content">
                        <a href=<?php echo "single-gallery.php?id=".$gallery->GalleryID; ?> class="ui black header">
                            <?php echo utf8_encode($gallery->GalleryName); ?>
                        </a>
                        <div class="description"><?php echo $gallery->GalleryCity.', '.$gallery->GalleryCountry ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    
    <?php include("includes/footer.inc.php"); ?>
</body>

</html>