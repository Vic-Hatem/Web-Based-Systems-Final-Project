<?php
session_start();
$_SESSION=[];
session_destroy();
setcookie('email1',"",time()-3600);
header('location: Login.php');
exit;