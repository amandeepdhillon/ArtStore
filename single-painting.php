<?php
    include('includes/art-setup.inc.php');
    
    if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
        header('Location: single-painting.php?id=420');
    }

    include('includes/single-painting.helper.php');
    
    $id = $_GET['id'];
    
    // Definitions of TableGateways used on this page
    $gate = new PaintingTableGateway($db);
    $painting = $gate->findByID($id);
    
    $artistGate = new ArtistTableGateway($db);
    $artist = $artistGate->getArtistByPaintingID($id);
    
    $galleryGate = new GalleryTableGateway($db);
    $gallery = $galleryGate->findById($painting->GalleryID);
    
    $genreGate= new GenreTableGateway($db);
    $genres = $genreGate->findGenresByPaintingID($id);
    
    $subjectGate= new SubjectTableGateway($db);
    $subjects = $subjectGate->findSubjectsByPaintingID($id);
    
    $frameGate = new TypesFramesTableGateway($db);
    $frames = $frameGate->findAll();
                                        
    $glassGate = new TypesGlassTableGateway($db);
    $glasses = $glassGate->findAll();
                    
    $mattGate = new TypesMattTableGateway($db);
    $matts = $mattGate->findAll();

    $reviewGate = new ReviewTableGateway($db);
    $reviews = $reviewGate->findBy("PaintingID=?", array($id));

    if($painting == false){
        $painting = getPaintingByID($db, 5);
    }
    
    // Helper functions
    $_SESSION['painting'] = $id;
    
    $overallRating = calculateAverageReview($reviews);
?>

<?php include('includes/head.inc.php'); ?>

