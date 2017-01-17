<?php  
      include 'includes/art-setup.inc.php';
      $gate = new ArtistTableGateway($db);
      $artists = $gate->findAllSorted(true);
?>

<?php include 'includes/head.inc.php'; ?>

<body >
    
<?php include('includes/header.inc.php'); ?>
  
<h1 id="browseGenreHeading">Artists</h1>  

<main class="ui container">
      <div class="ui six doubling cards">
            <?php foreach ($artists as $artist) {?>
                <a class="card" href=<?php echo "single-artist.php?id=".$artist->ArtistID; ?> >
                    <div class="image">
                        <img src=<?php echo "images/art/artists/square-medium/".$artist->ArtistID.".jpg"; ?> >
                    </div>
                    <div class="content">
                        <h3><?php echo utf8_encode($artist->ArtistName); ?></h3>
                    </div>
                </a>
            <?php } ?>
      </div>
</main>    
      <?php include("includes/footer.inc.php"); ?>
</body>
</html>