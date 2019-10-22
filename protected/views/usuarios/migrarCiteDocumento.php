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
<h2>Proceso para migrar CITES y DOCUMENTOS </h2>
<br>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

      	<a class="btn btn-app" href="index.php?r=usuarios/migrarUserFaltante" style="color: black;">
			<i class="fa fa-share"></i>MIGRAR USUARIOS FALTANTES
		</a>

      </div>    
    </div>
        <!-- ./row -->
  </div>
 </section>  

<!-- ##################################################################### -->
<!-- ############# CODIGO PARA MIGRAR LOS CITES Y DOCUMENTOS ############# -->
<!-- ##################################################################### -->

<?php


$i=0;
$dataReader=Usuarios::getSeguimientoSiacoDistinct(); 
//print_r($dataReader);
foreach ($dataReader as $row) { 

	$nuri=$row['codigo'];	
	//echo "<br> --> ".$nuri;


// codigo para obtener los cites asociados al nuri
// tambien se obtendran el tipo documento y usuario	
	$dataReader2=Usuarios::getHojasRutaSiaco($nuri); 
		
	foreach ($dataReader2 as $row2) {
			$i++;
			$cite=$row2['codigo']; 
			//echo "<br>".$i." --> ".$cite;

			// codigo para almacenar los documentos en la tabla documentos
			$doc=Usuarios::getDocumentosSiaco($cite);
			//echo "<br>---> ".$doc['tipo_documento'];

//			$user=$doc['autor'];

			$row_usuario=Usuarios::getDatosUserPostgres($doc['autor']);

			switch ($doc['tipo_documento']) {
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

			echo "<br> --> ".$i." - ".$nuri." - ".$cite." - ".$doc['tipo_documento'];		

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
				$documentos->remitente_institucion='null';
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
			$date=explode(' ', $doc['fecha']);
			$documentos->fecha=$date[0];
			$documentos->hora=$date[1];

			// codigo para obtener la gestion del documento
			// para ello tenemos que separar la gestion de la fecha de  de la base en mysql
			$array_gest=explode('-',$date[0]);
			$gestion=$array_gest['0'];


			$documentos->adjuntos=$doc['adjuntos'];
			$documentos->copias=$doc['copias'];
			//$documentos->copias='null';
			$documentos->via_nombres=$doc['via_nombres'];
			//$documentos->via_nombres='null';
			$documentos->via_cargo=$doc['via_cargo'];
			//$documentos->via_cargo='null';
			$documentos->nro_hojas=$doc['nro_hojas'];
			$documentos->gestion=$gestion;
			$documentos->fecha_registro=date('Y-m-d');
			$documentos->hora_registro=date('H:i:s');
			$documentos->fk_usuario=$row_usuario['id_usuario'];
			$documentos->fk_tipo_documento=$tipo;
			$documentos->fk_estado_documento=2;
			$documentos->fk_area=$row_usuario['fk_area'];;
			$documentos->fk_documento=0;
			$documentos->ruta_documento='null';
			$documentos->activo=1;
			$documentos->usuario_destino=1;
			$documentos->grupo_destino=0;
			$documentos->nombre_grupo='null';
			$documentos->fk_motivo=0;

			//$documentos->=$doc[''];
			
			if ($documentos->insert()) {
				// codigo para almacebar en la tabla hojas ruta

				$hojasruta= new HojasRuta();
				$hojasruta->isNewRecord = true;
				$hojasruta->nur=$nuri;
				$hojasruta->codigo=$documentos->codigo;
				$hojasruta->nro=0;
				$hojasruta->fecha=date('Y-m-d');
				$hojasruta->hora=date('H:i:s');
				$hojasruta->proceso=4;
				$hojasruta->fecha_registro=date('Y-m-d');
				$hojasruta->hora_registro=date('H:i:s');
				$hojasruta->fk_usuario=$row_usuario['id_usuario'];;
				$hojasruta->gestion=$gestion;
				$hojasruta->activo=1;
				$hojasruta->fk_documento=$documentos->id_documento;
				$hojasruta->oficial=0;
				$hojasruta->insert();

			}
			else{
				echo "no guardo documentos";
			} 



		}//foreach ($dataReader2 as $row2) {

} //foreach ($dataReader as $row) { 

?>




