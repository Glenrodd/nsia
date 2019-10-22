<?php
/* @var $this RegionalesController */
/* @var $model Regionales */

$this->breadcrumbs=array(
	'Regionales'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List Regionales', 'url'=>array('index')),
	array('label'=>'Create Regionales', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#regionales-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><strong>Administraci&oacute;n de Regionales</strong></h3>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
          	<div class="card-body pad table-responsive">		
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('regionales/create'), array('class'=>'btn btn-block btn-success')); ?>
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
	'id'=>'regionales-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id_regional',
		'regional',
		'sigla',
		'descripcion',
		//'activo',
		array(
				'name'=>'activo',
				'header'=>'Estado',
				'value'=>'$data->activo==1?"Habilitado":"Deshabilitado"',
							),
		array(
			'class'=>'CButtonColumn',
			//'template' => '{update}',
        	'htmlOptions'=>array('width'=>'190px','style'=>'text-align:center',),
		),
	),
)); ?>
