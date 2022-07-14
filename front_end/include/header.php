<?php header("X-Frame-Options: DENY");
header("Content-Security-Policy: frame-ancestors 'none'", false);?>
<?php session_start(); ?>
<?php include '../database/dbhelper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="Content-Security-Policy" content="script-src 'self' https://apis.google.com"> -->
    <!-- ngăn JavaScript nội tuyến thực thi-->
    <title>Inforword</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- jQuery library -->
    <script>
        // function submitform(){
        //       $(".myForm").submit();
        // }
    </script>
  
    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<div class="wrap-content">
    <header>
        <div class="container-fluid top-header" style="background-image: linear-gradient(90deg, #21324a, #111727);
    background-color: #2a3e41; color:#fff; width: 100%;">
            <div class="row">
                <div class="container">
                    <div class="row topbar align-items-center justify-content-end">
                        <a href="#" class="icon-1"></a>
                        <a href="#" class="icon-2"></a>
                        <a href="#" class="icon-3"></a>
                        <a href="#" class="icon-4"></a>
                        <a href="#" class="icon-5"></a>
                        <a href="#" class="icon-6"></a>
                        <a href="#" class="icon-7"></a>
                        <div class="row ml-3">
                            <?php if (isset($_SESSION['user_id'])) {
                                // echo $_SESSION['username'];
                                $id =  $_SESSION['user_id'];
                                //  echo $_SESSION['image'];
                            ?>
                                <div class="dropdown">

                                    <img class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" src="./image1/user.jpg" style="width: 30px; height: 28px; border-radius: 50%; padding: 0"></img>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <p class="mx-4 my-1"><i class="fa-solid fa-user" style="margin-right: 8px;"></i> <?php echo $_SESSION['name']; ?></p>
                                        </li>
                                        <?php
                                          if($_SESSION['user_role']=='admin'){ ?>
                                            <li><a class="dropdown-item no-padding" href="../admin/index.php"><img src="https://icons.veryicon.com/png/o/miscellaneous/yuanql/icon-admin.png" alt="" style="margin-right: 8px; width: 17px; height: 17px;"></img> Trang quản trị</a></li>
                                    <?php      } else{

                                          ?>
                                        <li><a class="dropdown-item no-padding" href="./addPostFromClient.php?id=<?php echo htmlspecialchars($id); ?>"><i class="fa-solid fa-plus" style="margin-right: 8px;"></i> Thêm bài viết</a></li>
                                        <?php } ?>
                                        <li><a class="dropdown-item no-padding" href="./editProfileMoreSecurity.php?id=<?php echo htmlspecialchars($_SESSION["user_id"]); ?>"><i class="fa-solid fa-pen" style="margin-right: 8px;"></i> Sửa thông tin</a></li>
                                        <!-- <li><a class="dropdown-item no-padding" href="./editProfile.php?id=<?php echo htmlspecialchars($id); ?>"><i class="fa-solid fa-pen" style="margin-right: 8px;"></i> Sửa thông tin</a></li>
                                        <li><a class="dropdown-item no-padding" href="./changePassword.php?id=<?php echo htmlspecialchars($id); ?>"><img src="https://uxwing.com/wp-content/themes/uxwing/download/07-web-app-development/change-password.png" alt="" style="margin-right: 8px; width: 17px; height: 17px;"></img> Đổi mật khẩu</a></li> -->
                                        <li><a class="dropdown-item no-padding" href="./changePasswordMoreSecurity.php?id=<?php echo htmlspecialchars($_SESSION['user_id']); ?>"><img src="https://uxwing.com/wp-content/themes/uxwing/download/07-web-app-development/change-password.png" alt="" style="margin-right: 8px; width: 17px; height: 17px;"></img> Đổi mật khẩu</a></li>
                                        <li><a class="dropdown-item no-padding" href="./logout.php"><i class="fa-solid fa-right-from-bracket" style="margin-right: 8px;"></i> Đăng xuất</a></li>
                                    </ul>
                                </div>

                            <?php } else { ?>

                                <a href="./registerMoreSecurity.php" style="text-decoration: none; color: #fff;">Đăng ký</a>
                                |
                                <a href="./loginMoreSecurity.php" style="text-decoration: none; color: #fff;">Đăng nhập</a>
                            <?php } ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- banner -->
        <div class="container-fluid box-banner align-items-center">
            <div class="main-header">

                <div class="container inner-banner">
                    <div class="row align-items-center" style="height:100%;">
                        <div class="col-12 col-lg-4">
                        <!-- <a href="index.php" class="logo"> -->
                            <!-- thay vì viết index.php do ta đã thay ở trong .htaccess nên chỉ cần index ho thôi -->
                            <a href="index.php" class="logo">
                                <img src="image1/logo.png" />
                            </a>
                        </div>
                        <div class="col-12 col-lg-8">
                            <a href="#" class="banner">
                                <img src="image1/banner.jpg" />
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <?php include 'navigation.php'; ?>
    </header>

    <body>