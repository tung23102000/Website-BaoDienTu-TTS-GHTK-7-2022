<?php  include "header.php"; ?>
<?php include "../../database/dbhelper.php";  ?>

<?php 
if(isset($_POST['create'])){
    $post_title        = $_POST['post_title'];
    $post_image        = $_FILES['image']['name'];
    $post_image_temp   = $_FILES['image']['tmp_name'];//File đã upload trong thư mục tạm thời trên Web Server
    $post_category_id  = $_POST['post_category'];
    $post_content      = $_POST['post_content'];
    $post_author        = $_POST['post_author'];
    $post_tag        = $_POST['post_tag'];
    $post_date         = date('H:i d-m-Y');
    move_uploaded_file($post_image_temp,"../images/{$post_image}");// chuyển từ chỗ tạm thời sang thư mục ảnh ở root
    $sql = "INSERT INTO posts(post_title,post_author,post_image,post_content,post_date,post_tag,post_category_id) 
    VALUES('{$post_title}','{$post_author}','{$post_image}','{$post_content}',now(),'{$post_tag}','{$post_category_id}')";
   $query= mysqli_query($connection,$sql);
   if($query){
      echo '
      <script>
       swal({
           title: "Thêm bài viết thành công!",
           text: "",
           icon: "success",
           button: "Ok",
       });
       </script>';
   }
}



?>
<div class="container">
<h2 class="text-center" style="color: #cc1414; margin-top: 35px; margin-bottom: 40px;">Thêm bài viết</h2>
<form action="" method="post" enctype="multipart/form-data">    
     
     <div class="form-group">
        <label for="title" style="color: black; font-weight: bold;">Title</label>
        <input type="text" class="form-control" name="post_title">
     </div>

     <div class="form-group">
         <label for="post_image" style="color: black; font-weight: bold;">Image</label>
         <br>
          <input type="file"  name="image">
      </div>  

      <div class="form-group">
        <label for="category" style="color: black; font-weight: bold;">Category</label>
       <select name="post_category" id="">
           
<?php

        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_categories )) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
                    
            echo "<option value='$cat_id'>{$cat_title}</option>";
         
            
        }

?>
           
        
       </select>
     </div>

     <div class="form-group">
        <label for="title" style="color: black; font-weight: bold;">Author</label>
        <input type="text" class="form-control" name="post_author">
     </div>
        <div class="form-group">
         <label for="title" style="color: black; font-weight: bold;">Content</label>
         <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
      </div>
      <div class="form-group">
        <label for="title" style="color: black; font-weight: bold;">Tag</label>
        <input type="text" class="form-control" name="post_tag">
     </div>

       <div class="form-group">
          <input class="btn btn-success" type="submit" name="create" value="Thêm bài viết">
      </div>


</form>
</div>
<?php include "footer.php"; ?>
