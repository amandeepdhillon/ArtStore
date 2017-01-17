<?php 
    include 'includes/art-setup.inc.php';

    $gate = new SubjectTableGateway($db);
    $subjects = $gate->findAllSorted(true);
?>

<?php include 'includes/head.inc.php'; ?>

<body>

    <?php include ('includes/header.inc.php'); ?>

<h1 id="browseGenreHeading">Subjects</h1>
    <main class="ui container">
        <div class="ui six doubling cards">
            <?php foreach ($subjects as $subject) {?>
                <a class="card" href=<?php echo "single-subject.php?id=".$subject->SubjectID; ?> >
                    <div class="image">
                        <img src=<?php echo "images/art/subjects/square-medium/".$subject->SubjectID.".jpg"; ?> >
                    </div>
                    <div class="content">
                        <h3><?php echo utf8_encode($subject->SubjectName); ?></h3>
                    </div>
                </a>
            <?php } ?>
    </main>
    
    <?php include("includes/footer.inc.php"); ?>
</body>

</html>