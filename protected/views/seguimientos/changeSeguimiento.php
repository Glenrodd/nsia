<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */
/* @var $form CActiveForm */
?>

<h3>Formulario de B&uacute;squeda <b><i>"Cambio de fechas"</i></b></h3>
<i>En este formulario podra modificar los datos de: Prove&iacute;do, Fecha y Hora de derivaci&oacute;n y recepci&oacute;n</i>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seguimientos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<a class="btn btn-app" href="index.php?r=site/menuAdministracion" style="color: black;">
        <i class="fa fa-dedent"></i>Retornar Administraci&oacute;n
    </a>

	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <i class="fa fa-search"></i> Ingrese el NUR/NURI para realizar la b&uacute;squeda</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <!-- text input -->
                  <div class="form-group">
        			<label>
					<?php echo $form->labelEx($model,'codigo'); ?>
        			</label>
					<?php echo $form->textField($model,'codigo',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'codigo'); ?>
                  </div>

                  
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              	<?php echo CHtml::submitButton($model->isNewRecord ? 'Buscar' : 'Actualizar', array('class' => 'btn btn-info')); ?>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
	</section>
<?php $this->endWidget(); ?>

</div><!-- form -->


