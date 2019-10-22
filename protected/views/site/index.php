<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIACO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
    <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
</head>


<?php



if (Yii::app()->user->isGuest){
  $this->redirect(array('login'));
 }


// codigo para bloquear el sistema en caso de documentos no recpecionados
 if (Seguimientos::getVerificaSiHayPendientes()>0) {

    $num=Seguimientos::getMensajeBloqueoUsuario();
      if ($num<=0) {
        $this->redirect(array('site/bloqueoSistema'));
      }
  }

//$password='qwerty';
//echo hash('sha512', $password);

// codigo para solicitar cambio de contraseña si fuera generico
if (Usuarios::getObtenerP()==1) {
  $this->redirect(array('usuarios/updatePassword'));
}


	$this->pageTitle=Yii::app()->name;
?>
<!-- Content Wrapper. Contains page content -->
  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- =========================================================== -->
        <h5 class="mt-4 mb-2">REPORTES VARIOS </h5>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon" style="border:1px solid white; font-size:40px;"><i class="fa fa-id-badge"></i></span>

              <a href="index.php?r=seguimientos/documentacionDespachadaPDF&id_usuario=<?=Yii::app()->user->id_usuario;?>" style="text-decoration: none; color: black;">
              <div class="info-box-content">
                <span class="info-box-text"><b>Reporte </b></span>
                <span class="info-box-number">Derivados </span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  (Documentaci&oacute;n Despachada)
                </span>
              </div>
              </a>


              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon" style="border:1px solid white; font-size:40px;"><i class="fa fa-share-square-o"></i></span>

              <a href="index.php?r=documentos/adminSinDerivar" style="text-decoration: none; color: black;">
              <div class="info-box-content">
                <span class="info-box-text"><b>Sin </b></span>
                <span class="info-box-number">Derivar</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  (Documentos, H.S. sin derivar)
                </span>
              </div>
              </a>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon" style="border:1px solid black; font-size:40px;"><i class="fa fa-user-circle-o"></i></span>

              <a href="index.php?r=seguimientos/pendientesUsuarioEXCEL&id_usuario=<?=Yii::app()->user->id_usuario;?>" style="text-decoration: none; color: black;">
              <div class="info-box-content">
                <span class="info-box-text"><b>Pendientes</b></span>
                <span class="info-box-number">de Usuario (Excel)</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  (Recibidos y sin recepci&oacute;n)
                </span>
              </div>
              </a>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon" style="border:1px solid white; font-size:40px;"><i class="fa fa-sitemap"></i></span>

              <a href="index.php?r=seguimientos/pendientesArea" style="text-decoration: none; color: black;">
              <div class="info-box-content">
                <span class="info-box-text"><b>Reporte </b></span>
                <span class="info-box-number">Pendientes</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  (Pendientes &Aacute;rea/Unidad)
                </span>
              </div>
              </a>


              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- =========================================================== -->
        
        
        <!--<div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-file-text-o"></i></span>
              <div class="info-box-content">
                <a href="index.php?r=seguimientos/documentacionDespachadaPDF&id_usuario=<?php //Yii::app()->user->id_usuario;?>" style="text-decoration: none; color: black;">
                <span class="info-box-text"><i>(Documentaci&oacute;n Despachada)</i></span>
                <span class="info-box-number">Reporte Derivados</span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa fa-file-text"></i></span>

              <div class="info-box-content">
                <a href="index.php?r=documentos/adminSinDerivar" style="text-decoration: none; color: black;">
                <span class="info-box-text"><i>(Documentos, H.S. sin derivar)</i></span>
                <span class="info-box-number">Sin Derivar</span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa fa-files-o"></i></span>
              <div class="info-box-content">
                <a href="index.php?r=seguimientos/pendientesUsuarioPDF&id_usuario=<?php //Yii::app()->user->id_usuario;?>" style="text-decoration: none; color: black;">
                <span class="info-box-text"><i>(Recibidos y sin recepci&oacute;n)</i></span>
                <span class="info-box-number">Pendientes Usuario</span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fa fa-file-o"></i></span>

              <div class="info-box-content">
                <a href="index.php?r=seguimientos/pendientesArea" style="text-decoration: none; color: black;">
                <span class="info-box-text"><i>(Pendientes &Aacute;rea/Unidad)</i></span>
                <span class="info-box-number">Reporte Pendientes</span>
              </a>
              </div>
            </div>
          </div>
        </div> -->

        <!-- =========================================================== -->

        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4">RESUMEN</h5>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->


            <div class="small-box bg-info" onclick="location.href='index.php?r=seguimientos/documentosLlegar';" style="cursor:pointer;" >
            
              <div class="inner">
                <h3>&nbsp;&nbsp;
                  <?=Seguimientos::countQueDebenLlegar(1,Yii::app()->user->id_usuario)+Seguimientos::countQueDebenLlegar(0,Yii::app()->user->id_usuario)?>
                </h3>

                <p>Que deben llegar</p>
              </div>
              <div class="icon">
                <i class="fa fa-stack-overflow"></i>
              </div>
                <a href="index.php?r=seguimientos/documentosLlegar" class="small-box-footer">
                Abrir Bandeja <i class="fa fa-arrow-circle-right"></i>
                </a>
            
            </div>


          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success" onclick="location.href='index.php?r=seguimientos/pendientesOficiales';" style="cursor:pointer;" >
              <div class="inner">
                <h3>&nbsp;&nbsp;
                  <?=Seguimientos::countPendientes(1,1,Yii::app()->user->id_usuario)?> 
                  <!--<sup style="font-size: 20px">%</sup>-->
                </h3>

                <p>Pendientes Oficiales</p>
              </div>
              <div class="icon">
                <i class="fa fa-hand-peace-o"></i>
              </div>
              <a href="index.php?r=seguimientos/pendientesOficiales" class="small-box-footer">
                Abrir Bandeja <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning" onclick="location.href='index.php?r=seguimientos/pendientesDigitales';" style="cursor:pointer;" >
              <div class="inner">
                <h3>&nbsp;&nbsp;
                  <?=Seguimientos::countPendientes(0,2,Yii::app()->user->id_usuario)?>
                </h3>

                <p>Pendientes Digitales</p>
              </div>
              <div class="icon">
                <i class="fa fa-ravelry"></i>
              </div>
              <a href="index.php?r=seguimientos/pendientesDigitales" class="small-box-footer">
                Abrir Bandeja <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger" onclick="location.href='index.php?r=seguimientos/documentosLlegarUrgente';" style="cursor:pointer;" >
              <div class="inner">
                <h3>&nbsp;&nbsp;
                   <?=Seguimientos::countQueDebenLlegarUrgente()?>
                </h3>
                <p><b>NUR/NURI(s) Urgentes</b></p>
              </div>
              <div class="icon">
                <i class="fa fa-exclamation-triangle"></i>
              </div>
              <a href="index.php?r=seguimientos/documentosLlegarUrgente" class="small-box-footer">
                Abrir Bandeja <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          
        </div>
        <!-- /.row -->

        <!-- =========================================================== -->
        <div class="row">

        	<div class="col-md-12">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header" style="background-color: #086A87; color: white;">
                <h3 class="card-title">OPCIONES DISPONIBLES</h3>
              </div>


            <center>
              <div class="card-body">
                

                <a class="btn btn-app" href="index.php?r=seguimientos/recepcionBloque" style="color: black;">
                  <i class="fa fa-stack-exchange"></i> Recepci&oacute;n Bloque
                </a>

                <a class="btn btn-app" href="index.php?r=documentos/citesGestion" style="color: black;">
                  <i class="fa fa-address-book-o"></i> <b>CITES</b> Asignados
                </a>

                <a class="btn btn-app" href="index.php?r=site/menuDocumentos" style="color: black;">
                  <i class="fa fa-file-text-o"></i> Generar Documento
                </a>
                <a class="btn btn-app" href="index.php?r=usuarios/updatePassword" style="color: black;">
                  <i class="fa fa-users"></i> Cambiar Contraseña
                </a>
                <!--<a  href="index.php?r=archivadosDigitales/archivoGestion" class="btn btn-app" style="color: black;">
                  <i class="fa fa-archive"></i>Archivo Digital
                </a>-->
                <a href="index.php?r=site/menuBusqueda" class="btn btn-app" style="color: black;">
                  <i class="fa fa-search-plus"></i> B&uacute;squeda
                </a>
                <!--<a class="btn btn-app" style="color: black;">
                  <i class="fa fa-clipboard"></i> Hojas de Seguimiento
                </a>-->
                <a class="btn btn-app" href="index.php?r=hojasRuta/menuGestion" style="color: black;">
                  <i class="fa fa-newspaper-o"></i> NURI(s) Creados
                </a>
                <a href="index.php?r=seguimientos/adminCorregirDerivacion" class="btn btn-app" style="color: black;">
                  <i class="fa fa-external-link"></i> Corregir Derivaci&oacute;n
                </a>
                <a class="btn btn-app" href="index.php?r=site/menuDerivaciones" style="color: black;">
                  <i class="fa fa-list"></i> Lista Derivaci&oacute;n
                </a>
                <a class="btn btn-app" href="index.php?r=documentos/adminSinNuri" style="color: black;">
                  <i class="fa fa-edit"></i> Doc. sin <b>NURI</b>
                </a>

                <a class="btn btn-app" href="index.php?r=seguimientos/pendientesUsuarioEXCEL&id_usuario=<?=Yii::app()->user->id_usuario;?>" style="color: black;">
                  <i class="fa fa-file-excel-o"></i>Reporte Pendientes
                </a>

                <a class="btn btn-app" href="index.php?r=documentos/administracionObservados" style="color: black;">
                  <i class="fa fa-commenting"></i>Doc. Observados
                </a>

                <a class="btn btn-app" href="index.php?r=seguimientos/desagruparNuri" style="color: black;">
                  <i class="fa fa-exchange"></i>Desagrupar NURI(s)
                </a>

                <a class="btn btn-app" href="index.php?r=documentos/generarMembretadoWord" style="color: black;">
                  <i class="fa fa-file-text-o"></i>Hoja Membretada
                </a>

                <a class="btn btn-app" href="http://archivo.abc.gob.bo" target="_blank" style="color: black;">
                  <i class="fa fa-external-link"></i><b>Archivo SAD</b>
                </a>

                <a class="btn btn-app" href="index.php?r=documentos/citesArea" style="color: black;">
                  <i class="fa fa-reorder"></i><b>CITES</b> &Aacute;rea/Unidad
                </a>
              <?php  if (Yii::app()->user->id_nivel==3 OR Yii::app()->user->id_nivel==1 OR Yii::app()->user->id_nivel==2) { ?>
                <a class="btn btn-app" href="index.php?r=seguimientos/pendientesAreaDetalle" style="color: black;">
                  <i class="fa fa-file-powerpoint-o"></i><b>Pendientes &Aacute;rea/Unidad</b>
                </a>
              <?php } ?>    


              <?php  if (Yii::app()->user->usuario=='vcd') {
                
               ?>    
                <a class="btn btn-app" href="index.php?r=seguimientos/adminDigitalesVcd" style="color: black; background: #A9D0F5;">
                  <i class="fa fa-external-link"></i>Pendientes Digital
                </a>

                <a  href="index.php?r=archivadosDigitales/archivoGestion" class="btn btn-app" style="color: black;  background: #A9D0F5;">
                  <i class="fa fa-archive"></i>Archivo Digital
                </a>

              <?php } ?>    

                <!--<a class="btn btn-app">
                  <span class="badge bg-warning">3</span>
                  <i class="fa fa-bullhorn"></i> Notifications
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-success">300</span>
                  <i class="fa fa-barcode"></i> Products
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-purple">891</span>
                  <i class="fa fa-users"></i> Users
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-teal">67</span>
                  <i class="fa fa-inbox"></i> Orders
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-info">12</span>
                  <i class="fa fa-envelope"></i> Inbox
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-danger">531</span>
                  <i class="fa fa-heart-o"></i> Likes
                </a>-->
                
              </div>
            </center>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        	</div>

		    </div>
        <!-- /.row -->
        <!-- =========================================================== -->
        <div class="row">

          <div class="col-md-12">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header" style="background-color: #086A87; color: white;">
                <h4 class="card-title">RECEPCI&Oacute;N</h4>
              </div>

              <script type="text/javascript">
                function getBuscarRecibir(){  
                    
                    var valor=$("#inputBuscarRecibir").val();
                    valor = valor.trim();
                      if (valor=='' || valor=='*') {
                          alert('Es necesario ingresar un dato válido');
                      }
                      else{
                          location.href = 'index.php?r=seguimientos/recibirNuri&nuri='+valor;
                      }
                }
                </script>


            <center>
              <div class="card-body">
                

          <div class="form-inline ml-3" style="width: 50%;">
              <div class="input-group input-group-sm" >

              <?php echo CHtml::beginForm('index.php?r=seguimientos/recibirNuri','get', array('class'=>'form-inline ml-3')); ?>

                <?php //echo CHtml::label('ingrese nuri','user01',array('class'=>'small'))?>
                <?php echo CHtml::textField('nuri','',array('id'=>'inputBuscar','class'=>'form-control form-control-navbar', 'placeholder'=>'Recibir NUR/NURI...', 'aria-label'=>'Search'))?>
                <?php //echo CHtml::submitButton(".<i class='fa fa-search'></i>",array('class'=>'btn btn-navbar')); ?>

                <button class="btn btn-info btn-sm" >
                          <i class="fa fa-download" style="font-size: 20px;"></i> Recibir
                </button>

              <?php echo CHtml::endForm(); ?>
              </div>
          </div>    


               <!-- <div class="form-inline ml-3" style="width: 40%;">
                  <div class="input-group input-group-sm" >
                    
                    <input class="form-control form-control-navbar" type="search" placeholder="Recibir NUR/NURI" aria-label="Search" id="inputBuscarRecibir" required autofocus>

                    <div class="input-group-append">
                      <button class="btn btn-info btn-sm" onclick="javascript:getBuscarRecibir();" >
                        <i class="fa fa-download" style="font-size: 20px;"></i> Recibir
                      </button>
                    </div>
                  </div>
                </div>  -->

               
              </div>
            </center>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

        </div>
        <!-- /.row -->

        

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php 


