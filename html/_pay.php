<?php
    $orderId = '';
    $orderId = isset($_GET["orderID"])?$_GET["orderID"]:'Failed!';
    $totalPrice  = 0;
    $totalPrice = isset($_GET["Val"])?(float)$_GET["Val"]:'Failed!';
?>

<div class="container bg-white" style="font-family: sans-serif;color: black;">
    <div class="text-center">
        <h1 style="font-family: sans-serif;color: black;">Payment screen from vendor.</h1>
        <img src="https://www.sabcnews.com/sabcnews/wp-content/uploads/2019/09/SABC-News_5-Banks_P-1.png" width="50%"
            alt="banks logos">
        <br>
        <hr>
        <form>
            BANK: FNB<br>
            BRANCH: 123-341<br>
            TYPE: SAVINGS<br>
            ACC: 6776542341<br>
            OUR REF: <?=$orderId?><br>
            <b>Total: R<?=sprintf('%01.2f', $totalPrice)?></b><br>
            Please send proof of payment to:<br>
            <a href="mailto:sales@queensonlinedeli.co.za">sales@queensonlinedeli.co.za</a>
            <hr>
            <a href="index.php" class="btn btn-outline-success">Home</a>
        </form>
        <br>
        <hr>
    </div>
</div>