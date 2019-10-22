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
        <a href="#" class="nav-link">
          <i class="fa fa-file-text-o"></i>
          Generar Documentos
        </a>
      </li>
      <li class="nav-item d-none d-xl-inline-block">
        <a href="#" class="nav-link">
          <i class="fa fa-stack-overflow"></i>
          Que deben llegar
        </a>
      </li>
      <li class="nav-item d-none d-xl-inline-block">
        <a href="#" class="nav-link">
          <i class="fa fa-hand-peace-o"></i>
          Pendientes
        </a>
      </li>
      <li class="nav-item d-none d-xl-inline-block">
        <a href="#" class="nav-link">
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
          <a class="dropdown-item">
            <i class="fa fa-file-text-o mr-2"></i> 
              <b>NUR/NURI(s)</b> derivados
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item">
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
                <a class="nav-link active">
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
                <a class="nav-link active">
                  <i class="fa fa-search-plus nav-icon"></i>
                  <p>Opciones de B&uacute;squeda</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Lista Derivaci&oacute;n</p>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link active">
                  <i class="fa fa-low-vision nav-icon"></i>
                  <p>Borradores&nbsp;&nbsp; <b>(<?=Documentos::countBorradores()?>)</b></p>
                </a>
              </li>

          <?php if (Yii::app()->user->id_nivel==5) { ?>
              <li class="nav-item">
                <a  class="nav-link active">
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
                <a class="nav-link active">
                  <i class="fa fa-file-text-o mr-2"></i> 
                    <b>NUR/NURI(s)</b> derivados
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active">
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
                <a class="nav-link active">
                  <i class="fa fa-newspaper-o nav-icon"></i>
                  <p>Reportes</p>
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
                <a class="nav-link active">
                  <i class="fa fa-tasks nav-icon"></i>
                  <p>Parametros</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active">
                  <i class="fa fa-group nav-icon"></i>
                  <p>Administrar Usuarios</p>
                </a> 
              </li>
              <li class="nav-item">
                <a class="nav-link active">
                  <i class="fa fa-cogs nav-icon"></i>
                  <p>Administraci&oacute;n </p>
                </a> 
              </li>
              <li class="nav-item">
                <a class="nav-link active">
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
<!-- ################################################################################################################################### -->
<!-- ################################################################################################################################### -->


<head>

<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.treeview.css" />
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cookie.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.treeview.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo.js"></script>



 


</head>
<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */

$array_meses=array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');

$this->breadcrumbs=array(
  'Seguimientoses'=>array('index'),
  'Create',
);
$nuri=strtoupper($nuri);
?>
             <!-- /.card-body -->
                  <!-- text input -->
                  <!--<i  class="fa fa-paw"></i>
                  <i  class="fa fa-envelope"></i>
                  <i  class="fa fa-user"></i>
                  <i  class="fa fa-comments"></i>
                  <i  class="fa fa-commenting"></i>
                  <i  class="fa fa-pencil"></i>
                  <i  class="fa fa-file-text-o"></i>-->


<?php //echo "-----> ".$nuri ?>
<center>
<a class="btn btn-app btn-sm" href="index.php?r=seguimientos/printBusquedaIndex&nuri=<?=$nuri?>" target="_blank" style="color:white; background-color:#086A87; ">
    <i class="fa fa-print"></i>Imprimir Seguimiento
</a>
</center>
<h3><strong>Detalle de seguimiento </strong></h3>





<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                  <!--<i  style="font-size: 20px; color: black;" class="fa fa-search"></i>-->
                  <i  class="fa fa-search"></i>
                  B&uacute;squeda de NURI/NUR: <b><?=$nuri?></b>.
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
      <div class="row">
        
       <?php 
       // codigo para verificar si el nuri esta registrado 
       // en la base de datos Postgres nueva
       // en caso de existir nos muestra el valor de la nueva base de datos
       if (Seguimientos::countNuriHojasRuta($nuri)>0) {

          $row=Seguimientos::getCabeceraSeguimiento($nuri);
          $tipo_documento=$row['tipo_doc'];
          $fecha_creacion=$row['fecha_creacion'];
          $hora_creacion=$row['hora_creacion'];
          $cite=$row['cite'];
          $adjunto=$row['adjunto'];
          $referencia=$row['referencia'];
          $destinatario=$row['destinatario'];
          $id_doc=$row['id_doc'];
          $remitente_institucion=$row['rem_institucion'];
          $remitente=$row['remitente'];
          $bandera_remitente=0;
          

       }
       else{
          $row=Seguimientos::getCabeceraSeguimientoMYSQL($nuri);
          $tipo_documento=$row['tipo_documento'];
          $fecha_creacion=$row['fecha'];
          $hora_creacion='';
          $cite=$row['cite'];
          $adjunto=$row['adjuntos'];
          $referencia=$row['referencia'];
          $destinatario=$row['destinatario'];
          $remitente_institucion=$row['remitente_institucion'];
          $remitente=$row['remitente'].' - '.$row['remitente_cargo'];
          $id_doc=$cite;
          $bandera_remitente=0;

          if ($tipo_documento=='CARTA EXTERNA') {
            $remitente=1;
          }

       }



       ?> 

        <div class="col-md-9"><!-- inicio -->
         <div class="card-body">       
                  <div class="card-body pad table-responsive">
                    <?php //$row=Seguimientos::getCabeceraSeguimiento($nuri); 
                      //$id_doc=$row['id_doc'];
                    ?>
                   <table class="table-bordered table-striped" id="table_cabecera_seguimiento" style="font-size: 15px;" >
                  <tr>
                    <th><i  class="fa fa-files-o"></i> Tipo Documento</th>
                    <td><?=$tipo_documento?></td>
                    <th><i  class="fa fa-calendar"></i> Fecha/Hora Creaci&oacute;n</th>
                    <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($fecha_creacion))." - ".$hora_creacion?></td>  
                  </tr>
                  <tr>
                    <th><i  class="fa fa-pencil"></i> CITE</th>
                    <td>
                       <?php 
                       // codigo para mostrar los documentos asociados
                       // en el nuevo sistema
                       if (Seguimientos::countNuriHojasRuta($nuri)>0) {

                        $dataReader=Documentos::getNurisAsociados($nuri);
                        $l=0;
                        foreach($dataReader as $row2) {  ?>
                        <div class="tooltip3 tooltip-effect-1"><div class="tooltip-item">   
                        <?php    $l++;
                            echo CHtml::ajaxLink($row2['codigo'],
                              $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$row2['id_documento'])),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                            ),
                            array('id'=>'showJuiDialog'.$l, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                            ); echo "<br>"; ?>
                          </div>
                        <div class="tooltip-content clearfix" style="padding-left: 12px;"><div class="tooltip-text">Click en el enlace para ver el documento  </div>
                         </div>
                        </div><!-- tooltip3 tooltip-effect-1-->  
                        <br>
                      <?php  } // fin foreach

                       }
                       else{
                          //$row=Seguimientos::getCabeceraSeguimientoMYSQL($nuri);
                          $dataReader=Seguimientos::getNurisAsociadosMYSQL($nuri);
                          $i=0;
                          foreach($dataReader as $row2) {  ?>
                          <div class="tooltip3 tooltip-effect-1"><div class="tooltip-item">   
                          <?php    $i++;
                              echo CHtml::ajaxLink($row2['codigo'],
                                $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$row2['codigo'])),
                              array(
                                  'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                              ),
                              array('id'=>'showJuiDialog0'.$i, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                              ); echo "<br>"; ?>
                            </div>
                          <div class="tooltip-content clearfix" style="padding-left: 12px;"><div class="tooltip-text">Click en el enlace para ver el documento  </div>
                           </div>
                          </div><!-- tooltip3 tooltip-effect-1-->  
                          <br>
                        <?php  } // fin foreach
                        }
                       ?> 




                    </td> 
                    <th><i  class="fa fa-chain"></i> Adjuntos</th>
                    <td><?=$adjunto?></td>
                  </tr>
                  <tr>
                    <th><i  class="fa fa-commenting-o"></i> Referencia</th>
                    <td colspan="3"><?=$referencia?></td>  
                  </tr>
                  <tr>
                    <th><i  class="fa fa-user"></i> Remitente</th>
                    <td colspan="3"><?=$remitente?></td>  
                  </tr>
                  <tr>
                    <th><i  class="fa fa-user-o"></i> Destinatario</th>
                    <td colspan="3"><?=$destinatario?></td>  
                  </tr>
                  <?php 
                    if ($tipo_documento=='CARTA EXTERNA') {
                  ?>
                  <tr>
                    <th><i  class="fa fa-user-o"></i> Instituci&oacute;n Remitente</th>
                    <td colspan="3"><?=$remitente_institucion?></td>  
                  </tr>
                  <?php } ?>

                  <?php 

                    //CODIGO PARA VER EL DOCUMENTO ESCANEADO DEL SAC
                    if (count(Seguimientos::listaCartaExterna($nuri))>0){ ?>
                    
                    <tr>
                      <th><i  class="fa fa-file-text-o "></i> Documento Escaneado</th>
                      <td colspan="3">
                        <?php 
                        $dataReader=Seguimientos::listaCartaExterna($nuri); 
                        foreach ($dataReader as $row2) {
                          
                          echo CHtml::link(
                            "<b style='color:#0074DE;'>".$row2['codigo']."</b>",
                            Yii::app()->createUrl('/Documentos/viewCartaPDF', array('filename' => $row2['ruta_documento'])) ,
                            array('class'=>'','target'=>'_blank', 'style'=>'color: black;'));
                          echo "<br>";
                        }
                        ?>
                      </td>  
                    </tr>
                      
                  <?php  }//if (count(Seguimientos::listaCartaExterna($nuri))>0){ 
                    else{ 

                        //CODIGO PARA VER EL DOCUMENTO ESCANEADO DEL SIACO
                        if($tipo_documento=='CARTA EXTERNA') {
                          // codigo para separar la fecha del cite asociado al nuri y visualizar
                          $fecha_aso=explode(' ', $fecha_creacion);
                          $fecha=explode('-',$fecha_aso[0]);
                          $anio=$fecha[0];
                          $mes=$fecha[1]+0;
                          //$numero=($mes-1);
                          $nombre_mes=$array_meses[$mes-1];
                          $dia=$fecha[2];
                          for ($i=0; $i <count($array_meses) ; $i++) { 
                            //echo "<br>".$array_meses[$i];
                          }

                          $nuevo_cite = str_replace("/", "_", $cite); 
                    ?>
                         <tr>
                            <th><i  class="fa fa-file-text-o "></i> Documento Escaneado</th>
                            <td colspan="3">
                              <a href="http://siaco.abc.gob.bo/documentos/<?=$anio?>/<?=$nombre_mes?>/<?=$dia?>/<?=$nuevo_cite?>/<?=$nuevo_cite?>.PDF" target="_blank" ><?=$cite?></a>
                              <!--<a href="doc_siaco/<?=$anio?>/<?=$nombre_mes?>/<?=$dia?>/<?=$nuevo_cite?>/<?=$nuevo_cite?>.PDF" target="_blank" ><?=$cite?></a>-->
                            </td>  
                          </tr>
                    <?php 
                        }//if($tipo_documento=='CARTA EXTERNA') {
                  } //else{
                  ?>
                  <!--############## CODIGO PARA MSTRAR SI EL NURI PERTENECE A UN AGRUPADO DEL SIACO-->

                  <?php if (Seguimientos::getListaNurisAgrupadosSegundarioSIACOCount($nuri)>0) { 
                        $nuri_principal_mysql=Seguimientos::getNuriPrincipalMysql($nuri);
                  ?>
                  <tr>
                    <th><i  class="fa fa-group"></i> Agrupaci&oacute;n</th>
                    <td colspan="3" style="color:darkred;">Una copia de este documento pertenece al NUR/NURI Principal 

                      <div class="tooltip3 tooltip-effect-1">
                        <div class="tooltip-item">
                          
                           <b><a href="index.php?r=seguimientos/busquedaIndex&nuri=<?=$nuri_principal_mysql?>"><?=$nuri_principal_mysql?></a></b>
                          <?php 
                           /*echo CHtml::ajaxLink($nuri_principal,
                              $this->createUrl('seguimientos/busquedaNuriPrincipal', array("nuri"=>$nuri_principal)),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}',
                            ),
                            array(
                                    'id'=>'showJuiDialog3', 
                                    'style'=>'font-size:20px; ',
                                  ) // not very useful, but hey...
                            );*/
                          ?>
                        </div>
                        <div class="tooltip-content clearfix" style="padding-left: 12px;">
                          <div class="tooltip-text"> Usted puede ver el seguimiento del NUR/NURI Principal seleccionando este enlace  </div>
                         </div>
                        </div><!-- tooltip3 tooltip-effect-1-->
                      </td>  
                    </tr>

                    <?php 
                    }
                  ?>


                  <!--############## CODIGO PARA MSTRAR SI EL NURI PERTENECE A UN AGRUPADO DEL SAC-->
                  <?php if (Seguimientos::countNuriSecundarioAgrupacion($nuri)>0) { 
                        $nuri_principal=Seguimientos::getNuriPrincipal($nuri); 
                  ?>
                  <tr>
                    <th><i  class="fa fa-group"></i> Agrupaci&oacute;n</th>
                    <td colspan="3" style="color:darkred;">Una copia de este documento pertenece al NUR/NURI Principal 

                      <div class="tooltip3 tooltip-effect-1">
                        <div class="tooltip-item">


                          <a href="index.php?r=seguimientos/busquedaIndex&nuri=<?=$nuri_principal?>"><?=$nuri_principal?></a>
                          <?php 
                           /*echo CHtml::ajaxLink($nuri_principal,
                              $this->createUrl('seguimientos/busquedaNuriPrincipal', array("nuri"=>$nuri_principal)),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}',
                            ),
                            array(
                                    'id'=>'showJuiDialog3', 
                                    'style'=>'font-size:20px; ',
                                  ) // not very useful, but hey...
                            );*/
                          ?>
                        </div>
                        <div class="tooltip-content clearfix" style="padding-left: 12px;">
                          <div class="tooltip-text"> Usted puede ver el seguimiento del NUR/NURI Principal seleccionando este enlace  </div>
                         </div>
                        </div><!-- tooltip3 tooltip-effect-1-->
                      </td>  
                    </tr>

                    <?php 
                    }
                  ?>
                
               </table>
           </div>
                      
         </div>
           <!-- /.card -->
        </div><!-- fin -->

       
               

        <div class="col-md-3">
           <!-- /.card-header -->
          <div class="card-body">

            <!-- codigo obtenido de la raiz-->
            <!-- http://localhost/jquery-treeview-master/demo/ -->
            <?php if (Seguimientos::countNuriPrincipal($nuri)>0) { 

               $principal=' PRINCIPAL';
             } 
             else{ 

              if (Seguimientos::getListaNurisAgrupadossSIACOCount($nuri)) {
                $principal=' PRINCIPAL';
              }
              else{

              $principal=''; 
            }

            }
             ?>
            <h6 style="color:#0174DF; font-weight: bold;"><b><u>NUR/NURI <?=$principal?></u></b></h6>
              <ul id="browser" class="filetree">
                <li><i class="fa fa-folder-open-o" style="font-size: 21px;"></i>&nbsp;&nbsp;<b style="font-size:22px; color:#0B3861;"><?=$nuri?></b>
                  <ul>


                    <?php 
                     if (Seguimientos::getListaNurisAgrupadossSIACOCount($nuri)) {
                          $dataReader2=Seguimientos::getListaNurisAgrupadossSIACO($nuri); 
                           ?> 
                           <?php foreach ($dataReader2 as $row3) {  ?>
                               <li><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;

                              <a href="index.php?r=Seguimientos/busquedaIndex&nuri=<?=$row3['nur_s']?>"><?=$row3['nur_s']?></a>

                                <?php 
                           
                          /* echo CHtml::ajaxLink($row3['nur_s'],
                              $this->createUrl('seguimientos/busquedaNuriPrincipal', array("nuri"=>$row3['nur_s'])),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}',
                            ),
                            array(
                                    'id'=>'showJuiDialog3', 
                                    //'style'=>'font-size:20px; ',
                                  ) // not very useful, but hey...
                            ); */
                          ?>

                          <?php  }

                        }

                           ?>



                    <?php if (Seguimientos::countNuriPrincipal($nuri)>0) { 
                        $dataReader=Seguimientos::listaAgrupacion($nuri); 
                        foreach ($dataReader as $row2) {
                      ?>
                      <li><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;
                        
                          <a href="index.php?r=Seguimientos/busquedaIndex&nuri=<?=$row2['nur_hijo']?>"><?=$row2['nur_hijo']?></a>
                          <?php /* 
                           echo CHtml::ajaxLink($row2['nur_hijo'],
                              $this->createUrl('seguimientos/busquedaNuriPrincipal', array("nuri"=>$row2['nur_hijo'])),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}',
                            ),
                            array(
                                    'id'=>'showJuiDialog3', 
                                    //'style'=>'font-size:20px; ',
                                  ) // not very useful, but hey...
                            );
                          */?>

                        
                      </li>
                    <?php 
                          } // fin foreach
                        } ?>
                  </ul>
                </li>

              </ul><!-- fin ul-->

                      
          </div>
                  <!-- /.card -->
          </div>
               <!-- /.col -->
      </div>   




   
            
              
            


           

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialogClassroom',
    'options'=>array(
        'title'=>'Documento',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'60%',
        'height'=>670,
        'draggable' => false,
        //'position'=>array(600,600), 
        'position'=> array('my'=> "center", 'at'=> "center"),
        //'position'=>array('my'=>'center','at'=>'center', 'of' => ''),
    ),
));?>
<div class="divForForm"></div>

