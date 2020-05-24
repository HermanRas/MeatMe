<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add header -->
    <?php include_once('_head.php'); ?>
</head>

<body data-barba="wrapper">
    <!-- PageStart -->
    <main data-barba="container" data-barba-namespace="home">
        <?php include_once('_index.php'); ?>
    </main>
    <!-- include Scipts -->
    <?php include_once('_script.php') ?>

</body>

</html>