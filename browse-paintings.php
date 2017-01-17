<?php 
    include 'includes/art-setup.inc.php';
    include 'includes/head.inc.php';
?>

    <link href="css/popover.css" rel="stylesheet">
    <script src="js/painting-preview.js"></script>
    <script src="js/browse-painting.js"></script>

<body>

<?php 
    include 'includes/header.inc.php';
?>

<div class="ui hidden divider"></div>
<main class="ui container">
    <div class="ui segment">
        <div class="ui grid">

            <!-- Begin filter column -->
            <div class="four wide column">
                <h3 class="ui dividing header">Filters</h3>
                <form class="ui form" id="dropdownitem">
                    <?php 
                        $filters = array("Artist", "Gallery", "Shape");
                        
                        foreach ($filters as $filter) {
                            $gateName = $filter."TableGateway";
                            $nameField = $filter."Name";
                            $id = $filter."ID";
                            
                            $gate = new $gateName($db);
                            $items = $gate->findAllSorted(true);
                            
                    ?> 
                        <div class="field" id=<?php echo $filter."Filter"; ?> >
                            <label><?php echo $filter; ?></label>
                            <select class="ui dropdown" name =<?php echo $filter; ?> >
                                <option value=<?php echo 0; ?> >
                                    <?php echo "Select ".$filter; ?>
                                </option> 
                               <?php foreach ($items as $item) { ?>
                                   <option value=<?php echo $item->$id; ?> >
                                       <?php echo utf8_encode($item->$nameField); ?>
                                   </option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </form>
            </div>
            <!-- End filter column -->
                   
            <!-- Begin painting column -->
            <div class="twelve wide column">
                <h2>Paintings</h2>
                <p id='filter'>ALL PAINTINGS [TOP 20]</p>
                <div class="ui active dimmer">
                        <div class="ui text loader">Loading</div>
                </div>
                <div class="ui divided items" id="paintingsResults"></div>
            </div>
            <!-- End painting column -->
        </div>
    </div>
</main>

    <?php include("includes/footer.inc.php"); ?>
</body>
    <script>
        $('select.dropdown').dropdown();
    </script>
</html>