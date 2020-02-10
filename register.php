<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception; 

    include_once("config/core.php");
    $page_title = "Register Page";
    include_once("login_checker.php");
    include_once("config/Database.php");
    include_once("classes/User.php");
    include_once("vendor/autoload.php");
    include_once("libs/php/Utils.php");
    include_once("layout_header.php");
?>

    <div class="col-md-10 mr-auto ml-auto login-form-container mb-5"> 
      <div class="login-box">
        <?php
            // When form submitted
            if(isset($_POST['submit'])){

                $database = new Database();
                $conn = $database->connect();

                $mail = new PHPMailer(true);
 
                $user = new User($conn);
                $utils = new Utils();  

                $user->email = $_POST['email'];
                
                if($user->emailExists()){

                    echo '<div class="alert alert-danger">';
                     echo 'The email <strong>' . $user->email . '</strong> already registered.';
                    echo '</div>';

                }else{

                    $user->firstname = $_POST['firstname'];
                    $user->lastname = $_POST['lastname'];
                    $user->email = $_POST['email'];
                    $user->contact_number = $_POST['contact'];
                    $user->address = $_POST['address'];
                    $user->password = $_POST['password'];
                    $user->access_level = "Customer";
                    $user->status = 0; 
                    $access_code = $utils->getToken(); 
                    $user->access_code = $access_code; 

                    if($user->store()){

                        $send_to_email = $_POST['email'];
                        $subject = "Verification Email";
                        $body = "<p>Hi " . $send_to_email . "</p><br>";
                        $body .= "<span>Please click the following link to verify your email and login: </span>";
                        $body .= "<a href='$home_url/verify/?access_code=$access_code'>Click here.</a>"; 

                        if($utils->sendEmailViaPHPMailer($mail, $send_to_email, $subject, $body)){
                            echo '<div class="alert alert-success">';
                                echo 'Check your email inbox we send verification link.';
                            echo '</div>';
                        }else{
                            echo '<div class="alert alert-info">';
                                echo 'Unable to send email verification try again.';
                            echo '</div>'; 
                        }

                        $_POST = array(); 

                    }else{

                        echo '<div class="alert alert-danger">';
                            echo 'You are now registered. Unable to register. Please try again.';
                        echo '</div>';

                    }

                }

            }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h2 class="text-primary">Create Account</h2>
            <p class="text-muted mb-4">Please fill up all the box.</p>
            <hr>
            <div class="row mb-3">
                <div class="col-md-3"> 
                    <label for="firstname">Firstname:</label> 
                </div>
                <div class="col-md-9">
                    <input type="text" name="firstname" id="firstname" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="lastname">Lastname:</label> 
                </div>
                <div class="col-md-9">
                    <input type="text" name="lastname" id="lastname" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="email">Email Address:</label> 
                </div>
                <div class="col-md-9">
                    <input type="email" name="email" id="email" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="contact">Contact Number :</label> 
                </div>
                <div class="col-md-9">
                    <input type="text" name="contact" id="contact" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="address">Home Address :</label> 
                </div>
                <div class="col-md-9">
                    <textarea name="address" id="address" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="password">Password :</label> 
                </div>
                <div class="col-md-9">
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="c_password">Confirm Password :</label> 
                </div>
                <div class="col-md-9">
                    <input type="password" name="c_password" id="c_password" class="form-control">
                </div>
            </div>
            <hr>
            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-user-plus"></i> Register</button>
        </form>
      </div>
    </div>   

<?php
    include_once("layout_footer.php");
?>