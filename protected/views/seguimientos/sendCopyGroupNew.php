<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */
/* @var $form CActiveForm */
?>
<center>
<u>
	<h4>ENVIO DE COPIAS DIGITALES</h4>
</u>
</center>

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

	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
              </div>

              <table width="100%" cellpadding="3" cellspacing="0">
              <tr>
              	<td width="50%" style="border-right:1px solid black;">

  		      		<table width="100%">
  		      			<tr style="font-size: 13px; color:#0B3861;">
  		      				<th align="left">
  		      					<u>Integrantes grupo "<?=$grupos->nombre_grupo?>"</u><br><br>
  		      				</th>
  		      			</tr>
  		      			 <?php $dataReader2=Seguimientos::getListIntegrantesGrupo($grupos->id_grupo_derivacion); ?>	

								  <?php foreach ($dataReader2 as $row2) { ?>	
								  <tr  style="font-size: 11px; color:#0B4C5F;">
								    <td>-> <i><?=$row2['nombre']?></i></td>
								  </tr>
								 <?php } ?>
  		      			
  		      		</table>

              	</td>
              	<td width="50%" valign="top"  >
              		<!-- /.card-header -->
	              <div class="card-body">
	              	
	              	 <center><i>NUR/NURI  <b><?=$hojasRuta->nur?> </b></i></center>
  		      		 <br>
	                  <!-- text input -->
	                  <div class="form-group">
	                  	<center>
	        			<label style="vertical-align: top; font-size: 12px;"><b>
						<?php echo $form->labelEx($model,'Ingrese prove&iacute;do para el grupo * :'); ?></b>
	        			</label>
						<?php echo $form->textArea($model,'proveido',array('rows'=>4, 'cols'=>50, 'required'=>true)); ?>
						<?php echo $form->error($model,'proveido'); ?>
						</center>
	                  </div>

	                  
	              </div>
	              <!-- /.card-body -->
	              <br>
	              <center>
	              <div class="card-footer">
	              	<?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar copias digitales' : 'Actualizar', array('class' => 'btn btn-info')); ?>
	              </div>
	              <br>
	              <i style="font-size: 12px;">Se procedera a enviar una copia digital a todos los integrantes del grupo <b><?=$grupos->nombre_grupo?></b> con el prove&iacute;do suscrito</i>
	              </center>
              	</td>		
              </tr>
              </table>

            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
	</section>



	<div class="row">
		<?php //echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->hiddenField($model,'codigo',array('size'=>45,'maxlength'=>45, 'value'=>$hojasRuta->nur)); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'derivado_por'); ?>
		<?php //echo $form->textField($model,'derivado_por'); ?>
		<?php //echo $form->error($model,'derivado_por'); ?>
	</div>

	<div class="row">
		<?php //echo $form->textField($model,'derivado_a',array('class'=>'form-control')); ?>
		<?php //echo $form->error($model,'derivado_a'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'proveido'); ?>
		
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fecha_derivacion'); ?>
		<?php //echo $form->textField($model,'fecha_derivacion'); ?>
		<?php //echo $form->error($model,'fecha_derivacion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hora_derivacion'); ?>
		<?php //echo $form->textField($model,'hora_derivacion'); ?>
		<?php //echo $form->error($model,'hora_derivacion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fecha_recepcion'); ?>
		<?php //echo $form->textField($model,'fecha_recepcion'); ?>
		<?php //echo $form->error($model,'fecha_recepcion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hora_recepcion'); ?>
		<?php //echo $form->textField($model,'hora_recepcion'); ?>
		<?php //echo $form->error($model,'hora_recepcion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fk_accion'); ?>
		<?php //echo $form->textField($model,'fk_accion'); ?>
		<?php //echo $form->error($model,'fk_accion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fk_estado'); ?>
		<?php //echo $form->textField($model,'fk_estado'); ?>
		<?php //echo $form->error($model,'fk_estado'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'padre'); ?>
		<?php echo $form->hiddenField($model,'fk_grupo_derivacion', array('value'=>$grupos->id_grupo_derivacion)); ?>
		<?php echo $form->error($model,'fk_grupo_derivacion'); ?>
	</div>



	<div class="row">
		<?php //echo $form->labelEx($model,'padre'); ?>
		<?php echo $form->hiddenField($model,'padre', array('value'=>0)); ?>
		<?php echo $form->error($model,'padre'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'oficial'); ?>
		<?php //echo $form->textField($model,'oficial'); ?>
		<?php //echo $form->error($model,'oficial'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'hijo'); ?>
		<?php //echo $form->textField($model,'hijo',array('size'=>45,'maxlength'=>45)); ?>
		<?php //echo $form->error($model,'hijo'); ?>
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
		<?php //echo $form->labelEx($model,'gestion'); ?>
		<?php //echo $form->textField($model,'gestion'); ?>
		<?php //echo $form->error($model,'gestion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'confirmado'); ?>
		<?php //echo $form->textField($model,'confirmado'); ?>
		<?php //echo $form->error($model,'confirmado'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'activo'); ?>
		<?php //echo $form->textField($model,'activo'); ?>
		<?php //echo $form->error($model,'activo'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->