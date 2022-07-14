<?php include "include/admin_header.php"; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "include/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="text-align:center; color:#2a789b; font-size:40px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; border-bottom: 1px solid #FFF;">
                        POSTS MANAGEMENT

                    </h1>


                    <div class="row" style="margin-left: 0; margin-right: 0;">
                        <div class="search" style="float: left; margin-right: 50px;">

                            <form class="form-inline" action="search.php" method="post">
                                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search..." aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" name="submit_search" type="submit"><img src="../front_end/image1/icon-search.png" /></button>
                            </form>
                        </div>

                        <a href="include/add_post.php">
                            <button class="btn btn-success" style="margin-bottom: 15px; float: right;">Thêm bài viết</button>
                        </a>
                    </div>

                    <table class="table table-bordered table-hover table-responsive ">
                        <thead class="thead-dark">
                            <tr>
                                <th class="align-middle text-center align-middle" width="50px" style="vertical-align: middle;">ID</th>
                                <th class="align-middle text-center" style="vertical-align: middle;">Tác giả</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Ảnh</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Tiêu đề</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Danh mục</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Ngày</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">View</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Tag</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Post status</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">View count</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Comment count</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Edit</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "select * from posts ORDER BY post_id DESC ";
                            $selected_post_query = mysqli_query($connection, $sql);
                            while ($row = mysqli_fetch_assoc($selected_post_query)) {
                                $post_id = $row['post_id'];
                                $post_author = $row['post_author'];
                                $post_image = $row['post_image'];
                                $post_title = $row['post_title'];
                                $post_category_id = $row['post_category_id'];
                                $post_date = $row['post_date'];
                                //$post_content = $row['content'];
                                $post_status = $row['post_status'];
                                $post_view_count = $row['post_view_count'];
                                $post_comment_count = $row['post_comment_count'];
                                $post_tag = $row['post_tag'];

                                echo "<tr>";
                                echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$post_id}</td>";
                                echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$post_author}</td>";
                                echo "<td class ='align-middle text-center' style='vertical-align: middle;'><img class='img-responsive' width ='102px' src='images/{$post_image}' alt='image'/></td>";
                                echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$post_title}</td>";
                                // liên kết giữa bảng categories và posts vì 2 bảng này có lk với nhau qua postcategory_id=post_id
                                $sql = "SELECT * FROM categories where cat_id= {$post_category_id}";
                                $select_categories = mysqli_query($connection, $sql);
                                while ($row = mysqli_fetch_assoc($select_categories)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title']; //lấy ra từng cái title trong sau khi thực hiện câu lệnh
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$cat_title}</td>";
                                }

                                echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$post_date}</td>";
                                echo "<td class ='align-middle text-center' style='vertical-align: middle;'><a href='../front_end/post.php?p_id={$post_id}'>View post</a></td>";
                                echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$post_tag}</td>";
                                echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$post_status}</td>";
                                echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$post_view_count}</td>";
                                echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$post_comment_count}</td>";
                                echo "<td class ='align-middle text-center' style='vertical-align: middle;'><a href='include/edit_post.php?id={$post_id}'> <button class='btn btn-warning'>Sửa</button></a></td>";
                                echo "<td class ='align-middle text-center' style='vertical-align: middle;'><a href='posts.php?delete={$post_id}'><button class='btn btn-danger'>Xóa</button></a></td>";
                                echo "</tr>";
                            }
                            ?>


                            <?php
                            if (isset($_GET['delete'])) {
                                if (isset($_SESSION['user_role'])) {
                                    if ($_SESSION['user_role'] == 'admin') {
                                        $the_post_id = $_GET['delete'];
                                        $sql = "delete from posts where post_id = {$the_post_id}";
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
                                        header('Location: posts.php');
                                    }
                                }
                            }





                            ?>
                        </tbody>
                    </table>





                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php include "include/admin_footer.php"; ?>