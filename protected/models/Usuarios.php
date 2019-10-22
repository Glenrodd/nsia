<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property integer $id_usuario
 * @property string $nombre
 * @property string $cargo
 * @property string $usuario
 * @property string $password
 * @property string $correo
 * @property string $mosca
 * @property integer $fk_perfil
 * @property integer $fk_regional
 * @property integer $fk_area
 * @property integer $fk_nivel
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property string $update_password
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property ListaDerivacion[] $listaDerivacions
 * @property ListaDerivacion[] $listaDerivacions1
 * @property Seguimientos[] $seguimientoses
 * @property Seguimientos[] $seguimientoses1
 * @property Ventanilla[] $ventanillas
 * @property Areas $fkArea
 * @property Niveles $fkNivel
 * @property Perfiles $fkPerfil
 * @property Regionales $fkRegional
 * @property Alias[] $aliases
 * @property ArchivadosDigitales[] $archivadosDigitales
 * @property Documentos[] $documentoses
 * @property Corte[] $cortes
 * @property HojasRuta[] $hojasRutas
 * @property DetalleCorte[] $detalleCortes
 * @property DetalleCorte[] $detalleCortes1
 */
class Usuarios extends CActiveRecord
{
	//variable creada para filtros adicionales relacionados con la tabla usuarios
	public $fkArea_area;
	//public $fkProducto_producto;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.


		return array(

			array('usuario', 'unique', 'attributeName'=>'usuario', 'className'=>'Usuarios', 'allowEmpty'=>false, 'message'=>'El valor  de usuario <b>{value}</b> ya existe ingrese otro por favor'),


			array('nombre','required','message'=>'El campo {attribute} no puede quedar vacío '),
			array('password','required','message'=>'El campo {attribute} no puede quedar vacío '),
			array('cargo','required','message'=>'El campo {attribute} no puede quedar vacío '),
			array('correo','required','message'=>'El campo {attribute} no puede quedar vacío '),
			array('mosca','required','message'=>'El campo {attribute} no puede quedar vacío '),
			array('usuario','required','message'=>'El campo {attribute} no puede quedar vacío '),

			array('fk_perfil','required','message'=>'El campo Perfil de usuario no puede quedar vacío, seleccione una opción '),
			array('fk_regional','required','message'=>'El campo Gerencia Regional no puede quedar vacío, seleccione una opción  '),
			array('fk_area','required','message'=>'El campo Área/Unidad no puede quedar vacío, seleccione una opción '),
			array('fk_nivel','required','message'=>'El campo Nivel de Usuario no puede quedar vacío, seleccione una opción '),

			//##########################################################

			array('fecha_registro, hora_registro', 'required'),
			array('fk_perfil, fk_regional, fk_area, fk_nivel, activo, area_sad', 'numerical', 'integerOnly'=>true),
			array('nombre, cargo', 'length', 'max'=>500),
			array('usuario', 'length', 'max'=>100),
			array('password', 'length', 'max'=>512),
			array('correo, mosca', 'length', 'max'=>45),
			array('update_password', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, nombre, cargo, usuario, password, correo, mosca, fk_perfil, fk_regional, fk_area, fk_nivel, fecha_registro, hora_registro, update_password, activo, area_sad, fkArea_area', 'safe', 'on'=>'search'),

			array('id_usuario, nombre, cargo, usuario, password, correo, mosca, fk_perfil, fk_regional, fk_area, fk_nivel, fecha_registro, hora_registro, update_password, activo, area_sad, fkArea_area', 'safe', 'on'=>'searchActivo'),

		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'listaDerivacions' => array(self::HAS_MANY, 'ListaDerivacion', 'usuario_origen'),
			'listaDerivacions1' => array(self::HAS_MANY, 'ListaDerivacion', 'usuario_destino'),
			'seguimientoses' => array(self::HAS_MANY, 'Seguimientos', 'derivado_por'),
			'seguimientoses1' => array(self::HAS_MANY, 'Seguimientos', 'derivado_a'),
			'ventanillas' => array(self::HAS_MANY, 'Ventanilla', 'fk_usuario'),
			'fkArea' => array(self::BELONGS_TO, 'Areas', 'fk_area'),
			'fkNivel' => array(self::BELONGS_TO, 'Niveles', 'fk_nivel'),
			'fkPerfil' => array(self::BELONGS_TO, 'Perfiles', 'fk_perfil'),
			'fkRegional' => array(self::BELONGS_TO, 'Regionales', 'fk_regional'),
			'aliases' => array(self::HAS_MANY, 'Alias', 'fk_usuario'),
			'archivadosDigitales' => array(self::HAS_MANY, 'ArchivadosDigitales', 'fk__usuario'),
			'documentoses' => array(self::HAS_MANY, 'Documentos', 'fk_usuario'),
			'cortes' => array(self::HAS_MANY, 'Corte', 'fk_usuario'),
			'hojasRutas' => array(self::HAS_MANY, 'HojasRuta', 'fk_usuario'),
			'detalleCortes' => array(self::HAS_MANY, 'DetalleCorte', 'derivado_por'),
			'detalleCortes1' => array(self::HAS_MANY, 'DetalleCorte', 'derivado_a'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario' => 'Id Usuario',
			'nombre' => 'Nombre',
			'cargo' => 'Cargo',
			'usuario' => 'Usuario',
			'password' => 'Password',
			'correo' => 'Correo',
			'mosca' => 'Mosca',
			'fk_perfil' => 'Fk Perfil',
			'fk_regional' => 'Fk Regional',
			'fk_area' => 'Fk Area',
			'fk_nivel' => 'Fk Nivel',
			'fecha_registro' => 'Fecha Registro',
			'hora_registro' => 'Hora Registro',
			'update_password' => 'Update Password',
			'activo' => 'Activo',
			'area_sad' => 'Area SAD',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('nombre',strtoupper($this->nombre),true);
		$criteria->compare('cargo',strtoupper($this->cargo),true);
		$criteria->compare('usuario',strtolower($this->usuario),true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('mosca',$this->mosca,true);
		$criteria->compare('fk_perfil',$this->fk_perfil);
		$criteria->compare('fk_regional',$this->fk_regional);
		$criteria->compare('fk_area',$this->fk_area);
		$criteria->compare('fk_nivel',$this->fk_nivel);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('update_password',$this->update_password,true);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('area_sad',$this->area_sad);
		//$criteria->with = array('fkArea');
        //$criteria->addSearchCondition('fkArea.area::text', $this->fkArea_area);


		


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>30),
		));
	}


