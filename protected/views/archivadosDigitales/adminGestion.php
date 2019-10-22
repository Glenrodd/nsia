<?php
/* @var $this ArchivadosDigitalesController */
/* @var $model ArchivadosDigitales */

$this->breadcrumbs=array(
	'Archivados Digitales'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List ArchivadosDigitales', 'url'=>array('index')),
	array('label'=>'Create ArchivadosDigitales', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#archivados-digitales-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><b>Archivo Digital Gesti&oacute;n  <?=$gestion?></b></h3>



<?php //echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
));*/ ?>
</div><!-- search-form -->



<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              	<p style="color:#0B2F3A">
				Opcionalmente, puede ingresar un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> o <b>=</b>) al comienzo de cada uno de sus valores de búsqueda para especificar cómo se debe hacer la comparación.
				</p>

              		<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'archivados-digitales-grid',
				'dataProvider'=>$model->search(),
				'filter'=>$model,
				'columns'=>array(
					//'id_archivado_digital',
					//'codigo',
					array(
							'name'=>'codigo',
							'header'=>'NUR/NURI',
							'value'=>'$data->codigo',
							'htmlOptions'=>array('style'=>'text-align:center',),
						),
					//'fecha_archivo',
					array(
							'name'=>'fecha_archivo',
							'header'=>'Fecha Archivo',
							'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha_archivo))." - ".$data->hora_archivo',
							'htmlOptions'=>array('style'=>'text-align:center',),
						),
					//'hora_archivo',
					'lugar',
					'observaciones',

					array(
							'name'=>'fk_regional',
							'header'=>'Gerencia Regional',
							'value'=>'$data->getRegional($data->fk_regional)',
							'htmlOptions'=>array('style'=>'text-align:center',),
						),
					/*
					'fk_usuario',
					'fk_seguimiento',
					'fecha_registro',
					'hora_registro',
					'gestion',
					'activo',
					*/
					/*array(
						'class'=>'CButtonColumn',
					),*/
				),
			)); ?>
                 
              </div>
             
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
	</section>









