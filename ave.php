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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Aves 🐦 </h4>
                                <p class="category">Cochitas más lendas, estás son todas las que tenemos 💖 💖 💖 💖 💖 💖 💖 </p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Anillo</th>
                                      <th>Name</th>
                                      <th>Estado</th>
                                      <th>Fecha nacimiento</th>
                                      <th>Especie</th>
                                      <th>Genero</th>
                                    </thead>
                                    <tbody>

                                      <?php
                                      $host_db = "localhost";
                                      $user_db = "root";
                                      $pass_db = "";
                                      $db_name = "mis_aves";


                                      $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

                                      if ($conexion->connect_error) {
                                       die("La conexion falló: " . $conexion->connect_error);
                                      }

                                      $sql = "SELECT A.ave_anillo, A.ave_nombre, B.est_descrip, A.Ave_fecha_nac, E.esp_nombre, A.ave_genero FROM ave A, estado B, especie E WHERE A.ave_estado = B.est_id and A.ave_especie = E.esp_id";


                                      $result = $conexion->query($sql);
                                      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                        echo "<tr>";
                                        foreach ($row as $key => $value) {
                                          echo "<td>" . $value. "</td>" ;
                                        }
                                        echo "</tr>";
                                      }
                                       ?>
                                  </tbody>
                              </table>




                       </div>
                   </div>
               </div>
            </div>
        </div>



    </div>
</div>


</body>

<?php
include('view/footer.php');
?>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

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
