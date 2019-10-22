<?php
/* @var $this GrupoDerivacionController */
/* @var $model GrupoDerivacion */

$this->breadcrumbs=array(
	'Grupo Derivacions'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List GrupoDerivacion', 'url'=>array('index')),
	array('label'=>'Create GrupoDerivacion', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#grupo-derivacion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<h2><strong>Administraci&oacute;n de Grupos</strong></h2>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('grupoDerivacion/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
      	 </div>
        </div>
        <!-- ./row -->
    </div>
 </section>  

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
	'id'=>'grupo-derivacion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id_grupo_derivacion',
		'nombre_grupo',
		//'fk_area',
		array(
				'name'=>'fk_area',
				'header'=>'Área/Unidad',
				'value'=>'$data->fkArea->area',
			),
		//'fk_usuario',
		array(
				'name'=>'fk_usuario',
				'header'=>'Usuario',
				'value'=>'$data->fkUsuario->nombre',
			),

		//'fk_regional',
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
		/*
		'fecha_registro',
		'hora_registro',
		'activo',
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'190px','style'=>'text-align:center',),
		),
		*/
		array(
        'class'=>'CButtonColumn',
        'template' => '{enabledUsuario}{verDetalle}{view}{update}{delete}{addUsuario}',
        'htmlOptions'=>array('width'=>'230px','style'=>'text-align:center',),
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
        ), // fin buttons


	),
)); ?>


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

