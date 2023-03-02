<?php include 'includes/config.php'; $politics = $bytal->gPolitics(); $seoVariable = $politics;  include "includes/header.php"; ?>
<main class="container politics">
    <h1>
        <?=$politics->title->rendered?>
    </h1>
<?=$politics->content->rendered?>

</main>
 <?php include "includes/footer.php"; ?>