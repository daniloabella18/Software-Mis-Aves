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
include 'layouts/head.php';
?>

<body class="fixed-sn pink-skin bg-skin-lp">

    <header>
      <?php include 'layouts/sidebar.php';?>
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
                <li class="nav-item">
                    <a  href="logout.php" class="nav-link"><i class="fa fa-user"></i> <span class="hidden-sm-down">Log out</span></a>
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
                <h4 class="card-title">Administrar ave</h4>
                <p class="card-text">Descripción</p>

        <?php
          if (isset($_POST['submit'])){
            $anillo = $_POST['anillo'];
            $ave = $_POST['ave'];
            $estado = $_POST['estado'];
            $fechanac =  $_POST['fechanac'];
            $especie =  $_POST['especie'];
            $genero =  $_POST['genero'];
            $sql = "INSERT INTO ave(Ave_anillo, Ave_nombre, Ave_estado, Ave_fecha_nac, Ave_especie, Ave_genero) VALUES ('".$anillo."', '".$ave."', '".$estado."' ,'".$fechanac."', '".$especie."', '".$genero."')";
            $result = $conexion->query($sql);
            echo "<script> $(document).ready(function() {
                toastr.success('Ave  agregada correctamente);
             }); </script>";
          }
        ?>
        <form Method ="POST" ACTION = "">
            <!--Third row-->
            <div class="row">

                <!--First column-->
                <div class="col-md-4 m-b-4">
                    <div class="md-form">
                        <input type="text" id="form41" class="form-control" name="anillo">
                        <label for="form41" class="">Anillo</label>
                    </div>
                </div>

                <!--Second column-->
                <div class="col-md-4 m-b-4">
                    <div class="md-form">
                        <input type="text" id="form51" class="form-control" name="ave">
                        <label for="form51" class="ave">Ave</label>
                    </div>
                </div>
                  <div class="clearfix"></div>
                <!--Third column-->
                  <div class="col-md-4 m-b-4" >
                    <div class="md-form">
                      <select class="select-wrapper mdb-select" name="estado">
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
                      <label>Estado</label>
                    </div>
                  </div>

            </div>
            <!--/.Third row-->

            <div class="row">
              <!--Textarea with icon prefix-->
              <div class="col-md-4 m-b-4" >
                <div class="md-form">
                  <select class="select-wrapper mdb-select" name="especie">
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
                  <label>Especie</label>
                </div>
              </div>

              <div class="col-md-4 m-b-4">
                  <div class="md-form">
                      <input type="text" id="form51" class="form-control" name="fechanac">
                      <label for="form51" class="">Fecha nacimiento</label>
                  </div>
              </div>
              <div class="col-md-4 m-b-4">
                <div class="md-form">
                  <select class="select-wrapper mdb-select" name="genero">
                    <option value = "M">Macho</option>
                    <option value = "H">Hembra</option>
                  </select>
                  <label>Genero</label>
                </div>
            </div>
            </div>
            <div class="md-form form-group">
                <button type="submit"  name="submit" class="btn btn-primary btn-lg">Agregar</button>
            </div>
        </form>
        </div>

</br>


            <div class="card card-bloc">
              <table class="table ">
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
                    echo '<td><fieldset class="form-group"><input type="checkbox" id="checkbox1"><label for="checkbox1"></label></fieldset></td>';
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
              <div class="container">
                <div class="row">
                  <div class="col-md-3 offset-md-3">

                  <button type="submit"  name="submit" class="btn btn-primary">Modificar</button>
                </div>
                <div class="col-md-3 offset-md-3">
                  <button type="submit"  name="submit" class="btn btn-primary">Quitar</button>
                  </div>
                </div>
                </div>
          </div>

        </div>
    </main>
    <!--/Main layout-->
    <?php include 'layouts/footer.php';?>
</body>

</html>
