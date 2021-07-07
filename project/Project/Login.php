<?php session_start();?>
<?php require_once("Parts/header.php");

    require_once("db.php");
    
    $flag=1;
    if ($_POST) {
        $email1= $_POST["email1"];
        $pass1= $_POST["pass1"];
        $save_password=$_POST['save_password'];
        // checking if the email already exists in the database!
        $sql="SELECT * FROM Users";
        $result=mysqli_query($conn,$sql);
        $flag=0;
        while($row=mysqli_fetch_assoc($result)){
        

            if($row['email']==$email1){
                $flag=1;
                if($row['password']==$pass1){
                    $_SESSION["email1"]=$email1;
                    if ($save_password=='on'){
                        global $cookie_name,$cookie_value;
                        $cookie_name='email1';
                        $cookie_value=$email1;
                        setcookie($cookie_name,$cookie_value,strtotime("1 day"));
                    }
                    header('location: ToDoListPage.php');
                    exit;
                }
                else {
                    header('location: Login.php?err=2');
                    exit;
                }
            } 
        }

            
    }
    if($flag!=1){
        header('location: Login.php?err=1');
    } 
    $conn->close();

?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/Login.css">
</head>

<body>
    <div class="container" id="con">
        <div class="row">
            <h1 id="T1">Welcome To Our Family</h1>
            <br>
            <h2 id="T2"> Please Fill Up Your Details </h2>
        </div>
    </div>

    <div class="container" id="con">
                <?php if (isset($_GET["err"]) && $_GET["err"]=="1"):?>
                    <div class="alert alert-danger" role="alert">Email not Existed</div>
                <?php endif;?>
            <?php if (isset($_GET["err"]) && $_GET["err"]=="2"):?>
                <div class="alert alert-danger" role="alert">Wrong Password</div>
            <?php endif;?>
        <form method="POST" >
            <br>
            <div style="text-align: center;">
                <label id="email">Email</label> <input id="email1" name="email1" type="email" required />
                <br><br>
                <label id="password">Password</label> <input id="pass1" name="pass1" type="password" required />
                <br>
                <a href="ResetPassword.php" id="reset">Forgot Your Password? </a>
                <div class="mb-3">
                    <input type="checkbox"  name="save_password" id="save_password">
                    <label for="save_password" class="form-label">Remember me</label>  
                </div>
                <br><br>
                <a href="ToDoListPage.php">
                    <button id="btn-add" type="submit" action="ToDoListPage.php" class="btn btnContact"
                        data-bs-toggle="modal" data-bs-target="#contactModal">Login</button><br><br>
                </a>
                <h6 id="T3">First time here? Your more than welcome:</h6>
                <a href="Registration.php">
                    <button id="contactBtn1" type="button" class="btn btnContact" data-bs-toggle="modal"
                        data-bs-target="#contactModal">Sign Up</button>
                </a>
            </div>
        </form>
    </div>
    <script src="JS/Registration-js.js" type="text/javascript"></script>
    <script src="JS/Login.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
        
</body>
<?php require_once("Parts/footer.php");?>