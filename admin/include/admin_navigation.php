  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #224b53;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="color: #06eeff;">Admin Page</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
            
                <li><a href="../front_end/index.php"><i class="fa-solid fa-house-chimney"></i> HOME SITE</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <?php
                if (isset($_SESSION['name'])) {
                    echo $_SESSION['name'];
                }

                ?>
                <b class="caret"></b>
                </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="./logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
          
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                   
                    <li>
                        <a href="./categories.php"><i class="fa fa-fw fa-table"></i> Categories</a>
                    </li>
                    <li>
                        <a href="./posts.php"><i class="fa fa-fw fa-edit"></i> Posts</a>
                    </li>
                    <li>
                        <a href="./comments.php"><i class="fa-solid fa-comment" style="margin-right: 3px;"></i> Comments</a>
                    </li>
                   
                    <li >
                        <a href="./users.php"><i class="fa-solid fa-circle-user" style="margin-right: 3px;"></i>  Users</a>
                    </li>
                 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>