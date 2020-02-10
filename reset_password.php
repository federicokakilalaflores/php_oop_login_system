<?php
     include_once("config/core.php"); 
     $page_title = "Reset password";
     include_once("login_checker.php"); 
     include_once("config/Database.php");
     include_once("classes/User.php");

     $database = new Database();
     $conn = $database->connect();

     $user = new User($conn); 

     $user->access_code = isset($_GET['access_code']) ? $_GET['access_code'] : "";

     if(!$user->isAccessCodeExists()) :
          die('ERROR: Access code not found!');
     else :

     
?>
    
     <div class="col-md-4 col mr-auto ml-auto login-form-container">

     <?php
          if(isset($_POST['submit'])){

               $user->password = $_POST['new_pass'];
               
               echo $user->access_code;

               if($user->updatePasswordByAccessCode()){
                    echo '<div class="alert alert-success">Your password was successfully reset. Please 
                    <a href="'. $home_url .'/login">Login</a>
                    </div>';
                  
               }else{
                     echo '<div class="alert alert-danger">Unable to update your password</div>';
               }

          }
     ?>

          <div class="login-box">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?access_code=<?php echo $user->access_code; ?>" method="post">
                  <div class="form-group">
                      <label>New Password: </label>
                      <input type="password" name="new_pass" class="form-control">
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Reset Password</button>
               </form>     
          </div> 
     </div>

<?php
     endif;
     include_once("layout_footer.php");  
?>