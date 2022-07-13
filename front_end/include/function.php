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




?>