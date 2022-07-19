<?php include "header.php"; ?>
<?php include "../../database/dbhelper.php";  
include "function.php";
?>

<?php
if (isset($_GET['id'])) {
    $the_post_id = $_GET['id'];
}
$sql = "SELECT * FROM posts where post_id = {$the_post_id}";
$select_post_by_id = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_assoc($select_post_by_id)) {
    $post_id = $row['post_id']; //mấy cái 'post_id', 'post_author' là trường trong csdl đó
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tag = $row['post_tag'];
    $post_date = $row['post_date'];
    $sql2 = "SELECT * FROM users WHERE name = '$post_author'";
   
    $select_author_query = mysqli_query($connection, $sql2);
    $row2 = mysqli_fetch_assoc($select_author_query);
    // lấy ra tên
    $post_author_id = $row2['user_id'];
  
}


if (isset($_POST['update_post'])) {
    $post_author_id = $_POST['post_author'];
    $sql2 = "SELECT * FROM users WHERE user_id = $post_author_id";
    $select_author_query = mysqli_query($connection, $sql2);
    $row2 = mysqli_fetch_array($select_author_query);
    // lấy ra tên
    $post_author = $row2['name'];
    $post_title = filterInput($_POST['post_title']);
    $post_category_id = $_POST['post_category'];
    $post_status= $_POST['post_status'];
    $post_image        = $_FILES['image']['name'];
    $post_image_temp   = $_FILES['image']['tmp_name']; //File đã upload trong thư mục tạm thời trên Web Server
    $post_tag         = filterInput($_POST['post_tag']);
    $post_content      = $_POST['post_content'];
    $post_content = strip_tags($post_content,['p','b','u','img']);
    $post_content = mysqli_real_escape_string($connection, $post_content);
    //$post_content = htmlspecialchars($post_content);
    move_uploaded_file($post_image_temp, "../images/$post_image");
    if (empty($post_image)) {
        // nếu k có ảnh nào đc chọn tức là k thay đổi ảnh cũ thì phải thực hiện bằng cách lấy ảnh từ db
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {

            $post_image = $row['post_image'];
        }
    }

    $sql = "UPDATE posts SET 
      post_title = '{$post_title}', 
      post_author='{$post_author}',
       post_category_id= $post_category_id,
       post_date=now(),
       post_status = '{$post_status}',
       post_tag='{$post_tag}', 
       post_image='{$post_image}',
       post_content='{$post_content}' WHERE post_id=$the_post_id  ";
    $update_query = mysqli_query($connection, $sql);
    if (!$update_query) {
        die("query failed" . mysqli_error($connection));
    }
    else{
        echo '
        <script>
         swal({
             title: "Sửa bài viết thành công!",
             text: "",
             icon: "success",
             button: "Ok",
         });
         </script>';
     }
    echo "<p class='bg-success'>Post Updated. <a href='../../front_end/post.php?p_id={$the_post_id}'>View post</a></p>";
}


?>
<div class="container">
    <h2 class="text-center" style="color: #cc1414; margin-top: 35px; margin-bottom: 40px;">Sửa bài viết</h2>
    <form action="" method="post" enctype="multipart/form-data">


        <div class="form-group">
            <label for="title" style="color: black; font-weight: bold;">Post Title</label>
            <input value="<?php echo $post_title ?>" type="text" class="form-control" name="post_title">
        </div>

        <div class="form-group">
            <label for="title" style="color: black; font-weight: bold;">Post Category</label>
            <select name="post_category" id="">
                <?php
                $sql = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title']; //lấy ra từng cái title trong sau khi thực hiện câu lệnh ở trong csdl
                    if ($cat_id == $post_category_id) { // id của category == id của danh mục của post lúc trước
                        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                    } else {

                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="title" style="color: black; font-weight: bold;">Post Author</label>
            <!-- <input value="<?php //echo $post_author; ?>" type="text" class="form-control" name="post_author"> -->
            <select name="post_author" id="">
                <?php
                $sql = "SELECT * FROM users";
                $select_users = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($select_users)) {
                    $user_id = $row['user_id'];
                    $name = $row['name']; 
                   
                    if ($user_id == $post_author_id) { 
                        echo "<option selected value='{$user_id}'>{$name}</option>";
                    } else {

                        echo "<option value='{$user_id}'>{$name}</option>";
                    }
                }
                ?>
            </select>
        </div>


    <div class="form-group">
    <label for="post_image" style="color: black; font-weight: bold;">Post Status</label>
            <br>
    <select name="post_status" id="">
 
      <option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>
      <?php
      if ($post_status == 'published') {
        echo "<option value='draft'>draft</option>";
      } else {
        echo "<option value='published'>publish</option>";
      }
      ?>
    </select>
  </div>




        <div class="form-group">
            <label for="post_image" style="color: black; font-weight: bold;">Post Image</label>
            <br>
            <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
            <input type="file" name="image">
        </div>

        <div class="form-group">
            <label for="post_tags" style="color: black; font-weight: bold;">Post Tags</label>
            <input value="<?php echo $post_tag; ?>" type="text" class="form-control" name="post_tag">
        </div>

        <div class="form-group">
            <label for="post_content" style="color: black; font-weight: bold;">Post Content</label>
            <textarea class="form-control " name="post_content" id="summernote" cols="30" rows="10"><?php echo $post_content; ?></textarea>
        </div>



        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
        </div>


    </form>
</div>
<?php include "footer.php"; ?>