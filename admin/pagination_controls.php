<ul class="pagination">
    <?php
        if($page_number > 1){
            echo '  <li class="page-item"><a href="'. $home_url .'/admin/users" class="page-link">First</a></li>';
        }

        for($i = $initial_btn; $i < $last_btn; $i++){
            if($i > 0 && $i <= $total_pages){
                if($i == $page_number) {
                    echo '  <li class="page-item active"><a href="'. $home_url .'/admin/users?page='. $i .'" class="page-link">'. $i .'</a></li>';
                }else{
                    echo '  <li class="page-item"><a href="'. $home_url .'/admin/users?page='. $i .'" class="page-link">'. $i .'</a></li>';
                }
            }
        } 

        if($page_number < $total_pages){
            echo '  <li class="page-item"><a href="'. $home_url .'/admin/users?page='. $total_pages .'" class="page-link">Last</a></li>';
        }
    ?>
</ul> 