<?php
session_start();
unset($_SESSION['admin']); // unset admin session
header("Location: index");
?>
