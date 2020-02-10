<?php
    include_once("config/core.php");
    $page_title = "Index";
    $require_login = TRUE;
    include_once("login_checker.php");
    include_once("layout_header.php");

    echo '<h1 class="text-primary" style="margin-top:15vh;">DASHBOARD</h1>';    
    if($action === "login_success") {

        echo '<div class="alert alert-info">';
            echo '<strong> Hi ' . $_SESSION['firstname'] . ' welcome back! </strong>'; 
        echo '</div>'; 

    }
    elseif($action === "already_logged_in") {

        echo '<div class="alert alert-info">';
            echo '<strong>You are already logged in!</strong>'; 
        echo '</div>'; 

    } 



    include_once("layout_footer.php");  
?>
 



