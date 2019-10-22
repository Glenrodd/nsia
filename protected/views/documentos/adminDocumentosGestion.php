<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	'Manage',
);
?>


<b><h4>CITE(s) Asignados</h4></b>
<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
		'tabs'=>array(
			 'Informe'=>array('id'=>'test-id1','content'=>$this->renderPartial(
										'_tabCitesAsignados',
										array('gestion'=>$gestion, 'tipo_documento'=>1),true
										)),

			 'Nota Interna'=>array('id'=>'test-id2','content'=>$this->renderPartial(
										'_tabCitesAsignados',
										array('gestion'=>$gestion,'tipo_documento'=>2),TRUE
										)),

			 'Memorandum'=>array('id'=>'test-id3','content'=>$this->		renderPartial(
										'_tabCitesAsignados',
										array('gestion'=>$gestion,'tipo_documento'=>3),TRUE
										)),
			 'Carta'=>array('id'=>'testid4', 'content'=>$this->renderPartial(
										'_tabCitesAsignados',
										array('gestion'=>$gestion,'tipo_documento'=>4),TRUE
										)),
             'Circular'=>array('id'=>'test-id5','content'=>$this->renderPartial(
                                        '_tabCitesAsignados',
                                        array('gestion'=>$gestion,'tipo_documento'=>5),TRUE
                                        )),

             'Instructivo'=>array('id'=>'test-id6','content'=>$this->renderPartial(
                                        '_tabCitesAsignados',
                                        array('gestion'=>$gestion,'tipo_documento'=>8),TRUE
                                        )),
			/*'StaticTab 1'=>$sample_text,
			'StaticTab 2'=>$sample_text,
			'StaticTab 3'=>array('content'=>$sample_text, 'id'=>'tab3'),*/
		),
		// additional javascript options for the tabs plugin
		'options'=>array(
            'collapsible'=>true,
            'active'=>0,
            //'selected'=>'testid4',
            
		),
		 'id'=>'Menu_Ingresos',
         //'activeTab'=>'testid4',
	));

    ?>









