<?php include 'include/admin_header.php'; ?>

 
<div id="wrapper">

    <?php include 'include/admin_navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="text-align: center; color: #076a44; font-size:40px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; border-bottom: 1px solid #FFF;">
                        Welcome to Admin page

                    </h1>

                </div>
            </div>
            <!-- /.row -->



            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $sql = "SELECT * FROM posts";
                                    $select_post_query = mysqli_query($connection, $sql);
                                    $post_count = mysqli_num_rows($select_post_query);
                                    echo "<div class='huge'>{$post_count}</div>";

                                    ?>


                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="./posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $sql = "SELECT * FROM comments";
                                    $select_comment_query = mysqli_query($connection, $sql);
                                    $comment_count = mysqli_num_rows($select_comment_query);
                                    echo "<div class='huge'>{$comment_count}</div>";

                                    ?>

                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="./comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $sql = "SELECT * FROM users";
                                    $select_user_query = mysqli_query($connection, $sql);
                                    $user_count = mysqli_num_rows($select_user_query);
                                    echo "<div class='huge'>{$user_count}</div>";

                                    ?>

                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="./users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $sql = "SELECT * FROM categories";
                                    $select_category_query = mysqli_query($connection, $sql);
                                    $category_count = mysqli_num_rows($select_category_query);
                                    echo "<div class='huge'>{$category_count}</div>";

                                    ?>

                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="./categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


            <?php
            //  counting published posts
            $sql = "SELECT * FROM posts WHERE post_status = 'published' ";
            $select_all_published_posts = mysqli_query($connection, $sql);
            $published_post_count = mysqli_num_rows($select_all_published_posts);
            //  counting draft posts
            $sql = "SELECT * FROM posts WHERE post_status = 'draft' ";
            $select_all_draft_posts = mysqli_query($connection, $sql);
            $draft_post_count = mysqli_num_rows($select_all_draft_posts);
            //  counting unapproved comments
            $sql = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
            $select_all_unapproved_comments = mysqli_query($connection, $sql);
            $unapproved_comment_count = mysqli_num_rows($select_all_unapproved_comments);
            //  counting subcriber user
            $sql = "SELECT * FROM users WHERE user_role = 'subcriber' ";
            $select_all_subcriber_user = mysqli_query($connection, $sql);
            $subcriber_user_count = mysqli_num_rows($select_all_subcriber_user);


            ?>


            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                          
                            <?php
                            $color = ['red', 'yellow', 'blue', 'aqua', 'green', 'yellow', 'orange', 'black'];
                            $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Unapproved Comments', 'Users', 'Subcriber user', 'Categories'];
                            $element_count = [$post_count, $published_post_count, $draft_post_count, $comment_count, $unapproved_comment_count, $user_count, $subcriber_user_count, $category_count];
                            for ($i = 0; $i < 8; $i++) {

                                echo "['{$element_text[$i]}', {$element_count[$i]}],";
                                // in cho giống cái ví dụ ở dưới
                            }

                            ?>
                            //       ví dụ:        ['posts', 1000],
                            //                     ['comments',1000], 

                        ]);

                        var options = {
                            chart: {
                                title: 'Diagram of components in Inforword',
                                subtitle: '',
                                
                            },
                           colors: ['#70d6f2']
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include 'include/admin_footer.php'; ?>
    <?php //} } ?>