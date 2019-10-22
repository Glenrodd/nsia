<?php
/* @var $this GrupoDerivacionController */
/* @var $model GrupoDerivacion */
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
                  
                  <?php echo $form->label($model,'nombre_grupo'); ?>
                  </label>
					<?php echo $form->textField($model,'nombre_grupo',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
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



	
		<?php //echo $form->label($model,'id_grupo_derivacion'); ?>
		<?php //echo $form->textField($model,'id_grupo_derivacion'); ?>
	
		<?php //echo $form->label($model,'fk_area'); ?>
		<?php //echo $form->textField($model,'fk_area'); ?>
	
		<?php //echo $form->label($model,'fk_usuario'); ?>
		<?php //echo $form->textField($model,'fk_usuario'); ?>
	
		<?php //echo $form->label($model,'fk_regional'); ?>
		<?php //echo $form->textField($model,'fk_regional'); ?>
	
		<?php //echo $form->label($model,'fecha_registro'); ?>
		<?php //echo $form->textField($model,'fecha_registro'); ?>
	
		<?php //echo $form->label($model,'hora_registro'); ?>
		<?php //echo $form->textField($model,'hora_registro'); ?>
	
		<?php //echo $form->label($model,'activo'); ?>
		<?php //echo $form->textField($model,'activo'); ?>
	
	
<?php $this->endWidget(); ?>

</div><!-- search-form -->