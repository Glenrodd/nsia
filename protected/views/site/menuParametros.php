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


<!-- Main content -->
    <section class="content">
      <!-- =========================================================== -->
        <div class="row">

        	<div class="col-md-12">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">MENU DE PARAMETROS</h3>
                
                <div class="card-tools">
		            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
		              <i class="fa fa-minus"></i></button>
		            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
		              <i class="fa fa-times"></i></button>
		        </div>

              </div>
            <center>
              <div class="card-body">
                <a class="btn btn-app" href="index.php?r=regionales/admin" style="color: black;">
                  <i class="fa fa-map-marker"></i>Gerencia Regional
                </a>
                <a class="btn btn-app" href="index.php?r=areas/admin" style="color: black;">
                  <i class="fa fa-sitemap"></i>&Aacute;rea/Unidad
                </a>
                <a class="btn btn-app" href="index.php?r=estadoDocumento/admin" style="color: black;">
                  <i class="fa fa-paste"></i>Estado de Documento
                </a>
                <a class="btn btn-app" href="index.php?r=tipoDocumento/admin" style="color: black;">
                  <i class="fa fa-file-text-o"></i>Tipo de Documento
                </a>
                <a class="btn btn-app" href="index.php?r=niveles/admin" style="color: black;">
                  <i class="fa fa-group"></i>Niveles de Usuario
                </a>
                <a class="btn btn-app" href="index.php?r=estados/admin" style="color: black;">
                  <i class="fa fa-share-square-o"></i>Estado de Seguimiento
                </a>
                <a class="btn btn-app" href="index.php?r=acciones/admin" style="color: black;">
                  <i class="fa fa-share-square"></i>Acci&oacute;n de Seguimiento
                </a>
                <a class="btn btn-app" href="index.php?r=perfiles/admin" style="color: black;">
                  <i class="fa fa-user"></i>Perfil de Usuario
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