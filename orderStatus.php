<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add header -->
    <?php include_once('_head.php'); ?>
    <?php include_once('_storeData.php'); ?>
</head>

<body data-barba="wrapper">
    <!-- add Nav Bar -->
    <?php include_once('_nav.php'); ?>

    <!-- PageStart -->
    <main data-barba="container" data-barba-namespace="home">
        <?php include_once('_orderStatus.php'); ?>
    </main>
    <!-- Include footer -->
    <?php include_once('_footer.php'); ?>
    <!-- include Scipts -->
    <?php include_once('_script.php') ?>
</body>

</html>