<?php

session_start();
require_once("../db.php");
$email=$_SESSION['email1'];
$sql1="SELECT * FROM GroupUsers WHERE email='$email'";
$result1=mysqli_query($conn,$sql1);

while($row=mysqli_fetch_assoc($result1)){
    echo $row['id']; 
    echo ",";
    echo $row['group_name']; 
    echo ",";
}
$conn->close();
?>