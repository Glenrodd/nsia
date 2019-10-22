<?php
/* @var $this AccionesController */
/* @var $model Acciones */
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
                  <?php echo $form->label($model,'acción'); ?>
                  </label>
                  <?php echo $form->textField($model,'accion',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
                  </div>
                  <div class="form-group">
                  <label>
                  <?php echo $form->label($model,'observación'); ?>
                  </label>
                  <?php echo $form->textArea($model,'observacion',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
                  </div>
                  <div class="form-group">
                  <label>
                    <?php echo $form->label($model,'estado'); ?>
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

    <?php //echo $form->label($model,'id_accion'); ?>
    <?php //echo $form->textField($model,'id_accion'); ?>
	
<?php $this->endWidget(); ?>

</div><!-- search-form -->