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
                  <a class="nav-link">Registrar Nota</a>
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
                <h4 class="card-title">Registrar Nota</h4>
                <p class="card-text">Info ayuda </p>
        <form  Name ="form1" Method ="POST" ACTION = "">
            <!--Third row-->

            <div class="row">
              <!--Textarea with icon prefix-->
              <div class="col-md-12">
                <div class="md-form">
                    <i class="fa fa-pencil prefix"></i>
                    <textarea type="text" id="form8" class="md-textarea" name="nota"></textarea>
                    <label for="form8">Nota</label>
                </div>
              </div>
            </div>


        <div class="row">

            <!--First column-->
            <div class="col-md-3">
                <div class="md-form">
                    <input type="text" id="form41" class="form-control" name="turno" >
                    <label for="form41" class=""><?php echo getTurno($conexion); ?></label>
                </div>
            </div>

        <div class="md-form form-group">
            <button type="submit" class="btn btn-primary btn-lg">Agregar nota</a>
        </div>
        </form>
        </div>
  </div>
</br>


    <div class="card card-block">
      <table class="table table-responsive">
          <thead>
              <tr>
                  <th>#</th>
                  <th></th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <th scope="row">1</th>
                  <td>
                      <fieldset class="form-group">
                          <input type="checkbox" id="checkbox1">
                          <label for="checkbox1"></label>
                      </fieldset>
                  </td>
                  <td>Ashley</td>
                  <td>Lynwood</td>
                  <td>@ashow</td>
                  <td>
                      <a class="blue-text"><i class="fa fa-user"></i></a>
                      <a class="teal-text"><i class="fa fa-pencil"></i></a>
                      <a class="red-text"><i class="fa fa-times"></i></a>
                  </td>
              </tr>
              <tr>
                  <th scope="row">2</th>
                  <td>
                      <fieldset class="form-group">
                          <input type="checkbox" id="checkbox2">
                          <label for="checkbox2"></label>
                      </fieldset>
                  </td>
                  <td>Billy</td>
                  <td>Cullen</td>
                  <td>@cullby</td>
                  <td>
                      <a class="blue-text"><i class="fa fa-user"></i></a>
                      <a class="teal-text"><i class="fa fa-pencil"></i></a>
                      <a class="red-text"><i class="fa fa-times"></i></a>
                  </td>
              </tr>
              <tr>
                  <th scope="row">3</th>
                  <td>
                      <fieldset class="form-group">
                          <input type="checkbox" id="checkbox3">
                          <label for="checkbox3"></label>
                      </fieldset>
                  </td>
                  <td>Ariel</td>
                  <td>Macy</td>
                  <td>@arielsea</td>
                  <td>
                      <a class="blue-text"><i class="fa fa-user"></i></a>
                      <a class="teal-text"><i class="fa fa-pencil"></i></a>
                      <a class="red-text"><i class="fa fa-times"></i></a>
                  </td>
              </tr>

          </tbody>
      </table>
  </div>
        </div>
    </main>
    <!--/Main layout-->
    <?php include '../layouts/footer.php';?>
</body>

</html>
