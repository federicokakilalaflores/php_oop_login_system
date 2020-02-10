<?php
    if(!isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] !== TRUE){
        header("Location: $home_url/index.php?action=please_login");
    }

    elseif(isset($_SESSION['access_level']) && $_SESSION['access_level'] !== "Admin"){
        header("Location: $home_url/index.php?action=not_admin");  
    }
?>