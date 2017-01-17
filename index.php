<?php
    include 'FavoriteItem.class.php';
    include 'CartItem.class.php';
    session_start();
    include 'includes/head.inc.php';
?>

<body>

    <?php include('includes/header.inc.php'); ?>

    <div class="hero-container">
        <div class="ui text container">
            <h1 class="ui huge header">Decorate your world</h1>
            <a href="browse-paintings.php" class="ui huge orange button">Shop Now</a>
        </div>
    </div>
    <h2 class="ui horizontal divider"><i class="tag icon"></i> Deals</h2>

    <main class="ui centered cards container">

        <div class="ui card">
            <div class="image">
                <img src="images/art/works/medium/107050.jpg">
            </div>
            <div class="content">
                <h4>Experience the sensuous pleasures of the French Rococco</h4>
            </div>
            <a href="single-genre.php?id=83">
                <div class="ui bottom attached button">
                    <i class="info circle icon"></i> See More
                </div>
            </a>
        </div>


        <div class="ui card">
            <div class="image">
                <img src="images/art/works/medium/126010.jpg">
            </div>
            <div class="content">
                <h4>Appeciate the quiet beauty of the Dutch Golden Age</h4>
            </div>
            <a href="single-genre.php?id=87">
                <div class="ui bottom attached button">
                    <i class="info circle icon"></i> See More
                </div>
            </a>
        </div>


        <div class="ui card">
            <div class="image">
                <img src="images/art/works/medium/100030.jpg">
            </div>
            <div class="content">
                <h4>Discover the glorious color of the Renaissance</h4>
            </div>
            <a href="single-genre.php?id=78">
                <div class="ui bottom attached button">
                    <i class="info circle icon"></i> See More
                </div>
            </a>
        </div>

    </main>
    
</body>

</html>