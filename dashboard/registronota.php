<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Santiago');
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
              <li class="nav-item ">
                  <a href="controlave.php" class="nav-link">Registrar Control</a>
              </li>
              <li class="nav-item active">
                  <a href="registronota.php" class="nav-link">Registrar Nota</a>
              </li>
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
      <div class="card card-block">
        <h4 class="card-title">Buscar notas de un día</h4>
        <p class="card-text">Busqueda por fecha</p>
        <form action="" method="GET">
            <div class="row">
              <div class="col-md-4 offset-md-4" >
                <div class="md-form input-group">
                  <input type="search" class="form-control" placeholder="dd/mm/aaaa" name="search">
                  <span class="input-group-btn">
                      <button   type="submit" class="btn btn-primary btn-lg" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </span>
              </div>
              </div>
            </div>
            </form>
        <br/>
        <form action="registronota.php" method="post">

        <?php

        //Se recibe la información de buscar un ave
        if (isset($_GET['search'])) {
             $sql = "SELECT N.not_cod, U.usu_nombre, U.usu_apellido,  N.not_descrip, N.not_fecha, T.Tur_descp
                      FROM nota N, usuario U, turno T
                      WHERE N.not_usuario = U.usu_rut AND T.Tur_cod = N.not_turno AND N.not_fecha = '".date("Y-m-d", strtotime($_GET['search']))."'";
             $result = $conexion->query($sql);
             $count = 1;
            if(mysqli_num_rows($result) ==0){
              echo 'El ave pedida no existe';
            }else{


                 echo '<div class="table-responsive">
                      <table class="table ">
                 <thead>
                 <th class="addr" id="table_id" ></th>
                 <th>ID</th>
                 <th colspan="2">Cetrero</th>
                 <th>Nota</th>
                 <th>Fecha</th>
                 <th>Turno</th>
                 </thead>
                 <tbody>';
             while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                 echo '<tr>';
                 echo '<td><fieldset class="form-group"><input type="checkbox" id="checkbox'.$count.'" name="data['.$count.'][checkbox]" value="on "><label for="checkbox'.$count.'"></label></fieldset></td>';
                 echo '<td ><input type="hidden" name="data['.$count.'][not_cod]" value="'.$row['not_cod'].'">'.$row['not_cod'].'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][nombre]" value="'.$row['usu_nombre'].'">'.$row['usu_nombre'].'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][apellido]" value="'.$row['usu_apellido'].'">'.$row['usu_apellido'].'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][nota]" value="'.$row['not_descrip'].'">'.$row['not_descrip'].'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][fecha]" value="'.$row['not_fecha'].'">'.date("d-m-Y", strtotime($row['not_fecha'])).'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][turno]" value="'.$row['Tur_descp'].'">'.$row['Tur_descp'].'</td>';
                 echo "</tr>";
              $count= $count + 1;
             }
             echo '
                    </tbody>
                </table>
                </div>';
            //Botton de modificar ave
             echo '<div class="md-form form-group">';
             echo '<input type="hidden" name="count" value="data">';
             echo '<button type="submit"  name="modificar" class="btn btn-primary btn-lg">Modificar</button>';
             //Botton de quitar ave
             echo '<input type="hidden" name="count" value="data">';
             echo '<button type="submit"  name="quitar" class="btn btn-primary btn-lg">Quitar</button>';
             echo "</div>";
           }
         }
            ?>
          </form>
      </div>
      </br>

        <?php

        if (isset($_POST['quitar'])){
          foreach ($_POST['data'] as $key){
            if (!empty($key['checkbox'])) {
              $sql = "DELETE FROM nota WHERE not_cod = '".$key['not_cod']."' ";
              $resultquitar = $conexion->query($sql);
              }
            }

        }

        if (isset($_POST['submit'])){
          $sql = "SELECT Tur_cod, Tur_descp FROM `turno`";
          $resulttur = $conexion->query($sql);
          while ($row = $resulttur->fetch_array(MYSQLI_ASSOC)){
            if( $_POST['turno'] == $row['Tur_descp']){
              $turno = $row['Tur_cod'];
            }
          }

          $sql = "INSERT INTO `nota` (`not_cod`, `not_usuario`, `not_fecha`, `not_descrip`, `not_turno`)
          VALUES ('".$_POST['not_cod']."', '".$_POST['cetrero']."', '".date("Y-m-d", strtotime($_POST['fecha']))."', '".$_POST['nota']."', '".$turno."')
          ON DUPLICATE KEY UPDATE not_fecha=VALUES(not_fecha), not_descrip=VALUES(not_descrip), not_turno = VALUES(not_descrip)";
            $result = $conexion->query($sql);
            echo $conexion->error;
        }
        if (isset($_POST['modificar'])){
          foreach ($_POST['data'] as $key){
            if (!empty($key['checkbox'])) {
                $not_cod = $key['not_cod'];
                $nota = $key['nota'];
                $cetrero = $key['nombre'];
                $nota =  $key['nota'];
                $fecha =  $key['fecha'];
                $turno = $key['turno'];
                break;
            }
          }
        }
           ?>
        <div class="card card-block">
                  <h4 class="card-title">Registrar Nota</h4>
                  <p class="card-text">Info ayuda </p>

        <form Method ="POST" ACTION = "registronota.php">
              <!--Third row-->

              <div class="row">
                <!--Textarea with icon prefix-->
                <div class="col-md-12">
                  <div class="md-form">
                      <i class="fa fa-pencil prefix"></i>
                      <textarea type="text" id="form8" class="md-textarea" name="nota" ><?php if(isset($_POST['modificar'])){echo $nota;}else{echo "";} ?></textarea>
                      <label for="form8">Nota</label>
                  </div>
                </div>
              </div>


          <div class="row">

              <!--First column-->
              <div class="col-md-2">
                  <div class="md-form">
                      <input type="text" id="form41" class="form-control" name="turno"  value="<?php
                       if(isset($_POST['modificar'])){
                         echo $turno;
                       }else{
                         $turno=getTurno($conexion);
                         echo $turno;
                       }
                         ?>" readonly="readonly">
                      <label for="form41" class="">Turno</label>
                  </div>
              </div>

              <div class="col-md-2">
                  <div class="md-form">
                      <input type="text" id="form41" class="form-control" name="fecha" value="<?php if(isset($_POST['modificar'])){echo $fecha;}else{echo date("d-m-Y");} ?>" readonly="readonly">
                      <label for="form41" class=""> Fecha</label>
                  </div>
              </div>

              <div class="col-md-2">
                  <div class="md-form">
                      <input type="text" id="form41" class="form-control" name="cetrero" value="<?php if(isset($_POST['modificar'])){echo $cetrero;}else{echo $_SESSION['rut'];} ?>" readonly="readonly">                    <label for="form41" class=""> Cetrero</label>
                  </div>
              </div>
              <!--Third column-->
              <div class="col-md-2">
                  <div class="md-form">
                      <input type="text" id="form61" class="form-control" name="not_cod" value="<?php
                       if(isset($_POST['modificar'])){echo $not_cod;}else{
                          //Se obitene el id de control  del AUTO_INCREMENT
                         $aux = $conexion->query("SELECT `AUTO_INCREMENT` as AI FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$db_name."' AND TABLE_NAME = 'nota'")->fetch_array(MYSQLI_ASSOC);
                         $con_id = $aux['AI'];
                         echo $con_id;
                       } ?>" readonly="readonly">
                      <label for="form61" class="">ID Nota</label>
                  </div>
              </div>

              <div class="col-md-3">
                <div class="md-form form-group">
                    <button type="submit"  name="submit" class="btn btn-primary btn-lg"><?php if (!isset($_POST['modificar'])){echo 'Agregar nota'; }else {echo 'Modificar nota';} ?> </button>
                </div>
              </div>
          </form>
          </div>
    </div>
    </main>
    <!--/Main layout-->
    <?php include '../layouts/footer.php';

    echo "<script type='text/javascript'>
      $(document).ready(function(){";

    if (isset($_POST['submit'])) {
      if(!$result){
        echo("Hubo un error al procesar la solicitud: " .$conexion->error);
          echo 'toastr.error("Error al registrar el control");';
      }else {
        echo 'toastr.success("La nota ha sido agregada correctamente");';
      }
    }
    if (isset($_POST['quitar'])){
      if(!$resultquitar){
        echo("Hubo un error al procesar la solicitud: " .$conexion->error);
          echo 'toastr.error("Error al registrar el control");';
    }else {
      echo 'toastr.success("La nota ha sido quitada correctamente");';
    }
    }
echo "  });
</script>";

    ?>
</body>

</html>
