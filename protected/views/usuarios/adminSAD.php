<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Administracion',
);

/*$this->menu=array(
	array('label'=>'List Usuarios', 'url'=>array('index')),
	array('label'=>'Create Usuarios', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usuarios-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><strong>Administraci&oacute;n de Usuarios - SAD</strong></h3>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
          	<div class="card-body pad table-responsive">	
          		<a class="btn btn-app" href="index.php?r=site/menuGestionDocumental" style="color: black;">
		            <i class="fa fa-tasks"></i>Menu Gesti&oacute;n Documental
		        </a>
            </div>
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
	'id'=>'usuarios-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id_usuario',
		'nombre',
		'cargo',
		'usuario',
		//'password',
		//'correo',
		//'fk_perfil',
		//'fk_regional',
		array(
				'name'=>'fk_regional',
				'header'=>'Gerencia Regional',
				'value'=>'$data->fkRegional->regional',
				'filter'=> CHtml::listData(Regionales::model()->findAll(array('order'=>'id_regional')), 'id_regional', 'regional'),
							),
		//'fk_area',
		array(
				'name'=>'fk_area',
				'header'=>'Área/Unidad',
				'value'=>'$data->fkArea->area',
				'filter' => false,
							),
		//'fk_nivel',
		array(
				'name'=>'fk_nivel',
				'header'=>'Nivel',
				'value'=>'$data->fkNivel->nivel',
				'filter'=> CHtml::listData(Niveles::model()->findAll(array('order'=>'id_nivel')), 'id_nivel', 'nivel'),
							),
		array(
				'name'=>'fk_area',
				'header'=>'Responsable',
				'value'=>'$data->getResponsableArea($data->id_usuario,$data->fk_nivel)',
				'filter' => false,
							),
		array(
				'name'=>'activo',
				'header'=>'Estado',
				'value'=>'$data->activo==1?"Habilitado":"Deshabilitado"',

				'filter' => array(1 => 'Habilitado', 0 => 'Deshabilitado'),
				
			),
		/*
		'mosca',
		'fecha_registro',
		'hora_registro',
		'update_password',
		'activo',
		*/
		/*array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'150px','style'=>'text-align:center',),
		), */
		array(
			'class'=>'CButtonColumn',
			'header'=>'Opción',
			'template' => '{btnView}',//{addUsuario}
			'htmlOptions'=>array('width'=>'100px','style'=>'text-align:center',),
			'buttons'=>array(
			    'btnView' => array(
					'label'=>'<i class="fa fa-user-plus" style="font-size:20px;"></i>',
					'url'=>"CHtml::normalizeUrl(array('/usuarios/asignarSAD', 'id'=>\$data->id_usuario
					        ))",
					'options' => array(
								'class'=>'btnView btn btn-default btn-sm',
								//'class'=>'btnView btn btn-app btn-sm',
								'title'=>'Ver Registro',
								'id'=>'btnView',
							),
			    ), // fin opcion
			    
		     ),
		),  // fin buttons




	),
)); ?>


