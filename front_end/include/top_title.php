<?php include '../../database/dbhelper.php'; ?>


<?php
if(isset($_POST['menu'])){
switch($_POST['menu']){

    case 'mostViews':
       menu1();
     
        break;
    case 'lastest':
        menu2();
        //echo ($_POST['menu']);
        break;
    case 'comments':
       menu3();
        break;
    default:
       // someDefaultFunction();
       //echo ($_POST['menu']);
       menu1();
        break;
}
} else{
    menu1();
}
function menu1(){
   
    global $connection;
    $isActive = 'active';
    $sql = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_view_count DESC LIMIT 3";
    $y = 1;


                    $select_post_query = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_array($select_post_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_date = $row['post_date'];

                        echo '<div class="row" style="flex-wrap: nowrap; 
                         margin-right: 0;
                         margin-left: 0; padding-bottom: 8px; border-bottom: 1px solid #c2c2c2;">';

                        echo '<div class="number" style="color: #959595;">' . $y . '</div>';
                        echo ' <div class="infor"><a href="../front_end/post.php?p_id=' . $post_id . '" style="text-decoration: none; color: #111111;">' . $post_title . '</a></div>';
                        echo '</div>';
                        $y++;
                    }
}
function menu2(){
 
    global $connection;
    $isActive = 'active';
    $sql = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_date DESC LIMIT 3";
    $y = 1;


                    $select_post_query = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_array($select_post_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_date = $row['post_date'];

                        echo '<div class="row" style="flex-wrap: nowrap; 
                         margin-right: 0;
                         margin-left: 0; padding-bottom: 8px; border-bottom: 1px solid #c2c2c2;">';

                        echo '<div class="number" style="color: #959595;">' . $y . '</div>';
                        echo ' <div class="infor"><a href="../front_end/post.php?p_id=' . $post_id . '" style="text-decoration: none; color: #111111;">' . $post_title . '</a></div>';
                        echo '</div>';
                        $y++;
                    }
}
function menu3(){
   
    global $connection;
    $isActive = 'active';
    $sql = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_comment_count DESC LIMIT 3";
    $y = 1;
                    $select_post_query = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_array($select_post_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_date = $row['post_date'];

                        echo '<div class="row" style="flex-wrap: nowrap; 
                         margin-right: 0;
                         margin-left: 0; padding-bottom: 8px; border-bottom: 1px solid #c2c2c2;">';

                        echo '<div class="number" style="color: #959595;">' . $y . '</div>';
                        echo ' <div class="infor"><a href="../front_end/post.php?p_id=' . $post_id . '" style="text-decoration: none; color: #111111;">' . $post_title . '</a></div>';
                        echo '</div>';
                        $y++;
                    }
}


?>



