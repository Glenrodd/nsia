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

<h3><strong><u>Usuarios Gerencia Regional</u></strong></h3><br>

<!-- Main content -->
<!-- <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
          	<div class="card-body pad table-responsive">	
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php //echo CHtml::link('Nuevo Registro',array('usuarios/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
            </div>
            </div>    
        </div>
    </div>
 </section>  -->


<p style="color:#0B2F3A">
Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
</p>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php 

/*Yii::import('zii.widgets.grid.CGridView');

class SpecialGridView extends CGridView {
    public $usuario;
    public $regional;
    public $ip;
}*/
?>

<?php /*$this->widget('SpecialGridView', array(
	'id'=>'usuarios-grid',
	'dataProvider'=>$model->searchRegional(),
  
  //'usuario'=>Yii::app()->user->usuario,
  'regional'=>Yii::app()->user->regional,
  //'ip'=>CHttpRequest::getUserHostAddress(),*/



 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuarios-grid',
	'dataProvider'=>$model->searchRegional(), 
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
				'filter'=> CHtml::listData(Perfiles::model()->findAll(array('order'=>'id_perfil')), 'id_perfil', 'perfil'),
							),
		//'fk_regional',
		array(
				'name'=>'fk_regional',
				'header'=>'Gerencia Regional',
				'value'=>'$data->fkRegional->regional',
				//'filter'=> CHtml::listData(Regionales::model()->findAll(array('order'=>'id_regional')), 'id_regional', 'regional'),
				'filter' => false,
							),
		//'fk_area',
		array(
				'name'=>'fk_area',
				'header'=>'Área/Unidad',
				'value'=>'$data->fkArea->area',
				//'filter' => false,
				'filter'=> CHtml::listData(Areas::model()->findAll(array("condition"=>"t.fk_regional=".Yii::app()->user->regional, 'order'=>'id_area')), 'id_area', 'area'),
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
		/*array(
			'class'=>'CButtonColumn',
			'header'=>'Opción',
			'template' => '{btnView}{btnEdit}{btnDelete}',//{addUsuario}
			'htmlOptions'=>array('width'=>'210px','style'=>'text-align:center',),
			'buttons'=>array(
			    'btnView' => array(
					'label'=>'<i class="fa fa-eye" style="font-size:20px;"></i>',
					'url'=>"CHtml::normalizeUrl(array('/usuarios/view', 'id'=>\$data->id_usuario
					        ))",
					'options' => array(
								'class'=>'btnView btn btn-default btn-sm',
								//'class'=>'btnView btn btn-app btn-sm',
								'title'=>'Ver Registro',
								'id'=>'btnView',
							),
			    ), // fin opcion
			    'btnEdit' => array(
					'label'=>'<i class="fa fa-pencil" style="font-size:20px;"></i>',
					'url'=>"CHtml::normalizeUrl(array('/usuarios/update', 'id'=>\$data->id_usuario
					        ))",
					'options' => array(
								'class'=>'btnView btn btn-default btn-sm',
								//'class'=>'btnView btn btn-app btn-sm',
								'title'=>'Editar Registro',
								'id'=>'btnEdit',
							),
			    ), // fin opcion
			    'btnDelete' => array(
					'label'=>'<i class="fa fa-trash-o" style="font-size:20px;"></i>',
					'url'=>"CHtml::normalizeUrl(array('/usuarios/eliminar', 'id'=>\$data->id_usuario
					        ))",
					'options' => array(
								'class'=>'btnView btn btn-default btn-sm',
								//'class'=>'btnView btn btn-app btn-sm',
								'title'=>'Eliminar Registro',
								'id'=>'btnDelete',
							),
					//'click'=>'function(){return confirm("Realmente desea eliminar este resgitro  ?");}',


			    ), // fin opcion
			    
		     ),
		), */ // fin buttons




	),
)); ?>


