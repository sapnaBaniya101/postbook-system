<?php 
session_start();
unset($_SESSION['email']);
unset($_SESSION['user']);
echo header('Location: index.php?msg=logout');
?>