if (Yii::app()->user->id_usuario!=28) {// codigo para no mostrar popup a gerencia Juridica



if (Seguimientos::getVerificaSiHayPendientes()>0) {

   $num=Seguimientos::getMensajeBloqueoUsuario();
// codigo para que el mensaje se muestre entre los 5 y 7 dias para la recepcion
  if ($num>5 && $num<=7) {
    
  

  $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
  'id'=>'midialogo',
          // Opciones adicionales javascript
          'options'=>array(
              'title'=>'DOCUMENTOS NO RECEPCIONADOS',
              'autoOpen'=>true,
              'show'=> "fold",
                  'hide' => "scale",
                  'width'=>'60%',
                  'height'=>610,
                  'modal'=>true,
              'buttons' => array(
        //array('text'=>'Route','click'=> 'js:function(){'.$target.'}'),
        array('text'=>'Cerrar','click'=> 'js:function(){$(this).dialog("close");}'),
    ),    
          ),
          ));

      // echo "asdhklsajhdlkjsahldkjhsalkj";
        $usuario=Yii::app()->user->id_usuario;
        $usuarios=Usuarios::model()->findByPk($usuario);
        $this->renderPartial('/seguimientos/pendientesUsuarioWEB', array('usuarios'=>$usuarios));  

  $this->endWidget('zii.widgets.jui.CJuiDialog');

  // Link que abre la ventana de diálogo
  echo CHtml::link('', '#', array(
        'onclick'=>'$("#midialogo").dialog("open"); return false;',
       )
  );

  } //if ($num>0 && $num<=7) {

} //if (Seguimientos::getVerificaSiHayPendientes()>0) {



}// fin primer if




?>  

  
<!-- jQuery -->
<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/plugins/jquery/jquery.min.js"></script> -->






