 <!-- navbar -->
 <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <a href="<?php echo $home_url ?>" class="navbar-brand">E-SHOP</a>
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $home_url ?>/admin/index.php"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $home_url ?>/admin/users"><i class="fa fa-users"></i> Users</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto mr-0">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <i class="fa fa-user"></i> <?php echo $_SESSION['firstname'] ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right text-center">
                    <a class="dropdown-item" href="#">My Profile</a>
                    <a class="dropdown-item" href="<?php echo $home_url ?>/logout.php">Sign out</a>
                </div>
                </li>
            </ul>      
    </div>
</nav>
    <!-- end navbar -->