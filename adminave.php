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
              <p>Administrar ave</p>
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
        <h4 class="card-title">Buscar un ave</h4>
        <p class="card-text">Busqueda por anillo o nombre del ave</p>
        <form action="" method="GET">
            <div class="row">
              <div class="col-md-4 offset-md-4" >
                <div class="md-form input-group">
                  <input type="search" class="form-control" placeholder="Anillo o Nombre del ave" name="search">
                  <span class="input-group-btn">
                      <button   type="submit" class="btn btn-primary btn-lg" type="button">Go!</button>
                  </span>
              </div>
              </div>
            </div>
            </form>
        <br/>
        <form action="" method="post">

        <?php
        /*
        if (isset( $_POST['modificar'])) {
              $count = 1;
              echo '<br>';
              foreach ($_POST['data'] as $key){
                if(isset($_POST[2])){
                  print $count;
                  print $key['ave_anillo'];
                  print $key['ave_nombre'];
                  print $key['est_descrip'];
                  print $key['Ave_fecha_nac'];
                  print $key['esp_nombre'];
                  print $key['ave_genero'];
                  echo "<br>";
                  $count = $count + 1;
               }
           }
          }
          */
        if (isset($_GET['search'])) {
             $sql = "SELECT A.ave_anillo, A.ave_nombre, B.est_descrip, A.Ave_fecha_nac, E.esp_nombre, A.ave_genero FROM ave A, estado B, especie E WHERE A.ave_estado = B.est_id and A.ave_especie = E.esp_id and (A.ave_anillo = '".$_GET['search']."' or A.ave_nombre = '".$_GET['search']."')";
             $result = $conexion->query($sql);
             $count = 1;

            if(mysqli_num_rows($result) ==0){
              echo 'El ave pedida no existe';
            }else{


                 echo '<div class="table-responsive">
                      <table class="table ">
                 <thead>
                 <th class="addr" id="table_id" ></th>
                 <th>Anillo</th>
                 <th>Name</th>
                 <th>Estado</th>
                 <th>Fecha nacimiento</th>
                 <th>Especie</th>
                 <th>Genero</th>
                 </thead>
                 <tbody>';

             while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
               //if($_GET['search'] == $row['ave_anillo'] or $_GET['search'] == $row['ave_nombre']){

                 echo '<tr>';
                 echo '<td><fieldset class="form-group"><input type="checkbox" id="checkbox'.$count.'" name="'.$count.'"><label for="checkbox'.$count.'"></label></fieldset></td>';
                 echo '<td ><input type="hidden" name="data['.$count.'][ave_anillo]" value="'.$row['ave_anillo'].'">'.$row['ave_anillo'].'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][ave_nombre]" value="'.$row['ave_nombre'].'">'.$row['ave_nombre'].'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][est_descrip]" value="'.$row['est_descrip'].'">'.$row['est_descrip'].'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][Ave_fecha_nac]" value="'.$row['Ave_fecha_nac'].'">'.$row['Ave_fecha_nac'].'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][esp_nombre]" value="'.$row['esp_nombre'].'">'.$row['esp_nombre'].'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][ave_genero]" value="'.$row['ave_genero'].'">'.$row['ave_genero'].'</td>';
                 echo "</tr>";

              $count= $count + 1;
              //}
             }
             echo '
            </tbody>
        </table>
        </div>';
             echo '<input type="hidden" name="count" value="'.$count.'">';
             echo '<button type="submit"  name="modificar" class="btn btn-primary btn-lg">Modificar</button>';
           }
         }
            ?>
          </form>
      </div>

    <br/>


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
            $sql = "INSERT OR REPLACE INTO ave(Ave_anillo, Ave_nombre, Ave_estado, Ave_fecha_nac, Ave_especie, Ave_genero) VALUES ('".$anillo."', '".$ave."', '".$estado."' ,'".$fechanac."', '".$especie."', '".$genero."')";
            $result = $conexion->query($sql);
            echo "Datos actualizados correctamente";
          }

            $anillo = '';
            $nombre = '';
            $estado = '';
            $fechanac =  '';
            $especie =  '';
            $genero = '';
            if (isset($_POST['modificar'])) {
              foreach ($_POST['data'] as $key){
                if(isset($_POST[1])){
                  $anillo = $key['ave_anillo'];
                  $nombre = $key['ave_nombre'];
                  $estado = $key['est_descrip'];
                  $fechanac =  $key['Ave_fecha_nac'];
                  $especie =  $key['esp_nombre'];
                  $genero = $key['ave_genero'];
              }
            }
        }
        ?>
        <form Method ="POST" ACTION = "">
            <!--Third row-->
            <div class="row">

                <!--First column-->
                <div class="col-md-4 m-b-4">
                    <div class="md-form">
                        <input type="text" id="form41" class="form-control" name="anillo" value="<?php echo $anillo ?>" >
                        <label for="form41" class="">Anillo</label>
                    </div>
                </div>

                <!--Second column-->
                <div class="col-md-4 m-b-4">
                    <div class="md-form">
                        <input type="text" id="form51" class="form-control" name="ave" value="<?php echo $nombre ?>" >
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
                        if($especie !=''){
                          echo ' <option value="'.$row['Est_descrip'].'">';
                          echo $estado;
                          echo "</option>";
                        }
                        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                            if ($estado != $row['Est_descrip']) {
                            echo '<option value="'.$row['Est_id'].'">';
                            echo $row['Est_descrip'] ;
                            echo "</option>";
                          }
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
                       if($especie !=''){
                         echo ' <option value="'.$row['Esp_id'].'">';
                         echo $especie;
                         echo "</option>";
                       }
                       while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                         if ($especie != $row['Esp_nombre']) {
                           echo ' <option value="'.$row['Esp_id'].'">';
                           echo $row['Esp_nombre'] ;
                           echo "</option>";
                         }
                       }
                      ?>
                  </select>
                  <label>Especie</label>
                </div>
              </div>

              <div class="col-md-4 m-b-4">
                  <div class="md-form">
                      <input type="text" id="form51" class="form-control" name="fechanac"  value="<?php echo $fechanac ?>">
                      <label for="form51" class="">Fecha nacimiento</label>
                  </div>
              </div>
              <div class="col-md-4 m-b-4">
                <div class="md-form">
                  <select class="select-wrapper mdb-select" name="genero">
                    <?php if ($genero == 'H') {
                      echo '<option value = "H">Hembra</option>
                      <option value = "M">Macho</option>';
                    }else {
                        echo '<option value = "M">Macho</option>
                        <option value = "H">Hembra</option>';
                      }
                     ?>

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
      </div>
    </main>
    <!--/Main layout-->
    <?php include 'layouts/footer.php';?>

</body>

</html>
