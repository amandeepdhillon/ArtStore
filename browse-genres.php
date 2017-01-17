<?php
    include 'includes/art-setup.inc.php';
    
    $gate = new GenreTableGateway($db);
    $genres = $gate->findAllSorted(true);
?>
<?php include 'includes/head.inc.php'; ?>
<body>
<?php include ('includes/header.inc.php'); ?>
    
    <h1 id="browseGenreHeading">Genres</h1>

    <main class="ui container">

        <div class="ui six doubling cards">
            <?php foreach ($genres as $genre) {?>
                <a class="card" href=<?php echo "single-genre.php?id=".$genre->GenreID; ?> >
                    <div class="image">
                        <img src=<?php echo "images/art/genres/square-medium/".$genre->GenreID.".jpg"; ?> >
                    </div>
                    <div class="content">
                        <h3><?php echo utf8_encode($genre->GenreName); ?></h3>
                    </div>
                </a>
            <?php } ?>
        </div>
    </main>
    
    <?php include("includes/footer.inc.php"); ?>
</body>

</html>