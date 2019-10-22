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

<h2><strong>Administraci&oacute;n de Usuarios</strong></h2>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
          	<div class="card-body pad table-responsive">	
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('usuarios/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
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
		array(
				'name'=>'fk_perfil',
				'header'=>'Perfil',
				'value'=>'$data->fkPerfil->perfil',
							),
		//'fk_regional',
		array(
				'name'=>'fk_regional',
				'header'=>'Gerencia Regional',
				'value'=>'$data->fkRegional->regional',
							),
		//'fk_area',
		array(
				'name'=>'fk_area',
				'header'=>'Área/Unidad',
				'value'=>'$data->fkArea->area',
							),
		//'fk_nivel',
		array(
				'name'=>'fk_nivel',
				'header'=>'Nivel',
				'value'=>'$data->fkNivel->nivel',
							),
		array(
				'name'=>'activo',
				'header'=>'Estado',
				'value'=>'$data->activo==1?"Habilitado":"Deshabilitado"',
							),
		/*
		'mosca',
		'fecha_registro',
		'hora_registro',
		'update_password',
		'activo',
		*/
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'190px','style'=>'text-align:center',),
		),
	),
)); ?>
