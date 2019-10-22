<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
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
					<?php echo $form->label($model,'nombre'); ?>
					</label>
					<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>500,'class'=>'form-control')); ?>
                  </div>
                  <div class="form-group">
					<label>
					<?php echo $form->label($model,'cargo'); ?>
					</label>
					<?php echo $form->textField($model,'cargo',array('size'=>60,'maxlength'=>500,'class'=>'form-control')); ?>
                  </div>
                  <div class="form-group">
					<label>
					<?php echo $form->label($model,'usuario'); ?>
					</label>
					<?php echo $form->textField($model,'usuario',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
                  </div>
                  <div class="form-group">
					<label>
					<?php echo $form->label($model,'correo'); ?>
					</label>
					<?php echo $form->textField($model,'correo',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
                  </div>
                  <div class="form-group">
					<label>
					<?php echo $form->label($model,'Perfil de Usuario'); ?>
					</label>
					<?php //echo $form->textField($model,'fk_perfil',array('class'=>'form-control')); ?>
					<?php echo $form->dropDownList($model,'fk_perfil', $model->getListPerfil(), array('empty'=>'Seleccione Perfil','class'=>'form-control  select')); ?>
                  </div>
                  <div class="form-group">
					<label>
					<?php echo $form->label($model,'Gerencia Regional'); ?>
					</label>
					<?php //echo $form->textField($model,'fk_regional',array('class'=>'form-control')); ?>
					<?php echo $form->dropDownList($model,'fk_regional', $model->getListRegional(), array('empty'=>'Seleccione Regional','class'=>'form-control  select')); ?>
                  </div>
                  <div class="form-group">
					<label>
					<?php echo $form->label($model,'Área/Unidad'); ?>
					</label>
					<?php //echo $form->textField($model,'fk_area',array('class'=>'form-control')); ?>
					<?php echo $form->dropDownList($model,'fk_area', $model->getListArea(), array('empty'=>'Seleccione Area','class'=>'form-control  select')); ?>
                  </div>
                  <div class="form-group">
					<label>
					<?php echo $form->label($model,'nivel de usuario'); ?>
					</label>
					<?php //echo $form->textField($model,'fk_nivel',array('class'=>'form-control')); ?>
					<?php echo $form->dropDownList($model,'fk_nivel', $model->getListNivel(), array('empty'=>'Seleccione Nivel','class'=>'form-control  select')); ?>
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

		<?php //echo $form->label($model,'id_usuario'); ?>
		<?php //echo $form->textField($model,'id_usuario'); ?>
	
		<?php //echo $form->label($model,'mosca'); ?>
		<?php //echo $form->textField($model,'mosca',array('size'=>45,'maxlength'=>45)); ?>
	
		<?php //echo $form->label($model,'fecha_registro'); ?>
		<?php //echo $form->textField($model,'fecha_registro'); ?>
	
		<?php //echo $form->label($model,'hora_registro'); ?>
		<?php //echo $form->textField($model,'hora_registro'); ?>
	
<?php $this->endWidget(); ?>

</div><!-- search-form -->