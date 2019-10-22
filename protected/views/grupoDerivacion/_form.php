<?php
/* @var $this GrupoDerivacionController */
/* @var $model GrupoDerivacion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'grupo-derivacion-form',
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
                <h3 class="card-title">Los campos con * son obligatorios.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <!-- text input -->
                  <div class="form-group">
        			<label>
        				<?php echo $form->labelEx($model,'nombre_grupo'); ?>
        			</label>
						<?php echo $form->textField($model,'nombre_grupo',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
						<?php echo $form->error($model,'nombre_grupo'); ?>
                  </div>
                  
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



	
		<?php //echo $form->labelEx($model,'fk_area'); ?>
		<?php //echo $form->textField($model,'fk_area'); ?>
		<?php //echo $form->error($model,'fk_area'); ?>
	
		<?php //echo $form->labelEx($model,'fk_usuario'); ?>
		<?php //echo $form->textField($model,'fk_usuario'); ?>
		<?php //echo $form->error($model,'fk_usuario'); ?>
	
		<?php //echo $form->labelEx($model,'fk_regional'); ?>
		<?php //echo $form->textField($model,'fk_regional'); ?>
		<?php //echo $form->error($model,'fk_regional'); ?>
	
		<?php //echo $form->labelEx($model,'fecha_registro'); ?>
		<?php //echo $form->textField($model,'fecha_registro'); ?>
		<?php //echo $form->error($model,'fecha_registro'); ?>
	
		<?php //echo $form->labelEx($model,'hora_registro'); ?>
		<?php //echo $form->textField($model,'hora_registro'); ?>
		<?php //echo $form->error($model,'hora_registro'); ?>
	
		<?php //echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->hiddenField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	

	

<?php $this->endWidget(); ?>

</div><!-- form -->


<?php

	$usuario=Yii::app()->user->id_usuario;


    $criteria = new CDbCriteria();
    $criteria->condition = 'fk_usuario = :fk_usuario';

    $criteria->params = array(':fk_usuario' => $usuario);
    
    $criteria->order = "id_grupo_derivacion ASC";

    $dataProviderEstructura = new CActiveDataProvider('GrupoDerivacion',
                array(
                        'criteria'  => $criteria,
                        'pagination'=>array('pageSize'=>10),
                )
            );

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProviderEstructura,
    	//'dataProvider'=>$model->search(),
		//'filter'=>$model,
        //'cssFile'=>false,
        //'cssFile' => Yii::app()->baseUrl . '/css/gridView.css',
        'summaryText' => 'Mostrando {start} - {end} de {count} registros',
        'htmlOptions' => array('class' => 'grid-view rounded'),
    'columns'=>array(
        
    
      array(
            'name'=>'nombre_grupo',
            'header'=>'Nombre Grupo',
            'value'=>'$data->nombre_grupo',
            'htmlOptions'=>array('style'=>'text-align:center; font-size:13px;',),
         ),
      array(
				'name'=>'fk_area',
				'header'=>'Área/Unidad',
				'value'=>'$data->fkArea->area',
			),
	  array(
				'name'=>'fk_regional',
				'header'=>'Gerencia Regional',
				'value'=>'$data->fkRegional->regional',
			),
      array(
				'name'=>'activo',
				'header'=>'Estado',
				'value'=>'$data->activo==1?"Habilitado":"Deshabilitado"',
							),
   
    array(
        'class'=>'CButtonColumn',
        'template' => '{enabledUsuario}{verDetalle}{view}{update}{delete}{addUsuario}',
        'htmlOptions'=>array('width'=>'200px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(
            'addUsuario' => array(
                  'label'=>'Agregar Usuarios',
                  'url'=>"CHtml::normalizeUrl(array('usuarios/detalleGrupoDerivacion', 'id'=>\$data->id_grupo_derivacion
                    ))",
                      'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
                    'options' => array('class'=>'addUsuario'),
              ),

            'enabledUsuario' => array(
                  'label'=>'Habilitar Grupo',
                  'url'=>"CHtml::normalizeUrl(array('GrupoDerivacion/enabledUser', 'id'=>\$data->id_grupo_derivacion
                    ))",
                      'imageUrl'=>Yii::app()->request->baseUrl.'/images/enabledUser.png',
                    'options' => array('class'=>'enabledUser'),
              ),

            'verDetalle'=>
				array(
						'label'=>'Ver Detalle Usuarios',
					    'url'=>'Yii::app()->createUrl("GrupoDerivacion/verDetalleUsuarios", array("id"=>$data->id_grupo_derivacion,"asDialog"=>1))',
					    'imageUrl'=>Yii::app()->request->baseUrl.'/images/window.png',
					    'options'=>array(  
					    'ajax'=>array(
					            'type'=>'POST',
					                // ajax post will use 'url' specified above 
					            'url'=>"js:$(this).attr('href')", 
					            'update'=>'#id_view',
					           ),
					     ),
				    ),


          ),
        ),
    ),
 ));
?>

<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog', array( 
'id'=>'dlg-address-view',
'options'=>array(
    'title'=>'Detalle Usuarios ',
    'autoOpen'=>false, //important!
    'modal'=>true,
    'width'=>850,
    'height'=>600,
),
));
?>
	<div id="id_view"></div>

<?php $this->endWidget();?>