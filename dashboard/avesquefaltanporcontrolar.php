<?php
header('Content-Type: text/html; charset=utf-8');
  date_default_timezone_set('America/Santiago');

  //header('Content-Type: text/html; charset=iso-8859-1');
  session_start();
  if($_SESSION["loggedin"] != true) {
      echo("Access denied!");
      exit();
  }
  require_once("../db_const.php");
  $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
  $conexion->set_charset("utf8");
  if ($conexion->connect_error) {
   die("La conexion falló: " . $conexion->connect_error);
  }


  $tabla = false;


  function getTurno($conexion){
    $hora = date("H:i");
    $sql = "SELECT Tur_descp, Tur_hora_ini, Tur_hora_final FROM `turno`";
    $result = $conexion->query($sql);
    $turno=null;
    while ($row = $result->fetch_array(MYSQLI_ASSOC)){
      if ($row['Tur_hora_ini'] < $row['Tur_hora_final']) { //si se ve la hora en el mismo día
        if($row['Tur_hora_ini'] <= $hora and $hora <= $row['Tur_hora_final']){
          $turno = $row['Tur_descp'];
        }
      }elseif( $hora>"00:01" and $hora < "23:59" ){ // Si el turno es del día actual al siguiente
        if($row['Tur_hora_ini'] <= $hora and $hora >=$row['Tur_hora_final']){
          $turno = $row['Tur_descp'];
        }else {
          if($row['Tur_hora_ini'] > $hora and $hora <=$row['Tur_hora_final']){
            $turno = $row['Tur_descp'];
          }
        }
      }
    }
    return $turno;
  }
  $turno = getTurno($conexion);

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
              <p>Administrar ave</p>
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


      <div class="container-fluid text-center">

<!--/ Cuadro de arriba /--------------------------------------------------------------------------------------------------------------------------------->

        <div class="card card-block">
          <h4 class="card-title hidden-print">Aves que faltan por controlar</h4>
          <p class="card-text hidden-print">Aves que no se han controlado en el turno <?php echo $turno." del día ".date("d-m-Y")?></p>
          <h4 class="card-title visible-print-block">Últimos 30 días del ave <?php if(isset($_GET['search'])){ echo $_GET['search'];} ?></h4>



          <?php

          //Se recibe la información de buscar un control por su fecha
               $sql = "SELECT A.Ave_anillo, A.Ave_nombre
                        FROM ave A
                        WHERE A.Ave_anillo NOT IN (SELECT A.Ave_anillo
                          FROM ave A, control C
                          WHERE A.Ave_anillo = C.Con_Ave AND C.Con_fecha = '".date("Y-m-d")."' AND C.Con_turno = '".$turno."')";
               $result = $conexion->query($sql);

               echo $conexion->error;

              if(mysqli_num_rows($result) ==0){
                echo 'Ya se han registrado todas las aves para este turno';
              }else{
                   echo '<div class="table-responsive">
                    <table class="table ">
                   <thead>
                   <th>Anillo</th>
                   <th>Ave</th>
                   </thead>
                   <tbody>';
               $cont_anterior = -1;
               $table = '';
               while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                     $table .= '<tr>';
                     $table .= '<td >'.$row['Ave_anillo'].'</td>';
                     $table .= '<td>'.$row['Ave_nombre'].'</td>';
                     $table .= "</tr>";
               }
               echo $table;
               echo '
                      </tbody>
                  </table>
                 </div>';
             }

              ?>

        </div>


        <br>

        <div class="card card-block">
          <button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.print()" >Imprimir</button>

        </div>

<br> <!---/ Separa ambos Cuadros -->



</div>

        </div>
    </main>
    <!--/Main layout-->
    <?php include '../layouts/footer.php';?>



</body>

</html>
