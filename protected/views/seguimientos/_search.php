<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */
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
						<?php echo $form->textField($model,'codigo',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
                  </div>

                  <div class="form-group">
	        		  <label>
                  		<?php echo $form->label($model,'proveído'); ?>
	                  </label>
						<?php echo $form->textArea($model,'proveido',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
                  </div>

                  <div class="form-group">
	        		  <label>
                  		<?php echo $form->label($model,'fecha_derivación'); ?>
	                  </label>
						<?php //echo $form->textField($model,'fecha_derivacion'); ?>
						<?php 

							 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'model'=>$model,
								'name'=>'publishDate',
								'attribute'=>'fecha_derivacion',
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
									//'minDate'=>'2015-07-01', 
									//'maxDate'=> "+20Y",
								),
							)); 

						?>
                  </div>

                  <div class="form-group">
	        		  <label>
						<?php echo $form->label($model,'fecha_recepción'); ?>
	                  </label>
						<?php //echo $form->textField($model,'fecha_recepcion'); ?>
						<?php 

							 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'model'=>$model,
								'name'=>'publishDate',
								'attribute'=>'fecha_recepcion',
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
									//'minDate'=>'2015-07-01', 
									//'maxDate'=> "+20Y",
								),
							)); 

						?>                  
                  </div>

                 <div class="form-group">
                  	<label>
                    	<?php echo $form->label($model,'estado'); ?>
                  	</label>
	                    <?php //echo $form->textField($model,'activo'); ?>
	                    <?php echo $form->dropDownList($model,'oficial', 
	                              array(1=> 'Original', 0=> 'Copia Digital'), 
	                              array('empty'=>'Seleccione Tipo','class'=>'form-control  select')
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



	<div class="row">
		<?php //echo $form->label($model,'id_seguimiento'); ?>
		<?php //echo $form->textField($model,'id_seguimiento'); ?>
	</div>

	<div class="row">
		
	</div>

	<div class="row">
		<?php //echo $form->label($model,'derivado_por'); ?>
		<?php //echo $form->textField($model,'derivado_por'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'derivado_a'); ?>
		<?php //echo $form->textField($model,'derivado_a'); ?>
	</div>

	<div class="row">
		
	</div>

	<div class="row">
		
	</div>

	<div class="row">
		<?php //echo $form->label($model,'hora_derivacion'); ?>
		<?php //echo $form->textField($model,'hora_derivacion'); ?>
	</div>

	<div class="row">
		
	</div>

	<div class="row">
		<?php //echo $form->label($model,'hora_recepcion'); ?>
		<?php //echo $form->textField($model,'hora_recepcion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'fk_accion'); ?>
		<?php //echo $form->textField($model,'fk_accion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'fk_estado'); ?>
		<?php //echo $form->textField($model,'fk_estado'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'padre'); ?>
		<?php //echo $form->textField($model,'padre'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'oficial'); ?>
		<?php //echo $form->textField($model,'oficial'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'hijo'); ?>
		<?php //echo $form->textField($model,'hijo',array('size'=>45,'maxlength'=>45)); ?>
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
		<?php //echo $form->label($model,'gestion'); ?>
		<?php //echo $form->textField($model,'gestion'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'confirmado'); ?>
		<?php //echo $form->textField($model,'confirmado'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'activo'); ?>
		<?php //echo $form->textField($model,'activo'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->