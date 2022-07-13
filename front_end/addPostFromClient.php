<?php include "include/header.php"; ?>

<?php
if (isset($_SESSION['name'])) {
    $post_author = $_SESSION['name'];

    if (isset($_POST['create'])) {
        $post_title        = $_POST['post_title'];
        $post_image        = $_FILES['image']['name'];
        $post_image_temp   = $_FILES['image']['tmp_name']; //File đã upload trong thư mục tạm thời trên Web Server
        $post_category_id  = $_POST['post_category'];
        $post_content      = $_POST['post_content'];
        $post_tag        = $_POST['post_tag'];
        $post_date         = date('H:i d-m-Y');
        move_uploaded_file($post_image_temp, "../admin/images/{$post_image}"); // chuyển từ chỗ tạm thời sang thư mục ảnh ở root
        $post_content = strip_tags($post_content);
        $post_content = mysqli_real_escape_string($connection,$post_content);
        $sql = "INSERT INTO posts(post_title,post_author,post_image,post_content,post_date,post_tag,post_category_id,post_status) 
    VALUES('{$post_title}','{$post_author}','{$post_image}','{$post_content}',now(),'{$post_tag}','{$post_category_id}','draft')";
        mysqli_query($connection, $sql);
        if(mysqli_query($connection, $sql)){
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
}


?>
<div class="container">
    <h2 class="text-center" style="color: #cc1414; margin-top: 35px; margin-bottom: 40px; font-weight: bold;">Thêm bài viết</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title" style="color: black; font-weight: bold;">Title</label>
            <input type="text" class="form-control" name="post_title">
        </div>

        <div class="form-group">
            <label for="post_image" style="color: black; font-weight: bold;">Image</label>
            <br>
            <input type="file" name="image">
        </div>

        <div class="form-group">
            <label for="category" style="color: black; font-weight: bold;">Category</label>
            <select name="post_category" id="">

                <?php

                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<option value='$cat_id'>{$cat_title}</option>";
                }

                ?>


            </select>
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
            <div class="row" style="margin-left:0; justify-content:center;">
                <input class="btn btn-success" type="submit" name="create" value="Add Post">
                <a class="btn btn-warning" href="#" type="submit" name="" value="Cancel" style="margin-left: 25px;">Cancel</a>
            </div>

        </div>


    </form>

</div>

<?php include "include/footer.php"; ?>