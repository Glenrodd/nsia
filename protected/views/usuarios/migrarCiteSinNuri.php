<?php
/* @var $this UsuariosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuarioses',
);

/*$this->menu=array(
	array('label'=>'Create Usuarios', 'url'=>array('create')),
	array('label'=>'Manage Usuarios', 'url'=>array('admin')),
);*/
?>

<br>
<h2>Proceso para migrar usuarios</h2>
<br>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

      	
      </div>    
    </div>
        <!-- ./row -->
  </div>
 </section>  

<?php		/*
//you must have a animated gif
Yii::app()->clientScript->registerCss('xxx',
        '#yyy .ui-progressbar-value{
                background-image:url(images/pbar-ani.gif)
                }
        '); //must set .ui-progressbar-value in order to animate
 for ($i=0; $i <=60 ; $i++) { 

	$this->widget('zii.widgets.jui.CJuiProgressBar', array(
        'id' => 'yyy',
        'value'=>$i, //value in percent
        'htmlOptions'=>array(
                'style'=>'height:25px',
         ),
		)); 
	} */  ?>

<table width="80%" border="1">
	<thead>
		<tr>
			<th>ID</th>
			<th>nombre</th>
			<th>cargo</th>
			<th>usuario</th>
			<th>password</th>
			<th>correo</th>
			<th>mosca</th>
			<th>oficina</th>
			<th>id_area</th>
			<th>id_regional</th>

			<th>alias</th>
			
		</tr>
	</thead>

equipo local

 <?php 

$password='abc';  
echo hash('sha512', $password);

//  codigo para obtener todos los datos de la tabla usuario MySQL 
//  del servidor 192.168.4.52
$dataReader=Usuarios::getCiteSinNuri(); 
//print_r($dataReader);
$i=0;
foreach ($dataReader as $doc) { 

$i++;

echo "<br> ---> ".$i."---> ".$doc['codigo'];


			switch ($doc['fk_tipo_documento']) {
					    case 'CARTA EXTERNA':
					        $tipo=7;
					        break;
					    case 'INFORME':
					        $tipo=1;
					        break;
					    case 'NOTA':
					        $tipo=2;
					        break;
					    case 'MEMORANDUM':
					        $tipo=3;
					        break;    
					    case 'CIRCULAR':
					        $tipo=5;
					        break;        
					    case 'INSTRUCTIVO':
					        $tipo=8;
					        break;
					    case 'CARTA':
					        $tipo=4;
					        break;                
					}





			$documentos= new Documentos();
			//$documentos->id_documento = null;
			//$documentos->isNewRecord = true;
			$documentos->codigo=$doc['codigo'];
			$documentos->destinatario_titulo=$doc['destinatario_titulo'];
			//$documentos->destinatario_titulo='null';
			$documentos->destinatario_nombres=$doc['destinatario_nombres'];
			//$documentos->destinatario_nombres='null';
			$documentos->destinatario_cargo=$doc['destinatario_cargo'];
			//$documentos->destinatario_cargo='null';
			$documentos->destinatario_institucion=$doc['destinatario_institucion'];
			//$documentos->destinatario_institucion='null';
			$documentos->remitente_nombres=$doc['remitente_nombres'];
			$documentos->remitente_cargo=$doc['remitente_cargo'];

			if ($doc['remitente_institucion']=='') {
				$documentos->remitente_institucion='S/D';
			}else{
				$documentos->remitente_institucion=$doc['remitente_institucion'];
			}

			$documentos->referencia=$doc['referencia'];

			// codigo para importar el contenido
			if ($doc['contenido']=='') {
				$contenido='S/D';
			}
			else{
				$contenido=$doc['contenido'];
			}


			$documentos->contenido=$contenido;

			// codigo para separar la fecha de la base de datos mysql
			$documentos->fecha=$doc['fecha'];
			$documentos->hora=$doc['hora'];

			// codigo para obtener la gestion del documento
			// para ello tenemos que separar la gestion de la fecha de  de la base en mysql

			$documentos->adjuntos=$doc['adjuntos'];
			$documentos->copias=$doc['copias'];
			//$documentos->copias='null';
			$documentos->via_nombres=$doc['via_nombres'];
			//$documentos->via_nombres='null';
			$documentos->via_cargo=$doc['via_cargo'];
			//$documentos->via_cargo='null';
			$documentos->nro_hojas=$doc['nro_hojas'];
			$documentos->gestion=$doc['gestion'];
			$documentos->fecha_registro=$doc['fecha_registro'];
			$documentos->hora_registro=$doc['hora_registro'];

			// obtener por el autor

			$user=Usuarios::getDatosUserPostgres($doc['fk_usuario']);

			$documentos->fk_usuario=$user['id_usuario'];
			$documentos->fk_tipo_documento=$tipo;
			$documentos->fk_estado_documento=$doc['fk_estado_documento'];

			// obtener area

			$documentos->fk_area=$user['fk_area'];
			$documentos->fk_documento=0;
			$documentos->ruta_documento='null';
			$documentos->activo=1;
			$documentos->usuario_destino=1;
			$documentos->grupo_destino=0;
			$documentos->nombre_grupo='null';
			$documentos->fk_motivo=0;
			$documentos->observado=0;

			//$documentos->=$doc[''];
			
			$documentos->insert();

	
?>
	


<?php 

	//}


}
?>

</table>