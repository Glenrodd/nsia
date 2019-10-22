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
$dataReader=Usuarios::getUsuariosMySQL(); 
//print_r($dataReader);
$i=1;
foreach ($dataReader as $row) { 

//$i++;
	
	$nombre=trim($row['nombre']);
	$nombre=strtoupper($nombre);

	$cargo=trim($row['cargo']);
	$cargo=strtoupper($cargo);

	$usuario=trim($row['id_usuario']);
	$password=trim($row['password']);
	$password=hash('sha512', $password);
	
	$correo=trim($row['email']);
	$mosca=trim($row['mosca']);
	$oficina=trim($row['oficina']);
	$area_sad=$row['area_sad'];

	if ($row['area_sad']=='') {
		$area_sad=0;		
	}
	else{
		$area_sad=$row['area_sad'];		
	}
	
	//echo "<br>".$nombre." ".$cargo." ".$usuario." ".$password." ".$correo." ".$mosca." ".$oficina;

	$row2=Usuarios::getAreaSiaco($oficina);

	if ($row2['id_area']=='') {
		$color='lightblue';
		?>
		<tr>
			<td><?=$i++?></td>
			<td><?=$nombre?></td>
			<td><?=$cargo?></td>
			<td><?=$usuario?></td>
			<td>***</td>
			<td><?=$correo?></td>
			<td><?=$mosca?></td>
			<td><?=$oficina?></td>
			<td style="background-color:<?=$color?>"><?=$row2['id_area']?></td>
			<td style="background-color:<?=$color?>"><?=$row2['fk_regional']?></td>
		</tr>

<?php
	}
	else{
		$color='';	 }



		if ($row2['fk_regional']=='') {
			$regional=1;
		}
		else{
			$regional=$row2['fk_regional'];
		}


		if ($row2['id_area']=='') {
			$area=1;
		}
		else{
			$area=$row2['id_area'];
		}



		//codigo para almacenar en la base de datos postgres los usuarios
		//almacenados en la base MySQL

		$usuarios= new Usuarios();

		//$usuarios->isNewRecord = true;
		//$usuarios->id_usuario = null;
		$usuarios->nombre=$nombre;
		$usuarios->cargo=$cargo;
		$usuarios->usuario=$usuario;
		$usuarios->password=$password;
		//$usuarios->password='0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8';
		$usuarios->correo=$correo;
		$usuarios->mosca=$mosca;
		$usuarios->fk_perfil=4;
		$usuarios->fk_regional=$regional;
		$usuarios->fk_area=$area;
		$usuarios->fk_nivel=2;
		$usuarios->fecha_registro=date('Y-m-d');
		$usuarios->hora_registro=date('H:i:s');
		$usuarios->update_password=date('Y-m-d H:i:s');
		$usuarios->activo=$row['habilitado'];
		$usuarios->area_sad=$area_sad;
		//$usuarios->save();
		$usuarios->insert();

		$id_usuario=$usuarios->id_usuario;

		if ($row['habilitado']==1) {
		if (Usuarios::countAliasMysql($usuario)>0) {
			
			$row_alias=Usuarios::getAliasMysql($usuario);
			$dato=$row_alias['nom_alias']." - ".$row_alias['cargo_alias'];	


			$alias= new Alias();
			//$alias->isNewRecord = true;
			//$alias->id_alias = null;
			$alias->nombre=$row_alias['nom_alias'];
			$alias->cargo=$row_alias['cargo_alias'];
			$alias->descripcion='SIN DESCRIPCION';
			$alias->fk_usuario=$id_usuario;
			$alias->activo=1;
			$alias->fecha_registro=date('Y-m-d');
			$alias->hora_registro=date('H:i:s');
			$alias->insert();
			//$alias->save();
		}
		else{ $dato=''; }

	}

	else{ $dato=''; }

		




		?>
		<tr>
			<td><?=$i++?></td>
			<td><?=$nombre?></td>
			<td><?=$cargo?></td>
			<td><?=$usuario?></td>
			<td>***</td>
			<td><?=$correo?></td>
			<td><?=$mosca?></td>
			<td><?=$oficina?></td>
			<td style="background-color:<?=$color?>"><?=$row2['id_area']?></td>
			<td style="background-color:<?=$color?>"><?=$row2['fk_regional']?></td>
			<td><?=$dato?></td>
		</tr>


<?php 

	//}


}
?>

</table>