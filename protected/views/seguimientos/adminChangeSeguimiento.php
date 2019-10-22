<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */
/* @var $form CActiveForm */
?>
<center>
<h3><b><i>"Cambio de fecha, hora y prove&iacute;do"</i></b></h3>
<i>En este formulario podra modificar los datos de: Prove&iacute;do, Fecha y Hora de derivaci&oacute;n y recepci&oacute;n.<br> Solo es necesario seleccionar el campo que desea modificar</i>

</center>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-primary">
              <div class="card-header">
              	<h3 class="card-title">
              	<i class="fa fa-tasks"></i>
              	Detalle de NUR/NURI: <b><?=$nuri?></b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <!-- text input -->
                <a class="btn btn-app" href="index.php?r=seguimientos/changeSeguimiento" style="color: black;">
                  <i class="fa fa-search"></i>Retornar B&uacute;squeda
                </a>
                <a class="btn btn-app" href="index.php?r=site/menuAdministracion" style="color: black;">
                  <i class="fa fa-dedent"></i>Retornar Administraci&oacute;n
                </a>


            	<?php

// CODIGO AÑADIDO POR ALVARO CANQUI
		// codigo añadido para que en el _view solo muestre la informacion por regional
		
		
		//$gestion=2017;

		$criteria = new CDbCriteria();
		$criteria->condition = 'activo = :activo AND codigo = :codigo';

		$criteria->params = array(':activo' => 1,':codigo' => $nuri);
		$criteria->order = "id_seguimiento ASC";

		$dataProvider = new CActiveDataProvider('Seguimientos',
                array(
                        'criteria'  => $criteria,
                        'pagination'=>array('pageSize'=>15),
                )
            );
		//#############################################################
Yii::import('application.extensions.eeditable.*');

