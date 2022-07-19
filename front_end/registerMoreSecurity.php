<?php include '../database/dbhelper.php'; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./css/loginStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

<body>
    <?php
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $rePassword = $_POST['re-password'];

        if (!empty($username) && !empty($password) && !empty($name) && !empty($rePassword) && $_POST['g-recaptcha-response'] != "") {
            $secret = 'secret key';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            $username = mysqli_real_escape_string($connection, $username);
            $password = mysqli_real_escape_string($connection, $password);
            $name = mysqli_real_escape_string($connection, $name);
            $rePassword = mysqli_real_escape_string($connection, $rePassword);
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $select_user_query = mysqli_query($connection, $sql);
            $user_count = mysqli_num_rows($select_user_query);
            if ($user_count == 0) {

                if ($password === $rePassword) {
                    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
                    $query = "INSERT INTO users (username, name, password,user_role) VALUES ('{$username}','{$name}',
            '{$password}','subcriber')";
                    $regiser_user_query = mysqli_query($connection, $query);
                    if (!$regiser_user_query) {
                        die("Query failed " . mysqli_error($connection));
                    }
                    echo '
        <script>
        swal({
            title: "Đăng ký thành công!",
            text: "",
            icon: "success",
            button: "Ok",
        });
        </script>';
                    $sql = "SELECT * FROM users WHERE username = '$username'";
                    $select_user_query = mysqli_query($connection, $sql);
                    if (!$select_user_query) {
                        die("Query failed " . mysqli_error($connection));
                    }
                    while ($row = mysqli_fetch_array($select_user_query)) {
                        $db_user_id = $row['user_id'];
                        $db_username = $row['username'];
                        $db_password = $row['password'];
                        $db_name = $row['name'];
                        $db_role = $row['user_role'];
                        $db_image = $row['user_image'];
                    }
                    $_SESSION['user_id'] = $db_user_id;
                    $_SESSION['username'] = $db_username;
                    $_SESSION['name'] = $db_name;
                    $_SESSION['user_role'] = $db_role;
                    $_SESSION['image'] = $db_image;
                    header('Location: index.php');
                } else {
                    echo '
        <script>
        swal({
            title: "Vui lòng nhập lại mật khẩu cho khớp!",
            text: "",
            icon: "warning",
            button: "Ok",
        });
        </script>';
                }
            } else {
                echo '
                <script>
                swal({
                    title: "Đã tồn tại username!",
                    text: "",
                    icon: "error",
                    button: "Ok",
                });
                </script>';
            }
        } else {

            echo '
            <script>
            swal({
                title: "Vui lòng nhập đầy đủ các trường!",
                text: "",
                icon: "error",
                button: "Ok",
            });
            </script>';
        }
    }




    ?>

    <div class="login-page">
        <div class="form">
            <h2 style="    color: #306494;
    font-weight: bold; margin-bottom: 40px;">REGISTER FORM</h2>

            <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">

                    <label for="username" class="sr-only">Your name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name ">
                </div>
                <div class="form-group">

                    <label for="username" class="sr-only">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username ">
                </div>
                <div class="form-group">

                    <label for="username" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password " pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Mật khẩu phải ít nhất 8 kí tự, gồm ít nhất 1 chữ hoa, 1 chữ thường, 1 chữ số và 1 ký tự đặc biệt">
                </div>
                <div class="form-group">

                    <label for="username" class="sr-only">Repeat your password</label>
                    <input type="password" name="re-password" id="re-password" class="form-control" placeholder="Enter your password again " pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Mật khẩu phải ít nhất 8 kí tự, gồm ít nhất 1 chữ hoa, 1 chữ thường, 1 chữ số và 1 ký tự đặc biệt">
                </div>
                <div class="g-recaptcha" data-sitekey="secret "></div>
                <button type="submit" name="register" style=" border-radius: 16px;
    margin-top: 15px;">Register</button>
                <p class="message">Have already an account? <a href="loginMoreSecurity.php">Login here</a></p>
            </form>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
</body>

</html>