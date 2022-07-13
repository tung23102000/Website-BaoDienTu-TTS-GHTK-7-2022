<div class="container-fluid box-menu py-2">

 
    <nav class="container navbar navbar-expand-lg navbar-light align-items-center">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto menu-list">

                <?php
                $sql = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $sql);
                while ($row = mysqli_fetch_array($select_all_categories_query)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                   
                    $category_class = '';

                    $contact_class = '';
                    $pageName = basename($_SERVER['PHP_SELF']); //đưa ra tệp tin của 1 đường dẫn mà mình đang click vào

                    $contact = '/contact.php';
                    if (isset($_GET['category']) && $_GET['category'] == $cat_id) {
                        $category_class = 'active';
                    } else if ($pageName == $contact) {
                        $contact_class = 'active';
                    }
                    $cat_id= htmlspecialchars($cat_id);
                    echo "<li class='$category_class nav-item mx-1'><a class='nav-link' href='category.php?category={$cat_id}' style='color: #FFF;' font-family: 'Helvetica Neue';>{$cat_title}</a></li>";
                }
                ?>
             
                <li class="nav-item mx-1">
                    <a class="nav-link" href="./contact.php" style='color: #FFF;'>Contact</a>
                </li>

            </ul>
            <form class="form-inline" action="search.php" method="post">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 btn-search" name="submit_search" type="submit" ><img src="image1/icon-search.png" /></button>
            </form>
        </div>

    </nav>
</div>