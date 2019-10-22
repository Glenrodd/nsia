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

<h3><strong>Documentos sin NURI asignado</strong></h3>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Retornar',array('site/menuDocumentos'), array('class'=>'btn btn-block btn-success')); ?>
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

<?php 
//$dataProvider=new CActiveDataProvider('DetalleSolicitudes');


// CODIGO AÑADIDO POR ALVARO CANQUI
		// codigo añadido para que en el _view solo muestre la informacion por regional
$regional=Yii::app()->user->regional;
$usuario=Yii::app()->user->id_usuario;
$area=Yii::app()->user->id_area;

$criteria = new CDbCriteria();
$criteria->condition = 'fk_regional = :fk_regional AND fk_area=:fk_area AND fk_solicitud=:fk_solicitud';
$criteria->params = array(':fk_regional' => $regional,  ':fk_area' => $area, ':fk_solicitud' =>0);

$dataProvider = new CActiveDataProvider('DetalleSolicitudes',
                array(
                        'criteria'  => $criteria,
                )
            );

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array( // muestra el atributo 'fecha_creacion' usando una expresión para procesar el valor de éste
            /*'name'=>'fecha_creacion',
            'value'=>'date("M j, Y", $data->fecha_creacion)',*/
            'name'=>'fk_producto',
            'header'=>'Codigo Producto',
            'value'=>'$data->fkProducto->codigo_producto',
        ),
        array( // muestra el atributo 'fecha_creacion' usando una expresión para procesar el valor de éste
            /*'name'=>'fecha_creacion',
            'value'=>'date("M j, Y", $data->fecha_creacion)',*/
            'name'=>'fk_producto',
            'header'=>'Nombre Producto',
            'value'=>'$data->fkProducto->producto',
        ),

        array(
            'name'=>'fk_producto',
            'header'=>'Unidad/Medida',
            'value'=>'$data->obtener_unidadmedida()',
        ),

        'cantidad_solicitada', 

        array(  
            'class'=>'CButtonColumn',
        ),
    ),
 ));



?>