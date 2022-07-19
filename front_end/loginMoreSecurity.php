<?php include '../database/dbhelper.php'; ?>
<?php session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
      <link rel="stylesheet" href="./css/loginStyle.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<body>
<?php
 if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $select_user_query = mysqli_query($connection,$sql);
    if(!$select_user_query){
        die("Query failed ".mysqli_error($connection));
    }
    while($row = mysqli_fetch_array($select_user_query)){
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['password'];
        $db_name = $row['name'];
        $db_role = $row['user_role'];
        $db_image = $row['user_image'];
   

    }
    if(isset($db_password) && !empty($db_password)){
        if(password_verify($password,$db_password)){
        //if($password===$db_password){
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['name'] = $db_name;
            $_SESSION['user_role']= $db_role;
            $_SESSION['image']= $db_image;
            $_SESSION['edit_profile'] = 
            header('Location: index.php');
        }
        else{
            echo '
            <script>
            swal({
                title: "Đăng nhập thất bại!",
                text: "Sai thông tin đăng nhập!",
                icon: "error",
                button: "Ok",
            });
            </script>';
        }
    }
    else{
        echo '
        <script>
        swal({
            title: "Đăng nhập thất bại!",
            text: "Vui lòng nhập đầy đủ các trường!",
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
    font-weight: bold; margin-bottom: 40px;">LOGIN FORM</h2>
   
    <form class="login-form" action="" method="post" >
      <input type="text" placeholder="Enter username" name="username"/>
      <input type="password" placeholder="Enter password" name="password"/>
      <button type="submit" name="login" style=" border-radius: 16px;
    margin-top: 15px;">login</button>
      <p class="message">Not registered? <a href="registerMoreSecurity.php">Create an account</a></p>
    </form>
  </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
</body>
</html>