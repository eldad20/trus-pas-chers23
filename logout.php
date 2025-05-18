<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION = [];

    session_destroy();

    header('location: login.php');
    exit;
}
else
{
    header('location: index.php');
    exit;
}
