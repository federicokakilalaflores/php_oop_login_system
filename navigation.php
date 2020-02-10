 <!-- navbar -->
 <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <a href="<?php echo $home_url ?>" class="navbar-brand">E-SHOP</a>
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <?php
            if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true && $_SESSION['access_level'] == "Customer") :
        ?>  
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-capitalize" href="#" id="navbardrop" data-toggle="dropdown">
                    <i class="fa fa-user"></i> <?php echo $_SESSION['firstname']; ?> 
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="<?php echo $home_url ?>/logout.php">Sign Out</a>
                    </div>
                </li>
            </ul>   
        <?php
            else :
        ?>    
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $home_url ?>"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-info"></i> About</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <a class="nav-link" href="<?php echo $home_url ?>/login"><i class="fa fa-sign-in-alt"></i> Log In</a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" href="<?php echo $home_url ?>/register"><i class="fa fa-user-plus"></i> Register</a>
                </li>
            </ul>

        <?php 
            endif; 
        ?>

      
    </div>
    </nav>
    <!-- end navbar -->