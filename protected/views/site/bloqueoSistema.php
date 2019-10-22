<!DOCTYPE html>
<?php 

if (Yii::app()->user->isGuest){
  $this->redirect(array('login'));
 }

?>
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
<!-- jQuery -->
<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/dist/js/plugins/jquery/jquery.min.js"></script>-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>


 <!-- Estilos para tooltip -->
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tooltip-classic.css">
<!-- Estilos creados por Alvaro Canqui -->
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/estilos.css">


  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/adminlte.min.css">




   


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav" >
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#">
              <i class="fa fa-bars"></i>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a  class="nav-link"><i class="fa fa-home nav-icon"></i> Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link"><i class="fa fa-file-text-o"></i> Generar Documento</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link"><i class="fa fa-stack-overflow"></i> Que deben llegar</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link"><i class="fa fa-hand-peace-o"></i> Pendientes</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a  class="nav-link"><i class="fa fa-ravelry"></i> Pendientes Digitales</a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">B&uacute;squeda</a>
      </li>-->
    </ul>
    <!-- SEARCH FORM -->

    <!--<form class="form-inline ml-3">-->
    <div class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar..." aria-label="Search" id="inputBuscar" required>
        <div class="input-group-append">
          <button class="btn btn-navbar">
            <i class="fa fa-search"></i>
          </button>
          <!--<a class="btn btn-navbar">
            <i class="fa fa-search"></i>
          </a>-->
        </div>
      </div>
    </div>  
    <!--</form>-->



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o"></i>
          <span class="badge badge-danger navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a  class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/man_brown.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  
                  <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">No cambiaste tu contraseña</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 
                   hace 0 d&iacute;as
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>

          <div class="dropdown-divider"></div>
          <!-- # VERIFICAMOS QUE LA CONTRASEÑA CONTINUE SIENDO QWERTY-->

        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">Notificaciones</span>
          
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-clipboard mr-2"></i>
              Que deben llegar (Oficiales)
            <!--<span class="float-right text-muted text-sm">3 mins</span>-->
          </a>

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-clipboard mr-2"></i> 
              &nbsp;&nbsp;
              Que deben llegar (Digitales)
            <!--<span class="float-right text-muted text-sm">3 mins</span>-->
          </a>

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-stack-overflow mr-2"></i> 
              &nbsp;&nbsp;
              Pendientes oficiales
            <!--<span class="float-right text-muted text-sm">12 hours</span>-->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-file-text mr-2"></i> 
              &nbsp;&nbsp;
              Pendientes digitales
            <!--<span class="float-right text-muted text-sm">2 days</span>-->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-file mr-2"></i> Reportes
            <!--<span class="float-right text-muted text-sm">2 days</span>-->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Todas las Notificaciones</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/img/ABClogo.png" alt="ABC" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Panel Administraci&oacute;n</span>
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
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/img/ICONODaplicacion.png" class="img-circle elevation-2" alt="User Image">
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
                <a class="nav-link active">
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
                  <i class="fa fa-file-text nav-icon"></i>
                  <p>Reportes</p>
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
          




          <li class="nav-item">
            <a href="index.php?r=site/logout" class="nav-link">
              <span class="right badge badge-danger">
                <i class="nav-icon fa fa-ban"></i>
              </span>  
              <p>
                Salir
                <!--<span class="right badge badge-danger">...</span>-->
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
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/img/ICONODaplicacion.png" class="img-circle elevation-2" alt="User Image">
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
              <h1 class="m-0 text-dark"><b>Sistema Automatizado de Correspondencia - 2018</b></h1>
            </center>
          </div>
          <!-- /.col -->
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">SIACO</a></li>
              <li class="breadcrumb-item active">Inicio</li>
            </ol>
          </div>--> <!-- /.col -->
        </div><!-- /.row -->
        <br> 
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

      
      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                  Es necesario recepcionar los siguientes <b>NUR/NURI</b>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <!-- text input -->
                 <style type="text/css">
          .fila{
                  border-bottom: .5px solid #1C1C1C;
               }
          </style>

          <center>

          <b class="parpadea text" style="font-size: 25px; color:#0B2F3A; ">
                    <i class="fa fa-exclamation-triangle nav-icon"></i>
                    <u>Usuario Bloqueado</u> 
          </b>
          </center>

          <div class="card-body pad table-responsive">
            <table align="center" class="tabla_agrupacion" width="100%" cellspacing="0" cellpadding="6" class="table table-bordered table-striped" border="1">
              <tr style="font-size: 14px; background-color: #086A87; padding:6px; color: white;  text-align: center;">
                <th><br>NUR/NURI<br></th>
                <th><br>Derivado por<br></th>
                <th><br>Fecha/Hora Derivaci&oacute;n<br></th>
                <!--<th style="font-size:12px;">Prove&iacute;do</th>-->
                <th><br>Acci&oacute;n<br></th>
                <th><br>Estado<br></th>
                <th><br></th>
                <th><br></th>
              </tr>
              <?php $dataReader=Seguimientos::getNoRecibidosUsuario(Yii::app()->user->id_usuario); ?> 

              <?php 
                $i=0;
                foreach ($dataReader as $row) { 
                $i++;

                if(($i%2)==0){$color='#E6E6E6';}
                else{$color='white';}

               ?>  
                <tr  style="font-size: 9px; background-color:<?=$color?> " class="fila">

                  <td align="center" style="font-size: 12px;">
                    <i style="font-size: 10px; font-weight: bold; text-align: center;" >
                    <?php if ($row['tipo_documento']=='ORIGINAL') {
                      ?><i  class="fa fa-hand-peace-o" style="font-size: 28px; color: darkblue;"></i> <?php
                    } ?>  <br>
                    <?=$row['tipo_documento']?></i><br>
                    <?=$row['nuri']?>
                  </td>
                  <td style="font-size: 12px; text-align: left;" ><?=$row['usuario_origen']?></td>
                  <td style="font-size: 12px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
                  <!--<td style="font-size: 12px;"><? //=$row['proveido']?></td>-->
                  <td style="font-size: 12px;" align="center"><?php $cantidad= Seguimientos::getMostrarMensajeBloqueoNuri($row['f_derivacion']);

                    if($cantidad<0){ echo "<i style='color:red;'>Nuri Bloqueado</i> "; }
                    else{ echo "<i style='color:green;'>Disponible </i>"; }
                   ?> 
                    
                  </td>
                  <td style="font-size: 12px;" align="center"><?=$row['estado']?></td>
                  <td align="center">
                    <?php echo CHtml::link('<i class="fa fa-download" style="font-size: 20px;"></i> Recibir',array('seguimientos/recibirDocumentoBloqueo','id_seguimiento'=>$row['id_seguimiento']), array('class'=>'btn btn-danger btn-sm')); ?>
                  </td>
                  <td align="center">
                    <?php echo CHtml::link('<i class="fa fa-paw" style="font-size: 20px;"></i> Seguimiento',array('seguimientos/busquedaBloqueo','nuri'=>$row['nuri']), array('class'=>'btn btn-info btn-sm')); ?>
                  </td>
                  <!--<td align="center">
                    <?php /* echo CHtml::link('<i class="fa fa-paw" style="font-size: 20px;"></i> Seguimiento',array('seguimientos/recibirDocumentoBloqueo','id_seguimiento'=>$row['id_seguimiento']), array('class'=>'btn btn-info  btn-sm')); */ ?>

                    <br><br>

                    <?php 
                        /*   echo CHtml::ajaxLink($row['nuri'],
                              $this->createUrl('seguimientos/busquedaBloqueo', array("nuri"=>$row['nuri'])),
                            array(
                                'success'=>'function(r){$("#juiDialog3").html(r).dialog("open"); return false;}',
                            ),
                            array(
                                    'id'=>'showJuiDialog3', 
                                    'class'=>'btn btn-info  btn-sm',
                                  ) 
                            ); */
                    ?>
                  </td>-->
               </tr>
              <?php } ?>
               
            </table>
          </div>
          <br>
                           
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
    <strong>Copyright &copy; S.A.C. Versi&oacute;n 2019.</strong>
    <!-- <strong>Copyright &copy; S.A.C. Versi&oacute;n 2019 - <a href="http://www.abc.gob.bo" target="_blank">Administradora Boliviana de Carreteras</a>.</strong> -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap 4 -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/adminlte.min.js"></script>
</body>
</html>