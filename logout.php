<?php
session_start();
session_destroy();
$msg = "u bent uitgelogd";
header('location: index.php?msg=$msg');
?>