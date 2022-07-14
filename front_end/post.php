<?php include 'include/header.php'; 
include 'include/function.php';
?>
<!-- Page Content -->
<div class="container" style="margin-bottom: 40px;">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-12 col-md-8">

            <?php
            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];

               $the_post_id = mysqli_real_escape_string($connection,$the_post_id);
               $the_post_id = filterInput($the_post_id);
                if ($_SERVER['REQUEST_METHOD'] !== 'POST') { // nếu ko phải do gửi vào biểu mẫu post ở mục comment thì mới cho tăng biến đếm lượt xem
                    // đơn giản là ta tăng cột lượt xem lên 1 mỗi khi click vào 1 bài cụ thể có id
                    $views_query = "UPDATE posts SET post_view_count= post_view_count+1 where post_id = $the_post_id";
                    $update_views_count = mysqli_query($connection, $views_query);
                   // var_dump($update_views_count);
                    // if (!$update_views_count) {
                    //    die("Query failed " . mysqli_error($connection));
                    //    echo $views_query;
                    // }
                }

                $sql = "SELECT * FROM posts WHERE post_id = $the_post_id";
               // echo $sql;
                $select_all_posts_query = mysqli_query($connection, $sql);
                if (mysqli_num_rows($select_all_posts_query) < 1) {
                    echo "<h1 class='text-center'>No posts available</h1>";
                } else {
                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tag = $row['post_tag'];




            ?>
                        <br>
                        <h2>
                            <a href="#" style="text-decoration: none;  color: #333333; font-weight: bold;"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php" style="color: #33333; text-decoration: none;"><?php echo $post_author; ?></a>
                        </p>
                        <p><i class="fa-solid fa-clock"></i> <?php $date = date_create($post_date);
                                                                $date = date_format($date, "d/m/Y");
                                                                echo $date; ?></p>

                        <img class="img-responsive" src="../admin/images/<?php echo $post_image; ?>" alt="" style="width:100%">

                        <p><?php echo $post_content; ?></p>
                        <p style="color: #29a887;">#<?php echo $post_tag ?></p>


                        <hr>
                    <?php  } ?>



                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (isset($_POST['create_comment'])) {
                            if (isset($_SESSION['username'])) { //nếu đã đăng nhập rồi
                                $the_post_id = $_GET['p_id'];
                               $comment_content = $_POST['comment_content'];
                                $comment_content =  strip_tags($_POST['comment_content']);//loại bỏ các thẻ HTML,PHP ở đó
                                $comment_content = mysqli_real_escape_string($connection,$comment_content);
                                if (!empty($comment_content)) {
                                    $sql = 'INSERT INTO comments(comment_post_id, comment_author_id, comment_content, comment_status,
                                comment_date) VALUES("' . $the_post_id . '","' . $_SESSION['user_id'] . '", "' . $comment_content . '", "unapproved", now())';
                                // $sql = "INSERT INTO comments(comment_post_id, comment_author_id, comment_content, comment_status,
                                // comment_date) VALUES($the_post_id,'".$_SESSION['user_id']."', '".$comment_content."', 'unapproved', now())";
                                   //echo $sql;
                                    $create_comment_query = mysqli_query($connection, $sql);
                                    // if (!$create_comment_query) {
                                    //     die('query fail ' . mysqli_error($connection));
                                    // }
                                    // echo $sql."<br>";
                                    // echo $comment_content;
                                    $query = "UPDATE posts SET post_comment_count= post_comment_count+1 where post_id = $the_post_id";
                                    $update_comment_count = mysqli_query($connection, $query);
                                } else {
                                    echo "<script>alert('Fields cannot be empty ');</script>";
                                }
                            } else {
                                echo '
                                    <script>
                                    swal({
                                        title: "Vui lòng đăng nhập để thực hiện chức năng comment!",
                                        text: "",
                                        icon: "error",
                                        button: "Ok",
                                    });
                                    </script>';
                            }
                        }
                    }
                    ?>
                    <!-- Comment -->
                    <div class="well">
                        <h4><img src="https://cdnweb.dantri.com.vn/dist/720a45e76744508fd435.svg" alt="image" style="width:50px; height: 45px; margin-right: 10px;">Leave a Comment:</h4>
                        <form method="post" action="" role="form">

                            <?php if (isset($_SESSION['username'])) {


                            ?>


                                <p style="font-weight: bold;">Tác giả: <?php echo $_SESSION['name']; ?></p>



                            <?php }  ?>

                            <div class="form-group">
                                <label for="Comment">Your comment:</label>
                                <textarea name="comment_content" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" name="create_comment" class="btn btn-success">Submit</button>
                        </form>
                    </div>



                    <!-- Posted Comments -->
                    <?php
                    $sql = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} AND comment_status ='approved' ORDER BY comment_id DESC";
                    $select_comment_query = mysqli_query($connection, $sql);
                    if (!$select_comment_query) {
                        die("Query fail " . mysqli_error($connection));
                    }
                    while ($row = mysqli_fetch_assoc($select_comment_query)) {
                        $comment_date = $row['comment_date'];
                        $comment_author_id = $row['comment_author_id'];
                        $comment_content = $row['comment_content'];
                        $sql2 = "SELECT * FROM users WHERE user_id = $comment_author_id";
                        $select_author_query = mysqli_query($connection, $sql2);
                        $row2 = mysqli_fetch_array($select_author_query);
                        $author_name = $row2['name'];
                        $author_image = $row2['user_image'];


                    ?>
                        <!-- Comment -->
                        <div class="media my-5">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="../admin/images/<?php echo $author_image; ?>" alt="" style="margin-right: 14px;
    width: 34px; height: 34px; border-radius:50%;">
                            </a>
                            <div class="media-body">
                                <h6 class="media-heading"><?php echo $author_name; ?></h6>
                                <p style="margin-top: 1px; font-size: 12px; color: #816f6f;"><?php echo $comment_date ?></p>

                                <?php echo $comment_content ?>
                            </div>
                        </div>
                    <?php  } ?>

            <?php
                }
            } // nếu k có id bài
            else {
                header("Location: index.php");
            } ?>



        </div>

        <?php include "include/sidebarAJAX.php"; ?>

    </div>
    <!-- /.row -->

    <hr>
</div>
</div>



<?php

include 'include/footer.php';


?>