<?php

/**
 * This is the model class for table "documentos".
 *
 * The followings are the available columns in table 'documentos':
 * @property integer $id_documento
 * @property string $codigo
 * @property string $destinatario_titulo
 * @property string $destinatario_nombres
 * @property string $destinatario_cargo
 * @property string $destinatario_institucion
 * @property string $remitente_nombres
 * @property string $remitente_cargo
 * @property string $remitente_institucion
 * @property string $referencia
 * @property string $contenido
 * @property string $fecha
 * @property string $hora
 * @property string $adjuntos
 * @property string $copias
 * @property string $via_nombres
 * @property string $via_cargo
 * @property string $nro_hojas
 * @property integer $gestion
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property integer $fk_usuario
 * @property integer $fk_tipo_documento
 * @property integer $fk_estado_documento
 * @property integer $fk_area
 * @property integer $fk_documento
 * @property string $ruta_documento
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property Areas $fkArea
 * @property EstadoDocumento $fkEstadoDocumento
 * @property TipoDocumento $fkTipoDocumento
 * @property Usuarios $fkUsuario
 */
class Documentos extends CActiveRecord
{
	public $fkUsuario_nombre;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'documentos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			//valores unicos
			//array('codigo', 'unique', 'attributeName'=>'codigo', 'className'=>'Documentos', 'allowEmpty'=>false, 'message'=>'El Código del documento {value} ya existe ingrese otro por favor'),

			//array('usuario_destino','required','message'=>'Es necesario seleccionar al menos un destinatario de la lista. '),


			array('usuario_destino','compare','compareValue'=>0,'operator'=>'>','message'=>'Es necesario seleccionar al menos un destinatario de la lista.'),


			array('codigo','required','message'=>'El campo CITE no puede quedar vacío '),
			array('referencia','required','message'=>'El campo {attribute} no puede quedar vacío '),
			array('contenido','required','message'=>'El campo {attribute} no puede quedar vacío '),
			array('destinatario_nombres','required','message'=>'El campo {attribute} no puede quedar vacío '),
			//array('destinatario_cargo','required','message'=>'El campo {attribute} no puede quedar vacío '),
			array('remitente_nombres','required','message'=>'El campo {attribute} no puede quedar vacío '),
			array('remitente_cargo','required','message'=>'El campo {attribute} no puede quedar vacío '),
			array('remitente_institucion','required','message'=>'El campo {attribute} no puede quedar vacío '),

			array('nombre_grupo','required','message'=>'El campo Nombre Grupo no puede quedar vacío '),

			array('fk_motivo','required','message'=>'El campo Motivo no puede quedar vacío, seleccione una opción '),

			array('fk_tipo_documento','required','message'=>'El campo Tipo Documento no puede quedar vacío, seleccione una opción '),
			
			array('ruta_documento','required','message'=>'Es necesario subir un archivo PDF al sistema'),

			//array('destinatario_institucion','required','message'=>'El campo {attribute} no puede quedar vacío '),
			array('destinatario_titulo','required','message'=>'Seleccione una opcion de {attribute}'),

			//array('ruta_documento','required','message'=>'El campo {attribute} no puede quedar vacío '),

			array('fecha, hora, gestion, fecha_registro, hora_registro, fk_usuario, fk_estado_documento, fk_area', 'required'),
			
			array('gestion, fk_usuario, fk_tipo_documento, fk_estado_documento, fk_area, activo,usuario_destino,grupo_destino,observado', 'numerical', 'integerOnly'=>true),
			
			array('codigo, nro_hojas, ruta_documento', 'length', 'max'=>500),
			
