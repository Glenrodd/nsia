<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#documentos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<h3><strong>Administraci&oacute;n de Documentos Externos-  Gesti&oacute;n <?=$gestion?></strong></h3>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Retornar',array('site/menuVentanillaRecepcion'), array('class'=>'btn btn-block btn-success')); ?>
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
	'id'=>'hojas-ruta-grid',
	'dataProvider'=>$model->searchGestion($gestion),
	//'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id_hoja_ruta',
		//'nur',
		array(
	      'name'=>'nur',
	      'header'=>'NUR',
	      'value'=>'$data->nur',
	      'htmlOptions'=>array('style'=>'text-align:left; font-size:13px; text-align:center;',),
	      ),
		//'codigo',
		array(
	      'name'=>'codigo',
	      'header'=>'CITE Asociado',
	      'value'=>'$data->codigo',
	      'htmlOptions'=>array('style'=>'text-align:left; font-size:13px;',),
	      ),
		//'nro',
		//'fecha',
		array(
	      'name'=>'fecha',
	      'header'=>'Fecha/Hora',
	      'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->fecha))." -  ".$data->hora',
	      'htmlOptions'=>array('style'=>'text-align:center; font-size:13px;',),
	      'filter'=>false,
	      ),

		array(
				'name'=>'nro',
				'header'=>'Referencia',
				'value'=>'$data->fkDocumento->referencia',
				'htmlOptions'=>array('style'=>'text-align:left; font-size:13px;',),
				'filter'=>false,
							),
		array(
				'name'=>'nro',
				'header'=>'Destinatario',
				'value'=>'$data->fkDocumento->destinatario_nombres',
				'htmlOptions'=>array('style'=>'text-align:center; font-size:13px;',),
				'filter'=>false,
							),
		/*array(
				'name'=>'fk_documento',
				'header'=>'Tipo Documento',
				'value'=>'$data->fkDocumento->fkTipoDocumento->tipo_documento',
				'htmlOptions'=>array('style'=>'text-align:center; font-size:13px;',),
			),*/
		/*array(
				'name'=>'activo',
				'header'=>'Estado',
				'value'=>'$data->activo==1?"Habilitado":"Deshabilitado"',
							),*/
		/*
		'proceso',
		'fecha_registro',
		'hora_registro',
		'fk_usuario',
		'gestion',
		'activo',
		'fk_documento',
		*/

		array(
        'class'=>'CButtonColumn',
        'template' => '{agrupar}{derivar}', //{view} {update} {delete} {ingresoPdf}{verDetalle}{verificarIngreso}
        'htmlOptions'=>array('width'=>'200px','style'=>'text-align:center',),
        'header'=>'Editar',
        //'template' => '{solicitudPdf}',
        'buttons'=>array(

          'agrupar' => array(
            'label'=>' <i class="fa fa-edit"></i> Editar',
            'url'=>"CHtml::normalizeUrl(array('documentos/updateDocument', 'id_documento'=>\$data->fk_documento, 'tipo_documento'=>7
              ))",
               // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
              'options' => array(
              		//'class'=>'btn btn-app',
              		'class'=>'btn btn-default btn-sm',
              		'title'=>'editar doc.'
              		//'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',

              	),
               //'visible'=>'$data->getCountNuriDerivado($data->nur) > 0',
            ),// fin derivarDocumento

          'derivar' => array(
            'label'=>' <i class="fa fa-share"></i> Derivar',
            'url'=>"CHtml::normalizeUrl(array('seguimientos/derivarDocumento', 'id_documento'=>\$data->fk_documento, 'id_hoja_ruta'=>\$data->id_hoja_ruta
              ))",
               // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/excel.png',
              'options' => array(
              		//'class'=>'btn btn-app',
              		'class'=>'btn btn-default btn-sm',
              		'title'=>'editar doc.'
              		//'onclick'=>'js:alert("Renaming is currently disabled. Please stay tuned");',

              	),
               'visible'=>'$data->getCountNuriDerivado($data->nur)==0',
            ),// fin derivarDocumento
          


          ),
        ),// fin buttons


	),
)); ?>

