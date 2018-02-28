<?php
$user = new User();
$logged = TRUE;
if ($user->isLoggedIn()) {
  //if ($logged) {
    ?>

<header class="hidden-print" id="header">

    <h1 id="site-logo" class="hidden-print">
            <a href="#">
                <img src="img/logos/logo.png" style="height: 100px;width: 160px;" alt="Site Logo" />
            </a>
        </h1>

        <a href="javascript:;" data-toggle="collapse" data-target=".top-bar-collapse" id="top-bar-toggle" class="navbar-toggle collapsed">
            <i class="fa fa-cog"></i>
        </a>

        <a href="javascript:;" data-toggle="collapse" data-target=".sidebar-collapse" id="sidebar-toggle" class="navbar-toggle collapsed">
            <i class="fa fa-reorder"></i>
        </a>

    </header> <!-- header -->
    <nav id="top-bar" class="collapse top-bar-collapse hidden-print">

        <ul class="nav navbar-nav pull-left">
            <li class="">
                <a href="index.php?page=dashboard">
                    <i class="fa fa-home"></i>
                    Home
                </a>
            </li>

<!--            <li class="dropdown">;
                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                    Dropdown <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:;"><i class="fa fa-user"></i>&nbsp;&nbsp;Example #1</a></li>
                    <li><a href="javascript:;"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Example #2</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:;"><i class="fa fa-tasks"></i>&nbsp;&nbsp;Example #3</a></li>
                </ul>
            </li>-->

        </ul>

        <ul class="nav navbar-nav pull-right hidden-print">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                    <i class="fa fa-user"></i>
                    Welcome: <?php echo  $_SESSION['getin_username'];?>
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">

                    <li class="divider"></li>
                    <li>
                        <a href="index.php?page=logout">
                            <i class="fa fa-sign-out"></i>
                            &nbsp;&nbsp;Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </nav> <!-- /#top-bar -->
    <?php
} else {
    Redirect::to('index.php?page=login');
}
?>
