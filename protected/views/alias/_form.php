<?php
/* @var $this AliasController */
/* @var $model Alias */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'alias-form',
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
                  	<p style="font-size: 13px; color: darkred;"> <i> Una vez registrado el nuevo responsable de &Aacute;rea/Unidad , Subgerencia, Gerencia Nacional o Gerencia Regional, el sistema eliminar&aacute; a todos los resnposables almacenados con anterioridad</i> </p>
        			<label>
					<?php echo $form->labelEx($model,'nombre'); ?>
        			</label>
					<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>500,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'nombre'); ?>
                  </div>
                  <div class="form-group">
        			<label>
					<?php echo $form->labelEx($model,'cargo'); ?>
        			</label>
					<?php echo $form->textField($model,'cargo',array('size'=>60,'maxlength'=>300,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'cargo'); ?>
                  </div>
                  <div class="form-group">
        			<label>
					<?php echo $form->labelEx($model,'descripci&oacute;n'); ?>
        			</label>
					<?php echo $form->textArea($model,'descripcion',array('size'=>60,'maxlength'=>500,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'descripcion'); ?>
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




	
		<?php //echo $form->labelEx($model,'fk_usuario'); ?>
		<?php echo $form->hiddenField($model,'fk_usuario', array('value'=>$id)); ?>
		<?php echo $form->error($model,'fk_usuario'); ?>
	
		<?php //echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->hiddenField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	
		<?php //echo $form->labelEx($model,'fecha_registro'); ?>
		<?php //echo $form->textField($model,'fecha_registro'); ?>
		<?php //echo $form->error($model,'fecha_registro'); ?>
	
		<?php //echo $form->labelEx($model,'hora_registro'); ?>
		<?php //echo $form->textField($model,'hora_registro'); ?>
		<?php //echo $form->error($model,'hora_registro'); ?>


<?php $this->endWidget(); ?>

</div><!-- form -->