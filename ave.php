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
              </div>
              <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav navbar-left">
                    <li><a href="ave-agregar.php" onclick="hideAddress()">Agregar</a></li>
                    <li><a href="#"  onclick="hideAddress()" >Modificar</a></li>
                    <li><a href="#" onclick="showAddress()">Quitar</a></li>
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
                                <h4 class="title">Aves 🐦 </h4>
                                <p class="category">Cochitas más lendas, estás son todas las que tenemos 💖 💖 💖 💖 💖 💖 💖 </p>
                            </div>
                            <div class="content table-responsive table-full-width">

                              <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                       <h3 id="myModalLabel">Delete</h3>
                                   </div>
                                   <div class="modal-body">
                                       <p></p>
                                   </div>
                                   <div class="modal-footer">
                                       <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                       <button data-dismiss="modal" class="btn red" id="btnYes">Confirm</button>
                                   </div>
                              </div>

                                <table class="table table-hover table-striped">
                                    <thead>
                                      <th class="addr"  ></th>
                                      <th>Anillo</th>
                                      <th>Name</th>
                                      <th>Estado</th>
                                      <th>Fecha nacimiento</th>
                                      <th>Especie</th>
                                      <th>Genero</th>
                                    </thead>
                                    <tbody>

                                  <?php

                                      require_once("db_const.php");
                                      $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
                                      if ($conexion->connect_error) {
                                       die("La conexion falló: " . $conexion->connect_error);
                                      }

                                      $sql = "SELECT A.ave_anillo, A.ave_nombre, B.est_descrip, A.Ave_fecha_nac, E.esp_nombre, A.ave_genero FROM ave A, estado B, especie E WHERE A.ave_estado = B.est_id and A.ave_especie = E.esp_id";

                                      $result = $conexion->query($sql);
                                      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                        echo '<tr>';
                                        echo '<td class ="addr"   align="center"><a href="#"  data-id="'.$row["ave_anillo"].' class="delete-row"  onclick="deleteThis(this)""> <i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                                        echo "<td>".$row['ave_anillo']."</td>" ;
                                        echo "<td>".$row['ave_nombre']."</td>" ;
                                        echo "<td>".$row['est_descrip']."</td>" ;
                                        echo "<td>".$row['Ave_fecha_nac']."</td>" ;
                                        echo "<td>".$row['esp_nombre']."</td>" ;
                                        echo "<td>".$row['ave_genero']."</td>" ;
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
include('view/foot.php');
?>


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
