<?php
require_once("../db.php");
    $task = $_POST['task'];
    $username = $_POST['username1'];
    $status = 0;
    $duedate = $_POST['duedate'];
    $sql="INSERT INTO `Assignments`(`task`, `username`, `status`,`duedate`)
    VALUES ('$task','$username','$status','$duedate')";
    if($conn->query($sql)){
        $last_id=$conn->insert_id;
        echo json_encode(array('success'=>1,"id"=>$last_id));
    }
    else{
        echo json_encode(array('success'=>0));
    }
    $conn->close();

?>