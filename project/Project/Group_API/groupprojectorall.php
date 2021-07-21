<?php

session_start();
require_once("../db.php");


$sql1="SELECT * FROM GroupUsers";
$result1=mysqli_query($conn,$sql1);

while($row=mysqli_fetch_assoc($result1)){
    echo $row['group_name']; 
    echo ",";
}
$conn->close();
?>