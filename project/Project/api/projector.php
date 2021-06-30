<?php 
require_once("../db.php");

$sql1="SELECT * FROM Assignments";
$result1=mysqli_query($conn,$sql1);
$tasks=array();
while($row=mysqli_fetch_assoc($result1)){
    $tasks[]=$row;
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
?>