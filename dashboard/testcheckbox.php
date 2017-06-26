<?php
  session_start();
  if(!isset($_SESSION["loggedin"])) {
      die("No se tienen los permisos necesarios para acceder aquí");
      exit('0');
  }
  require_once("../db_const.php");
  $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
  if ($conexion->connect_error) {
   die("La conexion falló: " . $conexion->connect_error);
  }

  $query = "SELECT cli_cod,cli_nombre FROM cliente";
  $result = $conexion->query($query);

  while($row = $result->fetch_assoc()){
    $categories[] = array("id" => $row['cli_cod'], "val" => $row['cli_nombre']);
  }

  //$query = "SELECT id, catid, subcat FROM subcat";
  $query = "SELECT sed_cod, sed_cliente, sed_nombre FROM sede";
  $result = $conexion->query($query);

  while($row = $result->fetch_assoc()){
    $subcats[$row['sed_cliente']][] = array("id" => $row['sed_cod'], "val" => $row['sed_nombre']);
//    $subcats[$row['catid']][] = array("id" => $row['id'], "val" => $row['subcat']);

  }

  $jsonCats = json_encode($categories);
  $jsonSubCats = json_encode($subcats);

  echo $jsonCats;

?>
<head>


  </head>


<body class="fixed-sn pink-skin bg-skin-lp">
    <!--Main layout-->
    <main>
    <div class="container-fluid text-center">

      <div class="card card-block">
        <?php echo $jsonCats;
              echo "<br>";
              echo $jsonSubCats;
         ?>
         <br>
         <p id="demo"></p>

           <select id='categoriesSelect'>
           </select>

           <select id='subcatsSelect'>
           </select>

           <select id='cliente'>
             <option value="hom">Homecenter</option>
             <option value="met">metro</option>
           </select>

           <select id='sede'>
           </select>
      </div>
    <br/>

  </div>
</main>
<!--/Main layout-->

<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script><script type='text/javascript'>

  <?php
    echo "var categories = $jsonCats; \n";
    echo "var subcats = $jsonSubCats; \n";
  ?>



  $(document).ready(function(){
    <?php
      echo "var categories = $jsonCats; \n";
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
    //se vacia
    $('#cliente').bind('change', function (e) {
      $('#sede').empty();
      cliente = $( "#cliente" ).val();
      var itemval = ''
      for (var i = 0; i < subcats[cliente].length; i++) {
        itemval= '<option value="'+ subcats[cliente][i].id + '">'+ subcats[cliente][i].val + '</option>';
      }
      $("#sede").append(itemval)
    });
  });

</script>

</body>

</html>
