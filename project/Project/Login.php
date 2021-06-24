<?php session_start();?>
<?php require_once("parts/header.php");?>
<?php 
    $users = array(
        "hatem@gmail.com"=>"12345",
        "sandy@gmail.com"=>"12345",

    );
    if ($_POST) {
        $email1= $_POST["email1"];
        $pass1= $_POST["pass1"];
        $save_password=$_POST['save_password'];
        if (isset($users[$email1])) {
            if ($users[$email1]==$pass1) {
                $_SESSION["email1"]=$email1;
                if ($save_password=='on'){
                    setcookie('email1',$email1,strtotime("1 week"));
                }
                header('location: ToDoListPage.php');
                exit;
            }
            else {
                
                header('location: Login.php?err=1');
                exit;
            }
        }
        else {
            
            header('location: Login.php?err=1');
        }
    }
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="Login.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark main-navbar ">
        <div class="container">
            <img src="images/Logo.png" alt="logo">
            <a id="bar-logo" class="navbar-brand" href="#">Create Your Own Schedule</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <button id="contactBtn" type="button" class="btn btnContact" data-bs-toggle="modal"
                            data-bs-target="#contactModal">Contact Us</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" id="con">
        <div class="row">
            <h1 id="T1">Wellcome To Our Family</h1>
            <br>
            <h2 id="T2"> Please Fill Up Your Details </h2>
        </div>
    </div>

    <div class="container" id="con">
            <?php if (isset($_GET["err"]) && $_GET["err"]=="1"):?>
                <div class="alert alert-danger" role="alert">email not existed</div>
            <?php endif;?>
        <form method="POST" >
            <br>
            <div style="text-align: center;">
                <label id="email">Email</label> <input id="email1" name="email1" type="email" required />
                <br><br>
                <label id="password">Password</label> <input id="pass1" name="pass1" type="password" required />
                <br>
                <a href="ResetPassword.html" id="reset">Forgot Your Password? </a>
                <div class="mb-3">
                    <input type="checkbox"  name="save_password" id="save_password">
                    <label for="save_password" class="form-label">Remember me</label>
                    
                </div>
                <br><br>

                <a href="ToDoListPage.php">
                    <button id="btn-add" type="submit" action="ToDoListPage.php" class="btn btnContact"
                        data-bs-toggle="modal" data-bs-target="#contactModal">Login</button><br><br>
                </a>
                <h6 id="T3">Dont have an account ?</h6>
                <a href="Registration.php">
                    <button id="contactBtn1" type="button" class="btn btnContact" data-bs-toggle="modal"
                        data-bs-target="#contactModal">Sign Up</button>
                </a>

            </div>


        </form>
    </div>









    <script src="Registration-js.js" type="text/javascript"></script>
    <script src="Login.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
</body>
<?php require_once("parts/footer.php");?>