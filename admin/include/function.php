<?php

function filterInput($data) {

    $data = trim($data);
    $data = stripslashes($data);//xóa bỏ gạch chéo ngược \
    $data = htmlspecialchars($data);//lưu dưới dạng mã thoát HTML ví dụ: < là &lt
    
    return $data;
}





?>