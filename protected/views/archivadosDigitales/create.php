<?php
/* @var $this ArchivadosDigitalesController */
/* @var $model ArchivadosDigitales */

$this->breadcrumbs=array(
	'Archivados Digitales'=>array('index'),
	'Create',
);
?>

<h2>Archivo Digital</h2>

<i>Se procedera al archivo digital del NUR/NURI <b><?=$seguimientos->codigo?></b> en el sistema</i>
<br><br>

<?php $this->renderPartial('_form', array('model'=>$model,'seguimientos'=>$seguimientos,)); ?>