<?php
session_start();

function checkAuthentication() {
    if (!isset($_SESSION['user'])) {
        header("Location: " . BASE_PATH_SERVER . "/index.php/login");
        exit();
    }
}

function redirectIfAuthenticated() {
    if (isset($_SESSION['user'])) {
        header("Location: " . BASE_PATH_SERVER . "/index.php");
        exit();
    }
}