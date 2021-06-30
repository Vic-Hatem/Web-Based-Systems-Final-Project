<?php 
require_once("db.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.rtl.min.css" integrity="sha384-trxYGD5BY4TyBTvU5H23FalSCYwpLA0vWEvXXGm5eytyztxb+97WzzY+IWDOSbav" crossorigin="anonymous">
    <title>Final Project</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark main-navbar ">
        <div class="container">
            <img src="Logo.png" alt="logo">
            <?php
                if(isset($_COOKIE['email1'])){
                    $coockie_email=$_COOKIE['email1'];
                    $coockie_username = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM Users WHERE email='$coockie_email'"));
                    while($row=$coockie_username){
                        echo "Welcom ".$row['username'];
                        break;
                    }
                    
                }
            ?>
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
</body>
    