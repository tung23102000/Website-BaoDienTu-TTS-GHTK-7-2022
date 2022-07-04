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
                        USERS MANAGEMENT
         
                    </h1>


                    <div class="row" style="margin-left: 0; margin-right: 0;">
                        <div class="search" style="float: left; margin-right: 50px;">
                        
                            <form class="form-inline" action="search_user.php" method="post">
                                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search..." aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" name="submit_search" type="submit"><img src="../front_end/image1/icon-search.png" /></button>
                            </form>
                        </div>

                        <a href="include/add_user.php">
                            <button class="btn btn-success" style="margin-bottom: 15px; float: right;">Thêm người dùng</button>
                        </a>
                    </div>

                    <table class="table table-bordered table-hover table-responsive ">
                        <thead class="thead-dark">
                            <tr>
                                <th class="align-middle text-center align-middle" width="50px" style="vertical-align: middle;">ID</th>
                                <th class="align-middle text-center" style="vertical-align: middle;">Tên</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Ảnh</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Username</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Email</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Role</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Address</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Change role to Admin</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Change role to Subcriber</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Edit</th>
                                <th class="align-middle text-center align-middle" style="vertical-align: middle;">Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['submit_search'])) {
                                $search = $_POST['search'];
                                $sql = "SELECT * FROM users WHERE username OR name LIKE '%$search%'";
                                $search_user_query = mysqli_query($connection, $sql);
                                $count = mysqli_num_rows($search_user_query);
                                if ($count == 0) {
                                    echo '<h2>No users available</h2>';
                                } else {
                                 while ($row = mysqli_fetch_assoc($search_user_query)) {
                                    $user_id = $row['user_id'];
                                    $name = $row['name'];
                                    $user_image = $row['user_image'];
                                    $username = $row['username'];
                                    $user_role = $row['user_role'];
                                    $user_email = $row['user_gmail'];
                                    $user_address = $row['user_address'];


                                    echo "<tr>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$user_id}</td>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$name}</td>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'><img class='img-responsive' width ='102px' src='images/{$user_image}' alt='image'/></td>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$username}</td>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$user_email}</td>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$user_role}</td>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'>{$user_address}</td>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'><a href='users.php?change_to_sub={$user_id}'>Subcriber</a></td>";

                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'><a href='include/edit_user.php?id={$user_id}'> <button class='btn btn-warning'>Sửa</button></a></td>";
                                    echo "<td class ='align-middle text-center' style='vertical-align: middle;'><a href='users.php?delete={$user_id}'><button class='btn btn-danger'>Xóa</button></a></td>";
                                    echo "</tr>";
                                }
                             ?>


                             <?php
                                if (isset($_GET['delete'])) {
                                    $the_user_id = $_GET['delete'];
                                    $sql = "delete from users where user_id = {$the_user_id}";
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
                                    header('Location: users.php');
                                }
                              }
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    if (isset($_GET['change_to_admin'])) {
                        $the_user_id = $_GET['change_to_admin'];
                        $sql = "UPDATE users SET user_role='admin' WHERE user_id=$the_user_id";
                        $change_to_admin_query = mysqli_query($connection, $sql);

                        header("Location: users.php");
                    }

                    if (isset($_GET['change_to_sub'])) {
                        $the_user_id = $_GET['change_to_sub'];
                        $sql = "UPDATE users SET user_role='subcriber' WHERE user_id = $the_user_id";
                        $change_to_sub_query = mysqli_query($connection, $sql);

                        header("Location: users.php");
                    }


                    ?>




                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php include "include/admin_footer.php"; ?>