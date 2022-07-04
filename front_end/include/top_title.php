<?php include '../database/dbhelper.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="box-news-right">

<nav class="navbar navbar-expand-lg top-title">
    <ul class="navbar-nav">
        <?php
    //     if (isset($_GET['source'])) {

    //         if ($_GET['source'] == 'mostViews') {
    //             echo '<li class="nav-item">
    //         <a href="index.php?source=mostViews" class="nav-link active">MOST VIEWS</a>
    //         </li>';
    //             echo '<li class="nav-item">
    //         <a href="index.php?source=lastest" class="nav-link">lastest</a>
    //     </li>';
    //             echo '<li class="nav-item">
    //     <a href="index.php?source=comment" class="nav-link">Comment</a>
    // </li>';
    //         } else if ($_GET['source'] == 'lastest') {
    //             echo '<li class="nav-item">
    //                         <a href="index.php?source=mostViews" class="nav-link">MOST VIEWS</a>
    //                   </li>';
    //             echo '<li class="nav-item">
    //                         <a href="index.php?source=lastest" class="nav-link active">lastest</a>
    //                  </li>';
    //             echo '<li class="nav-item">
    //                         <a href="index.php?source=comment" class="nav-link">Comment</a>
    //                   </li>';
    //         } else {
    //                             echo '<li class="nav-item">
    //                                     <a href="index.php?source=mostViews" class="nav-link">MOST VIEWS</a>
    //                                    </li>';
    //                             echo '<li class="nav-item">
    //                                      <a href="index.php?source=lastest" class="nav-link">lastest</a>
    //                                   </li>';
    //                             echo '<li class="nav-item">
    //                                     <a href="index.php?source=comment" class="nav-link active">Comment</a>
    //                                   </li>';
    //         }
    //     } else {
    //         echo '<li class="nav-item">
    //         <a href="index.php?source=mostViews" class="nav-link active">MOST VIEWS</a>
    //         </li>';
    //         echo '<li class="nav-item">
    //         <a href="index.php?source=lastest" class="nav-link">lastest</a>
    //         </li>';
    //         echo '<li class="nav-item">
    //         <a href="index.php?source=comment" class="nav-link">Comment</a>
    //         </li>';
    //     }
        ?>
       <li class="nav-item"><a href="index.php?source=mostViews" class="nav-link">MOST VIEWS</a></li>
       <li class="nav-item"><a href="index.php?source=lastest" class="nav-link">lastest</a></li>
       <li class="nav-item"><a href="index.php?source=comment" class="nav-link">Comment</a></li>
    </ul>
</nav>

<div class="lst-content">
    <div class="item-content" style="flex-direction: column; padding-top: 8px">
        <!-- <div class="number">1</div> -->
        <?php
        if (isset($_GET['source'])) {

            if ($_GET['source'] == 'mostViews') {
                $isActive = 'active';
                $sql = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_view_count DESC LIMIT 3";
            } else if ($_GET['source'] == 'latest') {
                $isActive = 'active';
                $sql = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_date DESC LIMIT 3";
            } else {
                $isActive = 'active';
                $sql = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_comment_count DESC LIMIT 3";
            }
            $y = 1;


            $select_post_query = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_array($select_post_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_date = $row['post_date'];

                echo '<div class="row" style="flex-wrap: nowrap; 
                 margin-right: 0;
                 margin-left: 0; padding-bottom: 8px; border-bottom: 1px solid #c2c2c2;">';

                echo '<div class="number" style="color: #959595;">' . $y . '</div>';
                echo ' <div class="infor"><a href="../front_end/post.php?p_id=' . $post_id . '" style="text-decoration: none; color: #111111;">' . $post_title . '</a></div>';
                echo '</div>';
                $y++;
            }
        } else {
            $sql = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_view_count DESC LIMIT 3";
            $y = 1;
            $select_post_query = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_array($select_post_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_date = $row['post_date'];

                echo '<div class="row" style="flex-wrap: nowrap; 
                 margin-right: 0;
                 margin-left: 0; padding-bottom: 8px; border-bottom: 1px solid #c2c2c2;">';

                echo '<div class="number" style="color: #959595;">' . $y . '</div>';
                echo ' <div class="infor"><a href="../front_end/post.php?p_id=' . $post_id . '" style="text-decoration: none; color: #111111;">' . $post_title . '</a></div>';
                echo '</div>';

                $y++;
            }
        }
        ?>
    </div>
   
</div>

</div>
</body>
</html>



