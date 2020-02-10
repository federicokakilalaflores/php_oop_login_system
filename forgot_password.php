<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception; 

        include_once("config/core.php"); 
        $page_title = "Forgot password";
        include_once("config/Database.php");
        include_once("classes/User.php");
        include_once("vendor/autoload.php");  
        include_once("libs/php/Utils.php"); 
        
        $mail = new PHPMailer(true); 

        $database = new Database();
        $conn = $database->connect();

        $user = new User($conn);
        $utils = new Utils();

        include_once("layout_header.php");  
?>

        <div class="col-md-4 col mr-auto ml-auto login-form-container"> 
        <?php
            if(isset($_POST['submit'])){

                $user->email = $_POST['email'];

                if($user->emailExists()){

                    $user->access_code = $utils->getToken();
                    
                    if($user->updateAccessCode()){

                        $subject = "Reset Password";
                        $body = '<p>Please click the link below to reset your password.</p>';
                        $body .= '<a href="'.$home_url.'/reset_password/?access_code='.$user->access_code.'">Reset your password</a>';
                        
                        if(!$utils->sendEmailViaPHPMailer($mail, $user->email, $subject, $body)){
                            echo '<div class="alert alert-danger">ERROR: Unable to send your new access code.</div>';
                        }else{
                            echo '<div class="alert alert-info">Please check your email inbox to reset your password.</div>';
                        }

                    }else{
                        echo '<div class="alert alert-danger">ERROR: Unable to update access code.</div>';
                    }

                }else{
                    echo '<div class="alert alert-danger">ERROR: Your email cannot be found.</div>';
                }  
            }        
        ?>
            <div class="login-box">
                <img src="<?php echo $home_url ?>/assets/images/avatar3.png" alt="login-img" class="login-img mb-5">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <div class="form-group">
                        <label>Email: </label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-paper-plane"></i> Send Reset Link</button>  
            </div>
        </div>


<?php
        include_once("layout_footer.php");  
?>