<?php
/* @var $this RegionalesController */
/* @var $model Regionales */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	
	<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- right column -->
          <div class="col-md-6">
            
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <!-- text input -->
                  <div class="form-group">
					<label>
					<?php echo $form->label($model,'regional'); ?>
					</label>
					<?php echo $form->textField($model,'regional',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
                  </div>
                   <div class="form-group">
					<label>
					<?php echo $form->label($model,'sigla'); ?>
					</label>
					<?php echo $form->textField($model,'sigla',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
                  </div>
                   <div class="form-group">
					<label>
					<?php echo $form->label($model,'descripcion'); ?>
					</label>
					<?php echo $form->textArea($model,'descripcion',array('size'=>60,'maxlength'=>500,'class'=>'form-control')); ?>
                  </div>
                   <div class="form-group">
					<label>
					<?php echo $form->label($model,'Estado'); ?>
					</label>
					<?php //echo $form->textField($model,'activo'); ?>

          <?php echo $form->dropDownList($model,'activo', 
                      array(1=> 'Habilitado', 0=> 'Deshabilitado'), 
                      array('empty'=>'Seleccione Estado','class'=>'form-control  select')
                    ); ?>
                  </div>
                  
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
            	<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-info')); ?>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

	
		<?php //echo $form->label($model,'id_regional'); ?>
		<?php //echo $form->textField($model,'id_regional'); ?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->