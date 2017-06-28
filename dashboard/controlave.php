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

  //Precarga las sedes de los clientes
  if (isset($_POST['modificar'])){
     $query = "SELECT sed_cod, sed_cliente, sed_nombre FROM sede ";
   }else {
     $query = "SELECT sed_cod, sed_cliente, sed_nombre FROM sede";
   }
  $result = $conexion->query($query);
  while($row = $result->fetch_assoc()){
    $subcats[$row['sed_cliente']][] = array("id" => $row['sed_cod'], "val" => $row['sed_nombre']);
//    $subcats[$row['catid']][] = array("id" => $row['id'], "val" => $row['subcat']);
  }

  $jsonSubCats = json_encode($subcats);


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
              <li class="nav-item active">
                  <a class="nav-link">Registrar Control</a>
              </li>
              <li class="nav-item">
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
          <h4 class="card-title">Buscar Control</h4>
          <p class="card-text">Busqueda de los últimos 6 controles de un ave</p>
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
          <form action="controlave.php" method="post">

          <?php

          //Se recibe la información de buscar un ave
          if (isset($_GET['search'])) {
            //SELECT C.Con_id, A.Ave_anillo, A.Ave_nombre, C.Con_peso,C.Con_cape, U.usu_nombre, C.Con_fecha, T.Tur_descp, C.Con_obs  FROM control C, ave A, usuario U, turno T WHERE C.Con_Ave = A.Ave_anillo and C.Con_usu = U.usu_rut and C.Con_turno = T.Tur_cod
               $sql = "SELECT C.Con_id , A.Ave_anillo, A.Ave_nombre, C.Con_peso,C.Con_cape, GROUP_CONCAT( CONCAT( TC.Tco_animal, ' - ', CC.Cco_cant) SEPARATOR '<br>') as comi, U.usu_nombre, C.Con_fecha, T.Tur_descp, CL.cli_nombre, S.sed_nombre, C.Con_obs
                        FROM control_comida CC, control C, ave A, usuario U, turno T, tipo_comida TC, destino D, sede S, cliente CL
                        WHERE C.Con_Ave = A.Ave_anillo and C.Con_usu = U.usu_rut and C.Con_turno = T.Tur_cod AND CC.Cco_control= C.Con_id and CC.Cco_tco = TC.Tco_cod and D.Des_Control = C.Con_id and S.sed_cod = D.Des_sede and CL.cli_cod = S.sed_cliente
                        and (C.Con_Ave = '".$_GET['search']."' or A.Ave_nombre = '".$_GET['search']."')
                        GROUP BY C.Con_id";
               $result = $conexion->query($sql);
              if(mysqli_num_rows($result) ==0){
                echo 'No hay controles registrados para el ave '.$_GET['search'];
              }else{
                   echo '<div class="table-responsive">
                        <table class="table table-sm table-responsive ">
                   <thead>
                   <th class="addr" id="table_id" ></th>
                   <th>ID</th>
                   <th>Anillo</th>
                   <th>Ave</th>
                   <th>Peso</th>
                   <th>Caperuza</th>
                   <th colspan="2">Comida- Cantidad</th>
                   <th>Cetrero</th>
                   <th>Fecha</th>
                   <th>Turno</th>
                   <th>Cliente</th>
                   <th>Sede</th>
                   <th>Observación</th>
                   </thead>
                   <tbody>';
               $table = '';
               $count = 1;
               while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                     $table .= '<tr>'."\n";
                     $table .= '<td><fieldset class="form-group"><input type="checkbox" id="checkbox'.$count.'" name="data['.$count.'][checkbox]" value="on "><label for="checkbox'.$count.'"></label></fieldset></td>'."\n";
                     $table .= '<td ><input type="hidden" name="data['.$count.'][id]" value="'.$row['Con_id'].'">'.$row['Con_id'].'</td>'."\n";
                     $table .= '<td ><input type="hidden" name="data['.$count.'][anillo]" value="'.$row['Ave_anillo'].'">'.$row['Ave_anillo'].'</td>'."\n";
                     $table .= '<td><input type="hidden" name="data['.$count.'][nombre]" value="'.$row['Ave_nombre'].'">'.$row['Ave_nombre'].'</td>'."\n";
                     $table .= '<td><input type="hidden" name="data['.$count.'][peso]" value="'.$row['Con_peso'].'">'.$row['Con_peso'].'</td>'."\n";
                     $table .= '<td><input type="hidden" name="data['.$count.'][cape]" value="'.$row['Con_cape'].'">'.$row['Con_cape'].'</td>'."\n";
                     $table .= '<td><input type="hidden" name="data['.$count.'][comida]" value="'.$row['comi'].'">'.$row['comi'].'</td>'."\n";
                     $table .= '<td></td>'."\n";
                     $table .= '<td><input type="hidden" name="data['.$count.'][cetrero]" value="'.$row['usu_nombre'].'">'.$row['usu_nombre'].'</td>';
                     $table .= '<td><input type="hidden" name="data['.$count.'][fecha]" value="'.$row['Con_fecha'].'">'.date("d-m-Y", strtotime($row['Con_fecha'])).'</td>'."\n";
                     $table .= '<td><input type="hidden" name="data['.$count.'][turno]" value="'.$row['Tur_descp'].'">'.$row['Tur_descp'].'</td>'."\n";
                     $table .= '<td><input type="hidden" name="data['.$count.'][cliente]" value="'.$row['cli_nombre'].'">'.$row['cli_nombre'].'</td>'."\n";
                     $table .= '<td><input type="hidden" name="data['.$count.'][sede]" value="'.$row['sed_nombre'].'">'.$row['sed_nombre'].'</td>'."\n";
                     $table .= '<td><input type="hidden" name="data['.$count.'][obs]" value="'.$row['Con_obs'].'">'.$row['Con_obs'].'</td>'."\n";
                     $table .= "</tr>\n";

                $count= $count + 1;
               }
               echo $table;
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


    <br>

      <div class="card card-block">

        <?php
        $test = "Pollito - 1<br>Raton - 1";


        ?>


                <h4 class="card-title">Registrar Control</h4>
                <p class="card-text"> </p>
                    <?php
                    if (isset($_POST['modificar'])){ //Recibe la información del formulario agregar ave
                      foreach ($_POST['data'] as $key){
                        if (!empty($key['checkbox'])) {
                          $con_id = $key['id'];
                          $anillo = $key['anillo'];
                          $peso = $key['peso'];
                          $caperuza = $key['cape'];
                          $turno = $key['turno'];
                          $cliente = $key['cliente'];
                          $sede = $key['sede'];
                          $observacion = $key['obs'];
                          //Datos que nos existen
                          $cetrero = $key['cetrero'];
                          $fecha = $key['fecha'];
                          $comidas = explode( "<br>",$key['comida']);
                          if (count($comidas) == 2) {
                            $aux = explode("-", $comidas[0]);
                            $comida1 = $aux[0];
                            $cantidad1 = $aux[1];
                            $aux = explode("-", $comidas[1]);
                            $comida2 = $aux[0];
                            $cantidad2 = $aux[1];
                          }else {
                            $aux = explode("-", $comidas[0]);
                            $comida1 = $aux[0];
                            $cantidad1 = $aux[1];
                            $comida2 = '';
                            $cantidad2 ='';
                          }
                        }
                      }
                    }
                    if (isset($_POST['submit'])){ //Recibe la información del formulario agregar ave
                      $con_id = $_POST['con_id'];
                      $anillo = $_POST['anillo'];
                      $peso = $_POST['peso'];
                      $caperuza = $_POST['caperuza'];
                      $cetrero = $_POST['cetrero'];
                      $observacion = $_POST['observacion'];
                      $comida1 = $_POST['comida1'] === '' ? null : $_POST['comida1'] ;
                      $cantidad1 = $_POST['cantidad1'];
                      $comida2 = '';
                      $comida2 = empty($_POST['comida2']) ? null : $_POST['comida2'];
                      $cantidad2 = $_POST['cantidad2'];
                      $cliente = $_POST['cliente'];
                      $sede = $_POST['sede'];
                      $fecha =  date("Y-m-d", strtotime($_POST['fecha']));;

                      $sql = "SELECT Tur_cod, Tur_descp FROM `turno`";
                      $result = $conexion->query($sql);
                      while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                        if( $_POST['turno'] == $row['Tur_descp']){
                          $turno = $row['Tur_cod'];
                        }
                      }

                      //Insertar control
                      $sql = "INSERT INTO `control` (`Con_id`, `Con_Ave`, `Con_usu`, `Con_fecha`, `Con_turno`, `Con_peso`, `Con_cape`, `Con_obs`)
                              VALUES ('".$con_id."', '".$anillo."', '".$cetrero."', '".$fecha."', '".$turno."', '".$peso."', '".$caperuza."', '".$observacion."')";
                      $resultCon = $conexion->query($sql);
                      echo $conexion->error;

                      //Se inserta destino
                      $sql = "INSERT INTO `destino` (`Des_Control`, `Des_sede`)
                              VALUES ('".$con_id."', '".$sede."');";
                      $resultdestino = $conexion->query($sql);

                      //Se inserta comida
                      $sql = "INSERT INTO `control_comida` (`Cco_control`, `Cco_tco`, `Cco_cant`)
                              VALUES ('.$con_id.', '$comida1', '$cantidad1')";
                      $resultComida = $conexion->query($sql);
                      if ($comida2 != null) {
                        $sql = "INSERT INTO `control_comida` (`Cco_control`, `Cco_tco`, `Cco_cant`)
                                VALUES ('.$con_id.', '$comida2', '$cantidad2')";
                        $resultComida2 = $conexion->query($sql);
                      }
                      /*
                      echo $con_id."<br>";
                      echo $conexion->error;
                      echo '<br>';
                      echo $_SESSION['rut'];
                      echo $anillo;
                      echo $peso;
                      echo $caperuza;
                      echo $observacion;
                      echo $comida1;
                      echo $cantidad1;
                      echo $comida2;
                      echo $cantidad2;
                      echo $cliente;
                      echo $sede ;
                      echo $fecha;
                      echo '<br>';
                      echo $turno;

                      echo '<br>';
                      echo '<br>';
                      */
                    //  $sql = "INSERT INTO ave(Ave_anillo, Ave_nombre, Ave_estado, Ave_fecha_nac, Ave_especie, Ave_genero) VALUES ('".$anillo."', '".$ave."', '".$estado."' ,'".$fechanac."', '".$especie."', '".$genero."')
                        //       ON DUPLICATE KEY UPDATE Ave_nombre = '".$ave."', Ave_estado = '".$estado."', Ave_fecha_nac='".$fechanac."', Ave_especie='".$especie."', Ave_genero='".$genero."'";
                      //$result = $conexion->query($sql);
                }
                     ?>

        <form  Name ="form1" Method ="POST" ACTION = "controlave.php">
            <!--FILA ANILLO, PESO CAPERUA                         -->
            <div class="row">
                <!--First column-->
                <div class="col-md-3">
                    <div class="md-form">
                        <input type="text" id="form41" class="form-control" name="anillo"  value="<?php if(isset($_POST['modificar'])){echo $anillo;}else{echo '';} ?>">
                        <label for="form41" class="">Anillo</label>
                    </div>
                </div>
                <!--Third column-->
                <div class="col-md-2">
                    <div class="md-form">
                        <input type="text" id="form61" class="form-control" name="peso" value="<?php if(isset($_POST['modificar'])){echo $peso;}else{echo '';} ?>">
                        <label for="form61" class="">Peso</label>
                    </div>
                </div>
                <!--Third column-->
                <div class="col-md-2">
                  <div class="md-form">
                  <select class="mdb-select" name="caperuza">
                    <?php if(isset($_POST['modificar'])){
                      if($caperuza == 'CC'  ){
                      echo  ' <option value="CC">Con</option>
                              <option value="SC">Sin</option>';
                      }else{
                      echo ' <option value="SC">Sin</option>
                            <option value="CC">Con</option>';
                          }
                      }else {
                        echo  ' <option value="CC">Con</option>
                                <option value="SC">Sin</option>';
                      } ?>

                  </select>
                  <label for="form61" >Caperuza</label>
                  </div>
                </div>
                <!-- OBSERVACION -->
                <div class="col-md-5">
                  <div class="md-form">
                      <!--<i class="fa fa-pencil prefix"></i>
                        <textarea type="text" id="form8" class="md-textarea"></textarea>-->
                      <input type="text" id="form8" class="form-control" name="observacion" value="<?php if(isset($_POST['modificar'])){echo $observacion;}else{echo '';} ?>">
                      <label for="form8">Observación</label>
                  </div>
                </div>
            </div>
            <!--/.Third row-->

            <!--FILA COMIDA                         -->
            <div class="row" >
                <!--First column-->
                <div class="col-md-4">
                    <div class="md-form">
                      <div class="md-form">
                        <select class="mdb-select" name="comida1">
                          <?php
                          if(isset($_POST['modificar'])){

                             $sql = " SELECT Tco_cod, Tco_animal FROM `tipo_comida` ORDER BY Tco_animal = '".$comida1."'";
                           }else {
                             $sql = " SELECT Tco_cod, Tco_animal FROM `tipo_comida`";
                           }
                             $result = $conexion->query($sql);
                             $option = '';
                             while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                 $option .= ' <option value="'.$row['Tco_cod'].'">'.$row['Tco_animal'].'</option>';
                             }
                             echo $option;
                            ?>
                        </select>
                        <label for="form61" >Comida</label>
                      </div>
                    </div>
                </div>

                <!--Second column-->
                <div class="col-md-4">
                    <div class="md-form">
                        <input type="text" id="form51" class="form-control" name="cantidad1" value="<?php if(isset($_POST['modificar'])){echo $cantidad1;}else{echo "";} ?>">
                        <label for="form51" class="ave">Cantidad</label>
                    </div>
                </div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-primary" id="add_row">Agregar comida</button>
                </div>
              </div>

              <!--FILA COMIDA     OCULTA POR DEFECTO                    -->
              <div class="row" id="esconder">
                <!--First column-->
                <div class="col-md-4">
                    <div class="md-form">
                      <div class="md-form">
                        <select class="mdb-select" name="comida2">

                          <?php
                          if(isset($_POST['modificar']) and $comida2 != ''){
                             $sql = " SELECT Tco_cod, Tco_animal FROM `tipo_comida` ORDER BY Tco_animal = '".$comida2."'";
                             $result = $conexion->query($sql);
                             $option = '';
                             while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                 $option .= ' <option value="'.$row['Tco_cod'].'">'.$row['Tco_animal'].'</option>';
                               }
                             echo $option;
                           }else{
                             echo '<option value="" disabled selected></option>';
                             echo $option;
                           }

                            ?>
                        </select>
                        <label for="form61" >Comida</label>
                      </div>
                    </div>
                </div>

                <!--CANTIDAD-->
                <div class="col-md-4">
                    <div class="md-form">
                        <input type="text" id="form51" class="form-control" name="cantidad2" value="<?php if(isset($_POST['modificar'])){echo $cantidad2;}else{echo "";} ?>">
                        <label for="form51" class="ave">Cantidad</label>
                    </div>
                </div>

                <!--BOTON ESCONDE COMIDA-->
                <div class="col-md-4">
                  <button type="button" class="btn btn-primary" id="subtract_row">Esconder comida</button>
                </div>
              </div>
              <br>

              <!--FILA CLIENTE                   -->
            <div class="row">
                <div class="col-md-4">
                  <div class="md-form">
                    <select class="mdb-select" name="cliente" id='cliente'>
                      <?php
                      if (isset($_POST['modificar'])){
                         $sql = " SELECT cli_cod, cli_nombre FROM cliente ORDER BY cli_nombre='".$cliente."'";
                       }else {
                         $sql = " SELECT cli_cod, cli_nombre FROM cliente";
                       }
                         $result = $conexion->query($sql);
                         echo $conexion ->error;
                         $option = '';
                         while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                             echo ' <option value="'.$row['cli_cod'].'">'.$row['cli_nombre'].'</option>';
                         }

                        ?>

                        <?php /*
                        $option = '';
                        if (isset($_POST['modificar'])){
                           $sql = " SELECT cli_cod, cli_nombre FROM cliente ORDER BY cli_nombre='".$cliente."'";
                           $option = '';
                         }else {
                           $sql = " SELECT cli_cod, cli_nombre FROM cliente";
                           $option = '<option value="">Casa</option>';
                         }
                           $result = $conexion->query($sql);
                           while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                               $option +=' <option value="'.$row['cli_cod'].'">'.$row['cli_nombre'].'</option>';
                           }
                           echo $option;
                           */
                          ?>
                    </select>
                    <label for="form41" class="">Cliente</label>
                  </div>
                </div>
                <!--Third column-->
                <div class="col-md-8">
                  <div class="md-form">
                  <select class="mdb-select" id="sede" name="sede">
                  </select>
                  <label for="form61" >Sede</label>
                  </div>
                </div>
              </div>

              <!--Datos ocultos   -->
              <div class="row">

                  <!--First column-->
                  <div class="col-md-3">
                      <div class="md-form">
                          <input type="text" name="cetrero" class="form-control" value="<?php if(isset($_POST['modificar'])){echo $cetrero;}else{echo $_SESSION['rut'];} ?>" readonly="readonly">
                          <label for="form41" class="">Cetrero</label>
                      </div>
                  </div>

                  <!--Second column-->
                  <div class="col-md-3">
                      <div class="md-form">
                          <input type="text" id="form51" class="form-control" name="turno" value="<?php
                           if(isset($_POST['modificar'])){
                             echo $turno;
                           }else{
                             $turno=getTurno($conexion);
                             echo $turno;
                           }
                             ?>" readonly="readonly">
                          <label for="form51" class="">Turno</label>
                      </div>
                  </div>

                  <!--Third column-->
                  <div class="col-md-3">
                      <div class="md-form">
                          <input type="text" id="form61" class="form-control" name="fecha" value="<?php if(isset($_POST['modificar'])){echo $fecha;}else{echo date("d-m-Y");} ?>" readonly="readonly">
                          <label for="form61" class="">Fecha</label>
                      </div>
                  </div>

                  <!--Third column-->
                  <div class="col-md-3">
                      <div class="md-form">
                          <input type="text" id="form61" class="form-control" name="con_id" value="<?php
                           if(isset($_POST['modificar'])){echo $con_id;}else{
                              //Se obitene el id de control  del AUTO_INCREMENT
                             $aux = $conexion->query("SELECT `AUTO_INCREMENT` as AI FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'mis_aves' AND TABLE_NAME = 'control'")->fetch_array(MYSQLI_ASSOC);
                             $con_id = $aux['AI'];
                             echo $con_id;
                           } ?>" readonly="readonly">
                          <label for="form61" class="">ID control</label>
                      </div>
                  </div>

              </div>
              <!--/.Third row-->

              <div class="md-form form-group">
                  <button   name="submit" type="submit" class="btn btn-primary btn-lg">Agregar Control</a>
              </div>

        </form>



      </div>

