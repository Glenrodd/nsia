<?php

class UsuariosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('listaDerivacion','addUsuarioDerivacion','deleteUsuarioDerivacion','detalleGrupoDerivacion','addUsuarioGrupoDerivacion','deleteGrupoUsuarioDerivacion','updatePassword','eliminar','asignarSAD','adminSAD','regionalesByAreas'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('migrarUsuarios','create','update','admin','delete','migrarSeguimiento','migrarCiteDocumento','migrarUserFaltante','accesoSistema','migrarCiteSinNuri','migrarCiteConNUri','adminRegional'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Usuarios;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Usuarios']))
		{
			$model->attributes=$_POST['Usuarios'];
			
			$area_sad=$_POST['Usuarios']['area_sad'];
			$model->area_sad=$area_sad;

			$model->password=hash('sha512', $model->password);

			$model->nombre=strtoupper($model->nombre);
			$model->cargo=strtoupper($model->cargo);
			$model->mosca=strtoupper($model->mosca);
			$model->correo=strtolower($model->correo);
			$model->area_sad=0;
			//$model->=strtoupper($model->);


			if($model->save())
				$this->redirect(array('view','id'=>$model->id_usuario));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Usuarios']))
		{
			$model->attributes=$_POST['Usuarios'];
			$area_sad=$_POST['Usuarios']['area_sad'];
			$activo=$_POST['Usuarios']['activo'];
			if ($area_sad!="") {
				$model->area_sad=$area_sad;
			}
			else{
				$model->area_sad=0;
			}

			//$model->password=hash('sha512', $model->password);
			$model->activo=$activo;
			$model->nombre=strtoupper($model->nombre);
			$model->cargo=strtoupper($model->cargo);
			$model->mosca=strtoupper($model->mosca);
			$model->correo=strtolower($model->correo);
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_usuario));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionAsignarSAD($id)
	{
			$model=$this->loadModel($id);

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['Usuarios']))
			{
				$model->attributes=$_POST['Usuarios'];
				$area_sad=$_POST['Usuarios']['area_sad'];
				$model->attributes=$area_sad;
				//$model->password=hash('sha512', $model->password);
				if ($model->correo=='') {
					$model->correo='null';	
				}

				if ($model->mosca=='') {
					$model->mosca='null';	
				}

				$model->nombre=strtoupper($model->nombre);
				$model->cargo=strtoupper($model->cargo);
				$model->mosca=strtoupper($model->mosca);
				$model->correo=strtolower($model->correo);
				
				if($model->save()){
					Usuarios::mensajeAsignarSAD($model->nombre);
					$this->redirect(array('adminSAD'));
				}
			}

			$this->render('asignarSAD',array(
				'model'=>$model,
			));
	}


	public function actionUpdatePassword()
	{
		$model=$this->loadModel(Yii::app()->user->id_usuario);

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Usuarios']))
		{
			$model->attributes=$_POST['Usuarios'];
			$model->password=hash('sha512', $model->password);
			$model->nombre=strtoupper($model->nombre);
			$model->cargo=strtoupper($model->cargo);
			$model->mosca=strtoupper($model->mosca);
			$model->correo=strtolower($model->correo);
			


			
			if($model->save()){
				//echo "Contraseña cambiada correctamente";
				Yii::app()->user->setFlash('successm', " <i class='fa fa-thumbs-o-up' id='mensaje_emergente' style='color:#086A87;'></i><br> Contraseña actualizada Correctamente!");
				
				//$this->redirect(array('updatePassword'));
				$this->redirect(array('site/index'));
			}	

				Yii::app()->user->setFlash('errorm', "<i class='fa fa-times-circle nav-icon' style='color:red;'></i> Error al registrar la informacion!");
		}

		$this->render('updatePassword',array(
			'model'=>$model,
		));
	}

	
	public function actionListaDerivacion()
	{
		$model=new Usuarios('searchActivo');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuarios']))
			$model->attributes=$_GET['Usuarios'];


		// codigo para la paginacion de la tabla
		$count=Usuarios::countListDerivacion();
        $pages=new CPagination($count);
        $cantidad=$pages->pageSize=15;
         
        if(!isset($_GET["page"])){ $_GET["page"]=1; }
        $inicio=($_GET["page"]-1)*$cantidad;
        $getHojasDerivacion=Usuarios::getDerivaciones($inicio,$cantidad);
        //###########################################33


		$this->render('listaDerivacion',array(
			'model'=>$model,
			"hojas"=>$getHojasDerivacion,
			"pages"=>$pages
		));
	}


	public function actionDetalleGrupoDerivacion($id)
	{
		$model=new Usuarios('searchActivo');
		$grupoDerivacion=GrupoDerivacion::model()->findByPk($id);

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuarios']))
			$model->attributes=$_GET['Usuarios'];

		$this->render('detalleGrupoDerivacion',array(
			'model'=>$model,
			'grupoDerivacion'=>$grupoDerivacion,
			
		));
	}


	

	public function actionAddUsuarioDerivacion($id)
	{

		$connection= Yii::app()->db;

		$usuario=Yii::app()->user->id_usuario;

		// codigo para verificar que no existen usuarios
	 	/*$row=$connection->createCommand("SELECT count(id_lista_derivacion) as total
			   FROM lista_derivacion 
			   WHERE usuario_origen=$usuario AND usuario_destino=$id AND activo=1")->query()->read();*/
	 	
	 	$count = ListaDerivacion::model()->countByAttributes(array(
            'usuario_origen'=>$usuario,
            'usuario_destino'=>$id,
            'activo'=>1,
        ));


		if ($count==0) {
			// codigo para actualizar en la tabla  detalle_ingreso
			$connection->createCommand("INSERT INTO lista_derivacion (usuario_origen, usuario_destino) VALUES ($usuario,$id)")->execute();
		}
		else{

			$usuarios=Usuarios::model()->findByPk($id);
			Usuarios::mensajeListaDerivacion($usuarios->nombre);
		}


		$this->redirect(array('listaDerivacion'));
	}

	public function actionDeleteUsuarioDerivacion($id)
	{
		$connection= Yii::app()->db;
		// codigo para actualizar en la tabla  detalle_ingreso
		$connection->createCommand("UPDATE lista_derivacion SET activo=0 WHERE id_lista_derivacion=$id ")->execute();

		$this->redirect(array('listaDerivacion'));
	}

	public function actionAddUsuarioGrupoDerivacion($id,$id_grupo)
	{

		$connection= Yii::app()->db;

		$usuario=Yii::app()->user->id_usuario;

	 	/*$row=$connection->createCommand("SELECT count(id_detalle_grupo_derivacion) as total
			   FROM detalle_grupo_derivacion 
			   WHERE usuario_origen=$id AND activo=1 AND fk_grupo_derivacion=$id_grupo")->query()->read();
		
		if ($row['total']==0) {
			// codigo para actualizar en la tabla  detalle_ingreso
			$connection->createCommand("INSERT INTO detalle_grupo_derivacion (fk_grupo_derivacion, usuario_origen) VALUES ($id_grupo,$id)")->execute();
		}*/



		// codigo para verificar que no existen usuarios
		$count = DetalleGrupoDerivacion::model()->countByAttributes(array(
            'usuario_origen'=>$id,
            'fk_grupo_derivacion'=>$id_grupo,
            'activo'=>1,
        ));


		if ($count==0) {
			$connection->createCommand("INSERT INTO detalle_grupo_derivacion (fk_grupo_derivacion, usuario_origen) VALUES ($id_grupo,$id)")->execute();
		}
		else{

			$usuarios=Usuarios::model()->findByPk($id);
			Usuarios::mensajeListaDerivacion($usuarios->nombre);
		}





		$this->redirect(array('detalleGrupoDerivacion','id'=>$id_grupo));
	}

	public function actionDeleteGrupoUsuarioDerivacion($id)
	{
		$detalle=DetalleGrupoDerivacion::model()->findByPk($id);

		$connection= Yii::app()->db;
		// codigo para actualizar en la tabla  detalle_ingreso
		$connection->createCommand("UPDATE detalle_grupo_derivacion SET activo=0 WHERE id_detalle_grupo_derivacion=$id ")->execute();

		//$this->redirect(array('listaDerivacion'));

		$this->redirect(array('detalleGrupoDerivacion','id'=>$detalle->fk_grupo_derivacion));
	}



	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		//$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


	public function actionEliminar($id)
	{
		$connection= Yii::app()->db;

		// codigo para dar de baja al usuario  de la tabla usuarios
		$usuarios=$this->loadModel($id);
		$nombre=$usuarios->nombre;
		$usuarios->activo=0;

		if ($usuarios->update()) {

			// codigo para dar  de baja a los usuarios en la tabla
			//lista_derivacion
			$lista=Yii::app()->db->createCommand()->update('lista_derivacion', 
            	array('activo'=>0,), 'usuario_destino=:usuario_destino', 
            	array(':usuario_destino'=>$id)
	        );

			//codigo para eliminar al usuario de los grupos de derivacion
			$grupo=Yii::app()->db->createCommand()->update('detalle_grupo_derivacion', 
            	array('activo'=>0,), 'usuario_origen=:usuario_origen', 
            	array(':usuario_origen'=>$id)
	        );

	        $usuarios::mensajeExitoBaja($nombre);
		}
		else{

			$usuarios::mensajeErrorBaja($nombre);
		}

		$this->redirect(array('admin'));
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Usuarios');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usuarios('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuarios']))
			$model->attributes=$_GET['Usuarios'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAdminRegional()
	{
		$model=new Usuarios('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuarios']))
			$model->attributes=$_GET['Usuarios'];

		$this->render('adminRegional',array(
			'model'=>$model,
		));
	}

	public function actionAdminSAD()
	{
		$model=new Usuarios('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuarios']))
			$model->attributes=$_GET['Usuarios'];

		$this->render('adminSAD',array(
			'model'=>$model,
		));
	}


	public function actionAccesoSistema()
	{
		$this->render('accesoSistema',array(
			//'model'=>$this->loadModel($id),
		));
	}

	public function actionRegionalesByAreas(){

			$listado=Areas::model()->findAll("fk_regional=?", array($_POST["Usuarios"]["fk_regional"]));
				echo "<option value \"\">++ Seleccione Area/Unidad ++</option>";
			foreach ($listado as $data) 
				echo "<option value=\"{$data->id_area}\">{$data->area}</option>";



		
		//echo  $form->textField($model,'codigo_producto',array('size'=>45,'maxlength'=>45,'value'=>'alvaro'));	
		
	}


// codigo para migrar usuarios desde la base de datos  mysql del siaco
	public function actionMigrarUsuarios()
	{
		$this->render('migrarUsuarios',array(
			//'model'=>$this->loadModel($id),
		));
	}

	
	public function actionMigrarCiteDocumento()
	{
		$this->render('migrarCiteDocumento',array(
			//'model'=>$this->loadModel($id),
		));
	}

	public function actionMigrarUserFaltante()
		{
			$this->render('migrarUserFaltante',array(
				//'model'=>$this->loadModel($id),
			));
		}

	public function actionMigrarSeguimiento()
		{
			$this->render('migrarSeguimiento',array(
				//'model'=>$this->loadModel($id),
			));
		}


	public function actionMigrarCiteSinNuri()
		{
			$this->render('migrarCiteSinNuri',array(
				//'model'=>$this->loadModel($id),
			));
		}

	public function actionMigrarCiteConNuri()
		{
			$this->render('migrarCiteConNuri',array(
				//'model'=>$this->loadModel($id),
			));
		}			

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Usuarios the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Usuarios::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Usuarios $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuarios-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
