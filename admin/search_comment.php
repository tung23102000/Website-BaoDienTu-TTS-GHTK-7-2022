<?php include "include/admin_header.php";
include "include/function.php";
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "include/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="text-align:center; color:#2a789b; font-size:40px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; border-bottom: 1px solid #FFF;">
                        COMMENTS MANAGEMENT
                  
                    </h1>


                    <div class="row" style="margin-left: 0; margin-right: 0; margin-bottom: 15px;">
                        <div class="search" style="float: left; margin-right: 50px;">
                          
                            <form class="form-inline" action="search.php" method="post">
                                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search..." aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" name="submit_search" type="submit"><img src="../front_end/image1/icon-search.png" /></button>
                            </form>
                        </div>

                    </div>

                    <table class="table table-bordered table-hover table-responsive ">
                        <thead class="thead-dark">
                            <tr>
                                <th class="align-middle text-center align-middle" width="50px" style="vertical-align: middle;">ID</th>
                                <th class="align-middle text-center" style="vertical-align: middle;">Tác giả</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Nội dung</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">In response to</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Ngày</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Comment status</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Change to approved</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Change to unapproved</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['submit_search'])) {
                                $search_field = $_POST['search'];
                                filterInput($search_field);
                                $search_sql = "SELECT * FROM comments WHERE comment_content LIKE '%$search_field%'";
                                $selected_comment_query = mysqli_query($connection, $search_sql);
                                $count = mysqli_num_rows($selected_comment_query);
                                if ($count == 0) {
                                    echo '<h2>No comments available</h2>';
                                } else {
                                    while ($row = mysqli_fetch_assoc($selected_comment_query)) {
                                        $comment_id = $row['comment_id'];
                                        $comment_author_id = $row['comment_author_id'];
                                        $comment_post_id = $row['comment_post_id'];
                                        $comment_content = $row['comment_content'];
                                        $comment_status = $row['comment_status'];
                                        $comment_date = $row['comment_date'];
                                        echo "<tr>";
                                        echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$comment_id}</td>";
                                        $sql = "SELECT * FROM users WHERE user_id = $comment_author_id";
                                        $selected_author_query = mysqli_query($connection, $sql);
                                        while ($row = mysqli_fetch_array($selected_author_query)) {
                                            $user_id = $row['user_id'];
                                            $name = $row['name'];
                                            echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$name}</td>";
                                        }



                                        echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$comment_content}</td>";
                                        $sql2 = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                        $selected_post_query = mysqli_query($connection, $sql2);
                                        while ($row = mysqli_fetch_array($selected_post_query)) {
                                            $post_id = $row['post_id'];
                                            $post_title = $row['post_title'];
                                            echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$post_title}</td>";
                                        }
                                        echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$comment_date}</td>";
                                        echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$comment_status}</td>";
                                        echo "<td class ='align-middle text-center' style='vertical-align: middle;'><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                                        echo "<td class ='align-middle text-center' style='vertical-align: middle;'><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                                        echo "<td class ='align-middle text-center' style='vertical-align: middle;'><a href='comments.php?delete={$comment_id}'><button class='btn btn-danger'>Xóa</button></a></td>";
                                    }
                            ?>


                            <?php
                                    if (isset($_GET['delete'])) {
                                        $the_comment_id = $_GET['delete'];
                                        $sql = "delete from comments where comment_id = {$the_comment_id}";
                                        $delete_query = mysqli_query($connection, $sql);

                                        echo '
                                        <script>
                                        swal({
                                            title: "Xoá thành công!",
                                            text: "",
                                            icon: "success",
                                            button: "Ok",
                                        });
                                        </script>';
                                        header('Location: comments.php');
                                    }
                                    if (isset($_GET['unapprove'])) {
                                        $the_comment_id = $_GET['unapprove'];
                                        $sql = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
                                        $selected_comment_query = mysqli_query($connection, $sql);
                                        header("Location: comments.php");
                                    }
                                    if (isset($_GET['approve'])) {
                                        $the_comment_id = $_GET['approve'];
                                        $sql = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
                                        $selected_comment_query = mysqli_query($connection, $sql);
                                        header("Location: comments.php");
                                    }
                                }
                            }



                            ?>
                        </tbody>
                    </table>





                </div>
            </div>
      

        </div>
        

    </div>

    <?php include "include/admin_footer.php"; ?>