<?php $this->endWidget();?>

<script type="text/javascript">
// here is the magic
function addClassroom()
{
  <?php echo CHtml::ajax(array(
      'url'=>array('seguimientos/viewDocument', 'id'=>$id_doc),
      'data'=> "js:$(this).serialize()",
      'type'=>'post',
      'dataType'=>'json',
      'success'=>"function(data)
      {
        if (data.status == 'failure')
        {
          $('#dialogClassroom div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
          $('#dialogClassroom div.divForForm form').submit(addClassroom);
        }
        else
        {
          $('#dialogClassroom div.divForForm').html(data.div);
          setTimeout(\"$('#dialogClassroom').dialog('close') \",3000);
        }
        
      } ",
      ))?>;
  return false; 
  
}

</script>



      <!-- row -->
      <div class="row">
        <div class="col-md-12">

          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?=$nuri?> <b style="color: darkred;"><u>Oficial</u></b>
                  </span>
            </li>
            <!-- timeline item -->
            <li >
              <i class="fa fa-commenting " style="background-color: #0080FF; color: white;"></i>

              <div class="timeline-item">


                <div class="card-body pad table-responsive">
                <table  id="table_seguimiento" border="1" style="font-size:13px; ">
                  <tr>
                  <th>DERIVADO POR:</th>
                  <th>DERIVADO A:</th>
                  <th>DESPACHO</th>
                  <th>RECEPCI&Oacute;N</th>
                  <th>ACCI&Oacute;N</th>
                  <th>ESTADO</th>
                  <th>ADJUNTOS</th>
                </tr>
                  <!-- 
                  //#########################################################  
                  //codigo para mostrar el historico del nuri
                  // codigo para mostrar informaicon de la base de datios mysql
                  // siaco -->
                  <?php
                  $dataReader=Seguimientos::getSeguimientoMYSQL($nuri,2);
                  $i=0;
                  foreach($dataReader as $row) {
                    $i++;
                ?>
              <tr>
                <td rowspan="2">
                  <i  class="fa fa-paw" style="font-size: 21px;"></i>
                  <?=$row['nombre_origen']?>
                </td> 
                  <td rowspan="2">
                    <i  class="fa fa-paw" style="font-size: 21px;"></i>
                    <?=$row['nombre_destinatario']?>
                  </td>
                  <td>
                    <?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['fecha_derivacion']))?>
                    <?=$row['hora_derivacion']?>
                  </td>
                  <td>
                    <?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['fecha_recepcion']))?>
                    <?=$row['hora_recepcion']?>    
                  </td>
                  <td><?=$row['accion_seguimiento']?></td>
                  <td> 
                    <?php
                      
                      if ($row['estado']==100) {

                        echo CHtml::ajaxLink('<i class="fa fa-archive"></i>'.$row['estado_seguimiento'],
                              $this->createUrl('Seguimientos/viewDetalleArchivo', array("id"=>$row['id_seguimiento'])),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                            ),
                            array('id'=>'showJuiDialog2'.$i, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                            ); echo "<br>";
                      }
                      else{
                        echo $row['estado_seguimiento'];
                      }

                    ?>
                  </td>



                  <td align="center">
                    <?php
                    
                    $adjuntos=$row['adjuntos'];
                    if ($adjuntos!='') {

                    $row_adjunto=explode(',', $adjuntos);

                    $l=0;

                    for ($l=0; $l <count($row_adjunto) ; $l++) { 
                      
                        
                    //echo CHtml::ajaxLink($row['adjuntos'],
                              //$this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$adjuntos)),
                    $num=rand(11111111,99999999);  
                    echo CHtml::ajaxLink($row_adjunto[$l],
                              $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$row_adjunto[$l])),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                            ),
                            array('id'=>'showJuiDialog00'.$num, 'name'=>'showJuiDialog00'.$num, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                            ); echo "<br>";
                    }//for ($i=0; $i <count($row_adjunto) ; $i++) { 

                    
                    
                    }//if ($adjuntos!='') {

                    ?>


                  </td>
              </tr>
              <tr>
               <td colspan="5" style="background-color:#E0ECF8; "><b><u>PROVE&Iacute;DO:</u> </b><?=$row['proveido']?></td>
              </tr>
              <!-- -->
              <?php 
          
                  } //foreach($dataReader as $row) {
                ?>
                <!-- aqui finaliza el codigo extraido de la base MYSQL -->
                <!-- ############################################################### -->
                <tr><td colspan="7" bgcolor="#BDBDBD"></td></tr>
                
                <?php
                  $dataReader=Seguimientos::getSearchNuri($nuri,1);
                  $i=0;
                  foreach($dataReader as $row) {

                  //$total_contrato=$total_contrato+$row['total_contrato'];
                  if (($row['fk_estado']==1) || $row['fk_estado']==3 ) 
                  { $icono='<i class="fa fa-hand-peace-o" style="font-size:24px; color:#610B0B;"></i>'; 
                    $color='font-weight: bold;';
                    if ($row['confirmado']==1) {  $confirmado=' ';  }
                    else{ $confirmado='<i style="color:red; font-size:11px;">Sin confirmar</i>'; } //
                  }
                  else 
                  { 
                    $icono='<i class="fa fa-paw"  style="font-size: 21px;"></i>'; 
                    $color='';
                    $confirmado='';
                  } 
              ?>
              <tr>
                <td rowspan="2">
                  <i  class="fa fa-paw" style="font-size: 21px;"></i>
                  <?=$row['usuario_origen']?>
                </td> 
                  <td rowspan="2">
                    <?=$icono?><!-- codigo para mostrar el icono  -->
                    <?=$row['usuario_destino']?>
                  </td>
                  <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['f_derivacion']))." - ".$row['h_derivacion']?></td>
                  <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['f_recepcion']))." - ".$row['h_recepcion']?></td>
                  <td><?=$row['accion']?></td>
                  <td style="<?=$color?>">
                            <?php
                              
                              if ($row['fk_estado']==5) {

                                echo CHtml::ajaxLink('<i class="fa fa-archive"></i> '.$row['estado'],
                                      $this->createUrl('Seguimientos/viewDetalleArchivo', array("id"=>$row['id_seguimiento'])),
                                    array(
                                        'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                                    ),
                                    array('id'=>'showJuiDialog300000'.$i, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                                    ); echo "<br>";
                              }
                              else{
                                echo $row['estado']."<br>";
                                echo $confirmado;

                              }

                            ?>
                  </td>
                  <td align="center">
                    <?php 
                    
                    
                    if (Seguimientos::countSeguimientoHojaRuta($row['id_seguimiento'])>0) { 

                        $dataReader=Seguimientos::getCiteHojaRuta($row['id_seguimiento']);
                        foreach($dataReader as $row2) {  

                            $num2=rand(11111111111,9999999999);   
                            $i++;
                            echo CHtml::ajaxLink($row2['codigo'],
                              $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$row2['fk_documento'])),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                            ),
                            array('id'=>'showJuiDialog'.$num2, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                            ); echo "<br>";


                        } // fin foreach
                    } // fin if
                    else{
                       echo ""; 
                    }
                    ?>   
                  </td>
              </tr>
              <tr>
               <td colspan="5" style="background-color:#E0ECF8; "><b><u>PROVE&Iacute;DO:</u> </b><?=$row['proveido']?></td>
              </tr>
              <!-- <tr>
                <td colspan="7" bgcolor="#BDBDBD"></td>
              </tr>-->
              <?php 
          
                  } //foreach($dataReader as $row) {
                ?>
            </table>
           </div> 

              </div>
            </li>
            <!-- END timeline item -->
           
          </ul>
        </div>
        <?php 
