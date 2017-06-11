<?php
session_start();
if($_SESSION["loggedin"] != true) {
    echo("Access denied!");
    exit();
}
require_once("db_const.php");
$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
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
              </div>
              <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav navbar-left">
                    <li><a href="#" onclick="hideAddress()">Agregar</a></li>
                    <li><a href="ave.php"  onclick="hideAddress()" >Modificar</a></li>
                    <li><a href="ave.php" onclick="showAddress()">Quitar</a></li>
                  </ul>

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
                              <h4 class="title">Agregar Ave</h4>
                          </div>
                          <div class="content">
                              <form Name ="form1" Method ="POST" ACTION = "send.php">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Anillo</label>
                                              <input type="text" class="form-control" placeholder="Id-ave" id="ave" name="anillo" >
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Nombre</label>
                                              <input type="text" class="form-control" placeholder="Nombre" name="nombre">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Estado</label>
                                                <div class="form-group">
                                                <select class="form-control" id="estado">
                                                  <?php
                                                  $sql = " SELECT * FROM estado ";
                                                  $result = $conexion->query($sql);
                                                  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                    echo '  <option>';
                                                    echo $row['Est_descrip'] ;
                                                    echo "</option>";
                                                  }
                                                   ?>
                                                </select>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Fecha nacimiento</label>
                                              <input type="text" class="form-control" placeholder="DD/MM/AAAA">
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label>Especie</label>
                                                    <select class="form-control" id="especie">
                                                      <?php
                                                      $sql = " SELECT * FROM especie ";
                                                      $result = $conexion->query($sql);
                                                      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                        echo '  <option>';
                                                        echo $row['Esp_nombre'] ;
                                                        echo "</option>";
                                                      }
                                                       ?>
                                                    </select>
                                                  </div>
                                              </div>
                                          </div>

                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label>Genero</label>
                                              <select class="form-control" id="genero">
                                                <option>Macho</option>
                                                <option>Hembra</option>
                                              </select>
                                          </div>

                                      </div>
                                      <div class="col-md-4">
                                      <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                                                              <div class="clearfix"></div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>

              </div>
          </div>
      </div>
</div>

</body>

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

    <script>
    $(document).ready(function() {
        $(".addr").hide();
    } );

    function showAddress(){
        $(".addr").show();
    }
    function hideAddress(){
        $(".addr").hide();
    }

    function deleteThis(obj){
    	$(obj).closest('tr').remove();
    }
    </script>

    <!-- ight Bootstrap Table Core javascript and methods for Demo purpose -->
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
