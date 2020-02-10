<?php 
    include_once("config/core.php"); 
    $require_login = FALSE;
    $page_title = "Login Page";
    include_once("login_checker.php");
    include_once("config/Database.php");
    include_once("classes/User.php");
    include_once("layout_header.php"); 
    $access_denied = FALSE;

    // when the form was submitted
    if(isset($_POST['submit'])){

        $database = new Database();
        $conn = $database->connect();

        $user = new User($conn);
        $user->email = $_POST['email'];

        // check if email exist
        $is_email_exists = $user->emailExists();
        
        // login validation
        if($is_email_exists && password_verify($_POST['password'], $user->password) && $user->status === 1){

            $_SESSION['user_id'] = $user->id;
            $_SESSION['firstname'] = $user->firstname;
            $_SESSION['lastname'] = $user->lastname;
            $_SESSION['access_level'] = $user->access_level;
            $_SESSION['is_logged_in'] = TRUE;

            if($user->access_level == "Admin"){
                header("Location: $home_url/admin/index.php?action=login_success");
            }else{
                header("Location: $home_url/index.php?action=login_success"); 
            }
 
        }else{
            $access_denied = TRUE; 
        }
        
    }
?> 
        
        <div class="col-md-5 col mr-auto ml-auto login-form-container"> 
            <?php
                // access validation or page restriction
                if($action == "not_yet_logged_in"){
                    echo '<div class="alert alert-danger">Please login.</div>';
                }elseif ($action == "please_login") {
                    echo '<div class="alert alert-info">Please login to access that page.</div>';
                }elseif ($action == "not_admin") {
                    echo '<div class="alert alert-info">Your not an admin user.</div>'; 
                }elseif ($action == "email_verified") {
                    echo '<div class="alert alert-success">Your email address have been validated.</div>';
                }

                // tell the user if access denied 
                if($access_denied){
                    echo '<div class="alert alert-danger">
                            Access Denied: Your username or password maybe incorrect.
                        </div>'; 
                }
            ?>
            <div class="login-box">
                <img src="<?php echo $home_url ?>/assets/images/avatar3.png" alt="login-img" class="login-img mb-5">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <div class="form-group">
                        <label>Email: </label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password: </label>
                        <input type="password" name="password" class="form-control"> 
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in-alt"></i> Log In</button>
                </form>
                <div class="mt-4 text-center">
                    <a href="<?php echo $home_url ?>/forgot_password">Forgot password?</a> 
                </div>   
               
            </div>
        </div>

<?php include_once("layout_footer.php") ?>  

  