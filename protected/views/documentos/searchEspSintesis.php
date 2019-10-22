<?php
/* @var $this DocumentosController */
/* @var $model Documentos */
/* @var $form CActiveForm */
?>

<h4><b>B&uacute;squeda por S&iacute;ntesis</b></h4>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documentos-form',
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
                <h3 class="card-title">Todos los campos son obligatorios. <b>CARTA EXTERNA</b></h3>
              </div>
              <!-- /.card-header -->
	              


	              <div class="card-body">

	              	<!-- text input -->
	                  
	                <div class="row">  
	              	<div class="col-md-6">
	              		<div class="card-body">
	              			  
								<?php //echo $form->labelEx($model,'destinatario_titulo'); ?>
								<?php //echo $form->textField($model,'destinatario_titulo',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
								<?php //echo $form->error($model,'destinatario_titulo'); ?>

							 <div class="form-group">
								 <label>
								</label>
								<?php echo $form->labelEx($model,'S&iacute;ntesis *'); ?>
								<?php echo $form->textArea($model,'contenido',array('class'=>'form-control')); ?>
								<?php echo $form->error($model,'contenido'); ?>
			                  </div>	
			                  
	              		</div>
	              	</div>	<!-- col-md-6 -->

		            <div class="col-md-6">
		            	<div class="card-body">
		            		<div class="form-group">
				        		 <label>
									<?php echo $form->labelEx($model,'gestion'); ?>
				        		 </label>
									<?php //echo $form->textArea($model,'observaciones',array('size'=>60,'maxlength'=>500,'class'=>'form-control')); ?>

									<?php echo $form->dropDownList($model,'gestion', 
				                        array(
				                           		2006=> '2006', 
				                           		2007=> '2007', 
				                           		2008=> '2008', 
				                           		2009=> '2009', 
				                           		2010=> '2010', 
				                           		2011=> '2011', 
				                           		2012=> '2012', 
				                           		2013=> '2013',
				                           		2014=> '2014',
				                           		2015=> '2015',
				                           		2016=> '2016',
				                           		2017=> '2017',
				                           		2018=> '2018',
				                           		2019=> '2019',
				                           		2020=> '2020',
				                           		2021=> '2021',
				                           		2022=> '2022',
				                           		2023=> '2023',
				                           	), 
				                              array('empty'=>'Seleccione Gestión','class'=>'form-control  select')
				                        ); ?>

									<?php echo $form->error($model,'gestion'); ?>
				                </div>	
		            	</div>
		            </div><!-- col-md-6 -->

	              </div>
                
                  
                  
                  
                  
                  
                  
              </div>
              <!-- /.card-body -->

              <div class="card-footer" style="background-color: #F2F2F2;">
           		<?php echo CHtml::submitButton($model->isNewRecord ? 'Buscar' : 'Modificar Documento', array('class' => 'btn btn-success')); ?>
              </div>


            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

		<?php //echo $form->labelEx($model,'fecha'); ?>
		<?php //echo $form->textField($model,'fecha'); ?>
		<?php //echo $form->error($model,'fecha'); ?>


	<?php 

	//echo "usuario ---> ".Yii::app()->user->id_usuario;
	//echo "area ---> ".Yii::app()->user->id_area;
	
	?>	
		
		<?php //echo $form->labelEx($model,'hora'); ?>
		<?php //echo $form->textField($model,'hora'); ?>
		<?php //echo $form->error($model,'hora'); ?>
	
		<?php //echo $form->labelEx($model,'nro_hojas'); ?>
		<?php echo $form->hiddenField($model,'nro_hojas',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nro_hojas'); ?>
	
		<?php //echo $form->labelEx($model,'gestion'); ?>
		<?php //echo $form->textField($model,'gestion'); ?>
		<?php //echo $form->error($model,'gestion'); ?>
	
		<?php //echo $form->labelEx($model,'fecha_registro'); ?>
		<?php //echo $form->textField($model,'fecha_registro'); ?>
		<?php //echo $form->error($model,'fecha_registro'); ?>
	
		<?php //echo $form->labelEx($model,'hora_registro'); ?>
		<?php //echo $form->textField($model,'hora_registro'); ?>
		<?php //echo $form->error($model,'hora_registro'); ?>
	
		<?php //echo $form->labelEx($model,'fk_usuario'); ?>
		<?php //echo $form->textField($model,'fk_usuario'); ?>
		<?php //echo $form->error($model,'fk_usuario'); ?>
	
	
		<?php //echo $form->labelEx($model,'fk_area'); ?>
		<?php //echo $form->textField($model,'fk_area'); ?>
		<?php //echo $form->error($model,'fk_area'); ?>
	
		<?php //echo $form->labelEx($model,'fk_documento'); ?>
		<?php echo $form->hiddenField($model,'fk_documento'); ?>
		<?php echo $form->error($model,'fk_documento'); ?>
	
		<?php //echo $form->labelEx($model,'ruta_documento'); ?>
		<?php //echo $form->textField($model,'ruta_documento',array('size'=>60,'maxlength'=>100)); ?>
		<?php //echo $form->error($model,'ruta_documento'); ?>
	
		<?php //echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->hiddenField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>

		
		<?php //echo $form->labelEx($model,'usuario_destino'); ?>
		<?php echo $form->hiddenField($model,'usuario_destino',array('id'=>'usuario_destino', 'value'=>4)); ?>
		<?php echo $form->error($model,'usuario_destino'); ?>

		
		<?php //echo $form->labelEx($model,'grupo_destino'); ?>
		<?php echo $form->hiddenField($model,'grupo_destino',array('id'=>'grupo_destino')); ?>
		<?php echo $form->error($model,'grupo_destino'); ?>
	
<?php $this->endWidget(); ?>

</div><!-- form -->