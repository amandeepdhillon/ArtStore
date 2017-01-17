<?php
   include 'includes/art-setup.inc.php';

   $fav = $_SESSION['favorite']; 
   
   $artistGate = new ArtistTableGateway($db);
   $paintGate = new PaintingTableGateway($db);
   
   include ('includes/head.inc.php');
?>
<body>
 <?php
    include 'includes/header.inc.php';?>
<main>
    <div class="ui container">
            <h1>Favourites</h1>
            <div class="ui padded segment">
                <h3 class="ui dividing header">Favorite Artists</h3>
                <form class="ui form" method="POST" action="update-favorite.php">
                    <div class="ui grid">
                     <?php foreach($fav->getArtist() as $favitem){ 
                        $favArtist = $artistGate->findById($favitem);?> 
                        
                            <div class="two wide column">
                                <a class="card" href= <?php  echo "single-artist.php?id=" .$favArtist->ArtistID; ?> >
                                    <div class="ui tiny image">
                                        <img src=<?php echo "images/art/artists/square-thumb/" .$favArtist->ArtistID. ".jpg"; ?> >
                                    </div>
                                    <div class="ui black header"> <?php echo utf8_encode($favArtist->ArtistName); ?> </div>
                                    <div class="ui checkbox">
                                        <input type="checkbox" name="remArtist[<?php echo $favArtist->ArtistID ?>]">
                                        <label>Delete</label>
                                    </div>
                                </a>
                            </div>
                        
                    <?php } ?>
                    </div>
                    <div class="ui hidden divider"></div>
                   <button type="submit" name="removeA" value="remove" class="ui yellow button">
                        <i class= "remove sign icon"></i> Remove
                   </button>
                   <button type="submit" name="clearA" value="clear" class="ui negative button">
                        <i class="remove icon"></i> Clear All
                    </button>
                </form>
            </div>
        </div>
    
        <div class="ui header"></div>
                    
        <div class="ui container">
            
            <div class="ui padded segment">
                <h3 class="ui dividing header">Favorite Paintings</h3>
                <form class="ui form" method="POST" action="update-favorite.php">
                    <div class="ui grid">
                     <?php
                        foreach($fav->getPainting() as $favitem){
                            $favPainting = $paintGate->findById($favitem); ?>         
                             <a class="two wide column" href=<?php echo "single-painting.php?id=" .$favPainting->PaintingID ?>>
                                 <div class="ui centered tiny image">
                                     <img src=<?php echo "images/art/works/square-medium/" .$favPainting->ImageFileName. ".jpg";?> >
                                 </div>
                                 <div class="ui black header"> <?php echo utf8_encode($favPainting->Title); ?> </div>
                                 <div class="ui checkbox">
                                    <input type="checkbox" name="remPainting[<?php echo $favPainting->PaintingID ?>]">
                                    <label>Delete</label>
                                </div>
                             </a>
                             
                    <?php } ?>
                    </div>
                <div class="ui hidden divider"></div>
                <button type="submit" name="removeP" value="remove" class="ui yellow button">
                    <i class= "remove sign icon"></i> Remove
                  </button>
                <button type="submit" name="clearP" value="clear" class="ui negative button">
                    <i class="remove icon"></i> Clear All
                </button>
            </form>
        </div>
</div>

</main>

    <?php include("includes/footer.inc.php"); ?>
</body>
