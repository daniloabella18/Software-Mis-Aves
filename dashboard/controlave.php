<?php
  header('Content-Type: text/html; charset=utf-8');
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
  //$query = "SELECT id, catid, subcat FROM subcat";
  $query = "SELECT sed_cod, sed_cliente, sed_nombre FROM sede";
  $result = $conexion->query($query);

  while($row = $result->fetch_assoc()){
    $subcats[$row['sed_cliente']][] = array("id" => $row['sed_cod'], "val" => $row['sed_nombre']);
//    $subcats[$row['catid']][] = array("id" => $row['id'], "val" => $row['subcat']);

  }


  $jsonSubCats = json_encode($subcats);



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
               $sql = "SELECT C.Con_id , A.Ave_anillo, A.Ave_nombre, C.Con_peso,C.Con_cape, TC.Tco_animal, CC.Cco_cant,  U.usu_nombre, C.Con_fecha, T.Tur_descp, C.Con_obs  FROM control_comida CC, control C, ave A, usuario U, turno T, tipo_comida TC WHERE C.Con_Ave = A.Ave_anillo and C.Con_usu = U.usu_rut and C.Con_turno = T.Tur_cod AND CC.Cco_control= C.Con_id and CC.Cco_tco = TC.Tco_cod
                        and (C.Con_Ave = '".$_GET['search']."' or A.Ave_nombre = '".$_GET['search']."') ORDER BY C.Con_fecha asc LIMIT 6";
               //$sql2="SELECT Cco_control, Cco_tco, Cco_cant FROM control_comida WHERE Cco_control = '1'";
               $result = $conexion->query($sql);
               $count = 1;
              if(mysqli_num_rows($result) ==0){
                echo 'No hay controles registrados para el ave '.$_GET['search'];
              }else{
                   echo '<div class="table-responsive">
                        <table class="table ">
                   <thead>
                   <th class="addr" id="table_id" ></th>
                   <th>ID</th>
                   <th>Anillo</th>
                   <th>Ave</th>
                   <th>Peso</th>
                   <th>Caperuza</th>
                   <th >Comida</th>
                   <th>-</th>
                   <th>Cantidad</th>
                   <th>Cetrero</th>
                   <th>Fecha</th>
                   <th>Turno</th>
                   <th>Observación</th>
                   </thead>
                   <tbody>';
               $cont_anterior = -1;
               while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                   $con_actual =$row['Con_id'];
                   if ($con_actual != $cont_anterior) {
                     echo '<tr>';
                     echo '<td><fieldset class="form-group"><input type="checkbox" id="checkbox'.$count.'" name="data['.$count.'][checkbox]" value="on "><label for="checkbox'.$count.'"></label></fieldset></td>';
                     echo '<td ><input type="hidden" name="data['.$count.'][con_id]" value="'.$row['Con_id'].'">'.$row['Con_id'].'</td>';
                     echo '<td ><input type="hidden" name="data['.$count.'][ave_anillo]" value="'.$row['Ave_anillo'].'">'.$row['Ave_anillo'].'</td>';
                     echo '<td><input type="hidden" name="data['.$count.'][ave_nombre]" value="'.$row['Ave_nombre'].'">'.$row['Ave_nombre'].'</td>';
                     echo '<td><input type="hidden" name="data['.$count.'][con_peso]" value="'.$row['Con_peso'].'">'.$row['Con_peso'].'</td>';
                     echo '<td><input type="hidden" name="data['.$count.'][con_cape]" value="'.$row['Con_cape'].'">'.$row['Con_cape'].'</td>';
                     echo '<td><input type="hidden" name="data['.$count.'][tco_animal]" value="'.$row['Tco_animal'].'">'.$row['Tco_animal'].' </td>';
                     echo '<td>-</td>';
                     echo '<td><input type="hidden" name="data['.$count.'][cco_cant]" value="'.$row['Cco_cant'].'">'.$row['Cco_cant'].'</td>';
                     echo '<td><input type="hidden" name="data['.$count.'][usu_nombre]" value="'.$row['usu_nombre'].'">'.$row['usu_nombre'].'</td>';
                     echo '<td><input type="hidden" name="data['.$count.'][con_fecha]" value="'.$row['Con_fecha'].'">'.date("d-m-Y", strtotime($row['Con_fecha'])).'</td>';
                     echo '<td><input type="hidden" name="data['.$count.'][tur_descp]" value="'.$row['Tur_descp'].'">'.$row['Tur_descp'].'</td>';
                     echo '<td><input type="hidden" name="data['.$count.'][con_obs]" value="'.$row['Con_obs'].'">'.$row['Con_obs'].'</td>';
                     echo "</tr>";
                  }else{
                    $count= $count -1;
                    echo '<tr>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td><input type="hidden" name="data['.$count.'][tco_animal2]" value="'.$row['Tco_animal'].'">'.$row['Tco_animal'].'</td>';
                    echo '<td>-</td>';
                    echo '<td><input type="hidden" name="data['.$count.'][cco_cant2]" value="'.$row['Cco_cant'].'">'.$row['Cco_cant'].'</td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo "</tr>";
                  }
                $cont_anterior = $con_actual;
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


    <br>

      <div class="card card-block">
                <h4 class="card-title">Registrar Control</h4>
                <p class="card-text">Rellene los datos para registar el control de un ave, si desea modificar un control seleccione uno de los de abajo, controles de otros días no pueden ser modificados</p>
        <form  Name ="form1" Method ="POST" ACTION = "send.php">
            <!--Third row-->
            <div class="row">

                <!--First column-->
                <div class="col-md-3">
                    <div class="md-form">
                        <input type="text" id="form41" class="form-control" name="anillo">
                        <label for="form41" class="">Anillo</label>
                    </div>
                </div>

                <!--Third column-->
                <div class="col-md-2">
                    <div class="md-form">
                        <input type="text" id="form61" class="form-control" name="peso">
                        <label for="form61" class="">Peso</label>
                    </div>
                </div>
                <!--Third column-->
                <div class="col-md-2">
                  <div class="md-form">
                  <select class="mdb-select" name="caperuza">
                    <option value="" disabled selected></option>
                    <option value="c">Con</option>
                    <option value="s">Sin</option>
                  </select>
                  <label for="form61" >Caperuza</label>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="md-form">
                      <!--<i class="fa fa-pencil prefix"></i>
                      <textarea type="text" id="form8" class="md-textarea"></textarea>-->
                      <input type="text" id="form8" class="form-control" name="observacion"></textarea>
                      <label for="form8">Observación</label>
                  </div>
                </div>
            </div>
            <!--/.Third row-->

            <div class="row">
              <!--Textarea with icon prefix-->

            </div>

            <div class="row" id="copiar">
                <!--First column-->
                <div class="col-md-4">
                    <div class="md-form">
                      <div class="md-form">
                        <select class="mdb-select" name="caperuza">
                          <option value="hom">gorrion</option>
                          <option value="met">metro</option>
                        </select>
                        <label for="form61" >Comida</label>
                      </div>
                    </div>
                </div>

                <!--Second column-->
                <div class="col-md-4">
                    <div class="md-form">
                        <input type="text" id="form51" class="form-control" name="cantidad">
                        <label for="form51" class="ave">Cantidad</label>
                    </div>
                </div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-primary" id="add_row">Agregar comida</button>
                </div>
              </div>

              <div class="row" id="esconder">
                <!--First column-->
                <div class="col-md-4">
                    <div class="md-form">
                      <div class="md-form">
                        <select class="mdb-select" name="caperuza">
                          <option value="hom">gorrion</option>
                          <option value="met">metro</option>
                        </select>
                        <label for="form61" >Comida</label>
                      </div>
                    </div>
                </div>

                <!--Second column-->
                <div class="col-md-4">
                    <div class="md-form">
                        <input type="text" id="form51" class="form-control" name="cantidad">
                        <label for="form51" class="ave">Cantidad</label>
                    </div>
                </div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-primary" id="subtract_row">Esconder comida</button>
                </div>
              </div>

<br>

            <div class="row">
                <div class="col-md-4">
                  <div class="md-form">
                    <select class="mdb-select" name="caperuza" id='cliente'>
                      <option value="hom">Homecenter</option>
                      <option value="met">metro</option>
                    </select>
                    <label for="form41" class="">Comida</label>
                  </div>
                </div>

                <!--Third column-->
                <div class="col-md-8">
                  <div class="md-form">
                  <select class="mdb-select" id="sede">
                  </select>
                  <label for="form61" >Sede</label>
                  </div>
                </div>
              </div>

              <div class="md-form form-group">
                  <button type="submit" href="send.php" class="btn btn-primary btn-lg">Agregar Control</a>
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


        <?php
          echo "var subcats = $jsonSubCats; \n";
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
    </script>


</body>

</html>
