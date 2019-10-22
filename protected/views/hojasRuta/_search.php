<?php
/* @var $this HojasRutaController */
/* @var $model HojasRuta */
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
        				<?php echo $form->label($model,'nuri'); ?>
       				</label>
						<?php echo $form->textField($model,'nur',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
                  </div>
                   <div class="form-group">
       				<label>
        				<?php echo $form->label($model,'Cite Asociado'); ?>
       				</label>
						<?php echo $form->textField($model,'codigo',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
                  </div>
                   <div class="form-group">
       				<label>
        				<?php echo $form->label($model,'fecha'); ?>
       				</label>
						<?php //echo $form->textField($model,'fecha'); ?>
						<?php 

						 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'model'=>$model,
							'name'=>'publishDate',
							'attribute'=>'fecha',
							'language' => 'es',

							'htmlOptions' => array('readonly'=>"readonly", 'class'=>'shadowdatepicker form-control'),

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
								'minDate'=>'2015-07-01', 
								'maxDate'=> "+20Y",
							),
						)); 

					?>
                  </div>
                   <div class="form-group">
       				<label>
       				</label>
        				
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


	
		<?php //echo $form->label($model,'id_hoja_ruta'); ?>
		<?php //echo $form->textField($model,'id_hoja_ruta'); ?>
	
		<?php //echo $form->label($model,'nro'); ?>
		<?php //echo $form->textField($model,'nro'); ?>
	
		<?php //echo $form->label($model,'hora'); ?>
		<?php //echo $form->textField($model,'hora'); ?>
	
		<?php //echo $form->label($model,'proceso'); ?>
		<?php //echo $form->textField($model,'proceso'); ?>
	
		<?php //echo $form->label($model,'fecha_registro'); ?>
		<?php //echo $form->textField($model,'fecha_registro'); ?>
	
		<?php //echo $form->label($model,'hora_registro'); ?>
		<?php //echo $form->textField($model,'hora_registro'); ?>
	
		<?php //echo $form->label($model,'fk_usuario'); ?>
		<?php //echo $form->textField($model,'fk_usuario'); ?>
	
		<?php //echo $form->label($model,'gestion'); ?>
		<?php //echo $form->textField($model,'gestion'); ?>
	
		<?php //echo $form->label($model,'activo'); ?>
		<?php //echo $form->textField($model,'activo'); ?>
	
		<?php //echo $form->label($model,'fk_documento'); ?>
		<?php //echo $form->textField($model,'fk_documento'); ?>
	

<?php $this->endWidget(); ?>

</div><!-- search-form -->