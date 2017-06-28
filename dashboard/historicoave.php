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
          <h4 class="card-title hidden-print">Buscar por ave</h4>
          <p class="card-text hidden-print">Ingrese un ave para ver sus controles de los últimos 30 días.</p>
          <h4 class="card-title visible-print-block">Últimos 30 días del ave <?php if(isset($_GET['search'])){ echo $_GET['search'];} ?></h4>

          <form action="" method="GET">
              <div class="row">
                <div class="col-md-4 offset-md-4" >
                  <div class="md-form input-group">
                    <input type="search" class="form-control hidden-print" placeholder=" dd-mm-aaaa" name="search">
                    <span class="input-group-btn">
                        <button   type="submit" class="btn btn-primary btn-lg" type="button"><i class="fa fa-search hidden-print" aria-hidden="true"></i></button>
                    </span>
                </div>
                </div>
              </div>
              </form>
          <br/>

          <?php

          //Se recibe la información de buscar un control por su fecha
          if (isset($_GET['search'])) {
               $sql = "SELECT C.Con_id, A.Ave_anillo, A.Ave_nombre, C.Con_peso, C.Con_cape, C.Con_fecha, A.Ave_especie,  GROUP_CONCAT( CONCAT( TC.Tco_animal, ' - ', CC.Cco_cant) SEPARATOR '<br>') as comi,
                        CL.cli_nombre, S.sed_nombre, T.Tur_descp, U.usu_nombre, U.usu_apellido, C.Con_obs
                        FROM ave A, usuario U, turno T, control C
                        LEFT JOIN destino D
                        	INNER JOIN sede S ON S.sed_cod = D.Des_sede
                         ON C.Con_id = D.Des_Control
                        INNER JOIN cliente CL ON CL.cli_cod = S.sed_cliente
                        LEFT JOIN control_comida CC
                        	INNER JOIN tipo_comida TC ON TC.Tco_cod = CC.Cco_tco
                        ON C.Con_id = CC.Cco_control
                        WHERE A.Ave_anillo = C.Con_Ave AND C.Con_turno = T.Tur_cod AND C.Con_usu = U.usu_rut
                        and (A.Ave_anillo = '".$_GET['search']."' or A.Ave_nombre = '".$_GET['search']."')
                        GROUP BY C.Con_id
                        ORDER BY C.Con_id desc";
               $result = $conexion->query($sql);

               echo $conexion->error;

              if(mysqli_num_rows($result) ==0){
                echo 'No hay controles registrados para el día '.$_GET['search'];
              }else{
                   //echo '<div class="table-responsive">
                  echo '      <table class="table ">
                   <thead>
                   <th>ID</th>
                   <th>Anillo</th>
                   <th>Ave</th>
                   <th>Peso</th>
                   <th>C/S</th>
                   <th>Fecha</th>
                   <th>Especie</th>
                   <th colspan="2">Comida - Cantidad</th>
                   <th>Cliente</th>
                   <th>Sede</th>
                   <th>Turno</th>
                   <th colspan="2">Cetrero</th>
                   <th>Observación</th>
                   </thead>
                   <tbody>';
               $cont_anterior = -1;
               $table = '';
               // Asigna desde la tabla 1 hasta la última, SI MUESTRA
               while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                     $table .= '<tr>';
                     $table .= '<td >'.$row['Con_id'].'</td>';
                     $table .= '<td >'.$row['Ave_anillo'].'</td>';
                     $table .= '<td>'.$row['Ave_nombre'].'</td>';
                     $table .= '<td>'.$row['Con_peso'].'</td>';
                     $table .= '<td>'.$row['Con_cape'].'</td>';
                     $table .= '<td>'.date("d-m-Y", strtotime($row['Con_fecha'])).'</td>';
                     $table .= '<td>'.$row['Ave_especie'].'</td>';
                     $table .= '<td>'.$row['comi'].'</td>';
                     $table .= '<td></td>';
                     $table .= '<td>'.$row['cli_nombre'].'</td>';
                     $table .= '<td>'.$row['sed_nombre'].'</td>';
                     $table .= '<td>'.$row['Tur_descp'].'</td>';
                     $table .= '<td>'.$row['usu_nombre'].'</td>';
                     $table .= '<td>'.$row['usu_apellido'].'</td>';
                     $table .= '<td>'.$row['Con_obs'].'</td>';
                     $table .= "</tr>";
               }
               echo $table;
               echo '
                      </tbody>
                  </table>';
                  //echo '</div>';
             }

             $tabla = true;
           }
              ?>
            </form>
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
