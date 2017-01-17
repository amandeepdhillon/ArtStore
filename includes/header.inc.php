<header>
    <div class="ui attached stackable grey inverted  menu">
        <div class="ui container">
            <nav class="right menu">            
                <div class="ui simple  dropdown item">
                  <i class="user icon"></i>
                  Account
                    <i class="dropdown icon"></i>
                  <div class="menu">
                    <a class="item"><i class="sign in icon"></i> Login</a>
                    <a class="item"><i class="edit icon"></i> Edit Profile</a>
                    <a class="item"><i class="globe icon"></i> Choose Language</a>
                    <a class="item"><i class="settings icon"></i> Account Settings</a>
                  </div>
                </div>
                <a href="favorites.php" class=" item">
                  <i class="heartbeat icon"></i> Favorites
                  <div class="ui floated red label">
                    <?php 
                    if(!isset($_SESSION['favorite'])) $_SESSION['favorite']= new FavoriteItem();
                     echo count($_SESSION['favorite']->getPainting()) + count($_SESSION['favorite']->getArtist()); 
                    ?>
                  </div>
                </a>        
                <a href="cart.php" class=" item">
                  <i class="shop icon"></i> Cart
                  <div class="ui floated blue label">
                    <?php echo count($_SESSION['cart']); ?>
                  </div>
                </a>                                     
            </nav>            
        </div>     
    </div>   
    
    <div class="ui attached stackable borderless huge menu">
        <div class="ui container">
            <h2 class="header item">
              <img src="images/logo5.png" class="ui small image" >
            </h2>  
            <a href="index.php" class="item">
              <i class="home icon"></i> Home
            </a>       
            <a href="about-us.php" class="item">
              <i class="mail icon"></i> About Us
            </a>      
            <a href="#" class="item">
              <i class="home icon"></i> Blog
            </a>      
            <div class="ui simple dropdown item">
              <i class="grid layout icon"></i>
              Browse
                <i class="dropdown icon"></i>
              <div class="menu">
                <a href="browse-artists.php" class="item"><i class="users icon"></i> Artists</a>
                <a href="browse-galleries.php" class="item"><i class="university icon"></i> Galleries</a>
                <a href="browse-genres.php" class="item"><i class="theme icon"></i> Genres</a>
                <a href="browse-paintings.php" class="item"><i class="paint brush icon"></i> Paintings</a>
                <a href="browse-subjects.php" class="item"><i class="cube icon"></i> Subjects</a>
              </div>
            </div>        
            <div class="right item">
                <div class="ui search">
                  <div class="ui left icon input">
                    <input class="prompt" type="text" placeholder="Search Paintings...">
                    <i class="github icon"></i>
                  </div>
                  <div class="results"></div>
                </div>
            </div>      

        </div>
    </div>       
</header> 