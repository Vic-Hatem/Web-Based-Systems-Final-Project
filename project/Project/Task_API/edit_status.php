<?php
session_start();

require_once("../db.php");
$id=$_POST['id'];
$status_update = $_POST['status'];
$email=$_SESSION['email1'];

$sql1="SELECT * FROM Assignments WHERE id=$id";
$result1=mysqli_query($conn,$sql1);
while($row=mysqli_fetch_assoc($result1)){
    $task_update= $row['task'];
    $username_update = $row['username'];
    $duedate_update = $row['duedate']; 
}
    $sql_update="UPDATE `Assignments`
    SET `task`='$task_update',`username`='$username_update',`status`='$status_update',`duedate`='$duedate_update',`email`='$email'
    WHERE id=$id";
    if($conn->query($sql_update)){
        echo json_encode(array('success'=>1,"id"=>$id));
    }
    else{
        echo json_encode(array('success'=>0));
    }
?>
