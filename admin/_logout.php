<?php
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

    echo '<script>window.location.replace("index.php");</script>';
    die;
?>