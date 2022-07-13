<?php include 'include/header.php'; ?>
<!-- main-content -->
<main class="container main-content">

    <div class="row">
        <div class="col-12 col-lg-8">
            <h4 class="title-news">Lastest Posts</h4>
            <div class="list-news">
                <?php
                // var_dump( date("H:i:s Y-m-d"));
                $per_page = 6;
                if (isset($_GET['page'])) { // nếu ở trên url xuất hiện page thì lấy ra giá trị
                    $page = $_GET['page'];
                } else { // nếu k có thì gán bằng rỗng
                    $page = "";
                }
                if ($page == "" || $page == 1) { // nếu k có hoặc page =1 thì $page_1 =0
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * $per_page) - $per_page; // ví dụ page=2=> $page_1 sẽ bắt đầu từ vị trí chỉ số thứ 4(thực tế là từ bài viết số 5)
                }
                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                    $post_query_count = "SELECT * FROM posts";
                } else {
                    $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
                }
                //$post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
                $find_count = mysqli_query($connection, $post_query_count);
                $count = mysqli_num_rows($find_count);
                $count_page = ceil($count / $per_page);
                $sql = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_date DESC LIMIT $page_1,$per_page ";
      
                $select_lastest_post_query = mysqli_query($connection, $sql);
                while ($row = mysqli_fetch_array($select_lastest_post_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_content = $row['post_content'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tag = $row['post_tag'];
                    $post_view_count = $row['post_view_count'];
                    $post_comment_count = $row['post_comment_count'];
                    //echo $post_date;

                ?>
                    <div class="row news">

                        <div class="col-12 col-md-6 pic-news">
                            <a href="../front_end/post.php?p_id=<?php echo htmlspecialchars($post_id); ?>" class="img-thumb-news"><img src="../admin/images/<?php echo $post_image; ?> " style="width:100%; " /> </a>
                        </div>

                        <div class="col-12 col-md-6 infor-news">


                            <h4 class="title" style="font-family: 'Merriweather'; font-weight: bold; "><a href="../front_end/post.php?p_id=<?php echo htmlspecialchars($post_id); ?>"><?php echo $post_title; ?></a></h4>
                            <div class="infor-detail">
                                <i class="fa-solid fa-clock"></i>
                                <span class="date"><?php $date = date_create($post_date);
                                                    $date = date_format($date, "H:i d/m/Y");
                                                    echo $date; ?> </span>
                                <span class="comment"><?php echo $post_comment_count; ?></span>
                                <span class="like"><?php echo $post_view_count; ?></span>
                            </div>
                            <p class="description-news"><?php $string = $row['post_content'];
                                                        $string = strip_tags($string);
                                                        if (strlen($string) > 300) {

                                                            // thu gọn nội dung giới hạn 300 từ và điểm cuối cắt ở khoảng trắng
                                                            $stringCut = substr($string, 0, 300);
                                                            $endPoint = strrpos($stringCut, ' ');

                                                          
                                                            //nếu trong chuỗi k bao gồm bất kỳ khoảng trắng nào thì sẽ cắt ra trừ các từ
                                                            if ($endPoint) {
                                                                $string = substr($stringCut, 0, $endPoint);
                                                            }
                                                            //  $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                            $string = $string . '.';
                                                        }
                                                        echo $string; ?></p>
                            <div class="hash-tag"><a href="../front_end/post.php?p_id=<?php echo  htmlspecialchars($post_id); ?>"># <?php echo $post_tag; ?></a></div>
                        </div>
                    </div>

                <?php } ?>

            </div>
            <ul class=" container row paging-news">

                <?php
                for ($i = 1; $i <= $count_page; $i++) {
                    if ($i == $page) {
                        echo "<li class='page-item active'><a class='page-link' style='background-color:#22a7f7;'href='index.php?page={$i}'>$i</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>$i</a></li>";
                    }
                }

                ?>
            </ul>
        </div>
        <?php //include 'include/sidebar.php'; ?>
        <?php include 'include/sidebarAJAX.php'; ?>


        
    </div>
    <div class="content">
            <a href="#" class="ads-bottom">
                <img src="image1/ads-bottom.jpg" />
            </a>
        </div>
</main>
<?php include 'include/footer.php'; ?>