<body>

    <?php include ('includes/header.inc.php'); ?>

    <main>
        <!-- Main section about painting -->
        <section class="ui segment grey100">
            <div class="ui doubling stackable grid container">

                <div class="nine wide column">
                    <img src="images/art/works/medium/<?php echo $painting->ImageFileName ?>.jpg" alt="..." class="ui big image" id="artwork">

                    <div class="ui fullscreen modal">
                        <div class="image content">
                            <img src="images/art/works/large/<?php echo $painting->ImageFileName ?>.jpg" alt="..." class="image">
                            <div class="description">
                                <p></p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END LEFT Picture Column -->

                <div class="seven wide column">

                    <!-- Main Info -->
                    <div class="item">
                        <h2 class="header">
                            <?php echo utf8_encode($painting->Title) ?>
                        </h2>
                        <h3>
                            <?php echo utf8_encode($artist->ArtistName) ?>
                        </h3>
                        <div class="meta">
                            <p>
                                <?php 
                                    for($i=1; $i<=5; $i++){ ?>
                                        <i class="orange <?php if($i > $overallRating) { echo "empty"; } ?> star icon"></i>
                                <?php }?>
                               
                            </p>
                            <p>
                                <?php echo utf8_encode($painting->Excerpt) ?>
                            </p>
                        </div>
                    </div>

                    <!-- Tabs For Details, Museum, Genre, Subjects -->
                    <div class="ui top attached tabular menu ">
                        <a class="active item" data-tab="details"><i class="image icon"></i>Details</a>
                        <a class="item" data-tab="museum"><i class="university icon"></i>Museum</a>
                        <a class="item" data-tab="genres"><i class="theme icon"></i>Genres</a>
                        <a class="item" data-tab="subjects"><i class="cube icon"></i>Subjects</a>
                    </div>

                    <div class="ui bottom attached active tab segment" data-tab="details">
                        <table class="ui definition very basic collapsing celled table">
                            <tbody>
                                <tr>
                                    <td>
                                        Artist
                                    </td>
                                    <td>
                                        <a href="single-artist.php?id=<?php echo $painting->ArtistID ?>">
                                            <?php echo utf8_encode($artist->ArtistName) ?>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Year
                                    </td>
                                    <td>
                                        <?php echo $painting->YearOfWork ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Medium
                                    </td>
                                    <td>
                                        <?php echo $painting->Medium ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Dimensions
                                    </td>
                                    <td>
                                        <?php echo $painting->Width . "cm x " . $painting->Height . "cm" ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="ui bottom attached tab segment" data-tab="museum">
                        <table class="ui definition very basic collapsing celled table">
                            <tbody>
                                <tr>
                                    <td>
                                        Museum
                                    </td>
                                    <td>
                                        <a href=<?php echo "single-gallery.php?id=".$painting->GalleryID; ?>> 
                                            <?php echo utf8_encode($gallery->GalleryName); ?>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Assession #
                                    </td>
                                    <td>
                                        <?php echo $painting->AccessionNumber?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Copyright
                                    </td>
                                    <td>
                                        <?php echo $painting->CopyrightText ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        URL
                                    </td>
                                    <td>
                                        <a href=" <?php echo $painting->MuseumLink ?>">View painting at museum site</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="ui bottom attached tab segment" data-tab="genres">

                        <ul class="ui list">
                            <?php
                                foreach($genres as $genre){ ?>
                                    <li class="item">
                                        <a href=<?php echo "single-genre.php?id=".$genre->GenreID; ?> >
                                          <?php echo $genre->GenreName; ?>
                                        </a>
                                    </li>
                            <?php } ?>
                        </ul>

                    </div>
                    <div class="ui bottom attached tab segment" data-tab="subjects">
                        <ul class="ui list">
                            <?php
                                foreach($subjects as $subject){ ?>
                                    <li class="item">
                                        <a href=<?php echo "single-subject.php?id=". $subject->SubjectID; ?> >
                                            <?php echo $subject->SubjectName; ?>
                                        </a>
                                    </li>
                            <?php } ?>
                        </ul>
                    </div>

                    <!-- Cart and Price -->
                    <div class="ui segment">
                        <form method="GET" action="add-to-cart.php" class="ui form"> 
                            <div class="ui tiny statistic">
                                <div class="value">
                                    $
                                    <?php echo money_format('%i', $painting->MSRP)?>
                                </div>
                            </div>



                            <div class="four fields">
                                <div class="three wide field">
                                    <label>Quantity</label>
                                    <input name="quantity" type="number" min="0" value="1"> 
                                </div>

                                <div class="four wide field">
                                    <label>Frame</label>
                                    <select name="frame" id="frame" class="ui search dropdown">
                                    <?php foreach($frames as $frame){ ?>
                                        <option value=<?php echo $frame->FrameID; ?>> 
                                            <?php echo $frame->Title; ?> 
                                        </option>                    
                                    <?php } ?>  
                                     </select>
                                </div>


                                <div class="four wide field">
                                    <label>Glass</label>
                                    <select name="glass" id="glass" class="ui search dropdown">
                                      <?php foreach($glasses as $glass){ ?>
                                            <option value=<?php echo $glass->GlassID; ?>> 
                                                  <?php echo $glass->Title; ?> 
                                              </option> 
                                      <?php } ?>
                                    </select>
                                </div>
                                <div class="four wide field">
                                    <label>Matt</label>
                                    <select name="matt" id="matt" class="ui search dropdown">
                                        <?php foreach($matts as $matt){ ?>
                                              <option value=<?php echo $matt->MattID; ?>> 
                                                  <?php echo $matt->Title; ?> 
                                              </option>                     
                                        <?php  } ?>  
                                    </select>
                                </div>
                            </div>

                        <div class="ui divider"></div>
                            <button type="submit" class="ui labeled icon orange button">
                                <i class="add to cart icon"></i>
                              Add to Cart
                            </button>
                        <a href=<?php echo "../addFavorite.php?id=".$painting->PaintingID. "&type=painting&action=add"; ?>>
                            <button class="ui right labeled icon button" type="button">
                                <i class="heart icon"></i>
                                 Add to Favorites
                            </button>
                        </a>
                    </form>
                    
                   </div>
                    <!-- END Cart -->

                </div>
                <!-- END RIGHT data Column -->
            </div>
            <!-- END Grid -->
        </section>
        <!-- END Main Section -->

        <!-- Tabs for Description, On the Web, Reviews -->
        <section class="ui doubling stackable grid container">
            <div class="sixteen wide column">

                <div class="ui top attached tabular menu ">
                    <a class="active item" data-tab="first">Description</a>
                    <a class="item" data-tab="second">On the Web</a>
                    <a class="item" data-tab="third">Reviews</a>
                </div>

                <div class="ui bottom attached active tab segment" data-tab="first">
                    <?php echo utf8_encode($painting->Description) ?>
                </div>
                <!-- END DescriptionTab -->

                <div class="ui bottom attached tab segment" data-tab="second">
                    <table class="ui definition very basic collapsing celled table">
                        <tbody>
                            <tr>
                                <td>
                                    Wikipedia Link
                                </td>
                                <td>
                                    <a href="<?php echo $painting->WikiLink ?>">View painting on Wikipedia</a>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Google Link
                                </td>
                                <td>
                                    <a href="<?php echo $painting->GoogleLink ?>">View painting on Google Art Project</a>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Google Text
                                </td>
                                <td>
                                    <?php echo utf8_encode($painting->GoogleDescription) ?>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- END On the Web Tab -->

                <div class="ui bottom attached tab segment" data-tab="third">
                    <div class="ui feed">
                        <?php
                        foreach($reviews as $review){ ?>
                            <div class='event'>
                                <div class='content'>
                                    <div class="date">
                                        <?php echo date_format(date_create($review->ReviewDate), "Y/m/d"); ?>
                                    </div>
                                    <div class='meta'>
                                        <a class="like">
                                            <?php for($i=1; $i<=5; $i++) { ?> 
                                                <i class="<?php if($i > $review->Rating) { echo "empty"; } ?> star icon"></i>
                                            <?php }?>
                                        </a>
                                    </div>
                                    <div class="summary">
                                        <?php echo $review->Comment; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="ui divider"></div>
                        <?php } ?>
                    </div>
                </div>
                <!-- END Reviews Tab -->

            </div>
        </section>
        <!-- END Description, On the Web, Reviews Tabs -->

        <section class="ui container">
            <h3 class="ui dividing header">Related Works</h3>
        </section>

    </main>

    <?php include("includes/footer.inc.php"); ?>
</body>

</html>