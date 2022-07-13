<?php include('include/header.php');
include('include/function.php');
?>
<div class="container" style="margin-bottom: 40px;">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            if (isset($_POST['submit_search'])) {
                $search = $_POST['search'];
                filterInput($search);
                $sql = "SELECT * FROM posts WHERE post_tag OR post_title LIKE '%$search%'";
                $search_query = mysqli_query($connection, $sql);
                if (!$search_query) {
                    die("Query fail" . mysqli_error($connection));
                }
                $count = mysqli_num_rows($search_query);
                if ($count == 0) {
                    echo "<h1>NO RESULT</h1>";
                } else {
                    while ($row = mysqli_fetch_assoc($search_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tag = $row['post_tag'];

            ?>


                        <!-- First Blog Post -->
                        <h2>
                            <a href="../front_end/post.php?p_id=<?php echo $post_id; ?>" style="text-decoration: none; color: #333333;  font-weight: bold;"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php" style="color: #33333; text-decoration: none;"><?php echo $post_author; ?></a>
                        </p>
                        <p><i class="fa-solid fa-clock"></i> <?php $date = date_create($post_date);
                                                                $date = date_format($date, "h:i d/m/Y");
                                                                echo $date; ?></p>
                        <hr>
                        <img class="img-responsive" src="../admin/images/<?php echo $post_image; ?>" style="width: 100%;" alt="">
                        <hr>
                        <p style="margin-top:30px;"><?php $string = $row['post_content'];
                                                    $string = strip_tags($string);
                                                    if (strlen($string) > 500) {

                                            
                                                        $stringCut = substr($string, 0, 500);
                                                        $endPoint = strrpos($stringCut, ' ');

                                                  
                                                        if ($endPoint) {
                                                            $string = substr($stringCut, 0, $endPoint);
                                                        }
                                                      
                                                        $string = $string . ' ...';
                                                    }
                                                    echo $string; ?></p>
                        <a class="btn btn-primary" href="../front_end/post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

            <?php }
                }
            }
            ?>




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