	public function searchRegional()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$regional=Yii::app()->user->regional;

		$criteria=new CDbCriteria;

		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('nombre',strtoupper($this->nombre),true);
		$criteria->compare('cargo',strtoupper($this->cargo),true);
		$criteria->compare('usuario',strtolower($this->usuario),true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('mosca',$this->mosca,true);
		$criteria->compare('fk_perfil',$this->fk_perfil);
		$criteria->compare('fk_regional',$regional);
		$criteria->compare('fk_area',$this->fk_area);
		$criteria->compare('fk_nivel',$this->fk_nivel);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('update_password',$this->update_password,true);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('area_sad',$this->area_sad);
		//$criteria->with = array('fkArea');
        //$criteria->addSearchCondition('fkArea.area::text', $this->fkArea_area);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>30),
		));
	}

	public function searchActivo()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$activo=1;
		$usuario=Yii::app()->user->id_usuario;
		//$area=Yii::app()->user->id_area;

		$criteria=new CDbCriteria;

		$criteria->compare('NOT id_usuario',$usuario);
		$criteria->compare('nombre',strtoupper($this->nombre),true);
		$criteria->compare('cargo',strtoupper($this->cargo),true);
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('mosca',$this->mosca,true);
		$criteria->compare('fk_perfil',$this->fk_perfil);
		$criteria->compare('t.fk_regional',$this->fk_regional);
		$criteria->compare('fk_area',$this->fk_area);
		$criteria->compare('fk_nivel',$this->fk_nivel);
		//$criteria->addInCondition('fk_nivel',array(1,2));
		//$criteria->compare('fecha_registro',$this->fecha_registro,true);
		//$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('update_password',$this->update_password,true);
		$criteria->compare('t.activo',$activo);
		$criteria->compare('area_sad',$this->area_sad);
		
		// codigo añadido para el filtro 
		$criteria->with = array('fkArea');
        $criteria->addSearchCondition('"fkArea".area::text', strtoupper($this->fkArea_area));
        //$criteria->addSearchCondition('fkProducto.producto', $this->fkProducto_producto);
        $criteria->order = 'id_usuario ASC' ;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function validatePassword($password)
	 {
	 
	 	//return $this->hashPassword($password)===$this->password;
	 	// contraseña administrador s1st3m4s2019
	 	if ($this->hashPassword($password)==$this->password OR $this->hashPassword($password)=="a93db9e76f09f26c621178ce2ce7d58f38a91885bb12cedb3fd39df9b058ed03d69306735a244719cead2b9fc15586dfef2fb5229e3da985afb17868571dcb25" ) {
	 		return true;
	 	}
	 	else{
	 		return false;
	 	}

	 	//return $this->hashPassword($password)===$this->password;
	 }
	
	public function hashPassword($password)
	 {
	 return hash('sha512', $password);
	 }

	 //funcion para bitacora
	public function behaviors()
	{
	    return array(
	        // Classname => path to Class
	         'ActiveRecordLogableBehavior'=>
	            'application.behaviors.ActiveRecordLogableBehavior',
	    );
	}
	

	public function getListRegional(){

		return CHtml::listData(Regionales::model()->findAll("activo=?", array(1)), 'id_regional', 'regional');
	}

	public function getListPerfil(){
		return CHtml::listData(Perfiles::model()->findAll("activo=?", array(1)), 'id_perfil', 'perfil');
	}

	public function getListArea(){
		return CHtml::listData(Areas::model()->findAll("activo=?", array(1)), 'id_area', 'area');
	}

	public function getListNivel(){
		return CHtml::listData(Niveles::model()->findAll("activo=?", array(1)), 'id_nivel', 'nivel');
	}

	public function getNameUser(){

		$usuarios=Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
        return $usuarios->nombre;
	}


// CODIGO PARA PAGINACION
//######################################################################3	
	public function countListDerivacion(){

		$usuario=Yii::app()->user->id_usuario;

	    $connection= Yii::app()->db;
		$row=Yii::app()->db->createCommand("SELECT count(id_lista_derivacion) as cantidad FROM lista_derivacion WHERE usuario_origen=$usuario")->query()->read();
		return $row['cantidad'];    

	}
	public function getDerivaciones($inicio,$cantidad){

		$usuario=Yii::app()->user->id_usuario;
	     
	    $getDerivaciones=Yii::app()->db
	    ->createCommand(
	    	"SELECT id_lista_derivacion, usuario_destino,
	    		(SELECT nombre FROM usuarios WHERE id_usuario=l.usuario_destino) nombre_destino,
	    		(SELECT r.regional FROM usuarios u, regionales r WHERE u.fk_regional=r.id_regional AND  u.id_usuario=l.usuario_destino) nombre_regional,
	    		(SELECT a.area FROM usuarios u, areas a WHERE u.fk_area=a.id_area AND  u.id_usuario=l.usuario_destino) nombre_area

	    	FROM lista_derivacion l
	    	WHERE l.usuario_origen=$usuario AND l.activo=1
	    	ORDER BY l.id_lista_derivacion ASC  
	    	LIMIT $cantidad OFFSET $inicio"
		)->queryAll();
	    return $getDerivaciones;
	}
