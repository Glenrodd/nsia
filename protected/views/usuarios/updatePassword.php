<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,

	'enableClientValidation'=>false, 
	//'focus'=>array($model,'fallas_id'), 
	'clientOptions'=>array( 
			'validateOnSubmit'=>true, 
		) 
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

				<div class="row">
              	<div class="col-md-6">
	              	<div class="card-body">

	              		<div class="form-group">
						 <label>
						<?php echo $form->labelEx($model,'usuario'); ?>
						</label>
						<?php echo $form->textField($model,'usuario',array('size'=>60,'maxlength'=>100,'class'=>'form-control','disabled'=>true)); ?>
						<?php echo $form->error($model,'usuario'); ?>
	                  </div>
	                  <div class="form-group">
						 <label>
						<?php echo $form->labelEx($model,'password'); ?>
						</label>
						<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>512,'class'=>'form-control', 'value'=>'', 'autofocus'=>true)); ?>
						<?php echo $form->error($model,'password'); ?>
	                  </div>
	                  <div class="form-group">
						 <label>
						<?php echo $form->labelEx($model,'nombre'); ?>
						</label>
						<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>500,'class'=>'form-control','disabled'=>true)); ?>
						<?php echo $form->error($model,'nombre'); ?>
	                  </div>
	                  <div class="form-group">
						 <label>
						<?php echo $form->labelEx($model,'cargo'); ?>
						</label>
						<?php echo $form->textField($model,'cargo',array('size'=>60,'maxlength'=>500,'class'=>'form-control','disabled'=>true)); ?>
						<?php echo $form->error($model,'cargo'); ?>
	                  </div>

	              	</div>
	            </div>
	            <div class="col-md-6">
	            	<?php if (Usuarios::getObtenerP()==1) {?>
		            	<center>
		            	<div style="color:#B40404; font-size: 20px;" class="parpadea" >
		              	<i>Usted esta utilizando la contraseña por defecto, es necesario que la cambie en este momento </i>
		              	</div>	
		              	</center>
					<?php }  else { echo "<br><br>"; } ?>

	              	<div class="card-body" style="border: 1px solid gray;">
	              		<br>
	              		<center>
	              		<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/user-png-image-15189.png">
	              		</center>	
	              		<br>
	              	</div>
	            </div>
	            </div>  		



                  <!-- text input -->
                  

                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'correo'); ?>
					</label>
					<?php echo $form->textField($model,'correo',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'correo'); ?>
                  </div>
                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'mosca'); ?>
					</label>
					<?php echo $form->textField($model,'mosca',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'mosca'); ?>
                  </div>
                  
				
					<?php //echo $form->labelEx($model,'perfil de usuario *'); ?>
				
					<?php //echo $form->textField($model,'fk_perfil',array('class'=>'form-control')); ?>

					<?php //echo $form->dropDownList($model,'fk_perfil', $model->getListPerfil(), array('empty'=>'Seleccione Perfil','class'=>'form-control  select','disabled'=>true)); ?>
					<?php //echo $form->error($model,'fk_perfil'); ?>
                
                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'gerencia Regional *'); ?>
					</label>
					<?php //echo $form->textField($model,'fk_regional',array('class'=>'form-control')); ?>
					<?php echo $form->dropDownList($model,'fk_regional', $model->getListRegional(), array('empty'=>'Seleccione Regional','class'=>'form-control  select','disabled'=>true)); ?>
					<?php echo $form->error($model,'fk_regional'); ?>
                  </div>
                  <div class="form-group">
					 <label>
					<?php echo $form->labelEx($model,'Área/Unidad *'); ?>
					</label>
					<?php //echo $form->textField($model,'fk_area',array('class'=>'form-control')); ?>
					<?php echo $form->dropDownList($model,'fk_area', $model->getListArea(), array('empty'=>'Seleccione Area','class'=>'form-control  select','disabled'=>true)); ?>
					<?php echo $form->error($model,'fk_area'); ?>
                  </div>
                  
				
					<?php //echo $form->labelEx($model,'nivel de usuario *'); ?>
				
					<?php //echo $form->textField($model,'fk_nivel',array('class'=>'form-control')); ?>
					<?php //echo $form->dropDownList($model,'fk_nivel', $model->getListNivel(), array('empty'=>'Seleccione Nivel','class'=>'form-control  select','disabled'=>true)); ?>
					<?php //echo $form->error($model,'fk_nivel'); ?>
                

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

	
		<?php //echo $form->labelEx($model,'fecha_registro'); ?>
		<?php //echo $form->hiddenField($model,'fecha_registro', array('value'=>date('Y-m-d'))); ?>
		<?php //echo $form->error($model,'fecha_registro'); ?>
<!-- ###################################################################### -->
		<?php //echo $form->labelEx($model,'hora_registro'); ?>
		<?php //echo $form->hiddenField($model,'hora_registro', array('value'=>date('H:i:s'))); ?>
		<?php //echo $form->error($model,'hora_registro'); ?>
<!-- ###################################################################### -->
		<?php //echo $form->labelEx($model,'update_password'); ?>
		<?php echo $form->hiddenField($model,'update_password', array('value'=>date('Y-m-d H:i:s'))); ?>
		<?php echo $form->error($model,'update_password'); ?>
<!-- ###################################################################### -->
		<?php //echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->hiddenField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->