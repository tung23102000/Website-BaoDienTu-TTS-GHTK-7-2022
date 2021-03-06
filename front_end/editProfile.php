<?php include "include/header.php"; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE user_id = $id";
    $select_users_query = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id']; //mấy cái 'user_id', 'user_password' là trường trong csdl đó
        $username = $row['username'];
        $user_password = $row['password'];
        $user_fullname = $row['name'];
        $user_email = $row['user_gmail'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_address = $row['user_address'];
    }
}

?>
<?php
if(isset($_POST['edit_user'])){

    $user_fullname      = $_POST['user_fullname'];
    $username         = $_POST['username'];
    $user_email         = $_POST['user_gmail'];
    $user_address     = $_POST['user_address'];
    $user_image        = $_FILES['image']['name'];
    $user_image_temp   = $_FILES['image']['tmp_name'];//File đã upload trong thư mục tạm thời trên Web Server
    move_uploaded_file($user_image_temp, "../admin/images/$user_image");
    if (empty($user_image)) {
        // nếu k có ảnh nào đc chọn tức là k thay đổi ảnh cũ thì phải thực hiện bằng cách lấy ảnh từ db
        $query = "SELECT * FROM users WHERE user_id = $id ";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {

            $user_image = $row['user_image'];
        }
    }
   $sql = 'UPDATE users SET 
   name = "' . $user_fullname. '", 
   username="' . $username . '", 
   user_gmail="' . $user_email . '", 
   user_image="' . $user_image . '",
   user_address="' . $user_address . '"
   WHERE user_id="' .$id.'"';
   $update_query = mysqli_query($connection, $sql);
   if (!$update_query) {
       die("query failed" . mysqli_error($connection));
   }
   else{
    echo '
    <script>
    swal({
        title: "Cập nhật thành công!",
        text: "",
        icon: "success",
        button: "Ok",
    });
    </script>';
   }
}


?>
<div class="container-fluid">
    <section id="login">
        <div class="container my-4">
            <div class="row" style="margin-right: 0;">
                <div class="col-3">
                    <div class="card h-60">
                        <div class="card-body">
                            <div class="account-settings">
                                <div class="user-profile">
                                    <div class="user-avatar">
                                        <?php if(empty($user_image)){  ?>
                                        <img src="https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" alt="Maxwell Admin" style="width: 90px;
    height: 100px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;">
                                     <?php    } else { ?>
                                        <img src="../admin/images/<?php echo $user_image; ?>" alt="Image" style="width: 100px;
    height: 100px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;">
                                   <?php  } ?>
                                    </div>
                                    <h5 class="user-name"><?php echo $user_fullname; ?></h5>
                                    <h6 class="user-email"><?php echo $user_email; ?></h6>
                                </div>
                                <div class="about">
                                    <!-- <h5>Address</h5> -->
                                    <p><i class="fa-solid fa-house"></i> <?php echo $user_address; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-wrap">
                        <h2 style="text-align:center; color:#5495a1;">Edit Profile</h2>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Fullname</label>
                                <input type="text" value="<?php echo $user_fullname; ?>" class="form-control" name="user_fullname" placeholder="Enter your fullname">
                            </div>

                            <div class="form-group">
                                <label for="post_image">Avatar</label>
                                <br>
                                <img width="150" src="../admin/images/<?php echo $user_image; ?>" alt="image">
                            
                                <input type="file" name="image">
                            </div>

                            <div class="form-group">
                                <label for="post_tags">Username</label>
                                <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label for="post_tags">Email</label>
                                <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_gmail">
                            </div>
                            <div class="form-group">
                                <label for="post_tags">Address</label>
                                <input type="text" value="<?php echo $user_address; ?>" class="form-control" name="user_address">
                            </div>
                            
                            <div class="form-group">
                                <div class="row" style="margin-left:0; justify-content:center;">
                                    <input class="btn btn-success" type="submit" name="edit_user" value="Edit User">
                                    <a class="btn btn-warning" href="#" type="submit" name="" value="Cancel" style="margin-left: 25px;">Cancel</a>
                                </div>

                            </div>


                        </form>


                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>

</div>


<?php include "include/footer.php"; ?>