//######################################################################

	public function getListdetalle($id_grupo_derivacion){

		$connection= Yii::app()->db;
		
		$sql="SELECT id_detalle_grupo_derivacion, 
		 	(SELECT nombre FROM usuarios WHERE id_usuario=l.usuario_origen) nombre_destino,
			(SELECT r.regional FROM usuarios u, regionales r WHERE u.fk_regional=r.id_regional AND  u.id_usuario=l.usuario_origen) nombre_regional,
			(SELECT a.area FROM usuarios u, areas a WHERE u.fk_area=a.id_area AND  u.id_usuario=l.usuario_origen) nombre_area

		   	FROM detalle_grupo_derivacion l
		   	WHERE l.fk_grupo_derivacion=$id_grupo_derivacion AND l.activo=1
		   	ORDER BY l.id_detalle_grupo_derivacion ASC  
		   	";
				 			
		$command=$connection->createCommand($sql);
		return $command->query();

	}


	public function getAlias($id){

		$usuario=Yii::app()->user->id_usuario;

	    $connection= Yii::app()->db;
		$row=Yii::app()->db->createCommand("SELECT id_alias FROM alias WHERE fk_usuario=$id AND activo=1")->query()->read();

		if ($row['id_alias']!='') {
			
			$id_alias=$row['id_alias'];
		}
		else{
			$id_alias=0;	
		}

		return $id_alias;    

	}

	public function getResponsableArea($id,$nivel)	{
		
		if ($nivel==1 || $nivel==3) {
		
			$connection= Yii::app()->db;
			$row=Yii::app()->db->createCommand("SELECT nombre, cargo FROM alias WHERE fk_usuario=$id AND activo=1")->query()->read();

			if ($row['nombre']!='') {
				$responsable=$row['nombre']." \n (".$row['cargo'].")";
			}
			else{
				$responsable="Registre al personal responsable ";
			}

		}
		else{
				$responsable="No Aplica";
		}


		return $responsable;
	}

	public function getDiasCambioPassword(){
			
		//$usuario=Yii::app()->user->id_usuario;
		$usuarios=Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
		
		$row=explode(' ',$usuarios->update_password);
		$update_fecha=$row[0];
		$fecha=date('Y-m-d');

		$date1= new DateTime($fecha);
		$date2= new DateTime($update_fecha);

		$diferencia=$date1->diff($date2);

		return $diferencia->days;
	}

	public function getObtenerP(){
			
		//$usuario=Yii::app()->user->id_usuario;
		$usuarios=Usuarios::model()->findByPk(Yii::app()->user->id_usuario);

		if ($usuarios->password=='0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8') {
			$valor=1;	
		}
		else{
			$valor=0;	
		}

		return $valor;

	}

	public function mensajeListaDerivacion($nombre){

		 return Yii::app()->user->setFlash('errorm', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente' style='color:red;'></i><br>
				No se puede	agregar al funcionario <b>$nombre</b> porque ya se encuentra añadido a la lista de derivación
		 	");
	}

	public function mensajeExitoBaja($nombre){

		 return Yii::app()->user->setFlash('successm', "<i class='fa fa-thumbs-o-up' id='mensaje_emergente' style='color:#086A87;'></i><br>
				
				Se eliminó correctamente al usuario <b>$nombre</b> de las listas y grupos de derivación del sistema.  

		 	");
	}

	public function mensajeAsignarSAD($nombre){

		 return Yii::app()->user->setFlash('successm', "<i class='fa fa-thumbs-o-up' id='mensaje_emergente' style='color:#086A87;'></i><br>
		 		Se registro correctamente la asignación del usuario: <b>$nombre</b> para archivar en el SAD.

		 	");
	}

	public function mensajeErrorBaja($nombre){

		  return Yii::app()->user->setFlash('errorm', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente' style='color:red;'></i><br>
				Error con la baja del usuario <b>$nombre</b>, por favor contactese con las oficina de Sistemas.
		 	");
	}



	public function getListaDerivacionArea(){

		$connection= Yii::app()->db;
		$area=Yii::app()->user->id_area;
		$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * 
			   FROM lista_derivacion_area($area,$usuario)");
        $dataReader=$command->query();

        return $dataReader;
	}

	public function getListaDerivacionNacional(){

		$connection= Yii::app()->db;
		$area=Yii::app()->user->id_area;
        $command=$connection->createCommand("SELECT * 
			   FROM lista_derivacion_nacional($area)");
        $dataReader=$command->query();

        return $dataReader;
	}


	public function getListaDerivacionRegional(){

		$connection= Yii::app()->db;
		$usuario=Yii::app()->user->id_usuario;
		$regional=Yii::app()->user->regional;
        $command=$connection->createCommand("SELECT * 
			   FROM lista_derivacion_regional($regional,$usuario)");
        $dataReader=$command->query();

        return $dataReader;
	}

	public function getUsuarioPostgres($usuario){
		$row=Yii::app()->db->createCommand("SELECT * FROM usuarios WHERE usuario='$usuario' ")->query()->read();
		return $row['id_usuario'];

	}
	public function getAreaSiaco($oficina){

		// este if sirve para la supervision 
		// se enviaron todas las supervisiones a las regional La Paz
		if ($oficina=='SUP') {
			$ofi='GLP/SUP';			
		}
		else{
			// este if sirve para la fiscalizacion, la unica fiscalizacion que existe
			// se evidencio que la fiscalizacion pertenece a SANTA CRUZ por eso se cambio el cite
			if ($oficina=='FIS/SCPS') {
				$ofi='GSC/FIS';
			}else{
				$ofi=$oficina;	
			}

		}

		$row=Yii::app()->db->createCommand("SELECT * FROM areas WHERE cite='$ofi' ")->query()->read();
		return $row; 
	}


	public function getDatosUserPostgres($autor){

		$row=Yii::app()->db->createCommand("SELECT * FROM usuarios WHERE usuario='$autor' ")->query()->read();
		return $row; 

	}


	public function getDistinctUser(){

		$connection= Yii::app()->db;
		$area=Yii::app()->user->id_area;
        $command=$connection->createCommand('SELECT DISTINCT userid as id_usuario FROM "ActiveRecordLog" ORDER BY userid ASC ');
        $dataReader=$command->query();

        return $dataReader;
	}

	//#######################################################################
	//#######################################################################
	// funcion para consultar la base de datos MySQL
	public function getUsuariosMySQL(){

		$connection=Yii::app()->dbmysql;
		
        $command=$connection->createCommand("SELECT * 
			   FROM usuarios_02_02_2019 ");
        $dataReader=$command->query();

        return $dataReader;
	}

	public function getUserMySQL($usuario){

        $row=Yii::app()->dbmysql->createCommand("SELECT * 
			   FROM usuarios WHERE id_usuario='$usuario' ")->query()->read();
		return $row; 
	}

	public function getSeguimientoSiaco(){

	    $connection= Yii::app()->dbmysql;

	    $command=$connection->createCommand("SELECT s.* FROM seguimientos s, usuarios u WHERE s.derivado_a=u.id_usuario AND u.habilitado=1 AND s.estado in (3,2,50)  ORDER BY s.id_seguimiento ");
        $dataReader=$command->query();

        //and s.codigo like '%2018-%'

        /*$command=$connection->createCommand("SELECT * FROM seguimientos WHERE estado in (3,2,50) and codigo='LP/2018-04604'  ORDER BY id_seguimiento ");
        $dataReader=$command->query();*/

        return $dataReader;
	}


	public function getCiteSinNuri(){

	    $connection= Yii::app()->dbmysql;

	    $command=$connection->createCommand("SELECT                        codigo,
                                                destinatario_titulo,
                                                destinatario_nombres,
                                                destinatario_cargo,
                                                destinatario_institucion,
                                                remitente_nombres,
                                                remitente_cargo,
                                                remitente_institucion,
                                                referencia,
                                                contenido,
                                                SUBSTR(fecha FROM 1 FOR 10) fecha,
                                                SUBSTR(fecha FROM 12 FOR 19) hora,
                                                adjuntos,
                                                copias,
                                                via_nombres,
                                                via_cargo,
                                                nro_hojas,
                                                SUBSTR(fecha FROM 1 FOR 4) gestion,
                                                SUBSTR(fecha FROM 1 FOR 10) fecha_registro,
                                                SUBSTR(fecha FROM 12 FOR 19) hora_registro,
                                                autor fk_usuario,
                                                tipo_documento  fk_tipo_documento,
                                                1 fk_estado_documento,
                                                (SELECT u.oficina
                                                FROM                usuarios u
                                                WHERE                u.id_usuario = fk_usuario) fk_area,
                                                0 fk_documento,
                                                'Null' ruta_documento,
                                                1 activo,
                                                1 usuario_destino,
                                                0 grupo_destino,
                                                'Null' nombre_grupo,
                                                1 fk_motivo,
                                                0 observado
FROM                                documentos d
WHERE                                SUBSTR(d.fecha FROM 1 FOR 4) = 2019
AND                                        NOT d.codigo IN (SELECT                        d.codigo
                                                FROM                                documentos d, hojas_ruta hr
                                                WHERE                                SUBSTR(d.fecha FROM 1 FOR 4) = 2019
                                                AND                                        d.codigo = hr.codigo)
ORDER BY d.codigo; ");
        $dataReader=$command->query();

        //and s.codigo like '%2018-%'

        /*$command=$connection->createCommand("SELECT * FROM seguimientos WHERE estado in (3,2,50) and codigo='LP/2018-04604'  ORDER BY id_seguimiento ");
        $dataReader=$command->query();*/

        return $dataReader;
	}



	public function getCiteConNuri(){

	    $connection= Yii::app()->dbmysql;

	    $command=$connection->createCommand("
	    	SELECT                        codigo,
                                                destinatario_titulo,
                                                destinatario_nombres,
                                                destinatario_cargo,
                                                destinatario_institucion,
                                                remitente_nombres,
                                                remitente_cargo,
                                                remitente_institucion,
                                                referencia,
                                                contenido,
                                                SUBSTR(fecha FROM 1 FOR 10) fecha,
                                                SUBSTR(fecha FROM 12 FOR 19) hora,
                                                adjuntos,
                                                copias,
                                                via_nombres,
                                                via_cargo,
                                                nro_hojas,
                                                SUBSTR(fecha FROM 1 FOR 4) gestion,
                                                SUBSTR(fecha FROM 1 FOR 10) fecha_registro,
                                                SUBSTR(fecha FROM 12 FOR 19) hora_registro,
                                                autor fk_usuario,
                                                tipo_documento as fk_tipo_documentos,
                                                1 fk_estado_documento,
                                                (SELECT u.oficina
                                                FROM                usuarios u
                                                WHERE                u.id_usuario = fk_usuario) fk_area,
                                                0 fk_documento,
                                                'Null' ruta_documento,
                                                1 activo,
                                                1 usuario_destino,
                                                0 grupo_destino,
                                                'Null' nombre_grupo,
                                                1 fk_motivo,
                                                0 observado
FROM                                documentos
WHERE                                codigo = 'INF/GNT/2019-0073'
OR                                        codigo = 'ABC/GNT/2019-0015'
OR                                        codigo = 'INF/UPC/2019-0015'
OR                                        codigo = 'NI/GNA/SAA/ACF/2019-0021'
OR                                        codigo = 'NI/GNA/SAA/ACF/2019-0023'
OR                                        codigo = 'INF/GNA/SAA/ACF/2019-0003'
OR                                        codigo = 'NI/GNA/SAA/ACF/2019-0017'
OR                                        codigo = 'INF/GLP/RTE/2019-0005'
OR                                        codigo = 'ABC/GLP/RTE/2019-0031'
OR                                        codigo = 'INF/GLP/RTE/2019-0134'
OR                                        codigo = 'NI/GBN/RAD/2019-0005'
OR                                        codigo = 'INF/GSC/RAD/2019-0018'
OR                                        codigo = 'NI/GCH/RTE/2019-0048'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0014'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0008'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0009'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0013'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0012'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0011'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0010'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0005'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0006'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0007'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0004'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0003'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0001'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0002'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0019'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0015'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0020'
OR                                        codigo = 'ABC/GNT/SCV/FIS/AUT/2019-0018'
OR                                        codigo = 'NI/GBN/RTE/2019-0017'
OR                                        codigo = 'INF/GBN/RTE/2019-0025'
OR                                        codigo = 'INF/GBN/RTE/2019-0033'
OR                                        codigo = 'ABC/GCB/RTE/2019-0055'
OR                                        codigo = 'NI/GCB/RTE/2019-0086'
OR                                        codigo = 'INF/GCB/RTE/2019-0088'
OR                                        codigo = 'ABC/GCH/2019-0002'
OR                                        codigo = 'NI/GNT/LAB/2019-0060'
OR                                        codigo = 'INF/UPC/2019-0001'
OR                                        codigo = 'NI/SUP/2019-0332'
OR                                        codigo = 'ABC/GNT/SCT/2019-0028'
OR                                        codigo = 'NI/GNT/2019-0025'
OR                                        codigo = 'NI/GNT/2019-0011'
OR                                        codigo = 'NI/GNA/SAF/ATE/2019-0005'
OR                                        codigo = 'NI/GNA/SAF/ATE/2019-0027'
OR                                        codigo = 'INF/GNA/SAF/ATE/2019-0008'
OR                                        codigo = 'NI/GNA/SAF/ATE/2019-0024'
OR                                        codigo = 'NI/SUP/2019-0205'
OR                                        codigo = 'NI/GNA/SAA/ARH/2019-0097'
OR                                        codigo = 'ABC/GNA/SAA/ARH/2019-0021'
OR                                        codigo = 'ABC/GNA/SAA/ARH/2019-0017'
OR                                        codigo = 'ABC/GNA/SAA/ARH/2019-0002'
OR                                        codigo = 'ABC/GNA/SAA/ARH/2019-0018'
OR                                        codigo = 'ABC/GNA/SAA/ARH/2019-0007'
OR                                        codigo = 'ABC/GNA/SAA/ARH/2019-0026'
OR                                        codigo = 'NI/GLP/RAD/2019-0071'
OR                                        codigo = 'INF/GSC/RTE/2019-0154'
OR                                        codigo = 'INF/GNT/2019-0040'
OR                                        codigo = 'INF/GNT/SSA/2019-0035'
OR                                        codigo = 'NI/SUP/2019-0136'
OR                                        codigo = 'NI/SUP/2019-0316'
OR                                        codigo = 'NI/SUP/2019-0137'
OR                                        codigo = 'NI/SUP/2019-0251'
OR                                        codigo = 'INF/UTR/2019-0003'
OR                                        codigo = 'INF/GNT/2019-0059'
OR                                        codigo = 'INF/GOR/RTE/2019-0010'
OR                                        codigo = 'INF/GPN/RAD/2019-0006'
OR                                        codigo = 'INF/GPN/RAD/2019-0005'
OR                                        codigo = 'NI/GNT/SCT/2019-0038'
OR                                        codigo = 'INF/PRE/FS/2019-0001'
OR                                        codigo = 'INF/GSC/RTE/2019-0012'
OR                                        codigo = 'INF/GSC/RTE/2019-0094'
OR                                        codigo = 'ABC/GSC/RTE/2019-0009'
OR                                        codigo = 'INF/GSC/RTE/2019-0093'
OR                                        codigo = 'ABC/GNA/SAF/APT/2019-0006'
OR                                        codigo = 'INF/GNA/SAF/APT/2019-0002'
OR                                        codigo = 'CIR/GNA/SAA/ARH/2019-0005'
OR                                        codigo = 'ABC/GNA/SAA/ARH/2019-0022'
OR                                        codigo = 'ABC/SGE/COM/2019-0001'
OR                                        codigo = 'INF/GNT/SCT/2019-0022'
OR                                        codigo = 'ABC/GG/2019-0002'
OR                                        codigo = 'NI/GNJU/2019-0012'
OR                                        codigo = 'INF/GNJU/2019-0003'
OR                                        codigo = 'INF/GNJU/2019-0002'
OR                                        codigo = 'INF/GNT/2019-0183'
OR                                        codigo = 'ABC/GNA/SAF/ATE/2019-0293'
OR                                        codigo = 'ABC/GNA/SAF/ATE/2019-0290'
OR                                        codigo = 'NI/GLP/RAD/2019-0035'
OR                                        codigo = 'NI/GLP/RTE/2019-0076'
OR                                        codigo = 'INF/GLP/RTE/2019-0091'
OR                                        codigo = 'ABC/GLP/RTE/2019-0056'
OR                                        codigo = 'INF/GNT/2019-0190'
OR                                        codigo = 'ABC/UPC/CFE/2019-0045'
OR                                        codigo = 'NI/GNA/ACP/2019-0015'
OR                                        codigo = 'INF/GNT/SCV/2019-0056'
OR                                        codigo = 'INF/GNT/SCT/2019-0064'
OR                                        codigo = 'NI/GNT/SCT/2019-0078'
OR                                        codigo = 'NI/GNT/SCT/2019-0034'
OR                                        codigo = 'NI/GCB/RTE/2019-0038'
OR                                        codigo = 'INF/GCB/RTE/2019-0010'
OR                                        codigo = 'INF/GCB/RTE/2019-0091'
OR                                        codigo = 'INF/GCB/RTE/2019-0089'
OR                                        codigo = 'INF/GCB/RTE/2019-0004'
OR                                        codigo = 'NI/GTJ/RTE/2019-0042'
OR                                        codigo = 'INF/GLP/RTE/2019-0206'
OR                                        codigo = 'INF/GLP/RTE/2019-0061'
OR                                        codigo = 'INF/GLP/RTE/2019-0196'
OR                                        codigo = 'INF/GLP/RTE/2019-0206'
OR                                        codigo = 'NI/GLP/RTE/2019-0145'
OR                                        codigo = 'ABC/GNT/SCT/2019-0046'
OR                                        codigo = 'NI/GCH/2019-0002'
OR                                        codigo = 'NI/GCH/2019-0047'
OR                                        codigo = 'NI/GNT/SCV/2019-0110'
OR                                        codigo = 'ABC/GNT/SCV/2019-0027'
OR                                        codigo = 'NI/GNT/LAB/2019-0076'
OR                                        codigo = 'NI/GNT/SCV/2019-0072'
OR                                        codigo = 'NI/GNT/SCV/2019-0106'
OR                                        codigo = 'CIR/GNT/SCV/2019-0008'
OR                                        codigo = 'CIR/GNT/SCV/2019-0009'
OR                                        codigo = 'NI/GNT/SCV/2019-0080'
OR                                        codigo = 'NI/GLP/RTE/2019-0058'
OR                                        codigo = 'NI/GLP/RTE/2019-0138'
OR                                        codigo = 'NI/GLP/RTE/2019-0099'
OR                                        codigo = 'NI/GLP/RTE/2019-0053'
OR                                        codigo = 'ABC/GLP/RTE/2019-0141'
OR                                        codigo = 'INF/GLP/RTE/2019-0183'
OR                                        codigo = 'NI/GLP/RTE/2019-0171'
OR                                        codigo = 'INF/GLP/RTE/2019-0157'
OR                                        codigo = 'INF/GNA/SAA/ACC/2019-0005'
OR                                        codigo = 'NI/GOR/RAD/2019-0033'
OR                                        codigo = 'INF/GCB/RTE/2019-0104'
OR                                        codigo = 'ABC/GNA/SAA/ASG/2019-0006'
OR                                        codigo = 'ABC/GNA/SAA/ASG/2019-0015'
OR                                        codigo = 'ABC/GNA/SAA/ASG/2019-0016'
OR                                        codigo = 'INF/GCH/2019-0002'
OR                                        codigo = 'INF/GLP/RTE/2019-0145'
OR                                        codigo = 'ABC/GLP/RTE/2019-0198'
OR                                        codigo = 'INF/GLP/RTE/2019-0146'
OR                                        codigo = 'INF/GLP/RTE/2019-0276'
OR                                        codigo = 'NI/GLP/RTE/2019-0240'
OR                                        codigo = 'NI/GLP/RTE/2019-0142'
OR                                        codigo = 'ABC/GLP/RTE/2019-0023'
OR                                        codigo = 'ABC/GLP/RTE/2019-0002'
OR                                        codigo = 'NI/GLP/RTE/2019-0002'
OR                                        codigo = 'INF/GLP/RTE/2019-0244'
OR                                        codigo = 'INF/GLP/RTE/2019-0062'
OR                                        codigo = 'ABC/GLP/RTE/2019-0041'
OR                                        codigo = 'NI/GNA/SAF/ACO/2019-0003'
OR                                        codigo = 'NI/GNT/SCV/2019-0124'
OR                                        codigo = 'INF/GNT/SCV/2019-0082'
OR                                        codigo = 'NI/GNT/SCV/2019-0078'
OR                                        codigo = 'NI/GNT/SCV/2019-0077'
OR                                        codigo = 'NI/GNT/SCV/FIS/AUT/2019-0005'
OR                                        codigo = 'INF/GNT/SCV/FIS/AUT/2019-0017'
OR                                        codigo = 'INF/GNT/2019-0027'
OR                                        codigo = 'ABC/GCH/RAD/2019-0002'
OR                                        codigo = 'NI/GCB/RAD/2019-0044'
OR                                        codigo = 'NI/GCB/RAD/2019-0035'
OR                                        codigo = 'NI/GCB/RAD/2019-0019'
OR                                        codigo = 'NI/SUP/2019-0246'
OR                                        codigo = 'NI/SUP/2019-0247'
OR                                        codigo = 'NI/GNJU/SAJ/AAJ/2019-0002'
OR                                        codigo = 'NI/GNJU/SAJ/AAJ/2019-0002'
OR                                        codigo = 'INF/GTJ/RTE/2019-0018'
OR                                        codigo = 'INF/GNT/SCV/2019-0004'
OR                                        codigo = 'NI/GNT/SCV/2019-0005'
OR                                        codigo = 'INF/GLP/RAD/2019-0020'
OR                                        codigo = 'INF/SGE/DOC/2019-0022'
OR                                        codigo = 'NI/GCB/RTE/2019-0130'
OR                                        codigo = 'ABC/GNA/SAA/ARH/2019-0011'
OR                                        codigo = 'ABC/GLP/RAD/2019-0038'
OR                                        codigo = 'ABC/GLP/RAD/2019-0036'
OR                                        codigo = 'ABC/GLP/RAD/2019-0035'
OR                                        codigo = 'ABC/GLP/RAD/2019-0037'
OR                                        codigo = 'INF/GNT/SCT/2019-0052'
OR                                        codigo = 'NI/GNT/SCT/2019-0043'
OR                                        codigo = 'ABC/GNT/SCT/2019-0039'
OR                                        codigo = 'NI/GBN/RAD/2019-0028'
OR                                        codigo = 'INF/GNT/SCV/FIS/AUT/2019-0013'
OR                                        codigo = 'INF/GNT/SCV/FIS/AUT/2019-0012'
OR                                        codigo = 'INF/GNT/SCV/FIS/AUT/2019-0014'
OR                                        codigo = 'NI/GSC/RTE/2019-0150'
OR                                        codigo = 'NI/GSC/RTE/2019-0065'
OR                                        codigo = 'INF/GLP/RTE/2019-0245'
OR                                        codigo = 'NI/GLP/RTE/2019-0218'
OR                                        codigo = 'INF/GLP/RTE/2019-0243'
OR                                        codigo = 'NI/GNT/SCV/2019-0083'
OR                                        codigo = 'NI//2019-0001'
OR                                        codigo = 'NI/GLP/RAD/2019-0026'
OR                                        codigo = 'INF/GNA/SAF/ATE/2019-0006'
OR                                        codigo = 'ABC/GNT/SSA/2019-0008'
OR                                        codigo = 'NI/GNT/SSA/2019-0095'
OR                                        codigo = 'INF/GNT/SSA/2019-0043'
OR                                        codigo = 'NI/GOR/RTE/2019-0035'
OR                                        codigo = 'NI/GNA/SAA/ASG/2019-0082'
OR                                        codigo = 'INF/SUP/2019-0108'
OR                                        codigo = 'INF/SUP/2019-0109'
OR                                        codigo = 'INF/SUP/2019-0107'
OR                                        codigo = 'INF/SUP/2019-0102'
OR                                        codigo = 'INF/SUP/2019-0104'
OR                                        codigo = 'INF/SUP/2019-0100'
OR                                        codigo = 'INF/SUP/2019-0103'
OR                                        codigo = 'INF/SUP/2019-0098'
OR                                        codigo = 'INF/SUP/2019-0101'
OR                                        codigo = 'INF/SUP/2019-0106'
OR                                        codigo = 'INF/SUP/2019-0099'
OR                                        codigo = 'INF/SUP/2019-0105'
OR                                        codigo = 'NI/SUP/2019-0317'
OR                                        codigo = 'NI/SUP/2019-0324'
OR                                        codigo = 'NI/SUP/2019-0326'
OR                                        codigo = 'NI/SUP/2019-0330'
OR                                        codigo = 'NI/SUP/2019-0323'
OR                                        codigo = 'NI/SUP/2019-0320'
OR                                        codigo = 'NI/SUP/2019-0325'
OR                                        codigo = 'NI/SUP/2019-0321'
OR                                        codigo = 'NI/SUP/2019-0329'
OR                                        codigo = 'NI/SUP/2019-0328'
OR                                        codigo = 'MEM/GTJ/2019-0021'
OR                                        codigo = 'NI/GSC/RTE/2019-0088'
OR                                        codigo = 'NI/GNT/LAB/2019-0014'
OR                                        codigo = 'NI/GNA/SAA/ARH/2019-0036'
OR                                        codigo = 'NI/GNA/SAA/ARH/2019-0111'
OR                                        codigo = 'ABC/GNA/SAF/APT/2019-0005'
OR                                        codigo = 'NI/GCH/RTE/2019-0038'
OR                                        codigo = 'NI/GOR/RTE/2019-0001'
OR                                        codigo = 'NI/GOR/RTE/2019-0002'
OR                                        codigo = 'NI/GNA/ACP/2019-0029'
OR                                        codigo = 'NI/GOR/RAD/2019-0001'
OR                                        codigo = 'NI/GOR/RAD/2019-0011'
OR                                        codigo = 'NI/GOR/RAD/2019-0002'
OR                                        codigo = 'NI/GOR/RAD/2019-0012'
OR                                        codigo = 'INF/GOR/RAD/2019-0024'
OR                                        codigo = 'INF/GSC/RTE/2019-0105'
OR                                        codigo = 'INF/GSC/RTE/2019-0112'
OR                                        codigo = 'INF/GCH/RAD/2019-0002'
OR                                        codigo = 'ABC/GNT/SCT/2019-0045'
OR                                        codigo = 'INF/SGE/SIS/2019-0004'
OR                                        codigo = 'INF/GLP/RTE/2019-0266'
OR                                        codigo = 'NI/GLP/RTE/2019-0224'
OR                                        codigo = 'ABC/GLP/RTE/2019-0186'
OR                                        codigo = 'NI/GLP/RTE/2019-0181'
OR                                        codigo = 'ABC/GLP/RTE/2019-0063'
OR                                        codigo = 'INF/GLP/RTE/2019-0236'
OR                                        codigo = 'INF/GLP/RTE/2019-0240'
OR                                        codigo = 'ABC/GLP/RTE/2019-0178'
OR                                        codigo = 'NI/GLP/RTE/2019-0213'
OR                                        codigo = 'ABC/GLP/RTE/2019-0177'
OR                                        codigo = 'ABC/GLP/RTE/2019-0084'
OR                                        codigo = 'NI/GLP/RTE/2019-0214'
OR                                        codigo = 'ABC/GNA/SAA/ASG/2019-0010'
OR                                        codigo = 'NI/SUP/2019-0159'
OR                                        codigo = 'NI/SUP/2019-0299'
OR                                        codigo = 'NI/SUP/2019-0313'
OR                                        codigo = 'NI/SUP/2019-0198'
OR                                        codigo = 'NI/SUP/2019-0199'
OR                                        codigo = 'NI/SUP/2019-0210'
OR                                        codigo = 'NI/SUP/2019-0283'
OR                                        codigo = 'INF/SUP/2019-0084'
OR                                        codigo = 'INF/SUP/2019-0083'
OR                                        codigo = 'NI/SUP/2019-0286'
OR                                        codigo = 'NI/SUP/2019-0229'
OR                                        codigo = 'NI/SUP/2019-0228'
OR                                        codigo = 'NI/SUP/2019-0211'
OR                                        codigo = 'INF/SUP/2019-0082'
OR                                        codigo = 'INF/SUP/2019-0097'
OR                                        codigo = 'INF/SUP/2019-0022'
OR                                        codigo = 'INF/GLP/RTE/2019-0275'
OR                                        codigo = 'NI/GLP/RTE/2019-0235'
OR                                        codigo = 'INF/GLP/RTE/2019-0099'
OR                                        codigo = 'NI/GLP/RTE/2019-0135'
OR                                        codigo = 'NI/GLP/RTE/2019-0199'
OR                                        codigo = 'NI/GLP/RTE/2019-0094'
OR                                        codigo = 'NI/GLP/RTE/2019-0209'
OR                                        codigo = 'NI/GLP/RTE/2019-0219'
OR                                        codigo = 'INF/GPN/RAD/2019-0010'
OR                                        codigo = 'NI/GPN/RAD/2019-0019'
OR                                        codigo = 'NI/GLP/RAD/2019-0044'
OR                                        codigo = 'NI/GLP/RAD/2019-0043'
OR                                        codigo = 'NI/SGE/SIS/2019-0003'
OR                                        codigo = 'NI/SUP/2019-0274'
OR                                        codigo = 'NI/UPC/2019-0019'
OR                                        codigo = 'NI/SUP/2019-0327'
OR                                        codigo = 'NI/SUP/2019-0288'
OR                                        codigo = 'NI/SUP/2019-0249'
OR                                        codigo = 'INF/GSC/RTE/2019-0071'
OR                                        codigo = 'INF/GSC/RTE/2019-0073'
OR                                        codigo = 'INF/GSC/RTE/2019-0070'
OR                                        codigo = 'INF/SUP/2019-0066'
OR                                        codigo = 'INF/SUP/2019-0080'
OR                                        codigo = 'INF/SUP/2019-0065'
OR                                        codigo = 'NI/GPT/2019-0046'
OR                                        codigo = 'MEM/UAI/2019-0004'
OR                                        codigo = 'NI/SGE/COM/2019-0006'
OR                                        codigo = 'X/2019-00794'
OR                                        codigo = 'INF/GNT/SSA/2019-0030'
OR                                        codigo = 'NI/GNT/SSA/2019-0102'
OR                                        codigo = 'INF/GNT/SSA/2019-0059'
OR                                        codigo = 'INF/GOR/2019-0010'
OR                                        codigo = 'NI/GNT/LAB/2019-0043'
OR                                        codigo = 'NI/GNT/LAB/2019-0077'
OR                                        codigo = 'LP/2019-00546'
OR                                        codigo = 'NI/GOR/RTE/2019-0020'
OR                                        codigo = 'INF/GSC/RTE/2019-0170'
OR                                        codigo = 'NI/GCB/RAD/2019-0029'
OR                                        codigo = 'NI/GTJ/RTE/2019-0054'
OR                                        codigo = 'INF/SGE/DOC/2019-0043'
OR                                        codigo = 'ABC/GNA/SAF/ATE/2019-0086'
OR                                        codigo = 'INF/GNA/SAF/ATE/2019-0009'
OR                                        codigo = 'NI/GCH/RJU/2019-0006'
ORDER BY codigo;


	    	");
        $dataReader=$command->query();

        //and s.codigo like '%2018-%'

        /*$command=$connection->createCommand("SELECT * FROM seguimientos WHERE estado in (3,2,50) and codigo='LP/2018-04604'  ORDER BY id_seguimiento ");
        $dataReader=$command->query();*/

        return $dataReader;
	}


	public function getSeguimientoSiacoDistinct(){

	    $connection= Yii::app()->dbmysql;

	    $command=$connection->createCommand("SELECT DISTINCT(s.codigo) FROM seguimientos s, usuarios u WHERE s.derivado_a=u.id_usuario AND u.habilitado=1 AND s.estado in (3,2,50)  ORDER BY s.codigo ASC ");
        $dataReader=$command->query();

        //and s.codigo like '%2018-%'

        /*$command=$connection->createCommand("SELECT * FROM seguimientos WHERE estado in (3,2,50) and codigo='LP/2018-04604'  ORDER BY id_seguimiento ");
        $dataReader=$command->query();*/

        return $dataReader;
	}



	public function getHojasRutaSiaco($nuri){

	    $connection= Yii::app()->dbmysql;

	    $command=$connection->createCommand("SELECT * FROM hojas_ruta WHERE nur='$nuri' ORDER BY codigo ASC ");
        $dataReader=$command->query();

        return $dataReader;
	}


	public function getHojasRutaSiacoCite($codigo){

	    $connection= Yii::app()->dbmysql;

        $row=Yii::app()->dbmysql->createCommand("SELECT * FROM hojas_ruta WHERE codigo='$codigo' ORDER BY codigo ASC ")->query()->read();
		return $row; 
	}




	public function getDocumentosSiaco($codigo){

        $row=Yii::app()->dbmysql->createCommand("SELECT * FROM documentos WHERE codigo='$codigo' ORDER BY codigo ASC ")->query()->read();
		return $row; 
	}


	public function getUsuarioMysql($usuario){

        $row=Yii::app()->dbmysql->createCommand("SELECT * FROM usuarios WHERE id_usuario='$usuario' OR alias='$usuario' ")->query()->read();
		return $row['id_usuario']; 
	}


	public function countAliasMysql($usuario){

        $row=Yii::app()->dbmysql->createCommand("SELECT count(id_usuario) as total FROM alias WHERE id_usuario='$usuario' ")->query()->read();
		return $row['total']; 
	}


	public function getAliasMysql($usuario){

        $row=Yii::app()->dbmysql->createCommand("SELECT * FROM alias WHERE id_usuario='$usuario' ")->query()->read();
		return $row; 
	}


	//#######################################################################
	//#######################################################################

	// funcion para consultar la base de datos POSTGRESQL - SAD
	public function getAreasSAD(){

		//$connection=Yii::app()->dbsad;
		
		$sql = "SELECT usu_id,usu_id||' - '||usu_nombres||' '||usu_apellidos nombres FROM tab_usuario WHERE usu_estado = 1 ORDER BY usu_id";
	  	$result = Yii::app()->dbsad->createCommand($sql)->queryAll();

	    return CHtml::listData($result,'usu_id','nombres');
        
	}

	
	//#######################################################################
	//#######################################################################

	



}
