<?php 
session_start();
require_once('../db.php');
$email=$_SESSION['email1'];

$admin=mysqli_fetch_assoc($conn->query("SELECT * FROM GroupUsers WHERE email='$email' and admin=1"))['email'];
$id=$_POST['id'];
$sql = "DELETE FROM GroupUsers WHERE id=$id";
if($admin==$email){
    if ($conn->query($sql)===TRUE) {
        echo json_encode(array('success' => 1));
    }else {
        echo json_encode(array('success' => 0));
    }
}
else{
    echo json_encode(array('success' => -1));
}
$conn->close();

?>