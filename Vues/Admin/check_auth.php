<?php
    session_start();
    require_once '../../Modeles/Admin.php';

    if (!Admin::isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
?> 