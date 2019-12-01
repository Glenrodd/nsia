<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  
  <!-- <link rel="icon" href="<?php echo Yii::app()->request->baseUrl;?>/images/LogoVIASBoliviaSiaco.png">  -->

  <title>S.A.C</title>


 <!-- Estilos para tooltip -->
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tooltip-classic.css">
<!-- Estilos creados por Alvaro Canqui -->
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/estilos.css">


  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  
  <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->

  <?php if (!Yii::app()->user->isGuest) { ?>
      <meta http-equiv="refresh" content="<?php echo Yii::app()->params['session_timeout'];?>;"/>
  <?php }?>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php 

if (!Yii::app()->user->isGuest){

  /*if (Seguimientos::getVerificaSiHayPendientes()>0) {

    $num=Seguimientos::getMensajeBloqueoUsuario();

      if ($num<=0) {

        //echo "bloquear sistema";
        $this->redirect(array('site/bloqueoSistema'));
      }
  } */

?>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav" >
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#">
              <i class="fa fa-bars"></i>
        </a>
      </li>

      <li class="nav-item d-none d-xl-inline-block">        
        <a href="index.php" class="nav-link">
          <i class="fa fa-home nav-icon"></i>
          Inicio
        </a>
      </li>
      <li class="nav-item d-none d-xl-inline-block">
        <a href="index.php?r=site/menuDocumentos" class="nav-link">
          <i class="fa fa-file-text-o"></i>
          Generar Documento
        </a>
      </li>
      <li class="nav-item d-none d-xl-inline-block">
        <a href="index.php?r=seguimientos/documentosLlegar" class="nav-link">
          <i class="fa fa-stack-overflow"></i>
          Que deben llegar
        </a>
      </li>
      <li class="nav-item d-none d-xl-inline-block">
        <a href="index.php?r=seguimientos/pendientesOficiales" class="nav-link">
          <i class="fa fa-hand-peace-o"></i>
          Pendientes
        </a>
      </li>
      <li class="nav-item d-none d-xl-inline-block">
        <a href="index.php?r=seguimientos/pendientesDigitales" class="nav-link">
          <i class="fa fa-ravelry"></i>
          Pendientes Digitales
        </a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">B&uacute;squeda</a>
      </li>-->
    </ul>
    <!-- SEARCH FORM -->

<script type="text/javascript">
    
  function getBuscar(){  
    
    var valor=$("#inputBuscar").val();
    valor = valor.trim();

      if (valor=='' || valor=='*') {
          alert('Es necesario ingresar un dato válido');
      }
      else{
          
          //alert (valor);
          location.href = 'index.php?r=Seguimientos/busquedaIndex&nuri='+valor;
          //location.href = 'index.php?r=site/menuDocumentos';
          //location.href = "http://www.google.com";
          //parent.location='http://www.google.com';
          

      }
  }

  
</script>




<div class="form-inline ml-3">
      <div class="input-group input-group-sm">
<?php echo CHtml::beginForm('index.php?r=seguimientos/busquedaIndex','get', array('class'=>'form-inline ml-3')); ?>

  <?php //echo CHtml::label('ingrese nuri','user01',array('class'=>'small'))?>
  <?php echo CHtml::textField('nuri','',array('id'=>'inputBuscar', 'maxlength'=>14 ,'class'=>'form-control form-control-navbar', 'placeholder'=>'Buscar...', 'aria-label'=>'Search'))?>
  <?php //echo CHtml::submitButton(".<i class='fa fa-search'></i>",array('class'=>'btn btn-navbar')); ?>

  <button class="btn btn-navbar" >
            <i class="fa fa-search"></i>
  </button>

<?php echo CHtml::endForm(); ?>    
 </div>
    </div> 


    <!--<form class="form-inline ml-3" method="GET" action="index.php?r=Seguimientos/busquedaIndex">-->
   <!-- <div class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar..." aria-label="Search" id="inputBuscar" name="nuri" required>
        <div class="input-group-append">
          <button class="btn btn-navbar" >
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </div>  -->
    <!--</form>-->



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o" style="font-size:23px;"></i>
          <span class="badge badge-danger navbar-badge">#</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a  class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/man_brown.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <b><?=Yii::app()->user->usuario?></b>
                  <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">No cambiaste tu contraseña</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 
                   hace <?=Usuarios::getDiasCambioPassword()?> d&iacute;as
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>


        <div class="dropdown-divider"></div>
          <!-- # VERIFICAMOS QUE LA CONTRASEÑA CONTINUE SIENDO QWERTY-->
          <a class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/man_brown.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <b><?=Yii::app()->user->usuario?></b>
                  <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">Reservas disponibles</p>
                <p class="text-sm text-muted"><i class="fa fa-hashtag mr-1"></i> 
                  <?=(15-Documentos::getNumeroReservados())?>
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          




          <div class="dropdown-divider"></div>
          <!-- # VERIFICAMOS QUE LA CONTRASEÑA CONTINUE SIENDO QWERTY-->
          <?php if (Usuarios::getObtenerP()==1) { ?>
          <a class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/man_brown.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <b><?=Yii::app()->user->usuario?></b>
                  
                  <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">Continuas utilizando la contraseña por defecto</p>
                <p class="text-sm text-muted"><i class="fa fa-key mr-1"></i> 
                  abc123 <i>(Cambiala)</i>
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <?php } ?>

          <div class="dropdown-divider"></div>
          <!-- # VERIFICAMOS QUE LA CONTRASEÑA CONTINUE SIENDO QWERTY-->

          <?php if (Seguimientos::getVerificaSiHayPendientes()>0) { ?>
          <a class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/man_brown.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <b><?=Yii::app()->user->usuario?></b>
                  
                  <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">Tienes NUR/NURI(s) sin recibir</p>
                <p class="text-sm text-muted"><i class="fa fa-key mr-1"></i> 
                  El sistema se bloqueara en <?=Seguimientos::getMensajeBloqueoUsuario()?> dias
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <?php } ?>

          <div class="dropdown-divider"></div>

          <!--<a href="#" class="dropdown-item">
             
            <div class="media">
              <img src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
             
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          -->
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o" style="font-size:23px;"></i>
          <span class="badge badge-warning navbar-badge">
            <?php 
            $usuario=Yii::app()->user->id_usuario;
              $total_notificacion=(Seguimientos::countQueDebenLlegar(1,$usuario)+Seguimientos::countQueDebenLlegar(0,$usuario)+Seguimientos::countPendientes(1,1,$usuario)+Seguimientos::countPendientes(0,2,$usuario));

              echo $total_notificacion;

            ?>
            
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header"><?=$total_notificacion?> Notificaciones</span>
          
          <div class="dropdown-divider"></div>
          <a href="index.php?r=seguimientos/documentosLlegar" class="dropdown-item">
            <i class="fa fa-clipboard mr-2"></i>
              <?=Seguimientos::countQueDebenLlegar(1,$usuario)?>&nbsp;&nbsp;  
              Que deben llegar (Oficiales)
            <!--<span class="float-right text-muted text-sm">3 mins</span>-->
          </a>

          <div class="dropdown-divider"></div>
          <a href="index.php?r=seguimientos/documentosLlegar" class="dropdown-item">
            <i class="fa fa-clipboard mr-2"></i> 
              <?=Seguimientos::countQueDebenLlegar(0,$usuario)?>&nbsp;&nbsp;
              Que deben llegar (Digitales)
            <!--<span class="float-right text-muted text-sm">3 mins</span>-->
          </a>

          <div class="dropdown-divider"></div>
          <a href="index.php?r=seguimientos/pendientesOficiales" class="dropdown-item">
            <i class="fa fa-stack-overflow mr-2"></i> 
               <?=Seguimientos::countPendientes(1,1,$usuario)?>&nbsp;&nbsp;
              Pendientes oficiales
            <!--<span class="float-right text-muted text-sm">12 hours</span>-->
          </a>
          <div class="dropdown-divider"></div>
          <a href="index.php?r=seguimientos/pendientesDigitales" class="dropdown-item">
            <i class="fa fa-file-text mr-2"></i> 
               <?=Seguimientos::countPendientes(0,2,$usuario)?>&nbsp;&nbsp;
              Pendientes digitales
            <!--<span class="float-right text-muted text-sm">2 days</span>-->
          </a>

          <div class="dropdown-divider"></div>
          <!--<a href="#" class="dropdown-item dropdown-footer">Todas las Notificaciones</a>-->
        </div>
      </li>

    <!-- ################################################################################################### -->  
    <!-- ################################################################################################### -->  
      <!-- REPORTES Y NOTIFICACIONES -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-print" style="font-size:23px;"></i>
          <!--<span class="badge badge-info navbar-badge">99999</span>-->
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">Reportes</span>
          
          <div class="dropdown-divider"></div>
          <a href="index.php?r=seguimientos/documentosDerivados" class="dropdown-item">
            <i class="fa fa-file-text-o mr-2"></i> 
              <b>NUR/NURI(s)</b> derivados
          </a>
          <div class="dropdown-divider"></div>
          <a href="index.php?r=seguimientos/documentosAtendidos" class="dropdown-item">
            <i class="fa fa-envelope-open-o mr-2"></i> 
              Documentacion atendida
          </a>
          
          <div class="dropdown-divider"></div>
          <!--<a href="#" class="dropdown-item dropdown-footer">Todas las Notificaciones</a>-->
        </div>
      </li>
      <!-- END -->



      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
<?php 
  } //if (!Yii::app()->user->isGuest){



