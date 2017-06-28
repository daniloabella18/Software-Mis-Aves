<!--Double navigation-->

<!-- Sidebar navigation -->
<ul id="slide-out" class="side-nav fixed sn-bg-1 custom-scrollbar hidden-print">
    <!-- Logo -->
    <li>
        <div class="logo-wrapper waves-light">
            <a href="dashboard.php"><img src="../assets/img/logo.png" class="flex-center"></a>
        </div>
    </li>
    <!--/. Logo -->
    <!--Social-->
    <!--/Social-->
    <!--Search Form
    <li>
        <form class="search-form" role="search">
            <div class="form-group waves-light">
                <input type="text" class="form-control" placeholder="Search">
            </div>
        </form>
    </li>
    -->
    <!--/.Search Form-->
    <!-- Side navigation links -->
    <li>
        <ul class="collapsible collapsible-accordion">
            <li><a  class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i> Aves<i class="fa fa-angle-down rotate-icon"></i></a>
                <div class="collapsible-body">
                    <ul>
                      <?php if( $_SESSION['cargo'] == 'Jef' ){
                        echo '<li><a href="adminave.php" class="waves-effect">Administrar aves</a>
                        </li>';}
                         ?>
                        <li><a href="controlave.php" class="waves-effect">Control ave</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li><a href="#" class="waves-effect">Administrar aves</a>
                                  </li>
                                  <li><a href="#" class="waves-effect">Control ave</a>
                                  </li>
                              </ul>
                          </div>
                        </li>
                    </ul>
                </div>
            </li>

            <?php if( $_SESSION['cargo'] == 'Jef' ){
            echo '<li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-users"></i> Usuarios</a></li>';}
            ?>
          <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-file-text-o"></i> Reportes<i class="fa fa-angle-down rotate-icon"></i></a>
          <div class="collapsible-body">
              <ul>
                  <li><a href="#" class="waves-effect">Aves por controlar</a>
                  </li>
                  <li><a href="Controlesdiarios.php" class="waves-effect">Controles diarios</a>
                  </li>
                  <li><a href="histoticoave.php" class="waves-effect">30 días ave</a>
                  </li>
              </ul>
          </div>

    </li>
    <?php if( $_SESSION['cargo'] == 'Jef' ){
    echo '<li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-database"></i> Tablas básicas<i class="fa fa-angle-down rotate-icon"></i></a>
        <div class="collapsible-body">
            <ul>
                <li><a href="#" class="waves-effect">Cliente</a>
                </li>
                <li><a href="#" class="waves-effect">Sede</a>
                </li>
                <li><a href="#" class="waves-effect">Turno</a>
                </li>
            </ul>
        </div>
    </li>';}
    ?>
    </ul>
    <!--/. Side navigation links -->
    <div class="sidenav-bg mask-strong"></div>
</ul>
<!--/. Sidebar navigation -->
