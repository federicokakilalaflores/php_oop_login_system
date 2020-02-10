<?php
    include_once("config/core.php"); 
    include_once("config/Database.php");
    include_once("classes/User.php");

    $database = new Database();
    $conn = $database->connect();

    $user = new User($conn);

    $user->access_code = isset($_GET['access_code']) ? $_GET['access_code'] : "";

    if(!$user->isAccessCodeExists()){
        die("ERROR: Access code not found.");
    }else{
        $user->status = 1;  
        $user->updateStatusByAccessCode();
        header("Location: $home_url/login.php?action=email_verified");
    }