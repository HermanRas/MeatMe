<?php
var_dump($_GET);
echo "<br>";
var_dump($_POST);

?>

<?php
//////////////////////////////////////////////////////////////////////
// Failed
//////////////////////////////////////////////////////////////////////
    if(isset($_GET['FAILED'])){
?>
<div class="container bg-white" style="font-family: sans-serif;color: black;">
    <div class="text-center">
        <h1 style="font-family: sans-serif;color: black;">Transaction Failed.</h1>
        <img src="https://www.sabcnews.com/sabcnews/wp-content/uploads/2019/09/SABC-News_5-Banks_P-1.png" width="50%"
            alt="banks logos">
        <br>
        <hr>
        nice message for user to say it failed
        <br>
        <hr>
    </div>
</div>
<?php
    }
?>

<?php
//////////////////////////////////////////////////////////////////////
// Failed
//////////////////////////////////////////////////////////////////////
    if(isset($_GET['SUCCESS'])){
?>
<div class="container bg-white" style="font-family: sans-serif;color: black;">
    <div class="text-center">
        <h1 style="font-family: sans-serif;color: black;">Transaction Completed.</h1>
        <img src="https://www.sabcnews.com/sabcnews/wp-content/uploads/2019/09/SABC-News_5-Banks_P-1.png" width="50%"
            alt="banks logos">
        <br>
        <hr>
        nice message for user to say it paid and ready to go!
        <br>
        <hr>
    </div>
</div>
<?php
    }
?>

<?php
//////////////////////////////////////////////////////////////////////
// Canceled
//////////////////////////////////////////////////////////////////////
    if(isset($_GET['CANCEL'])){
?>
<div class="container bg-white" style="font-family: sans-serif;color: black;">
    <div class="text-center">
        <h1 style="font-family: sans-serif;color: black;">Transaction Canceled.</h1>
        <img src="https://www.sabcnews.com/sabcnews/wp-content/uploads/2019/09/SABC-News_5-Banks_P-1.png" width="50%"
            alt="banks logos">
        <br>
        <hr>
        nice message for user to say it the transaction was Canceled!
        <br>
        <hr>
    </div>
</div>
<?php
    }
?>

<?php
//////////////////////////////////////////////////////////////////////
// Notice
//////////////////////////////////////////////////////////////////////
    if(isset($_GET['NOTICE'])){
?>
<div class="container bg-white" style="font-family: sans-serif;color: black;">
    <div class="text-center">
        <h1 style="font-family: sans-serif;color: black;">Transaction Notice.</h1>
        <img src="https://www.sabcnews.com/sabcnews/wp-content/uploads/2019/09/SABC-News_5-Banks_P-1.png" width="50%"
            alt="banks logos">
        <br>
        <hr>
        nice message for user to say it the transaction has a Notice please contact Bank!
        <br>
        <hr>
    </div>
</div>
<?php
    }
?>