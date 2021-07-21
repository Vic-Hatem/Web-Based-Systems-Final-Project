<?php require_once("Parts/header.php");?>
<?php
require_once("db.php");
if(isset($_POST['addUsers'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $sql="INSERT INTO `Users`( `email`, `password`, `username`)
    VALUES ('$email','$password','$username')";
    if($conn->query($sql)){
        echo "The User Has Been Added Successfully";
        header('location: Login.php');
    }
    else{
        echo  $conn->error;
    }
}
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="Registration-style.css">
</head>

<body>
    <div class="container" id="con">
        <div class="row">
            <h1 id="T1">We Are Happy You're Joining Our Family</h1>
            <br>
            <h2 id="T2"> Please Fill Up Your Details </h2>
        </div>
    </div>

    <div class="container" style="text-align: center;" id="con">
        <form method="POST">
            <br>
            <label>Email</label> <input type="email" placeholder="example@example.com" name="email" id="email"
                required /><br><br>
            <label>Confirm Email</label> <input type="email" id="secondEmail" required />
            <br><br>
            <label>Password</label> <input type="password" name="password" id="password"
                required />
            <br><br>
            <label>Confirm Password</label> <input type="password" 
                id="pass3" required />
            <br><br>
            <label>Username</label> <input type="text" name="username" id="username" required />
            <br><br>
            <input id="addUsers" type="submit" name="addUsers" value="Sign Up" style="    background-color: #f5efe3d8;
    border-radius: 30px;
    font-weight: bolder;
    border-color: antiquewhite;" onclick="addUser()">   
        </form>
    </div>
    <script src="JS/Registration-js.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
</body>
<?php require_once("Parts/footer.php");?>
