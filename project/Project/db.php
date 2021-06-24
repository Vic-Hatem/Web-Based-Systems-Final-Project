<?php
$servername="localhost";
$username="root";
$password="";
$conn= new mysqli($servername,$username,$password);
if($conn->connect_error)
    $die("Connection Failed".$conn->connect_error);

$dbName="MyUsers";
if(!mysqli_select_db($conn,$dbName)){
    $sql="CREATE DATABASE $dbName";
    if($conn->query($sql)==TRUE){
        echo "DATABASE created Successfuly";
    }
    else{
        echo "Error Creating Database: " . $conn->error;
    }
}
$conn=new mysqli($servername,$username,$password,$dbName);
$sql=" SELECT id FROM Users ";
if(!$conn->query($sql)){
    $sql="CREATE TABLE Users(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(99),`password` VARCHAR(99),`username` VARCHAR (99));";
    if($conn->query($sql)==TRUE){
        echo "Users Table Created Successfully!";
    }
    else{
        echo "Error Creating Table: " . $conn->error;
    }
}
