<?php include 'include/header.php'; ?>

<div class="container" style="margin-bottom: 40px;">

    <div class="row">


        <div class="col-md-8">

            <?php
            if (isset($_GET['category'])) {
                $post_category_id = $_GET['category'];
                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                    $sql = "SELECT * FROM posts where post_category_id = $post_category_id";
                } else {
                    $sql = "SELECT * FROM posts where post_category_id = $post_category_id AND post_status='published'";
                }

                $select_all_posts_query = mysqli_query($connection, $sql);
                if (mysqli_num_rows($select_all_posts_query) < 1) {
                    echo "<h1 class='text-center'>No posts available</h1>";
                } else {
                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tag = $row['post_tag'];




            ?>
                        <br>
                        <h2>
                            <a href="../front_end/post.php?p_id=<?php echo  htmlspecialchars($post_id); ?>" style="text-decoration: none; color: #333333;  font-weight: bold;"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php" style="color: #33333; text-decoration: none;"><?php echo $post_author; ?></a>
                        </p>
                        <p><i class="fa-solid fa-clock"></i> <?php $date = date_create($post_date);
                                                                $date = date_format($date, "h:i d/m/Y");
                                                                echo $date; ?></p>

                        <img class="img-responsive" src="../admin/images/<?php echo $post_image; ?>" alt="" style="width:100%">

                        <!-- giới hạn 300 kí tự nếu muốn đọc chi tiết phải bấm đọc thêm -->
                        <p style="margin-top:30px;"><?php $string = $row['post_content'];
                                                    $string = strip_tags($string);
                                                    if (strlen($string) > 500) {

                                                       
                                                        $stringCut = substr($string, 0, 500);
                                                        $endPoint = strrpos($stringCut, ' ');

                                                        
                                                        if ($endPoint) {
                                                            $string = substr($stringCut, 0, $endPoint);
                                                        }
                                                        //  $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                        $string = $string . ' ...';
                                                    }
                                                    echo $string; ?></p>
                        <p style="color: #29a887;">#<?php echo $post_tag ?></p>
                        <a class="btn btn-primary" href="../front_end/post.php?p_id=<?php echo  htmlspecialchars($post_id); ?>">Read More</a>

                        <hr>
            <?php  }
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
<?php include 'include/footer.php'; ?>