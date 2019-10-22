<?php
/* @var $this DocumentosController */
/* @var $model Documentos */
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
	                    <?php echo $form->label($model,'codigo'); ?>
        				</label>
						<?php echo $form->textField($model,'codigo',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
                  </div>
                  <div class="form-group">
        				<label>
	                    <?php echo $form->label($model,'destinatario_nombres'); ?>
        				</label>
						<?php echo $form->textField($model,'destinatario_nombres',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
                  </div>
                  <div class="form-group">
        				<label>
                   		<?php echo $form->label($model,'referencia'); ?>
        				</label>
						<?php echo $form->textArea($model,'referencia',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
                  </div>
                  <div class="form-group">
        				<label>
                   		<?php echo $form->label($model,'fecha'); ?>
        				</label>
						<?php //echo $form->textField($model,'fecha',array('class'=>'form-control')); ?>
						<?php 

						 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'model'=>$model,
							'name'=>'publishDate',
							'attribute'=>'fecha',
							'language' => 'es',

							'htmlOptions' => array('class'=>'shadowdatepicker form-control'),

							'options'=>array(
								
								'autoSize'=>true,
								'dateFormat'=>'yy-mm-dd',
								//'buttonImage'=>Yii::app()->baseUrl.'/images/calendario.jpg',
								//'buttonImageOnly'=>true,
								//'buttonText'=>'Fecha',
								'selectOtherMonths'=>true,
								'showAnim'=>'slide',
								'showButtonPanel'=>true,
								//'showOn'=>'button', 
								'showOtherMonths'=>true, 
								'changeMonth' => 'true', 
								'changeYear' => 'true', 
								//'minDate'=>'date("Y-m-d")', 
								//'minDate'=>'-2m', 
								//'minDate'=>'2015-07-01', 
								'maxDate'=> "+20Y",
							),
						)); 

					?>
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


	<div class="row">
		<?php //echo $form->label($model,'id_documento'); ?>
		<?php //echo $form->textField($model,'id_documento'); ?>
	</div>

	<div class="row">
		
	</div>

	<div class="row">
		<?php //echo $form->label($model,'destinatario_titulo'); ?>
		<?php //echo $form->textField($model,'destinatario_titulo',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		
	</div>

	<div class="row">
		<?php //echo $form->label($model,'destinatario_cargo'); ?>
		<?php //echo $form->textField($model,'destinatario_cargo',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'destinatario_institucion'); ?>
		<?php //echo $form->textField($model,'destinatario_institucion',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'remitente_nombres'); ?>
		<?php //echo $form->textField($model,'remitente_nombres',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'remitente_cargo'); ?>
		<?php //echo $form->textField($model,'remitente_cargo',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'remitente_institucion'); ?>
		<?php //echo $form->textField($model,'remitente_institucion',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		
	</div>

	<div class="row">
		<?php //echo $form->label($model,'contenido'); ?>
		<?php //echo $form->textArea($model,'contenido',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		
	</div>

	<div class="row">
		<?php //echo $form->label($model,'hora'); ?>
		<?php //echo $form->textField($model,'hora'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'adjuntos'); ?>
		<?php //echo $form->textField($model,'adjuntos',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'copias'); ?>
		<?php //echo $form->textField($model,'copias',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'via_nombres'); ?>
		<?php //echo $form->textField($model,'via_nombres',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'via_cargo'); ?>
		<?php //echo $form->textField($model,'via_cargo',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'nro_hojas'); ?>
		<?php //echo $form->textField($model,'nro_hojas',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'gestion'); ?>
		<?php //echo $form->textField($model,'gestion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'fecha_registro'); ?>
		<?php //echo $form->textField($model,'fecha_registro'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'hora_registro'); ?>
		<?php //echo $form->textField($model,'hora_registro'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'fk_usuario'); ?>
		<?php //echo $form->textField($model,'fk_usuario'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'fk_tipo_documento'); ?>
		<?php //echo $form->textField($model,'fk_tipo_documento'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'fk_estado_documento'); ?>
		<?php //echo $form->textField($model,'fk_estado_documento'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'fk_area'); ?>
		<?php //echo $form->textField($model,'fk_area'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'fk_documento'); ?>
		<?php //echo $form->textField($model,'fk_documento'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'ruta_documento'); ?>
		<?php //echo $form->textField($model,'ruta_documento',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'activo'); ?>
		<?php //echo $form->textField($model,'activo'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->