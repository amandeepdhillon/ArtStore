<?php
    include('includes/art-setup.inc.php');

    if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
        header('Location: single-artist.php?id=1');
    }
    
    $id = $_GET['id'];
    
    $gate = new ArtistTableGateway($db);
    
    //needs error check for invalid
    $artist = $gate->findByID($id); 
    
    $paintingGate = new PaintingTableGateway($db);
    $paintings = $paintingGate->findBy("ArtistId = ?", $id, YearOfWork);
?>
<?php
    include 'includes/head.inc.php';
?>
<link href="css/popover.css" rel="stylesheet">
<script src="js/painting-preview.js"></script>

<body>
        <?php 
include ('includes/header.inc.php');
?>
        <main>
            <div class="ui secondary segment">
                <div class="ui container items">
                    <div class="item">
                        <div class="image">
                            <img src="/images/art/artists/square-medium/<?php echo $artist->ArtistID ?>.jpg">
                        </div>
                        <div class="content">
                            <a class="header">
                                <?php echo utf8_encode($artist->ArtistName); ?>
                            </a>

                            <div class="description">
                                <p>
                                    <?php echo utf8_encode($artist->Details) ?>
                                </p>
                            </div>
                            <div class="extra">
                                <a href=<?php echo "../addFavorite.php?id=".$artist->ArtistID."&type=artist&action=add"; ?>>
                                    <button class="ui right labeled icon button" type="button">
                                        <i class="heart icon"></i>
                                         Add to Favorites
                                    </button>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="ui container">
            <div class="ui horizontal segments">
                <div class="ui teal center aligned segment">
                    <p>Year of Birth: <?php echo $artist->YearOfBirth; ?></p>
                </div>
                <div class="ui purple center aligned segment">
                    <p>Nationality: <?php echo $artist->Nationality; ?></p>
                </div>
                <div class="ui red center aligned segment">
                    <p>Artist Link: <a href="<?php echo $artist->ArtistLink;?>" class="artistLink"><?php echo $artist->ArtistLink;?></a></p>
                </div>
            </div>
            </div>

            <div class="ui container">
                <h3 class="ui dividing header">Paintings By This Artist</h3>
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