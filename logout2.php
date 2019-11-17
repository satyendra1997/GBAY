<?php
session_start();
 unset($_SESSION['plotid']);
header('Location:forms.php');
?>