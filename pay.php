<?php

if(isset($_POST['Email'])){
echo json_encode($_POST);
die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add header -->
    <?php include_once('_head.php'); ?>
</head>

<body data-barba="wrapper">
    <!-- add Nav Bar -->
    <?php include_once('_nav.php'); ?>

    <!-- PageStart -->
    <main data-barba="container" data-barba-namespace="home">
        <?php include_once('_pay.php'); ?>
    </main>
    <!-- Include footer -->
    <?php include_once('_footer.php'); ?>
    <!-- include Scipts -->
    <?php include_once('_script.php') ?>

</body>

</html>