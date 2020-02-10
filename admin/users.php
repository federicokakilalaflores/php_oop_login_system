<?php
    $page_title = "Users"; 
    include_once("../config/core.php");
    include_once("login_checker.php");
    include_once("layout_header.php");
    include_once("../config/Database.php");
    include_once("../classes/User.php");

    $database = new Database();
    $conn = $database->connect();

    $user = new User($conn);

    $users = $user->read($page_start_num, $records_per_page);
    $total_users = $user->countAll();

    // total pages
    $total_pages = ceil($total_users / $records_per_page); 
   
    // page btns range
    $range = 2;
    
    // initial range of pagination btn
    $initial_btn = $page_number - $range;  

    // last range of pagination btn 
    $last_btn = ($page_number + $range) + 1; 


?>

    <div class="col-md-12"> 
    <h2 class="text-primary mt-default text-uppercase mb-4">List of Users</h2>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="table-info">
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Permission</th>
                    </tr>
                </thead>   
                <tbody>
                <?php 
                    foreach($users as $user) : 
                ?>
                    <tr>
                        <td class="text-capitalize"><?php echo $user['firstname'] ?></td>
                        <td class="text-capitalize"><?php echo $user['lastname'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td class="text-capitalize"><?php echo $user['contact_number'] ?></td>
                        <td class="text-capitalize"><?php echo $user['access_level'] ?></td>
                    </tr>

                <?php endforeach ?>    
                </tbody>
            </table>
        </div>
        <hr>
        <!-- pagination controls -->
        <?php
            include_once("pagination_controls.php");
        ?>
    </div>

<?php
   include_once("layout_footer.php");
?>