<?php

session_start();
require_once("../db.php");
$group_name=$_POST['group_name'];

$sql1="SELECT * FROM GroupTasks WHERE group_name='$group_name'";
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

    echo $row['group_name']; 
    echo ",";
}
$conn->close();
?>