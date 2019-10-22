<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */



/*$this->menu=array(
	array('label'=>'List Usuarios', 'url'=>array('index')),
	array('label'=>'Create Usuarios', 'url'=>array('create')),
	array('label'=>'View Usuarios', 'url'=>array('view', 'id'=>$model->id_usuario)),
	array('label'=>'Manage Usuarios', 'url'=>array('admin')),
);*/
?>

<h3><strong> Detalle de accesos al sistema </strong></h3>

<!-- Main content -->
 

 <table width="60%" align="center" cellpadding="3px" cellspacing="0" border="1px">
   <tr align="center">
     <th>N°</th>
     <th>Nombre y Apellidos</th>
     <th>Área/Unidad organizacional</th>
     <th>Gerencia Regional</th>
     
   </tr>

<?php 
// codigo para obtener todos los usuarios que accedieron al sistema

$dataReader=Usuarios::getDistinctUser(); 
//print_r($dataReader);

$i=0;
foreach ($dataReader as $row) { 
  $id_usuario=$row['id_usuario'];
  //echo "<br> ->".$id_usuario;

  $usuarios=Usuarios::model()->findByPk($id_usuario);

  if (Usuarios::model()->findByPk($id_usuario)) {
  $i++;
    //echo " <br> si ->".$id_usuario;
?>
  
<tr>
  <td align="center"><?=$i?></td>
  <td><?=$usuarios->nombre ?></td>
  <td><?=$usuarios->fkArea->area ?></td>
  <td><?=$usuarios->fkRegional->regional ?></td>
</tr>

<?php
  } //if (Usuarios::model()->findByPk($id_usuario)) {
}//foreach ($dataReader as $row) {

 ?>  

 </table>
