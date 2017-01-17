<?php
// Initialize variables for cart and favourites, and start session
    include 'FavoriteItem.class.php';
    include 'CartItem.class.php';
    session_start();

require_once('dataAccess/protected/config.php');

// Load all necessary, associated files for the database connection
spl_autoload_register(function ($class) {
    $file = 'dataAccess/noTouch/' . $class . '.class.php';
    if (file_exists($file)) 
      include $file;
    else
      include 'dataAccess/model/' . $class . '.class.php';
});

$db = DatabaseAdapterFactory::create('PDO', array(DBCONNECTION, DBUSER, DBPASS));

?>