$this->widget('CGridViewPlus', array(
    'dataProvider'=>$dataProvider,
    //'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'afterAjaxUpdate'=>new CJavaScriptExpression("function(id){ $('#'+id).EEditable(); }"),
	
	'addingHeaders' => array(
         //array('group A' => 2, 'group B' => 5),             // first row
         array('' => 2, 'USUARIO ORIGEN' => 3, 'USUARIO DESTINO' => 3,' ' => 3),   // second row
     ),

    'columns'=>array(
        //'id_seguimiento',
        'codigo',
		//'derivado_por',
		array(
				'name'=>'derivado_por',
				'header'=>'Derivado Por',
				'value'=>'$data->getUsuario($data->derivado_por)',
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
			),
		//'derivado_a',
		//'proveido',
		array(
        		'name'=>'fecha_derivacion',
        		'header'=>'Fecha Derivación',
        		//'value'=>'date("m/d/Y",$data->fecha_derivacion)',
				'class'=>'EEditableColumn', 'editable_type'=>'editbox',
				'action'=>array('/Seguimientos/AjaxEditFechaDerivacion'),
				'htmlOptions'=>array('style'=>'text-align:center; padding-left:20px; font-size:12px;'),
			),
		array(
				'name'=>'hora_derivacion',
				'header'=>'Hora Derivación',
				//'value'=>'date("m/d/Y",$data->fecha)',
				'value'=>'$data->hora_derivacion',
				'class'=>'EEditableColumn', 'editable_type'=>'editbox',
				'action'=>array('/Seguimientos/AjaxEditHoraDerivacion'),
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
				//'value'=>'Yii::app()->dateFormatter->format("d/MMM/Y h:i:s",strtotime($data->datetime))',
			),

		array(
				'name'=>'derivado_a',
				'header'=>'Derivado A',
				'value'=>'$data->getUsuario($data->derivado_a)',
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
			),

		array(
        		'name'=>'fecha_recepcion',
        		'header'=>'Fecha Recepción',
        		//'value'=>'date("m/d/Y",$data->fecha_recepcion)',
				'class'=>'EEditableColumn', 'editable_type'=>'editbox',
				'action'=>array('/Seguimientos/AjaxEditFechaRecepcion'),
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
			),
		array(
				'name'=>'hora_recepcion',
				'header'=>'Hora Recepción',
				
				'value'=>'$data->hora_recepcion',
				'class'=>'EEditableColumn', 'editable_type'=>'editbox',
				'action'=>array('/Seguimientos/AjaxEditHoraRecepcion'),
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
				//'value'=>'Yii::app()->dateFormatter->format("d/MMM/Y h:i:s",strtotime($data->datetime))',
			),
		array(
        		'name'=>'proveido',
        		'header'=>'Proveído',
				'class'=>'EEditableColumn', 'editable_type'=>'editbox',
				'action'=>array('/Seguimientos/AjaxEditProveido'),
				'htmlOptions'=>array('style'=>'text-align:left; padding-left:5px; font-size:12px;'),
			),
		array(
				'name'=>'estado',
				'header'=>'Estado',
				//'value'=>'date("m/d/Y",$data->fecha)',
				'value'=>'$data->fkEstado->estado',
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
				//'value'=>'Yii::app()->dateFormatter->format("d/MMM/Y h:i:s",strtotime($data->datetime))',
			),
		array(
				'name'=>'oficial',
				'header'=>'Tipo',
				//'value'=>'date("m/d/Y",$data->fecha)',
				'value'=>'$data->oficial==1?"Original":"Copia Digital"',
				'htmlOptions'=>array('style'=>'text-align:center; font-size:12px;'),
				//'value'=>'Yii::app()->dateFormatter->format("d/MMM/Y h:i:s",strtotime($data->datetime))',
			),


		//############################################################
		

		//'id_seguimiento',
		
		/*
		'fecha_derivacion',
		'hora_derivacion',
		'fecha_recepcion',
		'hora_recepcion',
		'fk_accion',
		'fk_estado',
		'padre',
		'oficial',
		'hijo',
		'fecha_registro',
		'hora_registro',
		'gestion',
		'confirmado',
		'activo',
		*/
		/* array(
        'class'=>'CButtonColumn',
        'template' => '{view} {update} {delete}', //{ingresoPdf}{verDetalle}{verExcel} {verificarIngreso}
        'htmlOptions'=>array('width'=>'190px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(
          'ingresoPdf' => array(
            'label'=>'Generar PDF',
            'url'=>"CHtml::normalizeUrl(array('ingresoPdf', 'id'=>\$data->id_seguimiento
              ))",
                'imageUrl'=>Yii::app()->request->baseUrl.'/images/pdf.png',
              'options' => array('class'=>'ingresoPdf'),
            ),
          'verDetalle'=>
				array(
						'label'=>'ver Detalle',
					    'url'=>'Yii::app()->createUrl("Ingresos/verDetalleIngreso", array("id"=>$data->id_seguimiento,"asDialog"=>1))',
					    'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
					    'options'=>array(  
					    'ajax'=>array(
					            'type'=>'POST',
					                // ajax post will use 'url' specified above 
					            'url'=>"js:$(this).attr('href')", 
					            'update'=>'#id_view',
					           ),
					     ),
				    ),

			'verExcel' => array(
            'label'=>'Generar EXCEL',
            'url'=>"CHtml::normalizeUrl(array('ingresoExcel', 'id'=>\$data->id_seguimiento
              ))",
                'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
              'options' => array('class'=>'ingresoExcel'),
            ),	

            'verificarIngreso' => array(
			            'label'=>'Verificar Saldo Incial',
			            'url'=>"CHtml::normalizeUrl(array('verificarIngreso', 'id'=>\$data->id_seguimiento
			              ))",
			                'imageUrl'=>Yii::app()->request->baseUrl.'/images/table.png',
			              'options' => array('class'=>'verificarIngreso'),
			        ), 




          ),


        ),// fin buttons */







    ),
 ));



?> 
                  

                  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
	</section>