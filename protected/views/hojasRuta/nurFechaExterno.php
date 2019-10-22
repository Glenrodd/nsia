<?php
/* @var $this HojasRutaController */
/* @var $model HojasRuta */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hojas-ruta-form',
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
                <h3 class="card-title">Todos los campos son obligatorios.</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <!-- text input -->
                  <div class="row">  
                  <div class="col-md-6">
                    <div class="card-body">

                     <div class="form-group">
                      <label>
                        <i class="fa fa-calendar"></i>
                        <?php echo $form->labelEx($model,'Fecha Inicio *'); ?>
                      </label>
                        <?php //echo $form->textField($model,'fecha',array('class'=>'form-control')); ?>
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
                                          //'minDate'=>'2000-01-01',
                                          //'maxDate'=> date('Y-m-d'),
                                      ),
                                  ));

                          ?>
                        <?php echo $form->error($model,'fecha'); ?>
                     </div>  
                        
                    </div>
                  </div>  <!-- col-md-6 -->

                <div class="col-md-6">
                  <div class="card-body">
                    <div class="form-group">
                      <label>
                        <i class="fa fa-calendar"></i>
                        <?php echo $form->labelEx($model,'fecha fin *'); ?>
                      </label>
                        <?php //echo $form->textField($model,'fecha_registro',array('class'=>'form-control')); ?>
                        <?php 
                          $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                      'model'=>$model,
                                      'name'=>'publishDate1',
                                      'attribute'=>'fecha_registro',
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
                                          //'minDate'=>'2000-01-01',
                                          'maxDate'=> date('Y-m-d'),
                                      ),
                                  ));

                          ?>
                        <?php echo $form->error($model,'fecha_registro'); ?>
                    </div>
                  </div><!-- col-md-6 -->
                </div>
                  
              </div>
              <!-- /.card-body -->
              <div class="card-footer" style="background-color: #F2F2F2;">
              <?php echo CHtml::submitButton($model->isNewRecord ? 'Generar Reporte' : 'Modificar Documento', array('class' => 'btn btn-info')); ?>
              </div>


            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>




	
		<?php //echo $form->labelEx($model,'id_hoja_ruta'); ?>
		<?php echo $form->hiddenField($model,'id_hoja_ruta'); ?>
		<?php echo $form->error($model,'id_hoja_ruta'); ?>
	
		<?php //echo $form->labelEx($model,'nur'); ?>
		<?php echo $form->hiddenField($model,'nur',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nur'); ?>
	
		<?php //echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->hiddenField($model,'codigo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'codigo'); ?>
	
		<?php //echo $form->labelEx($model,'nro'); ?>
		<?php echo $form->hiddenField($model,'nro'); ?>
		<?php echo $form->error($model,'nro'); ?>
	
		<?php //echo $form->labelEx($model,'hora'); ?>
		<?php echo $form->hiddenField($model,'hora'); ?>
		<?php echo $form->error($model,'hora'); ?>
	
		<?php //echo $form->labelEx($model,'proceso'); ?>
		<?php echo $form->hiddenField($model,'proceso'); ?>
		<?php echo $form->error($model,'proceso'); ?>
	
		<?php //echo $form->labelEx($model,'hora_registro'); ?>
		<?php echo $form->hiddenField($model,'hora_registro'); ?>
		<?php echo $form->error($model,'hora_registro'); ?>
	
		<?php //echo $form->labelEx($model,'fk_usuario'); ?>
		<?php echo $form->hiddenField($model,'fk_usuario'); ?>
		<?php echo $form->error($model,'fk_usuario'); ?>
	
		<?php //echo $form->labelEx($model,'gestion'); ?>
		<?php echo $form->hiddenField($model,'gestion'); ?>
		<?php echo $form->error($model,'gestion'); ?>
	
		<?php //echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->hiddenField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	
		<?php //echo $form->labelEx($model,'fk_documento'); ?>
		<?php echo $form->hiddenField($model,'fk_documento'); ?>
		<?php echo $form->error($model,'fk_documento'); ?>
	

<?php $this->endWidget(); ?>

</div><!-- form -->