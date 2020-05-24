<?php
if(isset($_POST['login']) && isset($_POST['password'])){
    if($_POST['login'] === 'admin' && $_POST['password'] === "beef@pork"){
        $_SESSION['user'] = 'admin';
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