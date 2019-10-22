<?php
/* @var $this AreasController */
/* @var $model Areas */

$this->breadcrumbs=array(
	'Areases'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List Areas', 'url'=>array('index')),
	array('label'=>'Create Areas', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#areas-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><strong> Pendientes por &Aacute;reas/Unidades Organizacionales</strong></h3>

<p style="color:#0B2F3A">
Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
</p>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'areas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id_area',
		'area',
		'sigla',
		//'cite',
		//'descripcion',
		//'fk_regional',


		array(
				'name'=>'dependencia',
				'header'=>'Dependencia',
				'value'=>'$data->getAreaGrid($data->dependencia)',
							),

		array(
				'name'=>'fk_regional',
				'header'=>'Gerencia Regional',
				'filter'=> CHtml::listData(Regionales::model()->findAll(array('order'=>'id_regional')), 'id_regional', 'regional'),
				'value'=>'$data->fkRegional->regional',
							),

		//'dependencia',
		//'activo',
		array(
				'name'=>'activo',
				'header'=>'Estado',
				'value'=>'$data->activo==1?"Habilitado":"Deshabilitado"',
							),
		/*
		*/
		/*array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'190px','style'=>'text-align:center',),
		),*/
		array(
        'class'=>'CButtonColumn',
        'header'=>'Imprimir Pendientes',
        'template' => '{verUsuarios}', //{ingresoPdf}{verDetalle}{verExcel} {verificarIngreso}
        'htmlOptions'=>array('width'=>'100px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(


        	'verUsuarios'=>array(
						'label'=>'<i class="fa fa-desktop"></i> Ver Usuarios',
					    'url'=>'Yii::app()->createUrl("areas/viewUserArea", array("id_area"=>$data->id_area,"asDialog"=>1))',
					    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
					    'options'=>array(  
					    'ajax'=>array(
					            'type'=>'POST',
					                // ajax post will use 'url' specified above 
					            'url'=>"js:$(this).attr('href')", 
					            'update'=>'#id_view',
					           ),
					    	'class'=>'verUsuarios btn btn-app',
					     ),
				    ),
          ),
        ),// fin buttons

        array(
        'class'=>'CButtonColumn',
        'header'=>'Imprimir Pendientes',
        'template' => '{PendienteArea}', //{ingresoPdf}{verDetalle}{verExcel} {verificarIngreso}
        'htmlOptions'=>array('width'=>'100px','style'=>'text-align:center',),
        //'template' => '{solicitudPdf}',
        'buttons'=>array(

			'PendienteArea' => array(
			    'label'=>'<i class="fa fa-file-excel-o"></i> Imprimir',
			    //'url'=>"CHtml::normalizeUrl(array('seguimientos/updateSeguimientos', 'id'=>\$data->id_seguimiento
			      //  ))",

			    'url'=>'Yii::app()->createUrl("areas/pendientesAreaEXCEL", array("id_area"=>$data->id_area))',
			//'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
			'options' => array('class'=>'addUsuario btn btn-app'),
			    ),

          ),
        ),// fin buttons
	),
)); ?>


<?php 

$this->beginWidget('zii.widgets.jui.CJuiDialog', array( 
'id'=>'dlg-address-view',
'options'=>array(
    'title'=>'Información Solicitada',
    'autoOpen'=>false, //important!
    'modal'=>true,
    'width'=>'65%',
    'height'=>700,
),
));
?>
<div id="id_view"></div>
<?php $this->endWidget();?>
