<?php
if(isset($_POST['login']) && isset($_POST['password'])){
    $user = $_POST['login'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM
                admins
            WHERE
                name = '$user'
            AND
                password = '$pass'
            limit 1;";
    $sqlargs = array();
    require_once 'config/db_query.php'; 
    $result =  sqlQuery($sql,$sqlargs);

    if(count($result[0]) === 1){
        $_SESSION['user_id'] = $result[0][0]["id"];
        $_SESSION['user'] = $result[0][0]["name"];
        $_SESSION['acl'] = $result[0][0]["user_level"];
        if($_SESSION['acl'] === 9){
            $_SESSION['area_id'] = '%';
        }else{
            $_SESSION['area_id'] = $result[0][0]["area_id"];
        }
        echo '<script>window.location.replace("home.php");</script>';
        die;
    }else{
        
        echo    '<!-- Page Script -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>';
        echo     "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Wrong user or password!'
                        })
                    </script>";
    }
}



?>
<div class="container mt-3">
    <h1 class="bg-secondary-dark rounded p-2 text-center">QWEENS ONLINE DELI<br><small>Admin Panel</small></h1>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img class="login-ico" src="../img/icon.png" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form method="POST">
                <input type="text" id="login" class="fadeIn second" name="login" placeholder="LOGIN">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="PASSWORD">
                <input type="submit" class="fadeIn fourth" value="Log In">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>
            </div>

        </div>
    </div>
</div>