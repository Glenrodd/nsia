<?php
/* @var $this RegionalesController */
/* @var $model Regionales */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'regionales-form',
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
					<?php echo $form->labelEx($model,'regional'); ?>
        			</label>
					<?php echo $form->textField($model,'regional',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'regional'); ?>
                  </div>

                  <div class="form-group">
        			<label>
					<?php echo $form->labelEx($model,'sigla'); ?>
        			</label>
					<?php echo $form->textField($model,'sigla',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'sigla'); ?>
                  </div>

                  <div class="form-group">
        			<label>
					<?php echo $form->labelEx($model,'descripcion'); ?>
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


	
		<?php //echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->hiddenField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->