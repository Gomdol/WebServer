<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
} else {
    header("Location: mini_mission.php");
    exit;
}
?>