			array('destinatario_titulo, destinatario_nombres, destinatario_cargo, destinatario_institucion, remitente_nombres, remitente_cargo, remitente_institucion, adjuntos, via_nombres, via_cargo,nombre_grupo', 'length', 'max'=>2000),
			array('copias', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_documento, codigo, destinatario_titulo, destinatario_nombres, destinatario_cargo, destinatario_institucion, remitente_nombres, remitente_cargo, remitente_institucion, referencia, contenido, fecha, hora, adjuntos, copias, via_nombres, via_cargo, nro_hojas, gestion, fecha_registro, hora_registro, fk_usuario, fk_tipo_documento, fk_estado_documento, fk_area, fk_documento, ruta_documento, activo, usuario_destino, grupo_destino,nombre_grupo, fk_motivo, observado, fkUsuario_nombre', 'safe', 'on'=>'search'),

			array('id_documento, codigo, destinatario_titulo, destinatario_nombres, destinatario_cargo, destinatario_institucion, remitente_nombres, remitente_cargo, remitente_institucion, referencia, contenido, fecha, hora, adjuntos, copias, via_nombres, via_cargo, nro_hojas, gestion, fecha_registro, hora_registro, fk_usuario, fk_tipo_documento, fk_estado_documento, fk_area, fk_documento, ruta_documento, activo, usuario_destino, grupo_destino,nombre_grupo, fk_motivo, observado, fkUsuario_nombre', 'safe', 'on'=>'searchGestion'),
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
			'fkArea' => array(self::BELONGS_TO, 'Areas', 'fk_area'),
			'fkEstadoDocumento' => array(self::BELONGS_TO, 'EstadoDocumento', 'fk_estado_documento'),
			'fkTipoDocumento' => array(self::BELONGS_TO, 'TipoDocumento', 'fk_tipo_documento'),
			'fkUsuario' => array(self::BELONGS_TO, 'Usuarios', 'fk_usuario'),
			'fkMotivo' => array(self::BELONGS_TO, 'Motivos', 'fk_motivo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_documento' => 'Id Documento',
			'codigo' => 'CITE',
			'destinatario_titulo' => 'Destinatario Titulo',
			'destinatario_nombres' => 'Destinatario Nombres',
			'destinatario_cargo' => 'Destinatario Cargo',
			'destinatario_institucion' => 'Destinatario Institucion',
			'remitente_nombres' => 'Remitente Nombres',
			'remitente_cargo' => 'Remitente Cargo',
			'remitente_institucion' => 'Remitente Institucion',
			'referencia' => 'Referencia',
			'contenido' => 'Contenido',
			'fecha' => 'Fecha',
			'hora' => 'Hora',
			'adjuntos' => 'Adjuntos',
			'copias' => 'Copias',
			'via_nombres' => 'Via Nombres',
			'via_cargo' => 'Via Cargo',
			'nro_hojas' => 'Nro Hojas',
			'gestion' => 'Gestion',
			'fecha_registro' => 'Fecha Registro',
			'hora_registro' => 'Hora Registro',
			'fk_usuario' => 'Fk Usuario',
			'fk_tipo_documento' => 'Fk Tipo Documento',
			'fk_estado_documento' => 'Fk Estado Documento',
			'fk_area' => 'Fk Area',
			'fk_documento' => 'Fk Documento',
			'ruta_documento' => 'Ruta Documento',
			'activo' => 'Activo',
			'usuario_destino' => 'Usuario Destino',
			'grupo_destino' => 'Grupo Destino',
			'nombre_grupo' => 'Nombre Grupo',
			'fk_motivo' => 'Motivo',
			'observado' => 'observado',
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

		$criteria->compare('id_documento',$this->id_documento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('destinatario_titulo',$this->destinatario_titulo,true);
		$criteria->compare('destinatario_nombres',$this->destinatario_nombres,true);
		$criteria->compare('destinatario_cargo',$this->destinatario_cargo,true);
		$criteria->compare('destinatario_institucion',$this->destinatario_institucion,true);
		$criteria->compare('remitente_nombres',$this->remitente_nombres,true);
		$criteria->compare('remitente_cargo',$this->remitente_cargo,true);
		$criteria->compare('remitente_institucion',$this->remitente_institucion,true);
		$criteria->compare('referencia',$this->referencia,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('adjuntos',$this->adjuntos,true);
		$criteria->compare('copias',$this->copias,true);
		$criteria->compare('via_nombres',$this->via_nombres,true);
		$criteria->compare('via_cargo',$this->via_cargo,true);
		$criteria->compare('nro_hojas',$this->nro_hojas,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('fk_usuario',$this->fk_usuario);
		$criteria->compare('fk_tipo_documento',$this->fk_tipo_documento);
		$criteria->compare('fk_estado_documento',$this->fk_estado_documento);
		$criteria->compare('fk_area',$this->fk_area);
		$criteria->compare('fk_documento',$this->fk_documento);
		$criteria->compare('ruta_documento',$this->ruta_documento,true);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('usuario_destino',$this->usuario_destino);
		$criteria->compare('grupo_destino',$this->grupo_destino);
		$criteria->compare('nombre_grupo',$this->nombre_grupo);
		$criteria->compare('fk_motivo',$this->fk_motivo);
		$criteria->order = "fecha DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function searchRegional()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$regional=Yii::app()->user->regional;

		$criteria=new CDbCriteria;


		$criteria->select = '*';
        $criteria->alias="p";
        $criteria->join = 'INNER JOIN usuarios u ON u.id_usuario = p.fk_usuario';



		$criteria->compare('id_documento',$this->id_documento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('destinatario_titulo',$this->destinatario_titulo,true);
		$criteria->compare('destinatario_nombres',$this->destinatario_nombres,true);
		$criteria->compare('destinatario_cargo',$this->destinatario_cargo,true);
		$criteria->compare('destinatario_institucion',$this->destinatario_institucion,true);
		$criteria->compare('remitente_nombres',$this->remitente_nombres,true);
		$criteria->compare('remitente_cargo',$this->remitente_cargo,true);
		$criteria->compare('remitente_institucion',$this->remitente_institucion,true);
		$criteria->compare('referencia',$this->referencia,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('adjuntos',$this->adjuntos,true);
		$criteria->compare('copias',$this->copias,true);
		$criteria->compare('via_nombres',$this->via_nombres,true);
		$criteria->compare('via_cargo',$this->via_cargo,true);
		$criteria->compare('nro_hojas',$this->nro_hojas,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('fk_usuario',$this->fk_usuario);
		$criteria->compare('fk_tipo_documento',$this->fk_tipo_documento);
		$criteria->compare('fk_estado_documento',$this->fk_estado_documento);
		$criteria->compare('p.fk_area',$this->fk_area);
		$criteria->compare('fk_documento',$this->fk_documento);
		$criteria->compare('ruta_documento',$this->ruta_documento,true);
		$criteria->compare('p.activo',$this->activo);
		$criteria->compare('usuario_destino',$this->usuario_destino);
		$criteria->compare('grupo_destino',$this->grupo_destino);
		$criteria->compare('nombre_grupo',$this->nombre_grupo);
		$criteria->compare('fk_motivo',$this->fk_motivo);

		$criteria->addCondition('u.fk_regional = '.$regional);

		$criteria->order = "fecha DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchDocumento($tipo_documento, $gestion)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$usuario=Yii::app()->user->id_usuario;
		//$usuario=2;
		//$gestion=date('Y');
		$activo=1;
		$estado_documento=7;



		$criteria=new CDbCriteria;

		$criteria->compare('id_documento',$this->id_documento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('destinatario_titulo',$this->destinatario_titulo,true);
		$criteria->compare('destinatario_nombres',$this->destinatario_nombres,true);
		$criteria->compare('destinatario_cargo',$this->destinatario_cargo,true);
		$criteria->compare('destinatario_institucion',$this->destinatario_institucion,true);
		$criteria->compare('remitente_nombres',$this->remitente_nombres,true);
		$criteria->compare('remitente_cargo',$this->remitente_cargo,true);
		$criteria->compare('remitente_institucion',$this->remitente_institucion,true);
		$criteria->compare('referencia',$this->referencia,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('fecha::text',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('adjuntos',$this->adjuntos,true);
		$criteria->compare('copias',$this->copias,true);
		$criteria->compare('via_nombres',$this->via_nombres,true);
		$criteria->compare('via_cargo',$this->via_cargo,true);
		$criteria->compare('nro_hojas',$this->nro_hojas,true);
		$criteria->compare('gestion',$gestion);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('fk_usuario',$usuario);
		$criteria->compare('fk_tipo_documento',$tipo_documento);
		$criteria->compare('fk_estado_documento','<>'.$estado_documento);
		$criteria->compare('fk_area',$this->fk_area);
		$criteria->compare('fk_documento',$this->fk_documento);
		$criteria->compare('ruta_documento',$this->ruta_documento,true);
		$criteria->compare('activo',$activo);
		$criteria->compare('usuario_destino',$this->usuario_destino);
		$criteria->compare('grupo_destino',$this->grupo_destino);
		$criteria->compare('nombre_grupo',$this->nombre_grupo);
		$criteria->compare('fk_motivo',$this->fk_motivo);
		$criteria->order = "codigo DESC, fecha DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function searchDocumentoCiteArea($tipo_documento, $gestion,$id_area)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		//$usuario=Yii::app()->user->id_usuario;
		//$usuario=2;
		//$gestion=date('Y');
		$activo=1;
		//$estado_documento=7;



		$criteria=new CDbCriteria;

		$criteria->compare('id_documento',$this->id_documento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('destinatario_titulo',$this->destinatario_titulo,true);
		$criteria->compare('destinatario_nombres',$this->destinatario_nombres,true);
		$criteria->compare('destinatario_cargo',$this->destinatario_cargo,true);
		$criteria->compare('destinatario_institucion',$this->destinatario_institucion,true);
		$criteria->compare('remitente_nombres',$this->remitente_nombres,true);
		$criteria->compare('remitente_cargo',$this->remitente_cargo,true);
		$criteria->compare('remitente_institucion',$this->remitente_institucion,true);
		$criteria->compare('referencia',$this->referencia,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('fecha::text',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('adjuntos',$this->adjuntos,true);
		$criteria->compare('copias',$this->copias,true);
		$criteria->compare('via_nombres',$this->via_nombres,true);
		$criteria->compare('via_cargo',$this->via_cargo,true);
		$criteria->compare('nro_hojas',$this->nro_hojas,true);
		$criteria->compare('gestion',$gestion);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('fk_usuario',$this->fk_usuario);
		$criteria->compare('fk_tipo_documento',$tipo_documento);
		$criteria->compare('fk_estado_documento',$this->fk_estado_documento);
		//$criteria->compare('fk_estado_documento','<>'.$estado_documento);
		$criteria->compare('fk_area',$id_area);
		$criteria->compare('fk_documento',$this->fk_documento);
		$criteria->compare('ruta_documento',$this->ruta_documento,true);
		$criteria->compare('activo',$activo);
		$criteria->compare('usuario_destino',$this->usuario_destino);
		$criteria->compare('grupo_destino',$this->grupo_destino);
		$criteria->compare('nombre_grupo',$this->nombre_grupo);
		$criteria->compare('fk_motivo',$this->fk_motivo);
		$criteria->order = "codigo DESC, fecha DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 200)
		));
	}

	public function searchReservado($estado_documento)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$usuario=Yii::app()->user->id_usuario;
		//$usuario=2;
		//$gestion=date('Y');
		$activo=1;

		$criteria=new CDbCriteria;

		$criteria->compare('id_documento',$this->id_documento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('destinatario_titulo',$this->destinatario_titulo,true);
		$criteria->compare('destinatario_nombres',$this->destinatario_nombres,true);
		$criteria->compare('destinatario_cargo',$this->destinatario_cargo,true);
		$criteria->compare('destinatario_institucion',$this->destinatario_institucion,true);
		$criteria->compare('remitente_nombres',$this->remitente_nombres,true);
		$criteria->compare('remitente_cargo',$this->remitente_cargo,true);
		$criteria->compare('remitente_institucion',$this->remitente_institucion,true);
		$criteria->compare('referencia',$this->referencia,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('fecha::text',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('adjuntos',$this->adjuntos,true);
		$criteria->compare('copias',$this->copias,true);
		$criteria->compare('via_nombres',$this->via_nombres,true);
		$criteria->compare('via_cargo',$this->via_cargo,true);
		$criteria->compare('nro_hojas',$this->nro_hojas,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('fk_usuario',$usuario);
		$criteria->compare('fk_tipo_documento',$this->fk_tipo_documento);
		$criteria->compare('fk_estado_documento',$estado_documento);
		$criteria->compare('fk_area',$this->fk_area);
		$criteria->compare('fk_documento',$this->fk_documento);
		$criteria->compare('ruta_documento',$this->ruta_documento,true);
		$criteria->compare('activo',$activo);
		$criteria->compare('usuario_destino',$this->usuario_destino);
		$criteria->compare('grupo_destino',$this->grupo_destino);
		$criteria->compare('nombre_grupo',$this->nombre_grupo);
		$criteria->compare('fk_motivo',$this->fk_motivo);
		$criteria->order = "fecha DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function searchGestion($gestion)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		//$usuario=Yii::app()->user->id_usuario;
		//$usuario=2;
		//$gestion=date('Y');
		$activo=1;

		$criteria=new CDbCriteria;

		$criteria->compare('id_documento',$this->id_documento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('destinatario_titulo',$this->destinatario_titulo,true);
		$criteria->compare('destinatario_nombres',$this->destinatario_nombres,true);
		$criteria->compare('destinatario_cargo',$this->destinatario_cargo,true);
		$criteria->compare('destinatario_institucion',$this->destinatario_institucion,true);
		$criteria->compare('remitente_nombres',$this->remitente_nombres,true);
		$criteria->compare('remitente_cargo',$this->remitente_cargo,true);
		$criteria->compare('remitente_institucion',$this->remitente_institucion,true);
		$criteria->compare('referencia',$this->referencia,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('fecha::text',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('adjuntos',$this->adjuntos,true);
		$criteria->compare('copias',$this->copias,true);
		$criteria->compare('via_nombres',$this->via_nombres,true);
		$criteria->compare('via_cargo',$this->via_cargo,true);
		$criteria->compare('nro_hojas',$this->nro_hojas,true);
		$criteria->compare('gestion',$gestion);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		//$criteria->compare('fk_usuario',$this->fk_usuario);
		$criteria->with = array('fkUsuario');
        $criteria->addSearchCondition('"fkUsuario".nombre::text', strtoupper($this->fkUsuario_nombre));

		$criteria->compare('fk_tipo_documento',$this->fk_tipo_documento);
		$criteria->compare('fk_estado_documento',$this->fk_estado_documento);
		$criteria->compare('fk_area',$this->fk_area);
		$criteria->compare('fk_documento',$this->fk_documento);
		$criteria->compare('ruta_documento',$this->ruta_documento,true);
		$criteria->compare('t.activo',$activo);
		$criteria->compare('usuario_destino',$this->usuario_destino);
		$criteria->compare('grupo_destino',$this->grupo_destino);
		$criteria->compare('nombre_grupo',$this->nombre_grupo);
		$criteria->compare('fk_motivo',$this->fk_motivo);
		$criteria->order = "fecha DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function searchDocumentoUsuario()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$usuario=Yii::app()->user->id_usuario;
		//$usuario=2;
		$gestion=date('Y');
		$activo=1;

		$criteria=new CDbCriteria;

		$criteria->compare('id_documento',$this->id_documento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('destinatario_titulo',$this->destinatario_titulo,true);
		$criteria->compare('destinatario_nombres',$this->destinatario_nombres,true);
		$criteria->compare('destinatario_cargo',$this->destinatario_cargo,true);
		$criteria->compare('destinatario_institucion',$this->destinatario_institucion,true);
		$criteria->compare('remitente_nombres',$this->remitente_nombres,true);
		$criteria->compare('remitente_cargo',$this->remitente_cargo,true);
		$criteria->compare('remitente_institucion',$this->remitente_institucion,true);
		$criteria->compare('referencia',$this->referencia,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('fecha::text',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('adjuntos',$this->adjuntos,true);
		$criteria->compare('copias',$this->copias,true);
		$criteria->compare('via_nombres',$this->via_nombres,true);
		$criteria->compare('via_cargo',$this->via_cargo,true);
		$criteria->compare('nro_hojas',$this->nro_hojas,true);
		$criteria->compare('gestion',$gestion);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('fk_usuario',$usuario);
		$criteria->compare('fk_tipo_documento',$this->fk_tipo_documento);
		$criteria->compare('fk_estado_documento',$this->fk_estado_documento);
		$criteria->compare('fk_area',$this->fk_area);
		$criteria->compare('fk_documento',$this->fk_documento);
		$criteria->compare('ruta_documento',$this->ruta_documento,true);
		$criteria->compare('activo',$activo);
		$criteria->compare('nombre_grupo',$this->nombre_grupo);
		$criteria->compare('fk_motivo',$this->fk_motivo);
		$criteria->order = "fecha DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function searchDocumentoObservado()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$usuario=Yii::app()->user->id_usuario;
		$observado=1;
		$gestion=date('Y');
		$activo=1;

		$criteria=new CDbCriteria;

		$criteria->compare('id_documento',$this->id_documento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('destinatario_titulo',$this->destinatario_titulo,true);
		$criteria->compare('destinatario_nombres',$this->destinatario_nombres,true);
		$criteria->compare('destinatario_cargo',$this->destinatario_cargo,true);
		$criteria->compare('destinatario_institucion',$this->destinatario_institucion,true);
		$criteria->compare('remitente_nombres',$this->remitente_nombres,true);
		$criteria->compare('remitente_cargo',$this->remitente_cargo,true);
		$criteria->compare('remitente_institucion',$this->remitente_institucion,true);
		$criteria->compare('referencia',$this->referencia,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('fecha::text',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('adjuntos',$this->adjuntos,true);
		$criteria->compare('copias',$this->copias,true);
		$criteria->compare('via_nombres',$this->via_nombres,true);
		$criteria->compare('via_cargo',$this->via_cargo,true);
		$criteria->compare('nro_hojas',$this->nro_hojas,true);
		$criteria->compare('gestion',$gestion);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('fk_usuario',$usuario);
		$criteria->compare('fk_tipo_documento',$this->fk_tipo_documento);
		$criteria->compare('fk_estado_documento',$this->fk_estado_documento);
		$criteria->compare('fk_area',$this->fk_area);
		$criteria->compare('fk_documento',$this->fk_documento);
		$criteria->compare('ruta_documento',$this->ruta_documento,true);
		$criteria->compare('activo',$activo);
		$criteria->compare('nombre_grupo',$this->nombre_grupo);
		$criteria->compare('fk_motivo',$this->fk_motivo);
		$criteria->compare('observado',$observado);
		$criteria->order = "fecha DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Documentos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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


	public function getListEstadoDocumento(){

		return CHtml::listData(EstadoDocumento::model()->findAll("activo=? AND id_estado_documento!=? AND id_estado_documento!=?", array(1,5,7)), 'id_estado_documento', 'estado_documento');

	}

	public function getListMotivo(){

		return CHtml::listData(Motivos::model()->findAll("activo=?", array(1)), 'id_motivo', 'motivo');

	}

	public function getListTipoDocumento(){


		$sql = "SELECT id_tipo_documento,tipo_documento  
				FROM tipo_documento  
				WHERE id_tipo_documento in (1,2,3,4,5,7,8)
				";
  		$result = Yii::app()->db->createCommand($sql)->queryAll();

    return CHtml::listData($result,'id_tipo_documento','tipo_documento');

	}

	public function listadoDerivaciones()
	{

		/*$connection= Yii::app()->db;
	    $usuario=Yii::app()->user->id_usuario;

		$sql="SELECT id_lista_derivacion, usuario_destino, 
		    	(SELECT nombre FROM usuarios WHERE id_usuario=l.usuario_destino) nombre_destino,
		    	(SELECT u.cargo FROM usuarios u WHERE u.id_usuario=l.usuario_destino) cargos
		    	FROM lista_derivacion l
		    	WHERE l.usuario_origen=$usuario AND l.activo=1
		    	ORDER BY l.id_lista_derivacion ASC ";
							 			
	 	return $connection->createCommand($sql)->query();*/

	 	$connection= Yii::app()->db;

		$usuario=Yii::app()->user->id_usuario;


        $command=$connection->createCommand("SELECT * 
			   FROM lista_usuario_derivacion($usuario)");
        $dataReader=$command->query();

        return $dataReader;


	}

	public function listadoDerivacionesCartaExterna()
	{

		$connection= Yii::app()->db;
	    $usuario=Yii::app()->user->id_usuario;

		$sql="SELECT id_lista_derivacion, usuario_destino, 
		    	(SELECT a.nombre FROM alias a WHERE a.fk_usuario=l.usuario_destino AND  a.activo=1) nombre_destino,
		    	(SELECT a.cargo FROM alias a WHERE a.fk_usuario=l.usuario_destino AND  a.activo=1) cargos
		    	FROM lista_derivacion l
		    	WHERE l.usuario_origen=$usuario AND l.activo=1
		    	ORDER BY l.id_lista_derivacion ASC ";
							 			
	 	return $connection->createCommand($sql)->query();
	}

	public function listadoGrupos()
	{

		$connection= Yii::app()->db;
	    $usuario=Yii::app()->user->id_usuario;

		$sql="SELECT id_grupo_derivacion, nombre_grupo 
		    	FROM grupo_derivacion
		    	WHERE fk_usuario=$usuario AND activo=1
		    	ORDER BY id_grupo_derivacion ASC ";
							 			
	 	return $connection->createCommand($sql)->query();
	}

	public function getRemitente(){
		
	    $usuario=Yii::app()->user->id_usuario;
	    return Usuarios::model()->findByPk($usuario);
	}

	public function getCodigo($gestion,$area,$tipo,$regional){


		// revisar codigo si no esta registrado el sistema deberia registrarlo
	 	$connection= Yii::app()->db;

	 	$row=$connection->createCommand("SELECT correlativo 
			 				   FROM correlativos 
			 				   WHERE gestion=$gestion
			 				   AND fk_area=$area
			 				   AND fk_regional=$regional
			 				   AND fk_tipo_documento=$tipo
			 				   AND activo=1
			 				   ")->query()->read();

	 	$correlativo=$row['correlativo'];
	 	$correlativo++;

	 	if (strlen($correlativo)==1) { $numero="000".$correlativo;	}
	 	if (strlen($correlativo)==2) { $numero="00".$correlativo;	}
	 	if (strlen($correlativo)==3) { $numero="0".$correlativo;	}
	 	if (strlen($correlativo)==4) { $numero=$correlativo;	}

	 	$tipoDoc=TipoDocumento::model()->findByPk($tipo);	
	 	// codigo para obtener la sigla del area
		$areas=Areas::model()->findByPk($area);
		$codigo=$tipoDoc->sigla."/".$areas->cite."/".$gestion."-".$numero;

		// codigo para actualizar la tabla correlativos
		$connection->createCommand("UPDATE correlativos SET correlativo=$correlativo WHERE gestion=$gestion AND fk_area=$area AND fk_regional=$regional AND fk_tipo_documento=$tipo AND activo=1")->execute();

		return $codigo;

	}

	public function getNuri($gestion,$tipo){

	 	$connection= Yii::app()->db;

	 	$row=$connection->createCommand("SELECT correlativo 
			 				   FROM correlativos 
			 				   WHERE gestion='$gestion'
			 				   AND fk_tipo_documento='$tipo'
			 				   AND activo=1
			 				   ")->query()->read();

	 	$correlativo=$row['correlativo'];
	 	$correlativo++;

	 	if (strlen($correlativo)==1) { $numero="0000".$correlativo;	}
	 	if (strlen($correlativo)==2) { $numero="000".$correlativo;	}
	 	if (strlen($correlativo)==3) { $numero="00".$correlativo;	}
	 	if (strlen($correlativo)==4) { $numero="0".$correlativo;	}
	 	if (strlen($correlativo)==5) { $numero=$correlativo;	}

	 	$tipoDoc=TipoDocumento::model()->findByPk($tipo);	
	 	// codigo para obtener la sigla del area
		$codigo=$tipoDoc->sigla."/".$gestion."-".$numero;

		// codigo para actualizar la tabla correlativos
		$connection->createCommand("UPDATE correlativos SET correlativo=$correlativo WHERE gestion=$gestion AND fk_tipo_documento=$tipo AND activo=1")->execute();

		return $codigo;

	}

	// codigo paera obtener el nuri externo
	public function getNuriExterno($gestion){

	 	$connection= Yii::app()->db;


	 	$regional=Yii::app()->user->regional;
	 	$row=$connection->createCommand("SELECT id_ventanilla,correlativo,sigla 
			 				   FROM ventanilla 
			 				   WHERE gestion=$gestion
			 				   AND fk_regional =$regional
			 				   AND activo=1
			 				   ")->query()->read();
	 	$correlativo=$row['correlativo'];
	 	$id_ventanilla=$row['id_ventanilla'];
	 	$sigla=$row['sigla'];
	 	$correlativo++;

	 	if (strlen($correlativo)==1) { $numero="0000".$correlativo;	}
	 	if (strlen($correlativo)==2) { $numero="000".$correlativo;	}
	 	if (strlen($correlativo)==3) { $numero="00".$correlativo;	}
	 	if (strlen($correlativo)==4) { $numero="0".$correlativo;	}
	 	if (strlen($correlativo)==5) { $numero=$correlativo;	}

	 	//$tipoDoc=TipoDocumento::model()->findByPk($tipo);	
	 	// codigo para obtener la sigla del area

	 	if ($regional==1) {
			$nuri=$gestion."-".$numero;
	 	}
	 	else{
			$nuri=$sigla."/".$gestion."-".$numero;
	 	}

	 	//echo "----> ".$id_ventanilla;

		// codigo para actualizar la tabla correlativos
		$connection->createCommand("UPDATE ventanilla SET correlativo=$correlativo WHERE id_ventanilla=$id_ventanilla AND activo=1")->execute();

		return $nuri;

	}

	public function insertNurHojaRuta($gestion, $id_documento, $cite){

		$hojasruta= new HojasRuta();
		$hojasruta->nur=Documentos::getNuriExterno($gestion);
		$hojasruta->codigo=$cite;
		$hojasruta->nro=0;
		$hojasruta->fecha=date('Y-m-d');
		$hojasruta->hora=date('H:i:s');
		$hojasruta->proceso=4;
		$hojasruta->fecha_registro=date('Y-m-d');
		$hojasruta->hora_registro=date('H:i:s');
		$hojasruta->fk_usuario=Yii::app()->user->id_usuario;;
		$hojasruta->gestion=$gestion;
		$hojasruta->fk_documento=$id_documento;
		$hojasruta->oficial=1;
		$hojasruta->insert();


	}

	 public function insertRemitente($remitente_nombres,$remitente_cargo,$remitente_institucion){

		// para guardar institucion remitente
		$countInst = InstitucionRemitente::model()->countByAttributes(array(
            'institucion_remitente'=> $remitente_institucion,
            'nombre_remitente'=> $remitente_nombres,
            'cargo_remitente'=> $remitente_cargo,
            'activo'=>1
        ));

        if ($countInst==0) {
        	$institucion = new InstitucionRemitente();
        	$institucion->institucion_remitente=$remitente_institucion;
        	$institucion->nombre_remitente=$remitente_nombres;
        	$institucion->cargo_remitente=$remitente_cargo;
        	$institucion->descripcion='null';
        	$institucion->insert();

        }
        	 	

	 }

	public function getNuriHojasRuta($id){

		$connection= Yii::app()->db;
		//$gestion=date('Y');

	 	$row=$connection->createCommand("SELECT nur,id_hoja_ruta, nro 
			 				   FROM hojas_ruta 
			 				   WHERE fk_documento='$id'
			 				   AND activo=1
			 				   ")->query()->read();

	 	return $row;
	}

	public function countBorradores(){

		$count = Documentos::model()->countByAttributes(array(
            'fk_usuario'=>Yii::app()->user->id_usuario,
            'activo'=>1,
            'fk_estado_documento'=>7,
        ));
        return $count;
	}


	public function countNurNuevoSeguimiento($nur){

		$count = Seguimientos::model()->countByAttributes(array(
            'codigo'=>$nur,
            'activo'=>1,
            
        ));
        return $count;
	}

	public function verificarDocumentoOriginal($id_documento){

        $usuario=Yii::app()->user->id_usuario;
        $connection= Yii::app()->db;
		$gestion=date('Y');

	 	$row=$connection->createCommand("SELECT nro 
			 				   FROM hojas_ruta 
			 				   WHERE fk_documento=$id_documento
			 				   AND fk_usuario=$usuario
			 				   AND activo=1
			 				   ")->query()->read();

	 	return $row['nro'];
	}

	public function countNurSeguimientoPendiente($nur,$id_seguimiento){

        $usuario=Yii::app()->user->id_usuario;
        $connection= Yii::app()->db;
		$gestion=date('Y');

	 	$row=$connection->createCommand("SELECT count(id_seguimiento) as total 
			 				   FROM seguimientos 
			 				   WHERE codigo='$nur'
			 				   AND activo=1
			 				   AND derivado_a=$usuario
			 				   AND id_seguimiento=$id_seguimiento
			 				   AND fk_estado in (1,2)
			 				   ")->query()->read();

	 	return $row['total'];
	}





	public function countDocumentos($id){

		$connection= Yii::app()->db;
		$gestion=date('Y');

	 	$row=$connection->createCommand("SELECT count(id_hoja_ruta) as total 
			 				   FROM hojas_ruta 
			 				   WHERE fk_documento='$id'
			 				   AND activo=1
			 				   ")->query()->read();

	 	return $row['total'];
	}

	public function verificarNuri($id_documento){
		$connection= Yii::app()->db;
		$gestion=date('Y');

	 	$row=$connection->createCommand("SELECT nur 
			 				   FROM hojas_ruta 
			 				   WHERE fk_documento='$id_documento'
			 				   AND activo=1
			 				   ")->query()->read();

	 	if ($row['nur']=='') {
	 		$valor='<p style="color:red; font-size:18px;">NO ASIGNADO</p>';
	 	}
	 	else{
	 		$valor='<p style="font-size:18px;"><b><u>'.$row['nur'].'</u></b></p>';
	 	}

	 	return $valor;

	}

	public function getListNuriPendiente(){

		$usuario=Yii::app()->user->id_usuario;

	$sql = "SELECT * FROM lista_nuris_pendientes('$usuario')";
  	$result = Yii::app()->db->createCommand($sql)->queryAll();

    return CHtml::listData($result,'id_seguimiento','codigo_completo');
	}



	public function getListNuriCreado(){

	$usuario=Yii::app()->user->id_usuario;

	$sql = "SELECT * FROM lista_nuris_creados('$usuario')";
  	$result = Yii::app()->db->createCommand($sql)->queryAll();

    return CHtml::listData($result,'nur','nur');
	}

	public function getNurisAsociados($nuri){

		$connection= Yii::app()->db;
		$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT h.id_hoja_ruta, h.codigo, d.id_documento, d.fk_tipo_documento 
			   FROM hojas_ruta h, documentos d
			   WHERE h.nur='$nuri' 
			   AND h.activo=1 
			   AND h.nro=0
			   AND h.fk_documento=d.id_documento
			   ");
        $dataReader=$command->query();
        return $dataReader;
	}


	public function getNurisAsociadosRespuesta($nuri,$id_seguimiento){

		$connection= Yii::app()->db;
		$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT h.id_hoja_ruta, h.codigo, d.id_documento, d.fk_tipo_documento 
			   FROM hojas_ruta h, documentos d
			   WHERE h.nur='$nuri' 
			   AND h.activo=1 
			   AND h.nro=$id_seguimiento
			   AND h.fk_usuario=$usuario
			   AND h.fk_documento=d.id_documento
			   ");
        $dataReader=$command->query();
        return $dataReader;
	}


	

	public function getNameMonth($num){

		$meses=array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');

		return $meses[$num-1];
	}

	public function getRowExplode($string,$delimiter){

		$row=explode($delimiter,$string);
		return $row;
	}

	public function getNamePresidencia(){

		$connection= Yii::app()->db;

	 	$row=$connection->createCommand("SELECT a.nombre, a.cargo 
			 				   FROM usuarios u, alias a 
			 				   WHERE u.activo=1
			 				   AND u.fk_area=1
			 				   AND u.id_usuario=a.fk_usuario
			 				   AND a.activo=1
			 				   ")->query()->read();
	 	return $row;
	}

	public function getNurisSinDerivar(){

		$connection= Yii::app()->db;
		$usuario=Yii::app()->user->id_usuario;
        
        /*$command=$connection->createCommand("SELECT * 
			   FROM nuris_sin_derivar($usuario)");
        $dataReader=$command->query();

        return $dataReader;*/



        $sql = "SELECT * FROM nuris_sin_derivar($usuario)";

		$rawdata = Yii::app()->db->createCommand($sql)->queryAll();
		return $rawdata;
	 	
	}

	public function getInstitucionRemitente(){

		$connection= Yii::app()->db;

		$usuario=Yii::app()->user->id_usuario;


        $command=$connection->createCommand("SELECT * 
			   FROM institucion_remitente WHERE activo=1");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}

	public function getDocumentosSinNuri(){

		$connection= Yii::app()->db;

		$usuario=Yii::app()->user->id_usuario;


        $command=$connection->createCommand("SELECT * 
			   FROM documentos_sin_nuri($usuario)");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}

	public function getDetalleSeguimiento($nuri){

		$seguimiento=Seguimientos::model()->find(array(
		    'select'=>'proveido, derivado_a, fecha_derivacion, hora_derivacion',
		    'condition'=>'codigo=:nur AND activo=:activo AND oficial!=:oficial',
		    'params'=>array(':nur'=>$nuri, ':activo'=>1, ':oficial'=>0),
		    'order'=>'id_seguimiento',
		    'limit'=>1,
		));

		return $seguimiento;
	}


	public function getDetalleSeguimientoCopia($nuri,$numero_copia){

		$seguimiento=Seguimientos::model()->find(array(
		    'select'=>'proveido, derivado_a, fecha_derivacion, hora_derivacion',
		    'condition'=>'codigo=:nur AND activo=:activo AND oficial=:oficial AND numero_copia=:numero_copia',
		    'params'=>array(':nur'=>$nuri, ':activo'=>1, ':oficial'=>0, ':numero_copia'=>$numero_copia),
		));

		return $seguimiento;
	}

	public function getNumCopias($nuri){

		$connection= Yii::app()->db;

	 	$row=$connection->createCommand("SELECT count(id_seguimiento) as total 
			 				   FROM seguimientos 
			 				   WHERE padre=0
			 				   AND oficial=0
			 				   AND codigo='$nuri'
			 				   AND activo=1
			 				   ")->query()->read();

	 	return $row['total'];
	}

	public function getNameCopias($nuri){

		$connection= Yii::app()->db;

		$connection= Yii::app()->db;
		$dataReader=$connection->createCommand("SELECT derivado_a 
			 			FROM seguimientos
			 			WHERE codigo='$nuri' AND oficial=0 AND activo=1 ORDER BY id_seguimiento ASC ")->query();

		$copias='';
	 	foreach($dataReader as $row) {

	 		$usuarios=Usuarios::model()->findByPk($row['derivado_a']);	
	 		$area=$usuarios->fkArea->sigla;

	 		if ($copias=='') {
				$copias=$area;		
	 		}
	 		else{
	 			$copias=$copias.','.$area;
	 		}

		}

	 	return '<b style="font-size:8px; font-weight: normal;">'.$copias.'</b>';
	}

	public function getNameAreaDerivacion($id_usuario){

		$connection= Yii::app()->db;

	 	$row=$connection->createCommand("SELECT area 
			 				   FROM usuarios u, areas a 
			 				   WHERE u.id_usuario=$id_usuario
			 				   AND u.fk_area= a.id_area
			 				   
			 				   ")->query()->read();

	 	return $row['area'];
	}


	public function getCopiasDerivadas($nuri){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("SELECT id_seguimiento, derivado_a, numero_copia FROM seguimientos WHERE codigo='$nuri' AND  oficial=0 AND activo=1 ORDER BY id_seguimiento ASC");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}


	public function getCiteGestion($id_area){

		$connection= Yii::app()->db;
		$usuario=Yii::app()->user->id_usuario;
		
		$sql="SELECT DISTINCT gestion 
		   	FROM documentos
		   	WHERE fk_area=$id_area 
		   	AND activo=1
		   	ORDER BY gestion DESC  
		   	";
				 			
		$command=$connection->createCommand($sql);
		return $command->query();

	}


	public function getDocumentosGestion(){

		$connection= Yii::app()->db;
		$usuario=Yii::app()->user->id_usuario;
		
		$sql="SELECT DISTINCT gestion 
		   	FROM documentos
		   	WHERE activo=1
		   	ORDER BY gestion DESC  
		   	";
				 			
		$command=$connection->createCommand($sql);
		return $command->query();

	}

	public function getCitesAsignados($id_area,$tipo_documento,$gestion){

		$connection= Yii::app()->db;

		//$usuario=Yii::app()->user->id_usuario;

        $command=$connection->createCommand("SELECT * 
			   FROM cites_asignados($id_area,$tipo_documento,$gestion)");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}

	public function getNumeroReservados(){

		$usuario=Yii::app()->user->id_usuario;
		$count = Documentos::model()->countByAttributes(array(
            'fk_usuario'=> $usuario,
            'fk_estado_documento'=>1,
            'activo'=>1
        ));

        return $count;

	}

	public function getNumeroNurisAsociados($nuri){

		$usuario=Yii::app()->user->id_usuario;
		$count = HojasRuta::model()->countByAttributes(array(
            'fk_usuario'=> $usuario,
            'nur'=>$nuri,
            'nro'=>0,
            'activo'=>1,
        ));

        return $count;
	}

	public function getCountUserDerivacion(){

		$usuario=Yii::app()->user->id_usuario;
		$count = ListaDerivacion::model()->countByAttributes(array(
            'usuario_origen'=> $usuario,
            'activo'=>1
        ));

        return $count;

	}

	public function getObtenerNuri($id_documento){

		$connection= Yii::app()->db;

		//$usuario=Yii::app()->user->id_usuario;
		$count = HojasRuta::model()->countByAttributes(array(
            'fk_documento'=> $id_documento,
            'activo'=>1
        ));

        if ($count>0) {
        	
		 	$row=$connection->createCommand("SELECT nur, oficial 
				 				   FROM hojas_ruta 
				 				   WHERE fk_documento=$id_documento
				 				   AND activo=1
				 				   
				 				   ")->query()->read();

		 	if ($row['oficial']==1) {
		 		
		 	return "<i  class='fa fa-hand-peace-o' style='font-size: 18px; color: darkblue;'></i> <i> Original</i><br>".$row['nur'];
		 	}
		 	else{
		 		return "<i>Copia Digital</i><br>".$row['nur'];
		 	}
        }
        else{
        	return "<b style='color:#FA5858;'>Sin NUR/NURI</b>";
        }
	 	
	}// fin function


	public function getObtenerNur($id_documento){

		$connection= Yii::app()->db;

		//$usuario=Yii::app()->user->id_usuario;
		$count = HojasRuta::model()->countByAttributes(array(
            'fk_documento'=> $id_documento,
            'activo'=>1
        ));

        if ($count>0) {
        	
		 	$row=$connection->createCommand("SELECT nur, oficial 
				 				   FROM hojas_ruta 
				 				   WHERE fk_documento=$id_documento
				 				   AND activo=1
				 				   
				 				   ")->query()->read();

		 	return $row['nur'];
        }
        else{
        	return "<b style='color:#FA5858;'>Sin NUR/NURI</b>";
        }
	 	
	}// fin function


	public function getObtenerIDNuri($id_documento){

		$connection= Yii::app()->db;

		//$usuario=Yii::app()->user->id_usuario;
		$count = HojasRuta::model()->countByAttributes(array(
            'fk_documento'=> $id_documento,
            'activo'=>1
        ));

        if ($count>0) {
        	
		 	$row=$connection->createCommand("SELECT id_hoja_ruta 
				 				   FROM hojas_ruta 
				 				   WHERE fk_documento=$id_documento
				 				   AND activo=1
				 				   
				 				   ")->query()->read();

		 	return $row['id_hoja_ruta'];
        }
        else{
        	return 0;
        }
	 	
	}// fin function

	public function getCountSeguimiento($id_documento){

		$connection= Yii::app()->db;

		//$usuario=Yii::app()->user->id_usuario;
		$count = HojasRuta::model()->countByAttributes(array(
            'fk_documento'=> $id_documento,
            'activo'=>1
        ));

        if ($count>0) {
        	
		 	$row=$connection->createCommand("SELECT nur 
				 				   FROM hojas_ruta 
				 				   WHERE fk_documento=$id_documento
				 				   AND activo=1
				 				   
				 				   ")->query()->read();
		 	$nur=$row['nur'];
		 	$num = Seguimientos::model()->countByAttributes(array(
            'codigo'=> $nur,
            'activo'=>1
        	));

		 	return $num;

        }
        else{
        	return 0;
        }
	 	
	}// fin function

	public function mensajeDocumento(){

		 return Yii::app()->user->setFlash('errorm', "
		 	<i class='fa fa-exclamation-triangle' id='mensaje_emergente' style='color:red;'></i><br>Para crear un nuevo documento es necesario agregar usuarios a la lista de derivación.
		 ");


	}

	public function mensajeCreate(){

		 return Yii::app()->user->setFlash('successm', "<i class='fa fa-thumbs-o-up' id='mensaje_emergente' style='color:#086A87;'></i><br>
		 		Información registrada correctamente!.
		 	");
	}

	public function mensajeCreateDraft(){

		 return Yii::app()->user->setFlash('successm', "<i class='fa fa-floppy-o' id='mensaje_emergente' style='color:#086A87;'></i><br>
		 		Borrador guardado automaticamente. ".date('d/m/Y')." - ".date('H:i:s')." ");
	}

	public function mensajeErrorCreate(){

		 return Yii::app()->user->setFlash('successm', "<i class='fa fa-thumbs-o-up' id='mensaje_emergente' style='color:#086A87;'></i><br>
		 		Error al registrar la información del documento.
		 	");
	}


	public function mensajeUpdate($cite){

		 return Yii::app()->user->setFlash('successm', "<i class='fa fa-thumbs-o-up' id='mensaje_emergente' style='color:#086A87;'></i><br>
		 	Se actualizó correctamente la información del documento <b>$cite</b>.
		 	");
	}

	public function mensajeErrorUpdate($cite){

		 return Yii::app()->user->setFlash('errorm', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente' style='color:red;' ></i><br>Error al actualizar la información del documento <b>$cite</b>. Por favor contactese con la oficina de sistemas.");
	}


	public function mensajePendienteDerivacion(){

		 return Yii::app()->user->setFlash('errorm', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente' style='color:red;' ></i><br>Para derivar documento pendiente es necesario agregar usuarios a la lista de derivación.");
	}

	public function mensajeEliminarDocumento($nuri){

		 return Yii::app()->user->setFlash('errorm', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente'  style='color:red;'></i><br>
				No puede eliminar todos los documentos asociados al NUR/NURI <b>$nuri</b><br> debe contener al menos un CITE asociado.		 	
		 	");
	}


	public function documentoObservado($cite){

		 return Yii::app()->user->setFlash('successm', "<i class='fa fa-thumbs-o-up' id='mensaje_emergente' style='color:#086A87;'></i><br>
				La observación fue asignada correctamente documento con CITE: <b>$cite</b>		 	
		 	");
	}
	public function documentoErrorObservado($cite){

		 return Yii::app()->user->setFlash('errorm', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente'  style='color:red;'></i><br>
				Error al asignar la observación	al documento, por favor contactese con el administrador del sistema
		 	");
	}


	public function alertAsignarNuri(){

		 return Yii::app()->user->setFlash('errorm', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente'  style='color:red;'></i><br>
				Es necesario asignar NUR/NURI al sistema para generar el documento
		 	");
	}



	public function getSearchEspecificaCite($cite,$tipo_documento,$gestion){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("SELECT * 
			   FROM busqueda_cite_especifico('$cite',$tipo_documento,$gestion)");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}

	public function getCitesArea($id_area,$tipo_documento,$gestion){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("SELECT * 
			   FROM cites_area($id_area,$tipo_documento,$gestion)");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}


	
	public function getObtenerNuriBusqueda($id_documento){

		$connection= Yii::app()->db;

		//$usuario=Yii::app()->user->id_usuario;
		$count = HojasRuta::model()->countByAttributes(array(
            'fk_documento'=> $id_documento,
            'activo'=>1
        ));

        if ($count>0) {
        	
		 	$row=$connection->createCommand("SELECT nur, nro 
				 				   FROM hojas_ruta 
				 				   WHERE fk_documento=$id_documento
				 				   AND activo=1
				 				   
				 				   ")->query()->read();

		 	if ($row['nro']==0) {
		 		$oficial='<i class="fa fa-hand-peace-o" style="font-size: 28px; color: darkblue;"></i><br><i>Original</i><br>';
		 	}
		 	else{
		 		$seguimientos=Seguimientos::model()->findByPk($row['nro']);
		 		if ($seguimientos->oficial==1) {
		 			$oficial='<i class="fa fa-hand-peace-o" style="font-size: 28px; color: darkblue;"></i><br><i>Original</i><br>';
		 		}
		 		else{
		 			$oficial='<i>Copia Digital</i><br>';
		 		}
		 		
		 	}




		 	return $oficial.'<b>'.$row['nur'].'</b>';
        }
        else{
        	return "<b style='color:#FA5858;'>Sin NUR/NURI</b>";
        }
	 	
	}// fin function

	public function getSearchEspecificaReferencia($referencia,$tipo_documento,$gestion){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("SELECT * 
			   FROM busqueda_referencia_especifico('$referencia',$tipo_documento,$gestion)");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}// fin function

	public function getSearchEspecificaInstRem($institucion,$tipo_documento,$gestion){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("SELECT * 
			   FROM busqueda_remitente_especifico('$institucion',$tipo_documento,$gestion)");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}// fin function

	public function getSearchEspecificaNombreRem($nombre_remitente,$tipo_documento,$gestion){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("SELECT * 
			   FROM busqueda_nombre_remitente_especifico('$nombre_remitente',$tipo_documento,$gestion)");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}// fin function

	public function getSearchEspecificaSintesis($sintesis,$tipo_documento,$gestion){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("SELECT * 
			   FROM busqueda_sintesis_especifico('$sintesis',$tipo_documento,$gestion)");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}// fin function


//##############################################################################
// codigo para importar informacion de la base de datos MySQL
	
	// public function getSearchEspecificaCiteMySQL($cite,$tipo_documento,$gestion){

	// 	$connection= Yii::app()->dbmysql;
	// 	//$usuario=Yii::app()->user->id_usuario;

	// 	switch ($tipo_documento) {
	// 				    case 1:
	// 				        $tipo='INFORME';
	// 				        break;
	// 				    case 2:
	// 				        $tipo='NOTA';
	// 				        break;
	// 				    case 3:
	// 				        $tipo='MEMORANDUM';
	// 				        break;
	// 				    case 4:
	// 				        $tipo='CARTA';
	// 				        break;
	// 				    case 5:
	// 				        $tipo='CIRCULAR';
	// 				        break;
	// 				    case 7:
	// 				        $tipo='CARTA EXTERNA';
	// 				        break;        
	// 				    case 8:
	// 				        $tipo='INSTRUCTIVO';
	// 				        break;            
	// 				}

    //     $command=$connection->createCommand("CALL bus_cite_int('$cite',$gestion,'$tipo')");
    //     $dataReader=$command->query();

    //     return $dataReader;
	 	
	// }

	// public function getSearchEspecificaReferenciaMySQL($referencia,$tipo_documento,$gestion){

	// 	$connection= Yii::app()->dbmysql;
	// 	//$usuario=Yii::app()->user->id_usuario;

	// 	switch ($tipo_documento) {
	// 				    case 1:
	// 				        $tipo='INFORME';
	// 				        break;
	// 				    case 2:
	// 				        $tipo='NOTA';
	// 				        break;
	// 				    case 3:
	// 				        $tipo='MEMORANDUM';
	// 				        break;
	// 				    case 4:
	// 				        $tipo='CARTA';
	// 				        break;
	// 				    case 5:
	// 				        $tipo='CIRCULAR';
	// 				        break;
	// 				    case 7:
	// 				        $tipo='CARTA EXTERNA';
	// 				        break;        
	// 				    case 8:
	// 				        $tipo='INSTRUCTIVO';
	// 				        break;            
	// 				}

	// 	$command=$connection->createCommand("CALL bus_referencia('$referencia',$gestion,'$tipo')");
    //     $dataReader=$command->query();

    //     return $dataReader;
	 	
	// }

	// public function getSearchEspecificaInstRemMySQL($institucion,$tipo_documento,$gestion){

	// 	$connection= Yii::app()->dbmysql;
	// 	//$usuario=Yii::app()->user->id_usuario;

	// 	switch ($tipo_documento) {
	// 				    case 1:
	// 				        $tipo='INFORME';
	// 				        break;
	// 				    case 2:
	// 				        $tipo='NOTA';
	// 				        break;
	// 				    case 3:
	// 				        $tipo='MEMORANDUM';
	// 				        break;
	// 				    case 4:
	// 				        $tipo='CARTA';
	// 				        break;
	// 				    case 5:
	// 				        $tipo='CIRCULAR';
	// 				        break;
	// 				    case 7:
	// 				        $tipo='CARTA EXTERNA';
	// 				        break;    
	// 				    case 8:
	// 				        $tipo='INSTRUCTIVO';
	// 				        break;            
	// 				}

    //     $command=$connection->createCommand("CALL bus_institucion('$institucion',$gestion,'$tipo')");
    //     $dataReader=$command->query();

    //     return $dataReader;
	 	
	// }

	// public function getSearchEspecificaNombreRemMySQL($remitente,$tipo_documento,$gestion){

	// 	$connection= Yii::app()->dbmysql;
	// 	//$usuario=Yii::app()->user->id_usuario;

	// 	switch ($tipo_documento) {
	// 				    case 1:
	// 				        $tipo='INFORME';
	// 				        break;
	// 				    case 2:
	// 				        $tipo='NOTA';
	// 				        break;
	// 				    case 3:
	// 				        $tipo='MEMORANDUM';
	// 				        break;
	// 				    case 4:
	// 				        $tipo='CARTA';
	// 				        break;
	// 				    case 5:
	// 				        $tipo='CIRCULAR';
	// 				        break;
	// 				    case 7:
	// 				        $tipo='CARTA EXTERNA';
	// 				        break;    
	// 				    case 8:
	// 				        $tipo='INSTRUCTIVO';
	// 				        break;            
	// 				}

    //     $command=$connection->createCommand("CALL bus_remitente('$remitente',$gestion,'$tipo')");
    //     $dataReader=$command->query();

    //     return $dataReader;
	 	
	// }

	// public function getSearchEspecificaSintesisMySQL($sintesis,$tipo_documento,$gestion){

	// 	$connection= Yii::app()->dbmysql;
	// 	//$usuario=Yii::app()->user->id_usuario;

	// 	switch ($tipo_documento) {
	// 				    case 1:
	// 				        $tipo='INFORME';
	// 				        break;
	// 				    case 2:
	// 				        $tipo='NOTA';
	// 				        break;
	// 				    case 3:
	// 				        $tipo='MEMORANDUM';
	// 				        break;
	// 				    case 4:
	// 				        $tipo='CARTA';
	// 				        break;
	// 				    case 5:
	// 				        $tipo='CIRCULAR';
	// 				        break;
	// 				    case 7:
	// 				        $tipo='CARTA EXTERNA';
	// 				        break;    
	// 				    case 8:
	// 				        $tipo='INSTRUCTIVO';
	// 				        break;            
	// 				}

    //     $command=$connection->createCommand("CALL busqueda_sintesis('$sintesis',$gestion,'$tipo')");
    //     $dataReader=$command->query();

    //     return $dataReader;
	 	
	// }		

public function adminDocumentoHistorico($tipo_documento){

		$connection= Yii::app()->dbmysql;
		$usuario=Yii::app()->user->usuario;
        $command=$connection->createCommand("CALL cites_historicos('$usuario','$tipo_documento')");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}	



}
