<?php
session_start();
require_once("../db.php");
    $email=$_SESSION['email1'];

    $task = $_POST['task'];
    $username = $_POST['username11'];
    $status = 0;
    $duedate = $_POST['duedate'];
    
    $id=$_POST['id'];
    $group_name=mysqli_fetch_assoc($conn->query("SELECT * FROM GroupUsers WHERE id='$id' and email='$email'"))['group_name'];

    $group_admin=mysqli_fetch_assoc($conn->query("SELECT * FROM GroupUsers WHERE id='$id' and admin=1"))['email'];
    $sql="INSERT INTO `GroupTasks`(`task`, `username`, `status`,`duedate`,`group_admin`,`group_name`)
    VALUES ('$task','$username','$status','$duedate','$group_admin','$group_name')";
    if($conn->query($sql)){
        $last_id=$conn->insert_id;
        echo json_encode(array('success'=>1,"id"=>$last_id));
    }
    else{
        echo json_encode(array('success'=>0));
    }
    $conn->close();
?>