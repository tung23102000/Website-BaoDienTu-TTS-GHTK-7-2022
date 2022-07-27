<?php  ob_start();
include "include/header.php";
include "include/function.php"; ?>

<?php
if (isset($_GET['id'])) {
    if (isset($_SESSION['user_id'])) {
        if ($_GET['id'] === $_SESSION['user_id']) {
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
        } else {
            // echo '
            // <script>
            // swal({
            //     title: "Bạn không có quyền truy cập vào trang khác!",
            //     text: "",
            //     icon: "error",
            //     button: "Ok",
            // });
            // </script>';
        
           
            header('HTTP/1.0 404 Not Found');
            readFile('../error/404.php');
            include "include/footer.php";
            exit();
        }
    } else {
       
        header('HTTP/1.0 404 Not Found');
    readFile('../error/404.php');
    include "include/footer.php";
    exit();
    }
} else{
    header('HTTP/1.0 404 Not Found');
    readFile('../error/404.php');
    include "include/footer.php";
    exit();
}

?>


<?php
//mặc định là được upfile
$allowUpload   = true;
// Cỡ lớn nhất được upload (bytes)
$maxfilesize   = 800000;

////Những loại file được phép upload
$allowtypes    = array('jpg', 'png', 'jpeg', 'gif','JPG','PNG','JPEG','GIF');

if (isset($_POST['edit_user']) && $_SESSION['token']===$_POST['_token']) {
    if(time()>=$_SESSION['token-expire']){
        echo "Token hết hạn. Vui lòng load lại form.";
    } else{

    $user_fullname      = $_POST['user_fullname'];
    $username         = $_POST['username'];
    $user_email         = $_POST['user_gmail'];
    $user_address     = $_POST['user_address'];
    $user_image        = $_FILES['image']['name'];
    //echo $imageFileType;
    // echo "Type : " . $_FILES['image']['type'] ."<br>";
    $user_image_temp   = $_FILES['image']['tmp_name']; //File đã upload trong thư mục tạm thời trên Web Server
//var_dump($user_image_temp);
    if (empty($user_image)) {
        $user_image = getAvatarFromDB($id);
    }
    //cần kiểm tra ở kỹ ở thư mục tạm thời trc khi chuyển về thư mục cần lưu trữ
    //  $check = getimagesize($user_image_temp);
    $imageFileType = pathinfo($user_image, PATHINFO_EXTENSION); //lấy ra phần mở rộng file(đuôi file)
    // echo $imageFileType;
    // if ($check !== false) {
    $allowUpload = true;
    //  } else {
    // echo '
    //     <script>
    //     swal({
    //         title: "Cập nhật avatar thất bại!",
    //         text: "Đây không phải file ảnh!",
    //         icon: "error",
    //         button: "Ok",
    //     });
    //     </script>';
    //     $user_image=getAvatarFromDB($id);
    // $allowUpload = false;
    //     }
    //    // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
    if ($_FILES["image"]["size"] > $maxfilesize) {
        echo '
        <script>
        swal({
            title: "Cập nhật avatar thất bai!",
            text: "Upload ảnh vượt quá kích cỡ cho phép!",
            icon: "error",
            button: "Ok",
        });
        </script>';
        getAvatarFromDB($id);
        $allowUpload = false;
    }
    // Kiểm tra kiểu file
    if (!in_array($imageFileType, $allowtypes)) {
        echo '
            <script>
            swal({
                title: "Cập nhật avatar thất bại!",
                text: "Kiểu file không được phép!",
                icon: "error",
                button: "Ok",
            });
            </script>';
        $user_image = getAvatarFromDB($id);
        $allowUpload = false;
    }
    //}
    if ($allowUpload == true) {
        move_uploaded_file($user_image_temp, "../admin/images/$user_image");


        if (empty($user_image)) {
            // nếu k có ảnh nào đc chọn tức là k thay đổi ảnh cũ thì phải thực hiện bằng cách lấy ảnh từ db


            $user_image = getAvatarFromDB($id);
        }
        $sql = 'UPDATE users SET 
                name = "' . $user_fullname . '", 
                username="' . $username . '", 
                user_gmail="' . $user_email . '", 
                user_image="' . $user_image . '",
                user_address="' . $user_address . '"
                WHERE user_id="' . $id . '"';
        $update_query = mysqli_query($connection, $sql);
        if (!$update_query) {
            die("query failed" . mysqli_error($connection));
        } else {
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
}
}

$token = md5(uniqid());

$_SESSION['token'] = $token;
$_SESSION["token-expire"] = time() + 240;         //hạn sử dụng token chỉ trong 4 phút                                  
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
                                        <?php if (empty($user_image)) {  ?>
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
                            <input type="hidden" name="_token" value="<?php echo $token; ?>" />
                            
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