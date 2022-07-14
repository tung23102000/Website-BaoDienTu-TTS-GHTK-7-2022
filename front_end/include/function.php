<?php
function getAvatarFromDB($id){
    global $connection;
    $query = "SELECT * FROM users WHERE user_id = $id ";
            $select_image = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($select_image)) {

                $user_image = $row['user_image'];
            }
        return $user_image;
}
function filterInput($data) {
    global $connection;
    $data = trim($data);
    $data = stripslashes($data);//xóa bỏ gạch chéo ngược \
    $data = htmlspecialchars($data);//lưu dưới dạng mã thoát HTML ví dụ: < là &lt
    $data = mysqli_real_escape_string($connection,$data);
    return $data;
}



?>