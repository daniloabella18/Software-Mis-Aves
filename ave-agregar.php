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
                                                <select class="form-control" name="estado">
                                                  <?php
                                                  $sql = " SELECT * FROM estado ";
                                                  $result = $conexion->query($sql);
                                                  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                    echo '<option value="'.$row['Est_id'].'">';
                                                    echo $row['Est_descrip'] ;
                                                    echo "</option>";
                                                  }
                                                   ?>
                                                </select>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-2">
                                        <div class="form-group ">
                                          <label>Fecha de nacimiento</label>
                                          <input  id="datepickr" class="form-control" placeholder="DD/MM/YYYY" name="fecha">
                                        </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label>Especie</label>
                                                    <select class="form-control" name="especie">
                                                      <?php
                                                      $sql = " SELECT * FROM especie ";
                                                      $result = $conexion->query($sql);
                                                      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                        echo ' <option value="'.$row['Esp_id'].'">';
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
                                              <select class="form-control" name="genero">
                                                <option value = "M">Macho</option>
                                                <option value = "H">Hembra</option>
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


        <p><input id="datepickr" placeholder="Nothin' special"></p>

        <p><input class="datepickr" placeholder="Custom formatting"></p>

        <p><input id="minAndMax" placeholder="Min and max date options"></p>

        <p>
            <span class="calendar-icon"></span>
            <input id="calendar-input" placeholder="Click on my fancy icon">
        </p>

        <p><input title="parseMe" value="January 1, 3000" placeholder="Welcome to the world of tomorrow!"></p>

        <p><input id="someFrench" class="sil-vous-plait" placeholder="En francais"></p>


</body>

<?php
include('view/foot.php');
?>
    <!--  Calendario -->
  	<script src="assets/js/datepickr.js"></script>

    <script>
        // Custom date format
        datepickr('#datepickr', { dateFormat: 'd/m/Y'});

    </script>


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