</br>



        </div>
    </main>
    <!--/Main layout-->
    <?php include '../layouts/footer.php';?>

    <script type='text/javascript'>
      $(document).ready(function(){

        //agregar fila
        $('#esconder').hide();
        $("#subtract_row").hide();
        $("#add_row").click(function(){
          $("#esconder").show();
          $("#add_row").hide();
          $("#subtract_row").show();
        });
        $("#subtract_row").click(function(){
          $("#esconder").hide();
          $("#add_row").show();
          $("#subtract_row").hide();
        });

        <?php
        if (isset($_POST['submit'])){
          if ($resultCon) {
            echo 'toastr.success("Control agregado correctamente");';
          }else {
            echo 'toastr.error("Error al registrar el control");';
          }
        }
          echo "var subcats = $jsonSubCats; \n";
          if ($turno = null) {
            echo 'toastr.warning("No hay turno asociado a esta hora, se agrego turno de mañana");';
          }
        ?>

        console.log($( "#cliente" ).val());
        cliente = $( "#cliente" ).val();
        var itemval = ''
        for (var i = 0; i < subcats[cliente].length; i++){
          itemval= '<option value="'+ subcats[cliente][i].id + '">'+ subcats[cliente][i].val + '</option>';
        }
          console.log(itemval)

        $("#sede").append(itemval)
        $('#sede').material_select('update');
        //se vacia
        $('#cliente').bind('change', function (e) {
          $('#sede').empty();
          cliente = $( "#cliente" ).val();
          var itemval = ''
          for (var i = 0; i < subcats[cliente].length; i++) {
            itemval= '<option value="'+ subcats[cliente][i].id + '">'+ subcats[cliente][i].val + '</option>';
          }
          console.log("pico");
          $("#sede").append(itemval)
          $('#sede').material_select('update');
        });
      });
    </script>


</body>

</html>