// codigo para mostrar el popup dinamico mencionado en la tabla de seguimiento
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'juiDialog3',
                'options'=>array(
                    'title'=>'Documento',
                    'autoOpen'=>false,
                    'modal'=>true,
                    'width'=>'60%',
                    'height'=>670,
                ),

                ));

$this->endWidget();
//############################################
?>



        <!-- /.col -->
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?=$nuri?> <b style="color: darkred;"><u>Copias Digitales</u></b>
                  </span>
            </li>
            <!-- /.timeline-label -->
           
            <!-- timeline item -->

            <li >
              <i class="fa fa-commenting " style="background-color: #0080FF; color: white;"></i>

              <div class="timeline-item">
                <div class="card card-default "><!--collapsed-card-->
                  <div class="card-header">
                    <h3 class="card-title">Copia Digital</h3>
                      <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                          </button>
                    </div>
                    <!-- /.card-tools -->
               </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                     <table  id="table_seguimiento" border="1"  style="font-size:13px; ">
                        <tr>
                          <th>DERIVADO POR:</th>
                          <th>DERIVADO A:</th>
                          <th>DESPACHO</th>
                          <th>RECEPCI&Oacute;N</th>
                          <th>ACCI&Oacute;N</th>
                          <th>ESTADO</th>
                          <th>ADJUNTOS</th>
                        </tr>

                  <!-- 
                  //#########################################################  
                  //codigo para mostrar el historico del nuri
                  // codigo para mostrar informaicon de la base de datios mysql
                  // siaco -->
                  <?php 

                        $dataReader=Seguimientos::getSeguimientoMYSQL($nuri,0);
                        $j=0;
                        foreach($dataReader as $row) {
                          $j++;
                          //$total_contrato=$total_contrato+$row['total_contrato'];
                      ?>  
                         <tr>
                          <td rowspan="2">
                            
                            <?=$row['nombre_origen']?>
                          </td> 
                            <td rowspan="2">
                              
                              <?=$row['nombre_destinatario']?>
                            </td>
                            <td>
                              <?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['fecha_derivacion']))?>
                              <?=$row['hora_derivacion']?>
                            </td>
                            <td>
                              <?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['fecha_recepcion']))?>
                              <?=$row['hora_recepcion']?>         
                            </td>
                            <td><?=$row['accion_seguimiento']?></td>
                            <td> 
                            <?php
                              
                              if ($row['estado']==51) {

                                echo CHtml::ajaxLink('<i class="fa fa-archive"></i> '.$row['estado_seguimiento'],
                                      $this->createUrl('Seguimientos/viewDetalleArchivo', array("id"=>$row['id_seguimiento'])),
                                    array(
                                        'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                                    ),
                                    array('id'=>'showJuiDialog3'.$j, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                                    ); echo "<br>";
                              }
                              else{
                                echo $row['estado_seguimiento'];
                              }

                            ?>
                          </td>
                            <td align="center">
                              <?php
                              
                              $adjuntos=$row['adjuntos'];
                              if ($adjuntos!='') {
                                  
                              echo CHtml::ajaxLink($row['adjuntos'],
                                        $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$adjuntos)),
                                      array(
                                          'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                                      ),
                                      array('id'=>'showJuiDialog000000'.$j, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                                      ); echo "<br>";
                                }  

                              ?>


                            </td>
                        </tr>
                        <tr>
                          <td colspan="5"><b><u>PROVE&Iacute;DO:</u> </b><?=$row['proveido']?></td>

                        </tr>
                      <?php 
                  
                          } //foreach($dataReader as $row) {
                        ?>

                  <!-- aqui finaliza el codigo extraido de la base MYSQL -->
                  <!-- ###################################################### -->
                    <tr><td colspan="7" bgcolor="#BDBDBD"></td></tr>

                      <?php 
                        $i=0;
                        $dataReader=Seguimientos::getSearchNuri($nuri,0);
                        foreach($dataReader as $row) {
                          $i++;
                          //$total_contrato=$total_contrato+$row['total_contrato'];
                      ?>  
                     <tr>
                      <td rowspan="2">
                           <div class="numero_copia">
                              <?php
                                  if ($row['copia_padre']=='0') { $numero=''; }
                                  else { $numero=$row['copia_padre']; }
                                  echo $numero;
                               ?>
                            </div>
                        <?=$row['usuario_origen']?>
                      </td> 
                        <td rowspan="2">
                            <div class="numero_copia">
                              <?=$row['numero_copia']?>
                            </div>

                          <?=$row['usuario_destino']?>
                        </td>
                        <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['f_derivacion']))." - ".$row['h_derivacion']?></td>
                        <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['f_recepcion']))." - ".$row['h_recepcion']?></td>
                        <td><?=$row['accion']?></td>
                        <td>
                            <?php
                              
                              if ($row['fk_estado']==6) {

                                echo CHtml::ajaxLink('<i class="fa fa-archive"></i> '.$row['estado'],
                                      $this->createUrl('Seguimientos/viewDetalleArchivo', array("id"=>$row['id_seguimiento'])),
                                    array(
                                        'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                                    ),
                                    array('id'=>'showJuiDialog3'.$i, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                                    ); echo "<br>";

                                $confirmado=' ';
                              }
                              else{
                                echo $row['estado'];
                                if ($row['confirmado']==1) {  $confirmado=' ';  }
                              else{ $confirmado='<br> <i style="color:red; font-size:11px;">Sin confirmar</i>'; } 

                              }

                              echo $confirmado;

                            ?>
                              
                        </td>
                        <td>
                            <?php 
                    
                    
                          if (Seguimientos::countSeguimientoHojaRuta($row['id_seguimiento'])>0) { 

                              $dataReader=Seguimientos::getCiteHojaRuta($row['id_seguimiento']);
                              foreach($dataReader as $row2) {   
                                $num3=rand(111111,999999);
                                  $i++;
                                  echo CHtml::ajaxLink($row2['codigo'],
                                    $this->createUrl('Seguimientos/viewDocumentSeguimiento', array("id"=>$row2['fk_documento'])),
                                  array(
                                      'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}'
                                  ),
                                  array('id'=>'showJuiDialog'.$num3, 'style'=>'color:#0174DF; font-weight: bold;') // not very useful, but hey...
                                  ); echo "<br>";


                              } // fin foreach
                          } // fin if
                          else{
                             echo ""; 
                          }
                          ?>        
                        </td>
                    </tr>
                    <tr>
                      <td colspan="5"><b><u>PROVE&Iacute;DO:</u> </b><?=$row['proveido']?></td>
                    </tr>
                      <?php 
                  
                          } //foreach($dataReader as $row) {
                        ?>
                </table>
              </div>
                </div>
                <!-- /.card-body -->
        </div>
        <!-- /.card -->




                  

              </div>
            </li>
            <!-- END timeline item -->
            
            
            
            <li>
              <i class="fa fa-clock-o " style="background-color: #0080FF; color: white;"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->



        




      </div>
      <!-- /.row -->



                  
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>



<!-- ################################################################################################################################### -->
<!-- ################################################################################################################################### -->




        <!-- ./row -->
         <?php echo $nuri; ?>
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
