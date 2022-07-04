<form action="" method="post">
    <label for="cate-title">Edit category</label>
    <?php
    if (isset($_GET['edit'])) {
        $the_cat_id = $_GET['edit'];
        $sql = "SELECT * FROM categories where cat_id= {$the_cat_id}";
        $edit_categories = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($edit_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title']; //lấy ra từng cái title trong sau khi thực hiện câu lệnh
        }
    ?>
    <!-- chỗ ô nhập để sửa -->
        <input value="<?php if (isset($cat_title)) {echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">

    <?php }?>

    <!-- update -->

    <?php
    if (isset($_POST['update_category'])) {
        $the_cat_title = $_POST['cat_title'];
        $sql = "UPDATE categories SET cat_title = '{$the_cat_title}' where cat_id = {$cat_id}"; // cái cat_id là giá trị ở 
        // trên URl edit get ở function findAllCategories
        $update_query = mysqli_query($connection, $sql);
        if (!$update_query) {
            die("Error updating category " . mysqli_error($connection));
        }
    }

    ?>
<!-- nút bấm update -->
    <div class="form-group" style="margin-top:19px;">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update">
    </div>
</form>