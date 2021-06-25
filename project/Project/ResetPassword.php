<?php session_start();?>
<?php require_once("parts/header.php");

    require_once("db.php");
    $flag=1;
    if ($_POST) {
        
        $email_reset= $_POST["eml"];
        $pass_reset= $_POST["pass"];
        $sql="SELECT * FROM Users";
        $result=mysqli_query($conn,$sql);
        $flag=0;
        while($row=mysqli_fetch_assoc($result)){
            if($row['email']==$email_reset){
                $flag=1;
                $username=$row['username'];
                $sqll="UPDATE `Users`
                SET `email`='$email_reset',`password`='$pass_reset',`username`='$username' WHERE email='$email_reset'";
                if($conn->query($sqll)){
                    echo "Your Password Has Been Updated Successfully";
                    header('location: Login.php');
                    exit;

                }
                else{
                    echo  $conn->error;
                }
            }
        
        }   
    }
    if($flag!=1){
        header('location: ResetPassword.php?err=1');
    } 
    

?>



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="ResetPassword.css">
</head>

<body>
    

    <nav class="navbar navbar-expand-lg navbar-dark main-navbar ">
        <div class="container">
            <img src="Logo.png" alt="logo">
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

    <div class="container">
        <div class="row" id="T6">
            <h2> We will help you reset your password </h2>
        </div>
    </div>

    <div class="container">
        <?php if (isset($_GET["err"]) && $_GET["err"]=="1"):?>
            <div class="alert alert-danger" role="alert">Email not Existed</div>
        <?php endif;?>
        <br>
        <form method="POST">
            <label id="lblEmail">Email</label> <input type="email" id="eml" name="eml" required /><br><br>
            <label id="lblPassword" for="password">New Password</label> <input type="password" id="pass" name="pass" required /><br><br>

        <!-- <input id="reset" type="submit" value="Reset"/> -->
            
                    <button id="btn-add" type="submit" class="btn btnContact"
                        data-bs-toggle="modal" data-bs-target="#contactModal">Reset</button><br><br>
        </form>
    </div>


    <!-- <div ng-If=popUp() class="alert alert-success" role="alert">
        <h4 class="alert-heading">Reset Password!</h4>
        <p> Thank you , We have sent you a link to the mail you entered .
        </p>
        <hr>
        <p class="mb-0">Please, Check Your Mail .</p>
    </div>
 -->







    <script src="ResetPassword.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
</body>
<?php require_once("parts/footer.php");?>