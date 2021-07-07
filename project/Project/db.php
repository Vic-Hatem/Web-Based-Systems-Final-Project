<?php

$servername="localhost";
$username="root";
$password="";
$conn= new mysqli($servername,$username,$password);
if($conn->connect_error)
    $die("Connection Failed".$conn->connect_error);

$dbName="FinalProject";
if(!mysqli_select_db($conn,$dbName)){
    $sql="CREATE DATABASE $dbName";
    if($conn->query($sql)==TRUE){
        echo "DATABASE created Successfuly";
    }
    else{
        echo "Error Creating Database: " . $conn->error;
    }
}
// creating a users table 
$conn=new mysqli($servername,$username,$password,$dbName);
$sql=" SELECT id FROM Users ";
if(!$conn->query($sql)){
    $sql="CREATE TABLE Users(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(99) NOT NULL UNIQUE,`password` VARCHAR(99),`username` VARCHAR (99));";
    if($conn->query($sql)==TRUE){
        echo "Users Table Created Successfully!";
    }
    else{
        echo "Error Creating Table: " . $conn->error;
    }
}

// creating an assignment table
$sql1=" SELECT id FROM Assignments ";
if(!$conn->query($sql1)){
    $sql1="CREATE TABLE Assignments(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `task` VARCHAR(99),`username` VARCHAR (99),`status` Boolean,`duedate` DATE,`email` VARCHAR(99), FOREIGN KEY (email) REFERENCES Users(email));";
    if($conn->query($sql1)==TRUE){
        echo "Assignments Table Created Successfully!";
    }
    else{
        echo "Error Creating Table: " . $conn->error;
    }
}

$sql2=" SELECT id FROM GroupTasks ";
if(!$conn->query($sql2)){
    $sql2="CREATE TABLE GroupTasks(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `task` VARCHAR(99),`username` VARCHAR (99),`status` Boolean,`duedate` DATE,`group_admin` VARCHAR(99),`group_name` VARCHAR(99));";

    if($conn->query($sql2)==TRUE){
        echo "GroupTasks Table Created Successfully!";
    }
    else{
        echo "Error Creating Table: " . $conn->error;
        }
}

$sql3=" SELECT id FROM GroupUsers ";
if(!$conn->query($sql3)){
    $sql3="CREATE TABLE GroupUsers(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `email` VARCHAR(99),`group_name` VARCHAR(99),`admin` Boolean);";

    if($conn->query($sql3)==TRUE){
        echo "GroupUsers Table Created Successfully!";
    }
    else{
        echo "Error Creating Table: " . $conn->error;
        }
}
