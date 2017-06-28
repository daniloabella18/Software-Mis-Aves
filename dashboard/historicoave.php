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
          <h4 class="card-title">Buscar Controles</h4>
          <p class="card-text">Búsqueda por fecha</p>
          <form action="" method="GET">
              <div class="row">
                <div class="col-md-4 offset-md-4" >
                  <div class="md-form input-group">
                    <input type="search" class="form-control" placeholder=" dd-mm-aaaa" name="search">
                    <span class="input-group-btn">
                        <button   type="submit" class="btn btn-primary btn-lg" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                </div>
                </div>
              </div>
              </form>
          <br/>

          <?php

          //Se recibe la información de buscar un control por su fecha
          if (isset($_GET['search'])) {

// Se buscan los controles /=============================================================================================================================//

               $sql = "SELECT C.Con_id , A.Ave_anillo, A.Ave_nombre, C.Con_peso,C.Con_cape, GROUP_CONCAT( CONCAT( TC.Tco_animal, ' - ', CC.Cco_cant) SEPARATOR '<br>') as comi, U.usu_nombre, C.Con_fecha, T.Tur_descp, CL.cli_nombre, S.sed_nombre, C.Con_obs
                        FROM control_comida CC, control C, ave A, usuario U, turno T, tipo_comida TC, destino D, sede S, cliente CL
                        WHERE C.Con_Ave = A.Ave_anillo and C.Con_usu = U.usu_rut and C.Con_turno = T.Tur_cod AND CC.Cco_control= C.Con_id and CC.Cco_tco = TC.Tco_cod and D.Des_Control = C.Con_id and S.sed_cod = D.Des_sede and CL.cli_cod = S.sed_cliente
                        and (C.Con_fecha = '".date("Y-m-d", strtotime($_GET['search']))."')
                        GROUP BY C.Con_id";
               $result = $conexion->query($sql);

               echo $conexion->error;

              if(mysqli_num_rows($result) ==0){
                echo 'No hay controles registrados para el día '.$_GET['search'];
              }else{
                   echo '<div class="table-responsive">
                        <table class="table ">
                   <thead>
                   <th>ID</th>
                   <th>Anillo</th>
                   <th>Ave</th>
                   <th>Peso</th>
                   <th>C/S</th>
                   <th colspan="2">Comida - Cantidad</th>
                   <th>Cetrero</th>
                   <th>Fecha</th>
                   <th>Turno</th>
                   <th>Cliente</th>
                   <th>Sede</th>
                   <th>Observación</th>
                   </thead>
                   <tbody>';
               $cont_anterior = -1;
               $table = '';
               $count = 1;

               // Asigna desde la tabla 1 hasta la última, SI MUESTRA
               while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                     $table .= '<tr>';
                     $table .= '<td >'.$row['Con_id'].'</td>';
                     $table .= '<td >'.$row['Ave_anillo'].'</td>';
                     $table .= '<td>'.$row['Ave_nombre'].'</td>';
                     $table .= '<td>'.$row['Con_peso'].'</td>';
                     $table .= '<td>'.$row['Con_cape'].'</td>';
                     $table .= '<td>'.$row['comi'].'</td>';
                     $table .= '<td></td>';
                     $table .= '<td>'.$row['usu_nombre'].'</td>';
                     $table .= '<td>'.date("d-m-Y", strtotime($row['Con_fecha'])).'</td>';
                     $table .= '<td>'.$row['Tur_descp'].'</td>';
                     $table .= '<td>'.$row['cli_nombre'].'</td>';
                     $table .= '<td>'.$row['sed_nombre'].'</td>';
                     $table .= '<td>'.$row['Con_obs'].'</td>';
                     $table .= "</tr>";

                $count= $count + 1;
               }
               echo $table;
               echo '
                      </tbody>
                  </table>
                  </div>';
             }

             $tabla = true;
           }
              ?>
            </form>
        </div>

<br> <!---/ Separa ambos Cuadros -->

<!--/ Cuadro de abajo /----------------------------------------------------------------------------------------------------->

<div class="card card-block">
  <h4 class="card-title">Notas asociadas al día <?php if(isset($_GET['search'])){ echo $_GET['search'];} ?></h4>
  <br/>
  <?php
if(isset($_GET['search'])){
  //Se recibe la información de si buscar o no un Turno

       $sql = "SELECT N.not_cod, U.usu_nombre, U.usu_apellido,  N.not_descrip, N.not_fecha, T.Tur_descp
                FROM nota N, usuario U, turno T
                WHERE N.not_usuario = U.usu_rut AND T.Tur_cod = N.not_turno
                AND N.not_fecha = '".date("Y-m-d", strtotime($_GET['search']))."'";
       $result = $conexion->query($sql);

      if(mysqli_num_rows($result) ==0){
        echo 'Se necesita tener controles registrados para mostrar las notas del '.$_GET['search'];
      }else{
           echo '<div class="table-responsive">
                <table class="table  ">
           <thead>
           <th>Cetrero</th>
           <th>Turno</th>
           <th>Nota</th>
           </thead>
           <tbody>';
       $table = '';



       // Asigna desde la tabla 1 hasta la última, SI MUESTRA
       while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
             $table .= '<tr>';
             $table .= '<td >'.$row['usu_nombre'].'</td>';
             $table .= '<td >'.$row['Tur_descp'].'</td>';
             $table .= '<td>'.$row['not_descrip'].'</td>';
             $table .= "</tr>";
       }
       echo $table;
       echo '
              </tbody>
          </table>
          </div>';
     }
}
      ?>

</div>

</div>

<!--/ Parte de abajo /---------------------------------------------------------------------->

<br>


</br>



        </div>
    </main>
    <!--/Main layout-->
    <?php include '../layouts/footer.php';?>



</body>

</html>