?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/LogoVIASBoliviaSiaco.png" alt="ABC" class="brand-image elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-size: 14px;">Panel de<br> Administraci&oacute;n</span>
      <!--<span class="brand-text font-weight-light">Admin S.A.C.</span>-->
    </a>



    <?php 
      // nos muestra el menu si estamos logueados
      if (!Yii::app()->user->isGuest){
    ?>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!--<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/LOGOconstructor3.png" class="img-circle elevation-2" alt="User Image">-->
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=Yii::app()->user->usuario?></a>
          <span class="right badge badge-success">En L&iacute;nea</span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active" style="background-color: #086A87;">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Men&uacute; de opciones
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php" class="nav-link active">
                  <i class="fa fa-home nav-icon"></i>
                  <p>Inicio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?r=usuarios/updatePassword" class="nav-link active">
                  <i class="fa fa-key nav-icon"></i>
                  <p>Cambiar Contraseña</p>
                </a>
              </li>
              <!--<li class="nav-item">
                <a href="index.php?r=site/menuDocumentos" class="nav-link active">
                  <i class="fa fa-pencil-square-o nav-icon"></i>
                  <p>Generar Documento</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a  href="index.php?r=site/menuBusqueda"  class="nav-link active">
                  <i class="fa fa-search-plus nav-icon"></i>
                  <p>Opciones de B&uacute;squeda</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?r=site/menuDerivaciones" class="nav-link active">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Lista Derivaci&oacute;n</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?r=documentos/administracionBorrador" class="nav-link active">
                  <i class="fa fa-low-vision nav-icon"></i>
                  <p>Borradores&nbsp;&nbsp; <b>(<?=Documentos::countBorradores()?>)</b></p>
                </a>
              </li>

          <?php if (Yii::app()->user->id_nivel==5) { ?>
              <li class="nav-item">
                <a href="index.php?r=site/menuVentanillaRecepcion" class="nav-link active">
                  <i class="fa fa-vcard-o nav-icon"></i>
                      <p><b>Recepci&oacute;n Externa</b></p>
                </a>
              </li>
          <?php } ?>

            </ul>
          </li>

          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active"  style="background-color: #086A87;">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Reportes
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?r=seguimientos/documentosDerivados" class="nav-link active">
                  <i class="fa fa-file-text-o mr-2"></i> 
                    <b>NUR/NURI(s)</b> derivados
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?r=seguimientos/documentosAtendidos" class="nav-link active">
                  <i class="fa fa-envelope-open-o mr-2"></i> 
                    Documentacion atendida
                </a>
              </li>

            </ul>
          </li>


          <!-- CODIGO PARA ESPACIO EN BLANCO -->
          <li class="nav-item has-treeview menu-open">
              <ul class="nav nav-treeview">
                <li class="nav-item"><br></li>
              </ul>
          </li>

          <br>

          <?php if (Yii::app()->user->id_perfil==3) {  ?>     
            <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active"  style="background-color: #086A87;">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Gesti&oacute;n Documental
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?r=site/menuGestionDocumental" class="nav-link active">
                  <i class="fa fa-newspaper-o nav-icon"></i>
                  <p>Reportes</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

           <?php if (Yii::app()->user->id_perfil==2) {  ?>     
            <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active"  style="background-color: #086A87;">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Opciones Regional
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?r=usuarios/adminRegional" class="nav-link active">
                  <i class="fa fa-group nav-icon"></i>
                  <p>Usuarios Regional</p>
                </a> 
              </li>
              <li class="nav-item">
                <a href="index.php?r=documentos/adminDocumentosRegionales" class="nav-link active">
                  <i class="fa fa-file-text-o nav-icon"></i>
                  <p>Documentos Regional</p>
                </a> 
              </li>
            </ul>
          </li>
          <?php } ?>

          <!--#######################################################-->
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if (Yii::app()->user->id_perfil==1) {  ?>     
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active"  style="background-color: #086A87;">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Administraci&oacute;n
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?r=site/menuParametros" class="nav-link active">
                  <i class="fa fa-tasks nav-icon"></i>
                  <p>Parametros</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?r=usuarios/admin" class="nav-link active">
                  <i class="fa fa-group nav-icon"></i>
                  <p>Administrar Usuarios</p>
                </a> 
              </li>

              




              <li class="nav-item">
                <a href="index.php?r=site/menuAdministracion" class="nav-link active">
                  <i class="fa fa-cogs nav-icon"></i>
                  <p>Administraci&oacute;n </p>
                </a> 
              </li>
              <li class="nav-item">
                <a href="index.php?r=site/menuGestionDocumental" class="nav-link active">
                  <i class="fa fa-newspaper-o nav-icon"></i>
                  <p>Gesti&oacute;n Documental</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="fa fa-address-book nav-icon"></i>
                  <p>Ventanilla &Uacute;nica</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="fa fa-file-text nav-icon"></i>
                  <p>Reporte Pendientes</p>
                </a>
              </li>

            </ul>
          </li>
          <!--#######################################################-->
          <?php }  ?>    



          <li class="nav-item">
            <a href="index.php?r=site/logout" class="nav-link">
              <span class="right badge badge-danger">
                <i class="nav-icon fa fa-power-off"></i>
              </span>  
              <p>
                Salir
                <!--<span class="right badge badge-danger">...</span>-->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link">
                Reservas disponibles
              <p>
              <!--<i class="nav-icon fa fa-file-text-o"></i>-->
                <!--<span class="right badge badge-danger">...</span>-->
                <span class="right badge badge-info" style="font-size: 15px;">
                  <?=(15-Documentos::getNumeroReservados())?>
                </span>  
              </p>
            </a>
          </li>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <?php 
      }//if (!Yii::app()->user->isGuest){
       else{
    ?>  

        <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-4 pb-4 mb-4 d-flex">
        <div class="image">
          <!--<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/LOGOconstructor3.png" class="img-circle elevation-2" alt="User Image">-->
        </div>
        <div class="info">
           <center>
          <a href="#" class="d-block">Administradora <br>Boliviana <br>de Carreteras </a>
          </center> 
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item"><p></p></li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->


    <?php 
      }//else (!Yii::app()->user->isGuest){
    ?>


  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-8">
          <div class="col-sm-12">
            <center>
              <?php if (!Yii::app()->user->isGuest){ ?>
              <b style="font-size:23px;" >Sistema de Administraci&oacute;n de Correspondencia</b>
                <br>
                <div style="font-size: 13px;" ><?=Usuarios::getNameUser()?></div>
              <?php } ?>
            </center>
            
          </div><!-- /.col -->
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">SIACO</a></li>
              <li class="breadcrumb-item active">Inicio</li>
            </ol>
          </div>--> <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <div class="info_alert" >


                <center>
                  <?php
                  // CODIGO PARA MOSTRAR MENSJAES  AL CREAR ACCIONES EN LOS FORMULARIOS
                    $flashMessages = Yii::app()->user->getFlashes();
                    if ($flashMessages) {
                    echo '<ul class="flashes" style="list-style-type:none; width:60%;">';

                    echo '<div class="modal-dialogq" style="width:100%;">
                        <div class="modal-content">
                          <div class="modal-header" >
                            
                            <h4 class="modal-title" style="text-align:left; color:#0B4C5F;"><i class="fa fa-comments-o"></i> Alerta </h4>

                            


                          </div>
                          <div class="modal-body" >';

                        foreach($flashMessages as $key => $message) {
                            echo '<li>
                            <div class="flash-' . $key . '">
                            ' . $message . "
                            </div>
                            </li>\n";
                        }
                        echo "</div>
                              <div class='modal-footer' style='color:#0B4C5F;'>
                                <!--<button type='button' class='btn btn-default pull-left' data-dismiss='modal'>Close</button>
                                <button type='button' class='btn btn-primary'>Sistema de Correspondencia</button>-->
                                Sistema de Correspondencia

                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->";


                        echo '</ul>';

                    }
                  ?>
                </center>

            </div>
          </div>
        </div>




        <!-- ./row -->
         <?php echo $content; ?>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <center>
      <h5>Panel de ayuda</h5>
      </center>
      <hr style="color: white; background-color: white;">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active" style="background-color: #086A87;">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                 Video Tutoriales
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"  style="background-color: gray;">
                <a href="index.php?r=site/videoTutor&nombre=login&mensaje='Inicio de sesion'" class="nav-link active"   style="background-color: lightgray;">
                  <i class="fa fa-pencil-square-o nav-icon" style="color: black"></i>
                  <p style="color: black">Inicio de Sesi&oacute;n</p>
                </a>
              </li>
              <li class="nav-item"  style="background-color: gray;">
                <a href="#" class="nav-link active"   style="background-color: lightgray;">
                  <i class="fa fa-pencil-square-o nav-icon" style="color: black"></i>
                  <p style="color: black">Video Tutoriales</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li>
            <br>
          </li>

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active" style="background-color: #086A87;">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                ++ Opciones ++
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"  style="background-color: gray;">
                <a href="#" class="nav-link active"   style="background-color: lightgray;">
                  <i class="fa fa-pencil-square-o nav-icon" style="color: black"></i>
                  <p style="color: black">Manual de Usuario</p>
                </a>
              </li>
              <li class="nav-item"  style="background-color: gray;">
                <a href="#" class="nav-link active"   style="background-color: lightgray;">
                  <i class="fa fa-pencil-square-o nav-icon" style="color: black"></i>
                  <p style="color: black">Video Tutoriales</p>
                </a>
              </li>
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Sistemas
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 S.A.C. Versi&oacute;n 1.</strong>
    <!-- <strong>Copyright &copy; 2019 S.A.C. Versi&oacute;n 1.  - <a href="http://www.abc.gob.bo" target="_blank">Administradora Boliviana de Carreteras</a>.</strong> -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap 4 -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/adminlte.min.js"></script>

<!-- jQuery -->
<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/jquery/jquery.min.js"></script> -->


</body>
</html>

<?php
// codigo javascript para el mensjae flash
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info_alert").animate({opacity: 1.0}, 200).fadeOut("slow");',
   CClientScript::POS_READY
);
?>
