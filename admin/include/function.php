<?php

function filterInput($data) {
   global $connection;
    $data = trim($data);
    $data = stripslashes($data);//xóa bỏ gạch chéo ngược \
    $data = htmlspecialchars($data);//lưu dưới dạng mã thoát HTML ví dụ: < là &lt
    $data= mysqli_real_escape_string($connection, $data);
    return $data;
}





?>