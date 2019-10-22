<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */

$this->breadcrumbs=array(
	'Seguimientoses'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Seguimientos', 'url'=>array('index')),
	array('label'=>'Manage Seguimientos', 'url'=>array('admin')),
);*/
?>

<h3><strong>Derivaci&oacute;n</strong></h3>
<br>

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
                <h3 class="card-title">Los campos con * son obligatorios.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              	<div class="card-body pad table-responsive">


              	 <table class="table table-bordered table-striped" >
		            <tr style="font-size: 16px; " class="bg-success disabled color-palette">
		            	<th colspan="4" style="border: 1px solid darkgray;">DETALLE DERIVACIÓN</th>
		            </tr>
		            <tr style="font-size: 16px;"  style="">
		            	<th rowspan="3" style="border: 1px solid darkgray;">
		            		<?php 
		            			if ($hojasRuta->oficial==1) { ?>
		            				<center>
		            				 <!--<i style="font-size: 43px;" class="fa fa-star-o"></i><br>-->
		            				 <i  style="font-size: 40px; color: darkred;" class="fa fa-hand-peace-o"></i><br>
		            				Documento Oficial
		            				 </center>

		            				
		            		<?php	}   else{		?>
			            			<center>
			            				<br>
			            				Copia Digital
		            				 </center>
		            		<?php } ?>

		            		<center><p style="font-size:29px; color: darkblue;"><?=$hojasRuta->nur?></p>
		            			<?=$documentos->codigo?>
		            		</center>
		            	</th>
		            	<th align="center"  style="border: 1px solid darkgray;"><u>Derivado a:</u></th>
		            	<th align="center"   style="border: 1px solid darkgray;"><u>Fecha/Hora (Sin confirmar)</u></th>
		            </tr>
		            <tr  style="background-color: white;">
		              	<td style="border: 1px solid darkgray;">
		              		<?=$documentos->destinatario_nombres?><br>
		              		<i><b><p style="font-size: 14px;">(<?=$documentos->destinatario_cargo?>)<p></b></i>

		              		<?php //echo $form->textField($model,'derivado_a',array('value'=>$documentos->usuario_destino, 'class'=>'form-control')); ?>
		              		<?php
							// echo  $form->hiddenField($model,'fk_producto',array()); // Campo oculto para guardar el ID de la persona seleccionada
							echo $form->hiddenField($model,'derivado_a',array()); // Campo oculto para guardar el ID de la persona seleccionada
							$this->widget('zii.widgets.jui.CJuiAutoComplete',
							array(
								'name'=>'nombre_usuario', // Nombre para el campo de autocompletar
								'model'=>$model,
								'value'=>$model->isNewRecord ? '' : $model->fkUsuario->nombre.'  '.$model->fkUsuario->cargo.'',

								'source'=>$this->createUrl('Seguimientos/autocompleteUser'), // URL que genera el conjunto de datos
								'options'=> array(
								'showAnim'=>'fold',
								//'size'=>'70',
								'minLength'=>'3', // Minimo de caracteres que hay que digitar antes de relizar la busqueda
								'select'=>"js:function(event, ui) { 

										$('#Seguimientos_derivado_a').val(ui.item.id); // HTML-Id del campo
									/*  $('#nombreModelo_llaveForanea').val(ui.item.id); // HTML-Id del campo */

									}"
								),
								'htmlOptions'=> array(
									//'size'=>160,
									'class'=>'form-control',
									'placeholder'=>'Buscar Usuario...',
									'title'=>'Indique el nmbre de usuario para realizar la busqueda.'
									),
							));  
							?>
							<?php echo $form->error($model,'derivado_a'); ?>	

		              	</td>
		              	<td style="border: 1px solid darkgray;"><?=date('m/d/Y').' - '.date('H:i:s')?><br>
		              		<!--<i style="color: darkred; font-size: 12px;">La fecha y hora reales ser&aacute;n obtenidos <br> al momento de realizar la derivaci&oacute;n </i>-->
		              	</td>
		              	
		            </tr>
		            <tr  style="background-color: white;">
		              	<td style="border: 1px solid darkgray;" colspan="2"> <b><u>Referencia</u>: </b><?=$documentos->referencia?><br>
		              	</td>
		            </tr>
		         </table>
		     	</div>

                  <!-- text input -->
                  <div class="form-group">
        			<label>
					<?php echo $form->labelEx($model,'prove&iacute;do *'); ?>
        			</label>
					<?php echo $form->textArea($model,'proveido',array('rows'=>2, 'cols'=>50,'class'=>'form-control')); ?>
					<?php echo $form->error($model,'proveido'); ?>
                  </div>
 
                   <div class="form-group">
        			<label>
						<?php echo $form->labelEx($model,'Acci&oacute;n *'); ?>
        			</label>
						<?php //echo $form->textField($model,'fk_accion'); ?>
						<?php echo $form->dropDownList($model,'fk_accion', $model->getListAcciones(), array('empty'=>'Seleccione Acción','class'=>'form-control  select','options' => array('1'=>array('selected'=>true)))); ?>
						<?php echo $form->error($model,'fk_accion'); ?>
                  </div>
                  
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              	<?php echo CHtml::submitButton($model->isNewRecord ? 'Derivar Documento' : 'Actualizar', array('class' => 'btn btn-info')); ?>
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
		<?php //echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->hiddenField($model,'codigo',array('size'=>45,'maxlength'=>45, 'value'=>$hojasRuta->nur)); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'derivado_por'); ?>
		<?php echo $form->hiddenField($model,'derivado_por',array('value'=>Yii::app()->user->id_usuario)); ?>
		<?php echo $form->error($model,'derivado_por'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'derivado_a'); ?>
		
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'fk_estado'); ?>
		<?php echo $form->hiddenField($model,'fk_estado',array('value'=>3)); ?>
		<?php echo $form->error($model,'fk_estado'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->hiddenField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
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
		<?php //echo $form->labelEx($model,'padre'); ?>
		<?php //echo $form->textField($model,'padre'); ?>
		<?php //echo $form->error($model,'padre'); ?>
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

	

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



<?php

$usuarios=Usuarios::model()->findByPk($documentos->usuario_destino);

if ($usuarios->fk_nivel==3 || $documentos->fk_tipo_documento==5) {

?>
<br><h4><strong> Copia Digital enviada a Ventanilla &Uacute;nica</strong></h4>
<!--<i style="color: darkred;">
 En caso de tener registrada m&aacute;s de una copia digital derivada a ventanilla &uacute;nica puede eliminarla 
</i>-->	
<br>

<div class="div_info">
	<i>
	 Puede cambiar el contenido de la casilla <b>Prove&iacute;do</b> dando click sobre el texto  del campo mencionado
	</i>
</div>
<?php

		$criteria = new CDbCriteria();
		$criteria->condition = 'codigo = :codigo AND derivado_por=:derivado_por AND oficial=:oficial AND activo=:activo';
		$criteria->params = array(
				':codigo' => $hojasRuta->nur,
				':derivado_por' => Yii::app()->user->id_usuario,
				':oficial' => 0,
				':activo' => 1,
				//':fk_grupo_derivacion' => 0,
			);
		$criteria->order = "id_seguimiento ASC";

		$dataProvider = new CActiveDataProvider('Seguimientos',
                array(
                        'criteria'  => $criteria,
                        'pagination'=>array('pageSize'=>13),
                )
            );
		//#############################################################
Yii::import('application.extensions.eeditable.*');

$grid_id = 'solicitudes-grid';
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>$grid_id,
    'dataProvider'=>$dataProvider,
    // esta linea es importante, para que tras updates la extension siga funcionando:
	'afterAjaxUpdate'=>new CJavaScriptExpression("function(id){ $('#'+id).EEditable(); }"),
    'columns'=>array(
        array(
            'name'=>'codigo',
            'header'=>'NUR/NURI',
            'value'=>'$data->codigo',
             'htmlOptions'=>array('height'=>100, 'style'=>'text-align:center;'),
        ),
        array(
            'name'=>'derivado_a',
            'header'=>'Derivado a',
            'value'=>'$data->getUsuario($data->derivado_a)',
        ),
        array(
            'name'=>'fecha_derivacion',
            'header'=>'Fecha/Hora',
            'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_derivacion))." - ".$data->hora_derivacion',
        ),
        array(
            'name'=>'fk_estado',
            'header'=>'Estado',
            'value'=>'$data->fkEstado->estado',
        ),

         array(
            'name'=>'fk_estado',
            'header'=>'Estado',
            'value'=>'$data->fkEstado->estado',
        ),

        array(
				'name'=>'fk_grupo_derivacion',
				'header'=>'Grupo',
				'value'=>'$data->fk_grupo_derivacion==0?"Sin Grupo Asignado":$data->fkGrupoDerivacion->nombre_grupo',
				//'value'=>'$data->activo==1?"Habilitado":"Deshabilitado"',
				'cssClassExpression' => '$data->fk_grupo_derivacion==0? "grupoColumn" : ""',
		),

        array(
        		'name'=>'proveido',
        		'header'=>'Proveído',
				'class'=>'EEditableColumn', 'editable_type'=>'editbox',
				'action'=>array('/Seguimientos/ajaxEditColumn'),
				'htmlOptions'=>array('style'=>'text-align:left; width:30%; padding-left:20px;'),
			),
        
        array(
			'class'=>'CButtonColumn',
			'template' => '{delete}',//{addUsuario}
			'htmlOptions'=>array('width'=>'100px','style'=>'text-align:center',),
			'deleteButtonUrl'=>'Yii::app()->createUrl("/Seguimientos/eliminarDerivacion", array("id"=>$data->id_seguimiento))',
			 //'template' => '{solicitudPdf}',
			'buttons'=>array(
			    'addUsuario' => array(
			    'label'=>'Añadir a la Lista',
			    'url'=>"CHtml::normalizeUrl(array('addUsuarioDerivacion', 'id'=>\$data->id_seguimiento
			        ))",
			'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
			'options' => array('class'=>'addUsuario'),
			    ),
		     ),
		), // fin buttons
    ),
 ));

} //if ($usuarios->fk_nivel==3 || $documentos->fk_tipo_documento==5) {










