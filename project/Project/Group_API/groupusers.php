<?php

session_start();
require_once("../db.php");
$id = $_POST['id'];
$email = $_SESSION['email1'];

$group_name = mysqli_fetch_assoc($conn->query("SELECT * FROM GroupUsers WHERE id='$id'"))['group_name'];


$sql2 = "SELECT * FROM GroupUsers WHERE group_name='$group_name'";
$result2 = mysqli_query($conn, $sql2);


while ($row = mysqli_fetch_assoc($result2)) {
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
