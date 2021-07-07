<?php

session_start();
require_once("../db.php");
$group_name=$_POST['group_name'];

$sql1="SELECT * FROM GroupUsers WHERE group_name='$group_name'";
$result1=mysqli_query($conn,$sql1);

while($row=mysqli_fetch_assoc($result1)){
    echo $row['id'];
    echo ",";
    echo $row['email'];
    echo ",";
    echo $row['group_name']; 
    echo ",";
    echo $row['admin']; 
    echo ",";
}
$conn->close();
?>