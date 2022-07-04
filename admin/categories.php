<?php include "include/admin_header.php"; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "include/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="text-align:center; color:#2a789b; font-size:40px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                        CATEGORIES MANAGEMENT
                      
                    </h1>

                    <div class="col-xs-6">
                        <?php
                               if (isset($_POST['submit'])) {
                                $cat_title = $_POST['cat_title'];
                                if ($cat_title == "" || empty($cat_title)) {
                                    echo '
                                    <script>
                                     swal({
                                         title: "Thêm danh mục thất bại!",
                                         text: "Vui lòng nhập tên danh mục",
                                         icon: "error",
                                         button: "Ok",
                                     });
                                     </script>';
                                } else {
                                    $sql = "insert into categories(cat_title) value ('{$cat_title}')";
                                    $create_category_query = mysqli_query($connection, $sql);
                                    if (!$create_category_query) {
                                        die("Could not create category " . mysqli_error($connection));
                                    }
                                }
                            }

                        ?>

                        <form action="" method="post">
                            <label for="cate-title">Add category</label>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter the category" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" name="submit" value="Thêm danh mục">
                            </div>
                        </form>
                        <!-- edit -->
                        <?php
                        if (isset($_GET['edit'])) {
                            $cat_id = $_GET['edit'];
                            include "include/update_categories.php";
                        }
                        ?>
                    </div>


                    <div class="col-xs-6">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class='align-middle text-center' style='vertical-align: middle;'>ID</th>
                                    <th class='align-middle text-center' style='vertical-align: middle;'>Category Title</th>
                                    <th class='align-middle text-center' style='vertical-align: middle;'>Edit</th>
                                    <th class='align-middle text-center' style='vertical-align: middle;'>Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- hiện tất cả các mục trong bảng categories -->
                                <?php
                                $sql = "SELECT * FROM categories";
                                $select_categories = mysqli_query($connection, $sql);
                                while ($row = mysqli_fetch_assoc($select_categories)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title']; //lấy ra từng cái title trong sau khi thực hiện câu lệnh
                                    echo "<tr>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$cat_id}</td>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$cat_title}</td>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'><a href='categories.php?edit={$cat_id}'><button class='btn btn-warning'>Sửa</button></a></td>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'><a href='categories.php?delete={$cat_id}'><button class='btn btn-danger'>Xóa</button></a></td>";
                                    echo "</tr>";
                                }
                                ?>
                                <!-- xóa -->
                                <?php

                                if (isset($_GET['delete'])) { // $_GET['delete'] chính là số id đó ví dụ : 1 2 3 4
                                    $the_cat_id = $_GET['delete'];
                                    $sql = "DELETE FROM categories where cat_id ={$the_cat_id}";
                                    $delete_query = mysqli_query($connection, $sql);
                                    header("Location: categories.php");
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php include "include/admin_footer.php"; ?>