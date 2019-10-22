<?php
/* @var $this ListaDerivacionController */
/* @var $model ListaDerivacion */

$this->breadcrumbs=array(
	'Lista Derivacions'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List ListaDerivacion', 'url'=>array('index')),
	array('label'=>'Create ListaDerivacion', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lista-derivacion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><strong>Administraci&oacute;n de Listas de Derivaci&oacute;n</strong></h3>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('areas/create'), array('class'=>'btn btn-block btn-success')); ?>
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
	'id'=>'lista-derivacion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_lista_derivacion',
		'activo',
		'usuario_origen',
		'usuario_destino',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
