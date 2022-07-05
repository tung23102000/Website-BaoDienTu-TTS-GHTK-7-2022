<div class="col-12 col-lg-4">
    <h4 class="title-news">Popular Posts</h4>
    <div class="box-slide">
        <?php
        $sql = "SELECT * FROM posts ORDER BY post_view_count DESC LIMIT 3";
        $select_popular_post = mysqli_query($connection, $sql);
        //  var_dump($select_popular_post);

        while ($row = mysqli_fetch_array($select_popular_post)) {
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tag = $row['post_tag'];
        }
        ?>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php $i = 0;
                $class = " ";
                $count = mysqli_num_rows($select_popular_post);
                for ($i = 0; $i < $count; $i++) {
                    if ($i === 0) {
                        $class = "active";
                    } ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php echo $class; ?>"></li>
                <?php } ?>

                <!-- <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
            </ol>
            <div class="carousel-inner">

                <?php
                $sql = "SELECT * FROM posts ORDER BY post_view_count DESC LIMIT 3";
                $select_popular_post = mysqli_query($connection, $sql);
                //  var_dump($select_popular_post);
                $i = 0;
                while ($row = mysqli_fetch_array($select_popular_post)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tag = $row['post_tag'];

                    $class_item = '';
                    if ($i == 0) {
                        $class_item = "active";
                    } else {
                        $class_item = '';
                    }

                    echo "<div class='carousel-item $class_item'>
              <a href='../front_end/post.php?p_id=$post_id'><img class='d-block w-100' src='../admin/images/{$post_image}' alt='First slide'/><div class='carousel-caption d-none d-md-block' style='background: rgba(0,0,0,.5); left:0; right:0; bottom:0;'>
              <h6 style='   margin-bottom: 23px;'>$post_title</h6>
              
            </div></a>
               </div>";
                    $i++;
                }


                ?>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
    </div>
    <h4 class="title-news">Video</h4>
    <div class="box-video">

        <iframe width="100%" height="350" src="https://embed.vietnamnet.vn/v/001FQK.html" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen" data-mce-fragment="1"></iframe>
    </div>
    <div class="ads">
        <img src="image1/img-right3.jpg" />
    </div>
    <div class="box-news-right">

        <nav class="navbar navbar-expand-lg top-title">
            <ul class="navbar-nav">

                <!-- <li class="nav-item" id="mostViews"><a href="#">MOST VIEWS</a></li>
                <li class="nav-item" id="lastest"><a href="#">lastest</a></li>
                <li class="nav-item" id="comments"><a href="#">Comments</a></li> -->
                <li class="nav-item default" id="mostViews">
                    <!-- <a href="" class="nav-link active">MOST VIEWS</a> -->
                    MOST VIEWS
                </li>
                <li class="nav-item" id="lastest">
                    lastest
                </li>
                <li class="nav-item" id="comments">
                    Comment
                </li>

            </ul>
        </nav>

        <div class="lst-content">
            <div class="item-content" style="flex-direction: column; padding-top: 8px"></div>

        </div>

    </div>
    <!-- thời tiết -->
    <div class="twister">
        <h4 class="title-news">WEATHER</h4>
        <div class="weather-block">
            <div class="weather-result row" style="margin-right: 0; margin-left:0;">
                <?php include 'weatherAJAX.php'; ?>
            </div>
        </div>
    </div>

    <div class="twister">
        <h4 class="title-news">Twisters</h4>
        <img src="image1/twister.png" />
    </div>


    <div class="tag">
        <h4 class="title-news">TAGS</h4>
        <div class="d-flex content-tag flex-wrap">
            <?php
            $sql = "SELECT post_tag FROM posts LIMIT 5";
            $select_tags_query = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_array($select_tags_query)) {
                $post_tag = $row['post_tag'];
                $sql2 = "SELECT * FROM posts WHERE post_tag LIKE '$post_tag'";
                $select_post_query = mysqli_query($connection, $sql2);
                $row2 = mysqli_fetch_array($select_post_query);
                $post_id = $row2['post_id'];

                echo " <a href='../front_end/post.php?p_id=$post_id'>{$post_tag}</a>";
            }
            ?>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $(".default").text(function() {
            $(this).addClass('active-click');
            var id = $(this).attr("id");
            //alert(id);
            $.ajax({
                url: "./include/top_title.php",
                method: "POST",
                data: {
                    menu: id
                },
                success: function(data) {
                    $(".item-content").html(data);
                }
            })
        });

        $(".navbar-nav li").click(function() {
            var id = $(this).attr("id");
            $(".navbar-nav li").removeClass("active-click");
            $(this).addClass("active-click");
            $.ajax({

                url: "./include/top_title.php",
                method: "POST",
                data: {
                    menu: id
                },
                success: function(data) {


                    $(".item-content").html(data);
                }
            })

        })
    });
</script>