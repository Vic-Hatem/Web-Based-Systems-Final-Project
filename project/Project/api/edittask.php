<?php
require_once("../db.php");

    $id=$_POST['id'];
    $task_update= $_POST['task1'];
    $username_update = $_POST['username11'];
    $status_update = mysqli_fetch_assoc($conn->query("SELECT * FROM Assignments WHERE id=$id"))['status'];
    $duedate_update = $_POST['duedate1'];
    $sql_update="UPDATE `Assignments`
    SET `task`='$task_update',`username`='$username_update',`status`='$status_update',`duedate`='$duedate_update'
    WHERE id=$id";
    if($conn->query($sql_update)){
        echo json_encode(array('success'=>1,"id"=>$id));
    }
    else{
        echo json_encode(array('success'=>0));
    }
?>
