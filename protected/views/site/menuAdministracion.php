<?php
/* @var $this SiteController */
/* @var $error array */

if (Yii::app()->user->isGuest){
  $this->redirect(array('login'));
 }

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<center>
    <?php //echo CHtml::link('Link Text',array('controller/action'), array('class'=>'btn btn-info')); ?>
</center>

<?php /*
$this->widget('ext.TileSlideMenu.TileSlideMenu', array(
  'menuTitle'=>'Yii Framework',
  'items'=>array(
    array(
      'text' => 'Main Site',
      'url'=>'http://www.yiiframework.com/',
      'urlTarget'=>'_blank'
    ),
    array(
      'text' => 'Demos',
      'url'=>'http://www.yiiframework.com/demos/'
    ),
    array(
      'text' => 'Guide',
      'url'=>'http://www.yiiframework.com/doc/guide/'
    ),
    array(
      'text' => 'Class Reference',
      'url'=>'http://www.yiiframework.com/doc/api/'
    ),
    array(
      'text' => 'Wiki',
      'url'=>'http://www.yiiframework.com/wiki/'
    ),
    array(
      'text' => 'Extensions',
      'url'=>'http://www.yiiframework.com/extensions/'
    ),
    array(
      'text' => 'Forum',
      'url'=>'http://www.yiiframework.com/forum/'
    ),
    array(
      'text' => 'Live Chat',
      'url'=>'http://www.yiiframework.com/chat/'
    ),
  )
)); */


$this->widget('ext.JuiButtonSet.JuiButtonSet', array(
    'items' => array(
        array(
            'label'=>'Menu button 1',
            'icon-position'=>'left',
            'url'=>array('create') //urls like 'create', 'update' & 'delete' generates an icon beside the button
        ),
        array(
            'label'=>'Menu button 2',
            'icon-position'=>'left',
            'icon'=>'folder-open', // This a CSS class starting with ".ui-icon-"
            'url'=>array('action2')
        ),
    ),
    'htmlOptions' => array('style' => 'clear: both;'),
));


?>


<!-- Main content -->
    <section class="content">
      <!-- =========================================================== -->
        <div class="row">

        	<div class="col-md-12">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">MENU DE ADMINISTRACI&Oacute;N</h3>
                
                <div class="card-tools">
		            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
		              <i class="fa fa-minus"></i></button>
		            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
		              <i class="fa fa-times"></i></button>
		        </div>

              </div>
            <center>
              <div class="card-body">
                
                <p><u><b>SEGUIMIENTOS</b></u></p>

                <a class="btn btn-app" href="index.php?r=seguimientos/changeSeguimiento" style="color: black;">
                  <i class="fa fa-calendar"></i>Fecha/Prove&iacute;do
                </a>
                <a class="btn btn-app" href="index.php?r=seguimientos/adminChangeDerivacion" style="color: black;">
                  <i class="fa fa-edit"></i>Cambio Derivaci&oacute;n
                </a>
                <!--<a class="btn btn-app" href="index.php?r=estadoDocumento/admin" style="color: black;">
                  <i class="fa fa-share-square-o"></i>Nueva Derivaci&oacute;n
                </a>-->

                <a class="btn btn-app" href="index.php?r=seguimientos/desarchivoOriginalGestion" style="color: black;">
                  <i class="fa fa-archive"></i>Desarchivo SAD
                </a>
                <a class="btn btn-app" href="index.php?r=archivadosDigitales/desarchivoCopiaGestion" style="color: black;">
                  <i class="fa fa-file-zip-o"></i>Desarchivo Digital
                </a>

                <a class="btn btn-app" href="index.php?r=usuarios/accesoSistema" style="color: black;">
                  <i class="fa fa-user-secret"></i>Acceso al Sistema
                </a>




                <br>
                <p><u><b>DOCUMENTOS</b></u></p>
                <a class="btn btn-app" href="index.php?r=documentos/documentosGestion" style="color: black;">
                  <i class="fa fa-calendar"></i>Cambio de Fecha
                </a>
                <a class="btn btn-app" href="index.php?r=estados/admin" style="color: black;">
                  <i class="fa fa-user-o"></i>Asignaci&oacute;n de Usuario
                </a>
                <a class="btn btn-app" href="index.php?r=acciones/admin" style="color: black;">
                  <i class="fa fa-files-o"></i>Clonar Documento
                </a>
                <a class="btn btn-app" href="index.php?r=documentos/observadosGestion" style="color: black;">
                  <i class="fa fa-file-text-o"></i>Doc. Observados
                </a>

                <br>
                <p><u><b>HOJAS RUTA</b></u></p>
                <a class="btn btn-app" href="index.php?r=niveles/admin" style="color: black;">
                  <i class="fa fa-paste"></i>Asignar NUR/NURI
                </a>
                <a class="btn btn-app" href="index.php?r=estados/admin" style="color: black;">
                  <i class="fa fa-times-circle-o"></i>Baja Hoja Ruta
                </a>

                <br>
                <p><u><b>MIGRAR INFORMACI&Oacute;N</b></u></p>
                <a class="btn btn-app" href="index.php?r=usuarios/migrarUsuarios" style="color: black;">
                  <i class="fa fa-users"></i>Migrar Usuarios
                </a>
                <a class="btn btn-app" href="index.php?r=usuarios/migrarCiteDocumento" style="color: black;">
                  <i class="fa fa-sign-in"></i>Migrar Seguimiento
                </a>


                <a class="btn btn-app" href="index.php?r=usuarios/migrarCiteSinNUri" style="color: black;">
                  <i class="fa fa-sign-in"></i>Migrar Doc sin NUR/NURI
                </a>


                <a class="btn btn-app" href="index.php?r=usuarios/migrarCiteConNUri" style="color: black;">
                  <i class="fa fa-sign-in"></i>Migrar Doc con NUR/NURI
                </a>

              </div>
            </center>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        	</div>
		</div>
        <!-- /.row -->



    </section>
    <!-- /.content -->

    <!-- jQuery -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jquery/jquery.min.js"></script> 