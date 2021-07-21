<?php


session_start();
require_once("../db.php");
$email=$_SESSION['email1'];

$sql1="SELECT * FROM Assignments WHERE email='$email' ORDER BY task";
$result1=mysqli_query($conn,$sql1);

while($row=mysqli_fetch_assoc($result1)){
    echo $row['id'];
    echo ",";
    echo $row['task'];
    echo ",";

    echo $row['username'];
    echo ",";

    echo $row['status'];
    echo ",";

    echo $row['duedate']; 
    echo ",";
}
$conn->close();
?>