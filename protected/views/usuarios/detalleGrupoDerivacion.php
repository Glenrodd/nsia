<head>
	<!--<script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery-1.12.4.js"></script>
    <script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
    <link type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/colReorder.dataTables.min.css" rel="stylesheet" />-->

	<script type="text/javascript">
				/*    $(document).ready(function() {
				    // Setup - add a text input to each footer cell
				    $('#example thead th').each( function () {
				        var title = $('#example thead th').eq( $(this).index() ).text();
				        $(this).html( '<input type="text" placeholder="Buscar..." />' );
				        //$(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
				    } );
				    // DataTable
				    var table = $('#example').DataTable( {
				        colReorder: true
				    } );
				      
				    // Apply the filter
				    $("#example thead input").on( 'keyup change', function () {
				        table
				            .column( $(this).parent().index()+':visible' )
				            .search( this.value )
				            .draw();
				    } );
				    } );    */ 



					function destinatario(valor1, valor2){	

						$("#user_destino").html(valor1);
						$("#derivado_a").val(valor2);
						//$("#usuario_destino").val(valor3);
					}
					</script>
</head>
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

<?php 
Yii::import('zii.widgets.grid.CGridView');

class SpecialGridView extends CGridView {
    public $extraparam;
}
?>

					

<h4><strong>Adici&oacute;n de usuarios al grupo '<?=$grupoDerivacion->nombre_grupo?>'</strong></h4>


<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Retornar Administraci&oacute;n',array('grupoDerivacion/admin'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
      	 </div>
        </div>
        <!-- ./row -->
    </div>
 </section>  

 <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detalle de usuarios habilitados en el Sistema.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">


					<?php $this->widget('SpecialGridView', array(
						'id'=>'usuarios-grid',
						'dataProvider'=>$model->searchActivo(),
						'extraparam'=>$grupoDerivacion->id_grupo_derivacion,
						'filter'=>$model,
						'columns'=>array(
							//'nombre',
							array(
								'header' =>'Nombres' , 
								'name' =>'nombre', 
								'value' =>'$data->nombre' , 
								'htmlOptions'=>array('style'=>'text-align:left; font-size:13px;',),
							),
							array(
								'header'=>'Gerencia Regional',
								'name'=>'fk_regional',
								'value'=>'$data->fkRegional->regional',
								'htmlOptions'=>array('style'=>'text-align:center; font-size:13px;',),

					      	'filter'=> CHtml::listData(Regionales::model()->findAll(array('order'=>'id_regional')), 'id_regional', 'regional')

							),
							array(
									'name'=>'fk_area',
									'header'=>'Área/Unidad',
									'value'=>'$data->fkArea->area',
									'htmlOptions'=>array('style'=>'text-align:center; font-size:13px;',),
									'filter' => CHtml::activeTextField($model, 'fkArea_area'),
							),
							array(
						        'class'=>'CButtonColumn',
						        'template' => '{addUsuario}',
						        'htmlOptions'=>array('width'=>'90px','style'=>'text-align:center',),
						        //'template' => '{solicitudPdf}',
						        'buttons'=>array(
						          'addUsuario' => array(
						            'label'=>'Añadir al grupo',
						            'url'=>"CHtml::normalizeUrl(array('addUsuarioGrupoDerivacion', 'id'=>\$data->id_usuario, 'id_grupo'=>\$this->grid->extraparam
						              ))",
						                'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
						              'options' => array('class'=>'addUsuario'),
						            ),
						          ),
						        ), // fin buttons
						),
					)); ?>

					<!--<div class="card-body pad table-responsive">
						        <table id="example" class="display" style="width:100%">
						         <thead>
						            <tr>
						               <td align="center"><b>Nombres</b></td>
						               <td align="center"><b>Gerencia Regional</b></td>
						               <td align="center"><b>&Aacute;rea/Unidad</b></td>
						               <td align="center"><b></b></td>
						            </tr>
						            <tr>
						               <th align="center"><b>Nombres</b></th>
						               <th align="center"><b>Gerencia Regional</b></th>
						               <th align="center"><b>&Aacute;rea/Unidad</b></th>
						               <td align="center"><b></b></td>
						               
						            </tr>
						         </thead>
						       	 <tbody>
						         <?php 

						         $regional=Yii::app()->user->regional;

						         if ($regional==1) {
						         	$dataReader=Usuarios::getListaDerivacionArea(); 
						         }
						         else{
						         	$dataReader=Usuarios::getListaDerivacionRegional(); 
						         }

						         ?>	
						         <?php foreach ($dataReader as $row) { ?>	
						           <tr>
						            <td align="left"><?=$row['nombre_funcionario']?></td>
						            <td align="left"><?=$row['nombre_regional']?></td>
						            <td align="left"><?=$row['nombre_area']?></td>
						            <td>
						            	<?php 
											  echo CHtml::link(
								          CHtml::image(Yii::app()->baseUrl.'/images/add_user.png'), 
								               array('usuarios/addUsuarioGrupoDerivacion', 'id'=>$row['id_funcionario'], 'id_grupo'=>$grupoDerivacion->id_grupo_derivacion));
								         
											?>
						            </td>
						            
						           </tr>
						         <?php } 

						         $dataReader=Usuarios::getListaDerivacionNacional(); ?>	
						         <?php foreach ($dataReader as $row) { ?>	
						           <tr>
						            <td align="left"><?=$row['nombre_funcionario']?></td>
						            <td align="left"><?=$row['nombre_regional']?></td>
						            <td align="left"><?=$row['nombre_area']?></td>

						            <td>
						            	<?php 
											  echo CHtml::link(
								          CHtml::image(Yii::app()->baseUrl.'/images/add_user.png'), 
								               array('usuarios/addUsuarioGrupoDerivacion', 'id'=>$row['id_funcionario'], 'id_grupo'=>$grupoDerivacion->id_grupo_derivacion));
								         
											?>
						            </td>
						            
						           </tr>
						         <?php } ?>    	 
						         </tbody>
						    	</table>
						    </div>

              </div> -->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div>
          <!--/.col (right) -->
          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detalle de usuarios almacenados para derivar.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

				<div class="row">
		          <div class="col-md-12">
		            <div class="card-body pad table-responsive">
		              	

		                <table class="table table-bordered table-striped">
		                  <tr style="font-size: 16px;">
		              			<th align="center">Nombres</th>
		              			<th align="center">Gerencia Regional</th>
		              			<th align="center">&Aacute;rea/Unidad</th>
		              			<th></th>
		              	  </tr>
		              	  <?php 

			              	$dataReader=Usuarios::getListdetalle($grupoDerivacion->id_grupo_derivacion);


						 	foreach($dataReader as $row) {
		              	?>
		              	  <tr style="font-size: 13px;">
		              			<td><?=$row['nombre_destino']?></td>
		              			<td><?=$row['nombre_regional']?></td>
		              			<td><?=$row['nombre_area']?></td>
		              			<td>
									<?php echo CHtml::link('Eliminar',array('usuarios/deleteGrupoUsuarioDerivacion',
                                        'id'=>$row["id_detalle_grupo_derivacion"]), array('class'=>'btn btn-danger')); ?>
							    </td>
		              	  </tr>

		              	<?php } ?>
		                </table>
		          </div>
		          <!-- /.col -->

		        </div>
		        <!-- /.row -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>



