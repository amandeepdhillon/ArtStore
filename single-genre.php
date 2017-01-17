<?php 
    include 'includes/art-setup.inc.php';
    
    if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
        header('Location: single-genre.php?id=1');
    }
?>

<?php
$id = $_GET['id'];

$genreGate = new GenreTableGateway($db);
$genre = $genreGate->findByID($id);

$paintingGate = new PaintingTableGateway($db);
$paintings = $paintingGate->getPaintingsByGenreID($id);
?>

<?php include 'includes/head.inc.php'; ?>
<link href="css/popover.css" rel="stylesheet">
<script src="js/painting-preview.js"></script>

<body>

<?php include 'includes/header.inc.php'; ?>

    <main>
        <div class="ui secondary segment">
            <div class="ui container items">
                <div class="item">
                    <div class="image">
                        <img src="/images/art/genres/square-medium/<?php echo $id ?>.jpg">
                    </div>
                    <div class="content">
                        <a class="header"><?php echo utf8_encode($genre->GenreName) ?></a>
                        <div class="description">
                            <p><?php echo utf8_encode($genre->Description) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="ui container">
            <h3 class="ui dividing header">Paintings</h3>
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
</html>