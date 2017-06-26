<?php
  session_start();
  if(!isset($_SESSION["loggedin"])) {
      die("No se tienen los permisos necesarios para acceder aquí");
      exit('0');
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
                      <button   type="submit" class="btn btn-primary btn-lg" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </span>
              </div>
              </div>
            </div>
            </form>
        <br/>
        <form action="" method="post">

        <?php

        //Se recibe la información de buscar un ave
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
                 echo '<td><fieldset class="form-group"><input type="checkbox" id="checkbox'.$count.'" name="data['.$count.'][checkbox]" value="on "><label for="checkbox'.$count.'"></label></fieldset></td>';
                 echo '<td ><input type="hidden" name="data['.$count.'][ave_anillo]" value="'.$row['ave_anillo'].'">'.$row['ave_anillo'].'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][ave_nombre]" value="'.$row['ave_nombre'].'">'.$row['ave_nombre'].'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][est_descrip]" value="'.$row['est_descrip'].'">'.$row['est_descrip'].'</td>';
                 echo '<td><input type="hidden" name="data['.$count.'][Ave_fecha_nac]" value="'.$row['Ave_fecha_nac'].'">'.date("d-m-Y", strtotime($row['Ave_fecha_nac'])).'</td>';
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
            //Botton de modificar ave
             echo '<div class="md-form form-group">';
             echo '<input type="hidden" name="count" value="data">';
             echo '<button type="submit"  name="modificar" class="btn btn-primary btn-lg">Modificar</button>';
             //Botton de quitar ave
             echo '<input type="hidden" name="count" value="chk">';
             echo '<button type="submit"  name="quitar" class="btn btn-primary btn-lg">Quitar</button>';
             echo "</div>";
           }
         }
            ?>
          </form>
          <?php
      if(isset($_POST['data'])) {
        foreach ($_POST['data'] as $key){
            if (!empty($key['checkbox'])) {

              print $key['checkbox'];
              print $key['ave_anillo'];
              print $key['ave_nombre'];
              print $key['est_descrip'];
              print $key['Ave_fecha_nac'];
              print   $key['esp_nombre'];
              print $key['ave_genero'];
              echo "<br>";
            }
          }
        }

      ?>
      </div>
    <br/>

  </div>
</main>
<!--/Main layout-->

<?php include 'layouts/footer.php';
if (isset($_POST['submit'])) {
  if(!$result){
    echo("Hubo un error al procesar la solicitud: " .$conexion->error);
  }else {
    echo '<script>$(document).ready(function () {toastr.success("Ave  agregada correctamente");});</script>';
  }
}
?>



</body>

</html>
