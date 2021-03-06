<?php  include "header.php"; ?>
<?php include "../../database/dbhelper.php"; include "function.php"; ?>

<?php 
if(isset($_POST['create'])){
    $username = filterInput($_POST['username']);
    $name = filterInput($_POST['name']);
    $password = filterInput($_POST['password']);
    $user_image        = $_FILES['image']['name'];
    $user_image_temp   = $_FILES['image']['tmp_name'];//File đã upload trong thư mục tạm thời trên Web Server
    $user_email = filterInput($_POST['user_email']);
    $user_role = filterInput($_POST['user_role']);
    $user_address = filterInput($_POST['user_address']);
    move_uploaded_file($user_image_temp,"../images/{$user_image}");// chuyển từ chỗ tạm thời sang thư mục ảnh ở root
    $password = password_hash($password,PASSWORD_BCRYPT,array('cost' => 12));
    $sql = 'INSERT INTO users(username,name,user_role,user_image,user_gmail,password,user_address) 
          VALUES("'.$username.'","'.$name.'","'.$user_role.'","'.$user_image.'","'.$user_email.'", "'.$password.'","'.$user_address.'")';
    $query=mysqli_query($connection,$sql);
    if($query){
    echo '
      <script>
       swal({
           title: "Thêm người dùng thành công!",
           text: "",
           icon: "success",
           button: "Ok",
       });
       </script>';
    }
    echo "<p class='bg-success'>User created successfully: " . " " ."<a href='../users.php'>View Users</a></p>";
    
}



?>
<div class="container">
<h2 class="text-center" style="color: #cc1414; margin-top: 35px; margin-bottom: 40px;">Thêm người dùng</h2>
<form action="" method="post" enctype="multipart/form-data">    
     
     <div class="form-group">
        <label for="title" style="color: black; font-weight: bold;">Name</label>
        <input type="text" class="form-control" name="name">
     </div>

     <div class="form-group">
        <label for="title" style="color: black; font-weight: bold;">Username</label>
        <input type="text" class="form-control" name="username">
     </div>

     <div class="form-group">
         <label for="post_image" style="color: black; font-weight: bold;">Image</label>
         <br>
          <input type="file"  name="image">
      </div>  

      <div class="form-group">
        <label for="role" style="color: black; font-weight: bold;">Role</label><br>
       <select name="user_role" id="">
         <option value="subcriber">Select options</option>
         <option value="admin">Admin</option>
         <option value="subcriber">Subcriber</option>
          
        
       </select>
     </div>

     <div class="form-group">
        <label for="title" style="color: black; font-weight: bold;">Password</label>
        <input type="password" class="form-control" name="password">
     </div>
       
      <div class="form-group">
        <label for="title" style="color: black; font-weight: bold;">Email</label>
        <input type="email" class="form-control" name="user_email">
     </div>

     <div class="form-group">
        <label for="title" style="color: black; font-weight: bold;">Address</label>
        <input type="text" class="form-control" name="user_address">
     </div>

       <div class="form-group">
          <input class="btn btn-success" type="submit" name="create" value="Thêm người dùng">
      </div>


</form>
</div>
<?php include "footer.php"; ?>
