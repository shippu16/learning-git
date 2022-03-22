<?php
include('../include/session.php');
$_SESSION['id']=null;
$_SESSION['email']=null;
session_unset();

session_destroy();

header("Location: index.php");
?>