<?php
// login checker of customer access level

if(isset($_SESSION['access_level']) && $_SESSION['access_level'] == "Admin"){
    header("Location: $home_url/admin/index.php?action=logged_in_as_admin");
}

elseif(isset($require_login) && $require_login === TRUE){
    if(!isset($_SESSION['access_level'])){
        header("Location: $home_url/login?action=please_login");
    }
}

elseif(isset($_SESSION['access_level']) && $_SESSION['access_level'] == "Customer"){
    header("Location: $home_url/index.php?action=already_logged_in");
}
