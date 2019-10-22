<?php
/* @var $this HojasRutaController */
/* @var $model HojasRuta */
/* @var $form CActiveForm */
$documentos=Documentos::model()->findByPk($id_documento);
?>
<script type="text/javascript">
	/*$(document).ready(function(){

	$("#nuri").change(function(){
            //alert($("#nuri option:selected" ).text());
            var valor=$("#nuri option:selected" ).text();
            var nuri=valor.split(' ');
    		//alert(nuri[0]);
    		$('#nur').val(nuri[0]);
	});

});*/
</script>
<br>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hojas-ruta-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>


	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Los campos con * son obligatorios.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <!-- text input -->
                  <div class="form-group">
        			<label>
					<?php echo $form->labelEx($model,'NUR/NURI Pendiente *'); ?>
        			</label>
					

					<?php //echo $form->textField($model,'nro',array('class'=>'form-control')); ?>
					<?php echo $form->dropDownList($model,'nro', Documentos::getListNuriPendiente(), array('empty'=>'Seleccione NURI/NUR','class'=>'form-control  select', 'id'=>'nuri')); ?>
					<?php echo $form->error($model,'nro'); ?>
                  </div>
                  
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              	<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', array('class' => 'btn btn-info')); ?>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
	</section>



	<div class="row">
		<?php //echo $form->labelEx($model,'id_hoja_ruta'); ?>
		<?php //echo $form->textField($model,'id_hoja_ruta'); ?>
		<?php //echo $form->error($model,'id_hoja_ruta'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'nur'); ?>
		<?php //echo $form->hiddenField($model,'nur',array('id'=>'nur')); ?>
		<?php //echo $form->error($model,'nur'); ?>
	</div>

	<div class="row">
		
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->hiddenField($model,'codigo',array('value'=>$documentos->codigo)); ?>
		<?php echo $form->error($model,'codigo'); ?>
		
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fecha'); ?>
		<?php //echo $form->textField($model,'fecha'); ?>
		<?php //echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hora'); ?>
		<?php //echo $form->textField($model,'hora'); ?>
		<?php //echo $form->error($model,'hora'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'proceso'); ?>
		<?php //echo $form->textField($model,'proceso'); ?>
		<?php //echo $form->error($model,'proceso'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fecha_registro'); ?>
		<?php //echo $form->textField($model,'fecha_registro'); ?>
		<?php //echo $form->error($model,'fecha_registro'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hora_registro'); ?>
		<?php //echo $form->textField($model,'hora_registro'); ?>
		<?php //echo $form->error($model,'hora_registro'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fk_usuario'); ?>
		<?php //echo $form->textField($model,'fk_usuario'); ?>
		<?php //echo $form->error($model,'fk_usuario'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'gestion'); ?>
		<?php //echo $form->textField($model,'gestion'); ?>
		<?php //echo $form->error($model,'gestion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->hiddenField($model,'activo',array('value'=>1)); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fk_documento'); ?>
		<?php echo $form->hiddenField($model,'fk_documento', array('value'=>$id_documento)); ?>
		<?php echo $form->error($model,'fk_documento'); ?>
	</div>

	

<?php $this->endWidget(); ?>

</div><!-- form -->