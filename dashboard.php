<?php
session_start();
if($_SESSION["loggedin"] != true) {
    echo("Access denied!");
    exit();
}
?>

<!doctype html>
<html lang="es">
<?php
include('view/head.php');
?>
<body>
<div class="wrapper">
	<?php
	include('view/sidebar.php');
	?>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">


                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="logout.php">
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
								<h1 class="title">Hola <?= $_SESSION['username'] ?>  </h1>

								<p> Su rut es <?= $_SESSION['rut'] ?> y su cargo es <?= $_SESSION['cargo'] ?>
              </div>
            </div>
        </div>
    </div>

</body>


<?php
include('view/foot.php');
?>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project!
	<script src="assets/js/demo.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-star',
            	message: "Bienvenido a mis aves."

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>
-->
</html>
