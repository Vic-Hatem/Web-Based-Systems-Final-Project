<?php
session_start();
require_once("../db.php");
$email = $_SESSION['email1'];
$group_name = $_POST['group_name1'];
$admin = $_POST['admin'];
$name_exist = mysqli_fetch_assoc($conn->query("SELECT * FROM GroupUsers WHERE group_name='$group_name'"))['group_name'];
if ($name_exist) {
    $sql = "INSERT INTO `GroupUsers`(`email`,`group_name`,`admin`)
    VALUES ('$email','$group_name','$admin')";
    if ($conn->query($sql)) {
        $last_id = $conn->insert_id;
        echo json_encode(array('success' => 1, "id" => $last_id));
    } else {
        echo json_encode(array('success' => 0));
    }
} else {
    echo json_encode(array('success' => -1));
}

$conn->close();
