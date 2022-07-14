<?php ob_start();
include "include/header.php"; ?>

<?php
if (isset($_GET['id'])) {
    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['user_id'] === $_GET['id']) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM users WHERE user_id = $id";
            $select_users_query = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_assoc($select_users_query)) {
                $user_id = $row['user_id']; //mấy cái 'user_id', 'user_password' là trường trong csdl đó
                $username = $row['username'];
                $user_password = $row['password'];
            }
        } else {
            header('HTTP/1.0 404 Not Found');
            readFile('../error/404.php');
            exit();
        }
    } else {
        header('HTTP/1.0 404 Not Found');
        readFile('../error/404.php');
        exit();
    }
} else{
    header('HTTP/1.0 404 Not Found');
    readFile('../error/404.php');
    exit();
}

$token = md5(uniqid()); //ID được tạo từ hàm này không đảm bảo tính duy nhất của giá trị trả về nên để tạo một ID cực kỳ khó đoán kèm sử dụng hàm md5 () 

if (isset($_POST['submit']) && $_SESSION['_token'] == $_POST['_token']) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $rePassword = $_POST['rePassword'];
    $old_password = mysqli_real_escape_string($connection, $old_password);
    $new_password = mysqli_real_escape_string($connection, $new_password);
    $rePassword = mysqli_real_escape_string($connection, $rePassword);

    if (password_verify($old_password, $user_password)) {
        //echo password_verify($old_password,$user_password);
        //if ($old_password === $user_password) {


        if ($rePassword === $new_password) {
            $new_password = password_hash($new_password, PASSWORD_BCRYPT, array('cost' => 12));
            $sql = "UPDATE users SET password = '$new_password' WHERE user_id = $user_id";
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
        } else {
            echo '
        <script>
         swal({
             title: "Cập nhật thất bại!",
             text: "Vui lòng nhập khớp mật khẩu",
             icon: "error",
             button: "Ok",
         });
         </script>';
        }
    } else {
        echo '
    <script>
     swal({
         title: "Cập nhật thất bại!",
         text: "Vui lòng nhập đúng mật khẩu cũ",
         icon: "error",
         button: "Ok",
     });
     </script>';
    }
}


?>
<!-- Page Content -->
<div class="container-fluid">

    <section id="login">
        <div class="container">
            <div class="row my-3" style="margin-right: 0;">
                <div class="col-6" style="margin-left: 30%; margin-right: 30%;">
                    <div class="form-wrap">
                        <h2 style="text-align:center; color:#5495a1;">Change your password</h2>

                        <form role="form" action="" method="post" id="login-form" autocomplete="off">

                            <div class="form-group">
                                <label for="email" class="sr-only">Old password</label>
                                <input type="password" name="old_password" id="email" class="form-control" placeholder="Type your old password" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">New password</label>
                                <input type="password" name="new_password" id="subject" class="form-control" placeholder="Type your new password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Mật khẩu phải ít nhất 8 kí tự, gồm ít nhất 1 chữ hoa, 1 chữ thường, 1 chữ số và 1 ký tự đặc biệt">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">New password again</label>
                                <input type="password" name="rePassword" id="subject" class="form-control" placeholder="Type your new password again" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Mật khẩu phải ít nhất 8 kí tự, gồm ít nhất 1 chữ hoa, 1 chữ thường, 1 chữ số và 1 ký tự đặc biệt">
                            </div>
                            <input type="hidden" name="_token" value="<?php echo $token; ?>" />
                            <?php
                            $_SESSION['_token'] = $token;
                            ?>
                            <div class="form-group">
                                <div class="row" style="margin-left:0; justify-content:center;">
                                    <input class="btn btn-success" type="submit" name="submit" value="Submit">
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
<?php  ?>
<?php include "include/footer.php"; ?>