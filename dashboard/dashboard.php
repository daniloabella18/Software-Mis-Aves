<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

if(!isset($_SESSION["loggedin"])){
    die("No se tienen los permisos necesarios");
    exit('0');
}
include '../layouts/head.php';
?>

<body class="fixed-sn pink-skin bg-skin-lp">

    <header>
        <?php include '../layouts/sidebar.php';?>
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-xs-left">
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto">
                <p>Mis aves</p>
            </div>
            <ul class="nav navbar-nav ml-auto flex-row">
                <li class="nav-item">
                    <a  href="../logout.php" class="nav-link"><i class="fa fa-user"></i> <span class="hidden-sm-down">Log out</span></a>
                </li>

            </ul>
        </nav>
        <!-- /.Navbar -->
    </header>
    <!--/.Double navigation-->

    <!--Main layout-->
    <main>
        <div class="container-fluid text-center" style="height: 800px;">
          <h1 class="display-4">Bienvenido cetrero</h1>
          <p class="lead">Te haz logueado como  <?= $_SESSION['username']?> tu cargo es <?= $_SESSION['cargo'] ?> y tu rut es <?= $_SESSION['rut'] ?></p>
        </div>
    </main>
    <!--/Main layout-->

    <?php include '../layouts/footer.php';?>
</body>

</html>
