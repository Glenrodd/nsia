<?php

/**
 * This is the model class for table "seguimientos".
 *
 * The followings are the available columns in table 'seguimientos':
 * @property integer $id_seguimiento
 * @property string $codigo
 * @property integer $derivado_por
 * @property integer $derivado_a
 * @property string $proveido
 * @property string $fecha_derivacion
 * @property string $hora_derivacion
 * @property string $fecha_recepcion
 * @property string $hora_recepcion
 * @property integer $fk_accion
 * @property integer $fk_estado
 * @property integer $padre
 * @property integer $oficial
 * @property string $hijo
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property integer $gestion
 * @property integer $confirmado
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property Acciones $fkAccion
 * @property Estados $fkEstado
 * @property Usuarios $derivadoPor
 * @property Usuarios $derivadoA
 * @property Agrupaciones[] $agrupaciones
 * @property ArchivadosDigitales[] $archivadosDigitales
 */
class Seguimientos extends CActiveRecord
{
  public $derivadoPor_nombre;

  /*private $data = array();

  public function __get($key) {
    return (isset($this->data[$key]) ? $this->data[$key] : null);
  }

  public function __set($key, $value) {
    $this->data[$key] = $value;
  }*/

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seguimientos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('proveido','required','message'=>'El campo Proveído no puede quedar vacío '),
			array('fk_accion','required','message'=>'Seleccione una opción del campo Acción'),
			array('derivado_a','required','message'=>'Es necesario seleccionar el usuario al que derivará el documento'),

			array('codigo, derivado_por, fecha_derivacion, hora_derivacion, fecha_recepcion, hora_recepcion, fk_estado, padre, oficial, fecha_registro, hora_registro, gestion', 'required'),
			array('derivado_por, derivado_a, fk_accion, fk_estado, padre, oficial, gestion, confirmado, activo,fk_principal_agrupacion', 'numerical', 'integerOnly'=>true),
			array('codigo, hijo', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_seguimiento, codigo, derivado_por, derivado_a, proveido, fecha_derivacion, hora_derivacion, fecha_recepcion, hora_recepcion, fk_accion, fk_estado, padre, oficial, hijo, fecha_registro, hora_registro, gestion, confirmado, activo, fk_grupo_derivacion, fk_principal_agrupacion, numero_copia, derivadoPor_nombre', 'safe', 'on'=>'search'),

			array('id_seguimiento, codigo, derivado_por, derivado_a, proveido, fecha_derivacion, hora_derivacion, fecha_recepcion, hora_recepcion, fk_accion, fk_estado, padre, oficial, hijo, fecha_registro, hora_registro, gestion, confirmado, activo, fk_grupo_derivacion, fk_principal_agrupacion, numero_copia, derivadoPor_nombre', 'safe', 'on'=>'searchPendientesOficiales'),
			array('id_seguimiento, codigo, derivado_por, derivado_a, proveido, fecha_derivacion, hora_derivacion, fecha_recepcion, hora_recepcion, fk_accion, fk_estado, padre, oficial, hijo, fecha_registro, hora_registro, gestion, confirmado, activo, fk_grupo_derivacion, fk_principal_agrupacion, numero_copia, derivadoPor_nombre', 'safe', 'on'=>'searchPendientesDigitales'),
			array('id_seguimiento, codigo, derivado_por, derivado_a, proveido, fecha_derivacion, hora_derivacion, fecha_recepcion, hora_recepcion, fk_accion, fk_estado, padre, oficial, hijo, fecha_registro, hora_registro, gestion, confirmado, activo, fk_grupo_derivacion, fk_principal_agrupacion, numero_copia, derivadoPor_nombre', 'safe', 'on'=>'searchQueDebenLlegar'),
			array('id_seguimiento, codigo, derivado_por, derivado_a, proveido, fecha_derivacion, hora_derivacion, fecha_recepcion, hora_recepcion, fk_accion, fk_estado, padre, oficial, hijo, fecha_registro, hora_registro, gestion, confirmado, activo, fk_grupo_derivacion, fk_principal_agrupacion, numero_copia, derivadoPor_nombre', 'safe', 'on'=>'searchDesagrupar'),

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
			'fkAccion' => array(self::BELONGS_TO, 'Acciones', 'fk_accion'),
			'fkEstado' => array(self::BELONGS_TO, 'Estados', 'fk_estado'),
			'derivadoPor' => array(self::BELONGS_TO, 'Usuarios', 'derivado_por'),
			'derivadoA' => array(self::BELONGS_TO, 'Usuarios', 'derivado_a'),
			'agrupaciones' => array(self::HAS_MANY, 'Agrupaciones', 'fk_seguimiento'),
			'archivadosDigitales' => array(self::HAS_MANY, 'ArchivadosDigitales', 'fk_seguimiento'),
			
			'fkGrupoDerivacion' => array(self::BELONGS_TO, 'GrupoDerivacion', 'fk_grupo_derivacion'),

			'fkUsuario' => array(self::BELONGS_TO, 'Usuarios', 'derivado_a'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_seguimiento' => 'Id Seguimiento',
			'codigo' => 'NUR/NURI',
			'derivado_por' => 'Derivado Por',
			'derivado_a' => 'Derivado A',
			'proveido' => 'Proveido',
			'fecha_derivacion' => 'Fecha Derivacion',
			'hora_derivacion' => 'Hora Derivacion',
			'fecha_recepcion' => 'Fecha Recepcion',
			'hora_recepcion' => 'Hora Recepcion',
			'fk_accion' => 'Fk Accion',
			'fk_estado' => 'Fk Estado',
			'padre' => 'Padre',
			'oficial' => 'Oficial',
			'hijo' => 'Hijo',
			'fecha_registro' => 'Fecha Registro',
			'hora_registro' => 'Hora Registro',
			'gestion' => 'Gestion',
			'confirmado' => 'Confirmado',
			'activo' => 'Activo',
			'fk_grupo_derivacion' => 'Grupo Derivacion',
			'fk_principal_agrupacion' => 'Principal Agrupacion',
			'numero_copia' => 'Numero Copia',
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

		$criteria->compare('id_seguimiento',$this->id_seguimiento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('derivado_por',$this->derivado_por);
		$criteria->compare('derivado_a',$this->derivado_a);
		$criteria->compare('proveido',$this->proveido,true);
		$criteria->compare('fecha_derivacion::text',$this->fecha_derivacion,true);
		$criteria->compare('hora_derivacion',$this->hora_derivacion,true);
		$criteria->compare('fecha_recepcion::text',$this->fecha_recepcion,true);
		$criteria->compare('hora_recepcion',$this->hora_recepcion,true);
		$criteria->compare('fk_accion',$this->fk_accion);
		$criteria->compare('fk_estado',$this->fk_estado);
		$criteria->compare('padre',$this->padre);
		$criteria->compare('oficial',$this->oficial);
		$criteria->compare('hijo',$this->hijo,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('confirmado',$this->confirmado);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('fk_grupo_derivacion',$this->fk_grupo_derivacion);
		$criteria->compare('fk_principal_agrupacion',$this->fk_principal_agrupacion);
		$criteria->order = "id_seguimiento ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchQueDebenLlegar()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$estado=3;
		$activo=1;
		$confirmado=1;

		$criteria=new CDbCriteria;

		$criteria->compare('id_seguimiento',$this->id_seguimiento);
		$criteria->compare('codigo',$this->codigo,true);
		//$criteria->compare('derivado_por',$this->derivado_por);
		// codigo añadido para el filtro 
		$criteria->with = array('derivadoPor');
        $criteria->addSearchCondition('"derivadoPor".nombre::text', strtoupper($this->derivadoPor_nombre));

		$criteria->compare('derivado_a',Yii::app()->user->id_usuario);
		$criteria->compare('proveido',$this->proveido,true);
		$criteria->compare('fecha_derivacion::text',$this->fecha_derivacion,true);
		$criteria->compare('hora_derivacion',$this->hora_derivacion,true);
		$criteria->compare('fecha_recepcion::text',$this->fecha_recepcion,true);
		$criteria->compare('hora_recepcion',$this->hora_recepcion,true);
		$criteria->compare('fk_accion',$this->fk_accion);
		$criteria->compare('fk_estado',$estado);
		$criteria->compare('padre',$this->padre);
		$criteria->compare('oficial',$this->oficial);
		$criteria->compare('hijo',$this->hijo,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('confirmado',$confirmado);
		$criteria->compare('t.activo',$activo);
		$criteria->compare('fk_grupo_derivacion',$this->fk_grupo_derivacion);
		$criteria->compare('fk_principal_agrupacion',$this->fk_principal_agrupacion);
		$criteria->order = "codigo ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 200)
		));
	}

	public function searchQueDebenLlegarUrgente()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$estado=3;
		$activo=1;
		$confirmado=1;
		$accion=2;

		$criteria=new CDbCriteria;

		$criteria->compare('id_seguimiento',$this->id_seguimiento);
		$criteria->compare('codigo',$this->codigo,true);
		//$criteria->compare('derivado_por',$this->derivado_por);
		// codigo añadido para el filtro 
		$criteria->with = array('derivadoPor');
        $criteria->addSearchCondition('"derivadoPor".nombre::text', strtoupper($this->derivadoPor_nombre));

		$criteria->compare('derivado_a',Yii::app()->user->id_usuario);
		$criteria->compare('proveido',$this->proveido,true);
		$criteria->compare('fecha_derivacion::text',$this->fecha_derivacion,true);
		$criteria->compare('hora_derivacion',$this->hora_derivacion,true);
		$criteria->compare('fecha_recepcion::text',$this->fecha_recepcion,true);
		$criteria->compare('hora_recepcion',$this->hora_recepcion,true);
		$criteria->compare('fk_accion',$accion);
		$criteria->compare('fk_estado',$estado);
		$criteria->compare('padre',$this->padre);
		$criteria->compare('oficial',$this->oficial);
		$criteria->compare('hijo',$this->hijo,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('confirmado',$confirmado);
		$criteria->compare('t.activo',$activo);
		$criteria->compare('fk_grupo_derivacion',$this->fk_grupo_derivacion);
		$criteria->compare('fk_principal_agrupacion',$this->fk_principal_agrupacion);
		$criteria->order = "codigo ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 200)
		));
	}


	public function searchPendientesOficiales()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$estado=1;
		$activo=1;
		$confirmado=1;
		$oficial=1;



		$criteria=new CDbCriteria;

		$criteria->compare('id_seguimiento',$this->id_seguimiento);
		$criteria->compare('codigo',$this->codigo,true);
		//$criteria->compare('derivado_por',$this->derivado_por);

		// codigo añadido para el filtro 
		$criteria->with = array('derivadoPor');
        $criteria->addSearchCondition('"derivadoPor".nombre::text', strtoupper($this->derivadoPor_nombre));


		$criteria->compare('derivado_a',Yii::app()->user->id_usuario);
		$criteria->compare('proveido',$this->proveido,true);
		$criteria->compare('fecha_derivacion::text',$this->fecha_derivacion,true);
		$criteria->compare('hora_derivacion',$this->hora_derivacion,true);
		$criteria->compare('fecha_recepcion::text',$this->fecha_recepcion,true);
		$criteria->compare('hora_recepcion',$this->hora_recepcion,true);
		$criteria->compare('fk_accion',$this->fk_accion);
		$criteria->compare('fk_estado',$estado);
		$criteria->compare('padre',$this->padre);
		$criteria->compare('oficial',$oficial);
		$criteria->compare('hijo',$this->hijo,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('confirmado',$confirmado);
		$criteria->compare('t.activo',$activo);
		$criteria->compare('fk_grupo_derivacion',$this->fk_grupo_derivacion);
		$criteria->compare('fk_principal_agrupacion',$this->fk_principal_agrupacion);
		//$criteria->order = "fecha_recepcion DESC";
		$criteria->order = "codigo ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 150)
		));
	}

	public function searchDesagrupar()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$estado=1;
		$activo=1;
		$confirmado=1;
		$oficial=1;
		$observado=1;



		$criteria=new CDbCriteria;

		$criteria->compare('id_seguimiento',$this->id_seguimiento);
		$criteria->compare('codigo',$this->codigo,true);
		//$criteria->compare('derivado_por',$this->derivado_por);

		// codigo añadido para el filtro 
		$criteria->with = array('derivadoPor');
        $criteria->addSearchCondition('"derivadoPor".nombre::text', strtoupper($this->derivadoPor_nombre));


		$criteria->compare('derivado_a',Yii::app()->user->id_usuario);
		$criteria->compare('proveido',$this->proveido,true);
		$criteria->compare('fecha_derivacion::text',$this->fecha_derivacion,true);
		$criteria->compare('hora_derivacion',$this->hora_derivacion,true);
		$criteria->compare('fecha_recepcion::text',$this->fecha_recepcion,true);
		$criteria->compare('hora_recepcion',$this->hora_recepcion,true);
		$criteria->compare('fk_accion',$this->fk_accion);
		$criteria->compare('fk_estado',$estado);
		$criteria->compare('padre',$this->padre);
		$criteria->compare('oficial',$oficial);
		$criteria->compare('hijo',$this->hijo,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('confirmado',$confirmado);
		$criteria->compare('t.activo',$activo);
		$criteria->compare('fk_grupo_derivacion',$this->fk_grupo_derivacion);
		$criteria->compare('fk_principal_agrupacion',$this->fk_principal_agrupacion);
		$criteria->compare('observado',$observado);
		//$criteria->order = "oficial DESC";
		$criteria->order = "codigo ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 30)
		));
	}


	public function searchPendientesDigitales()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$estado=2;
		$activo=1;
		$confirmado=1;
		$oficial=0;



		$criteria=new CDbCriteria;

		$criteria->compare('id_seguimiento',$this->id_seguimiento);
		$criteria->compare('codigo',$this->codigo,true);
		//$criteria->compare('derivado_por',$this->derivado_por);

		$criteria->with = array('derivadoPor');
        $criteria->addSearchCondition('"derivadoPor".nombre::text', strtoupper($this->derivadoPor_nombre));

		$criteria->compare('derivado_a',Yii::app()->user->id_usuario);
		$criteria->compare('proveido',$this->proveido,true);
		$criteria->compare('fecha_derivacion::text',$this->fecha_derivacion,true);
		$criteria->compare('hora_derivacion',$this->hora_derivacion,true);
		$criteria->compare('fecha_recepcion::text',$this->fecha_recepcion,true);
		$criteria->compare('hora_recepcion',$this->hora_recepcion,true);
		$criteria->compare('fk_accion',$this->fk_accion);
		$criteria->compare('fk_estado',$estado);
		$criteria->compare('padre',$this->padre);
		$criteria->compare('oficial',$oficial);
		$criteria->compare('hijo',$this->hijo,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('confirmado',$confirmado);
		$criteria->compare('t.activo',$activo);
		$criteria->compare('fk_grupo_derivacion',$this->fk_grupo_derivacion);
		$criteria->compare('numero_copia',$this->numero_copia);
		$criteria->compare('fk_principal_agrupacion',$this->fk_principal_agrupacion);
		//$criteria->order = "fecha_recepcion DESC";
		$criteria->order = "codigo ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 150)
		));
	}


	public function searchParaAgrupar($id_seguimiento)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$estado=1;
		$activo=1;
		$confirmado=1;

		$criteria=new CDbCriteria;

		$criteria->compare('id_seguimiento','<>'.$id_seguimiento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('derivado_por',$this->derivado_por);
		$criteria->compare('derivado_a',Yii::app()->user->id_usuario);
		$criteria->compare('proveido',$this->proveido,true);
		$criteria->compare('fecha_derivacion::text',$this->fecha_derivacion,true);
		$criteria->compare('hora_derivacion',$this->hora_derivacion,true);
		$criteria->compare('fecha_recepcion::text',$this->fecha_recepcion,true);
		$criteria->compare('hora_recepcion',$this->hora_recepcion,true);
		$criteria->compare('fk_accion',$this->fk_accion);

		$criteria->addInCondition('fk_estado',array(1,2));

		//$criteria->compare('fk_estado',$estado);
		$criteria->compare('padre',$this->padre);
		$criteria->compare('oficial',$this->oficial);
		$criteria->compare('hijo',$this->hijo,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('confirmado',$confirmado);
		$criteria->compare('activo',$activo);
		$criteria->compare('fk_grupo_derivacion',$this->fk_grupo_derivacion);
		$criteria->compare('fk_principal_agrupacion',$this->fk_principal_agrupacion);
		$criteria->order = "oficial DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchChangeDrivacion()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$estado=3;
		$activo=1;
		$confirmado=1;

		$criteria=new CDbCriteria;

		$criteria->compare('id_seguimiento',$this->id_seguimiento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('derivado_por',$this->derivado_por);
		$criteria->compare('derivado_a',$this->derivado_a);
		$criteria->compare('proveido',$this->proveido,true);
		$criteria->compare('fecha_derivacion::text',$this->fecha_derivacion,true);
		$criteria->compare('hora_derivacion',$this->hora_derivacion,true);
		$criteria->compare('fecha_recepcion::text',$this->fecha_recepcion,true);
		$criteria->compare('hora_recepcion',$this->hora_recepcion,true);
		$criteria->compare('fk_accion',$this->fk_accion);

		$criteria->compare('fk_estado',$estado);

		//$criteria->compare('fk_estado',$estado);
		$criteria->compare('padre',$this->padre);
		$criteria->compare('oficial',$this->oficial);
		$criteria->compare('hijo',$this->hijo,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('confirmado',$confirmado);
		$criteria->compare('activo',$activo);
		$criteria->compare('fk_grupo_derivacion',$this->fk_grupo_derivacion);
		$criteria->compare('fk_principal_agrupacion',$this->fk_principal_agrupacion);
		$criteria->order = "id_seguimiento ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function searchCorregirDrivacion()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$estado=3;
		$activo=1;
		$confirmado=1;

		//$fecha_derivacion='2018-08-10';

		$criteria=new CDbCriteria;

		$criteria->compare('id_seguimiento',$this->id_seguimiento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('derivado_por',Yii::app()->user->id_usuario);
		$criteria->compare('derivado_a',$this->derivado_a);
		$criteria->compare('proveido',$this->proveido,true);
		$criteria->compare('fecha_derivacion::text',$this->fecha_derivacion,true);
		//$criteria->compare('fecha_derivacion::text',$fecha_derivacion,true);
		$criteria->compare('hora_derivacion',$this->hora_derivacion,true);
		$criteria->compare('fecha_recepcion::text',$this->fecha_recepcion,true);
		$criteria->compare('hora_recepcion',$this->hora_recepcion,true);
		$criteria->compare('fk_accion',$this->fk_accion);

		$criteria->compare('fk_estado',$estado);

		//$criteria->compare('fk_estado',$estado);
		$criteria->compare('padre',$this->padre);
		$criteria->compare('oficial',$this->oficial);
		$criteria->compare('hijo',$this->hijo,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('confirmado',$confirmado);
		$criteria->compare('activo',$activo);
		$criteria->compare('fk_grupo_derivacion',$this->fk_grupo_derivacion);
		$criteria->compare('fk_principal_agrupacion',$this->fk_principal_agrupacion);
		$criteria->order = "id_seguimiento ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchArchivoSAD()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$estado=5;
		$activo=1;
		$confirmado=1;
		$oficial=1;

		$criteria=new CDbCriteria;

		$criteria->compare('id_seguimiento',$this->id_seguimiento);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('derivado_por',$this->derivado_por);
		$criteria->compare('derivado_a',Yii::app()->user->id_usuario);
		$criteria->compare('proveido',$this->proveido,true);
		$criteria->compare('fecha_derivacion::text',$this->fecha_derivacion,true);
		$criteria->compare('hora_derivacion',$this->hora_derivacion,true);
		$criteria->compare('fecha_recepcion::text',$this->fecha_recepcion,true);
		$criteria->compare('hora_recepcion',$this->hora_recepcion,true);
		$criteria->compare('fk_accion',$this->fk_accion);
		$criteria->compare('fk_estado',$estado);
		$criteria->compare('padre',$this->padre);
		$criteria->compare('oficial',$oficial);
		$criteria->compare('hijo',$this->hijo,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('confirmado',$confirmado);
		$criteria->compare('activo',$activo);
		$criteria->compare('fk_grupo_derivacion',$this->fk_grupo_derivacion);
		$criteria->compare('fk_principal_agrupacion',$this->fk_principal_agrupacion);
		$criteria->order = "oficial DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Seguimientos the static model class
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

	public function getListAcciones(){

		return CHtml::listData(Acciones::model()->findAll("activo=?", array(1)), 'id_accion', 'accion');

	}

	public function getUsuario($id){

		$usuarios=Usuarios::model()->findByPk($id);
		return $usuarios->nombre;
	}


	public function getUsuarioPendientes($id){

		$usuarios=Usuarios::model()->findByPk($id);

		//return $usuarios->nombre;
		return "".$usuarios->nombre."<br><i style='font-size:11px; color:#0B2F3A;'><b>".$usuarios->fkArea->area."</b></i>";
	}

	public function getCabeceraSeguimiento($nuri){

		/*$connection= Yii::app()->db;
                                        
        $command=$connection->createCommand("SELECT * FROM detalle_departamento_new('$regional',$est_proy)");
        $dataReader=$command->query();

        $total_contrato=0;

        foreach($dataReader as $row) {
            $total_contrato=$total_contrato+$row['total_contrato'];
        }*/


        $connection= Yii::app()->db;
	 	$row=$connection->createCommand("SELECT * 
			 				   FROM cabecera_seguimiento('$nuri')")->query()->read();

	 	return $row;

	}

	public function getSearchNuri($nuri,$oficial){

		$connection= Yii::app()->db;
                                        
        $command=$connection->createCommand("SELECT * FROM busqueda_nuri('$nuri','$oficial')");
        $dataReader=$command->query();

        return $dataReader;
        	
	}

	public function getUserVentanilla(){

		$connection= Yii::app()->db;
		$usuario=Yii::app()->user->id_usuario;
		$regional=Yii::app()->user->regional;

                                        
       $row=$connection->createCommand("SELECT id_usuario
			 				   FROM usuarios 
			 				   WHERE fk_nivel=4
			 				   AND fk_regional='$regional'
			 				   AND activo=1
			 				   ")->query()->read();

       if ($row['id_usuario']!='') {
       		$valor=$row['id_usuario'];
       }
       else{
       		$valor=0;

       }

        return $valor;
        	
	}

	public function saveCopiaDigital($nur){

			$seguimientos = new Seguimientos();
			$seguimientos->codigo=$nur;
			$seguimientos->derivado_por=Yii::app()->user->id_usuario;
			$seguimientos->derivado_a=Seguimientos::getUserVentanilla();
			$seguimientos->proveido='FAVOR SU ATENCIÓN.';
			$seguimientos->fecha_derivacion=date('Y-m-d');
			$seguimientos->hora_derivacion=date('H:i:s');
			$seguimientos->fecha_recepcion="1000-01-01";
			$seguimientos->hora_recepcion="00:00:00";
			$seguimientos->fk_accion=1;
			$seguimientos->fk_estado=3;
			$seguimientos->padre=0;
			$seguimientos->oficial=0;
			$seguimientos->hijo=0;
			$seguimientos->fecha_registro=date('Y-m-d');
			$seguimientos->hora_registro=date('H:i:s');
			$seguimientos->gestion=date('Y');
			$seguimientos->confirmado=1;
			$seguimientos->fk_grupo_derivacion=0;

			$seguimientos->insert();	

	}


	public function saveCopiaDigitalGroup($nur,$id_grupo){

		$connection= Yii::app()->db;
	 	$dataReader=$connection->createCommand("SELECT usuario_origen 
		 			FROM detalle_grupo_derivacion
		 			WHERE fk_grupo_derivacion='$id_grupo' AND activo=1 ORDER BY id_detalle_grupo_derivacion ASC ")->query();

	 	foreach($dataReader as $row) {


			$seguimientos = new Seguimientos();
			$seguimientos->codigo=$nur;
			$seguimientos->derivado_por=Yii::app()->user->id_usuario;
			$seguimientos->derivado_a=$row['usuario_origen'];
			$seguimientos->proveido='PARA CONOCIMIENTO Y CUMPLIMIENTO, GRACIAS.';
			$seguimientos->fecha_derivacion=date('Y-m-d');
			$seguimientos->hora_derivacion=date('H:i:s');
			$seguimientos->fecha_recepcion="1000-01-01";
			$seguimientos->hora_recepcion="00:00:00";
			$seguimientos->fk_accion=1;
			$seguimientos->fk_estado=3;
			$seguimientos->padre=0;
			$seguimientos->oficial=0;
			$seguimientos->hijo=0;
			$seguimientos->fecha_registro=date('Y-m-d');
			$seguimientos->hora_registro=date('H:i:s');
			$seguimientos->gestion=date('Y');
			$seguimientos->confirmado=1;
			$seguimientos->fk_grupo_derivacion=$id_grupo;

			$seguimientos->insert();
		}		

	}

	public function countQueDebenLlegar($oficial,$id_usuario){

		$count = Seguimientos::model()->countByAttributes(array(
            'derivado_a'=>$id_usuario,
            'oficial'=>$oficial,
            'activo'=>1,
            'confirmado'=>1,
            'fk_estado'=>3,
        ));
        return $count;
	}


	public function countQueDebenLlegarUrgente(){

		$count = Seguimientos::model()->countByAttributes(array(
            'derivado_a'=>Yii::app()->user->id_usuario,
            'fk_accion'=>2,
            'activo'=>1,
            'confirmado'=>1,
            'fk_estado'=>3,
        ));
        return $count;
	}

	public function countPendientes($oficial,$estado,$id_usuario){

		$count = Seguimientos::model()->countByAttributes(array(
            'derivado_a'=>$id_usuario,
            'oficial'=>$oficial,
            'activo'=>1,
            'confirmado'=>1,
            'fk_estado'=>$estado,
        ));
        return $count;
	}

	public function countArchivoDigital(){

		$count = ArchivadosDigitales::model()->countByAttributes(array(
            'fk_usuario'=> Yii::app()->user->id_usuario,
            'activo'=>1,
        ));
        return $count;
	}

	public function getMostrarCodigo(){

		if ($this->oficial==1) { ?>
				<center>
				<i  class="fa fa-hand-peace-o" style="font-size: 28px; color: darkblue;"></i><br><i>Original</i><br>
				<b><?=$this->codigo?></b>	
				</center>
		<?php }
		else{
			?>	<center>
				<i>Copia Digital</i><br>
				<b><?=$this->codigo?></b>	
				</center>
		<?php
		}

		//return "<b>".$this->codigo."</b>";
	}

	public function getMostrarAgrupacion(){

		
		$connection= Yii::app()->db;
        $command=$connection->createCommand("
        	SELECT * 
			   FROM agrupaciones WHERE nur_padre='$this->codigo' AND activo=1");
        $dataReader=$command->query();
        ?>
        <table width="100%" cellpadding="0" cellspacing="0" >
        <?php
        foreach ($dataReader as $row) {
        	$seguimiento=Seguimientos::model()->findByPk($row['fk_seguimiento_hijo']);
        	$estado=$seguimiento->oficial==1?'Original':'Copia Digital'; ?>	
        	<tr style="background:none; color:#0B4C5F;">
        		<td><?=$row['nur_hijo']?></td>
        		<td><?=$estado?></td>
        	</tr>	
        	<?php
        }
		//return "<b>".$this->codigo."</b>";
		?>
		</table>	
		<?php
	}

	public function getListaDerivaciones(){

		$usuario=Yii::app()->user->id_usuario;

		$connection= Yii::app()->db;
        $command=$connection->createCommand("SELECT * 
			   FROM lista_derivacion($usuario)");
        $dataReader=$command->query();

        return $dataReader;


        /*$sql = "SELECT * FROM lista_derivacion($usuario)";
        $rawdata = Yii::app()->db->createCommand($sql)->queryAll();
        return $rawdata;*/
	 	
	}

	public function getListGrupos(){

		$usuario=Yii::app()->user->id_usuario;
		$connection= Yii::app()->db;

        $usuario=Yii::app()->user->id_usuario;
 		$sql = "SELECT id_grupo_derivacion, nombre_grupo 
		    	FROM grupo_derivacion
		    	WHERE fk_usuario=$usuario AND activo=1
		    	ORDER BY id_grupo_derivacion ASC";

        $rawdata = Yii::app()->db->createCommand($sql)->queryAll();
        
        return $rawdata;
	 	
	}

	public function getListIntegrantesGrupo($id_grupo){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("
        	SELECT  u.nombre, d.usuario_origen
			FROM detalle_grupo_derivacion d, usuarios u
			WHERE d.usuario_origen=u.id_usuario AND d.activo=1 AND u.activo=1 AND d.fk_grupo_derivacion=$id_grupo
			");
        $dataReader=$command->query();

        return $dataReader;
	}


	public function getDerivacionesDigitales($nuri,$id_nuri_padre){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("SELECT * 
			   FROM derivaciones_digitales('$nuri',$id_nuri_padre)");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}

	public function getListaNurisAgrupados($id_seguimiento){

		$connection= Yii::app()->db;

		$usuario=Yii::app()->user->id_usuario;


        $command=$connection->createCommand("SELECT * 
			   FROM lista_nuris_agrupados('$usuario',$id_seguimiento)");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}
	public function getListaNurisAgrupadosSinUsuarios($id_seguimiento){

		$connection= Yii::app()->db;

		$usuario=Yii::app()->user->id_usuario;


        $command=$connection->createCommand("SELECT * 
			   FROM lista_nuris_agrupados_sin_usuario($id_seguimiento)");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}

	public function getListaNurisAgrupadosCompleto($nuri){

		$connection= Yii::app()->db;

		$usuario=Yii::app()->user->id_usuario;


        $command=$connection->createCommand("SELECT * 
			   FROM lista_nuris_agrupados_completo('$nuri')");
        $dataReader=$command->query();

        return $dataReader;
	 	
	}

	public function getCountNurisAgrupados($id_seguimiento){

		$count = Seguimientos::model()->countByAttributes(array(
            'fk_principal_agrupacion'=> $id_seguimiento,
            'activo'=> 1
        ));

        return $count;
	 	
	}

	public function getCountNurisDerivado($nuri){

		$count = Seguimientos::model()->countByAttributes(array(
            'codigo'=> $nuri,
            'activo'=>1
        ));

        return $count;
	 	
	}


	public function getArchivoOriginalGestion(){

		$connection= Yii::app()->db;
		
		$sql="SELECT DISTINCT gestion 
		   	FROM seguimientos
		   	WHERE activo=1
		   	AND oficial=1
		   	ORDER BY gestion DESC  
		   	";
				 			
		$command=$connection->createCommand($sql);
		return $command->query();

	}

	public function getNurisPendientesOficialesDigitales($id_usuario){

		$connection= Yii::app()->db;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * 
			   FROM pendientes_oficiales_digitales($id_usuario)");
        $dataReader=$command->query();

        return $dataReader;
	}

	public function getDerivadosNoRecibidos($id_usuario){

		$connection= Yii::app()->db;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * 
			   FROM derivados_no_recibidos($id_usuario)");
        $dataReader=$command->query();

        return $dataReader;
	}

	public function getDerivadosNoRecibidosExterno($id_usuario){

		$connection= Yii::app()->db;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * 
			   FROM derivados_no_recibidos_externo($id_usuario)");
        $dataReader=$command->query();

        return $dataReader;
	}


	public function getNurExternoCreado($id_usuario,$gestion){

		$connection= Yii::app()->db;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * 
			   FROM nur_externo_creado($id_usuario,$gestion)");
        $dataReader=$command->query();

        return $dataReader;
	}

	public function recibirNuri($nuri){

		$usuario=Yii::app()->user->id_usuario;

		$connection= Yii::app()->db;
        $command=$connection->createCommand("SELECT * 
			   FROM recibir_nuri('$nuri',$usuario)");
        $dataReader=$command->query();

        return $dataReader;
	}

	public function getNoRecibidosUsuario($id_usuario){

		$connection= Yii::app()->db;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * 
			   FROM no_recibidos_usuario($id_usuario)");
        $dataReader=$command->query();

        return $dataReader;
	}

	public function getVerificaSiHayPendientes(){

		$usuario=Yii::app()->user->id_usuario;
		$count = Seguimientos::model()->countByAttributes(array(
            'derivado_a'=> $usuario,
            'fk_estado'=>3,
            'activo'=>1
        ));

        return $count;

	}

	public function getMensajeBloqueoUsuario()
	{
		$connection= Yii::app()->db;
		$fecha_menor=date('Y-m-d');
		$usuario=Yii::app()->user->id_usuario;
			
	 	$dataReader=$connection->createCommand("SELECT fecha_derivacion 
			 			FROM seguimientos
			 			WHERE derivado_a=$usuario AND fk_estado=3 AND confirmado=1 AND activo=1 ORDER BY id_seguimiento ASC ")->query();

	 	foreach($dataReader as $row) {

				if ($row['fecha_derivacion']<=$fecha_menor) {
					$fecha_menor=$row['fecha_derivacion'];			
				}		
			}
			// codigo para encontrar los dias restantes antes del bloqueo

			$date1= new DateTime(date('Y-m-d'));
			$date2= new DateTime($fecha_menor);

			$diferencia=$date1->diff($date2);

		return (8-$diferencia->days);

	} //fin function


	public function getMostrarMensajeBloqueoNuri($fecha)
	{
		$connection= Yii::app()->db;
		$fecha_menor=date('Y-m-d');
		$usuario=Yii::app()->user->id_usuario;
			
	 	$date1= new DateTime(date('Y-m-d'));
		$date2= new DateTime($fecha);

		$diferencia=$date1->diff($date2);

		return (7-$diferencia->days);

	} //fin function

	public function getObtenerReferenciaRemitente($nuri){

		$connection= Yii::app()->db;
		//$usuario=Yii::app()->user->id_usuario;
		//$regional=Yii::app()->user->regional;

                                        
       $row=$connection->createCommand("SELECT d.remitente_nombres, d.remitente_cargo, d.referencia
			FROM hojas_ruta h, documentos d 
			WHERE h.nur='$nuri'
			AND h.nro=0
			AND h.oficial=1
			AND h.activo=1
			AND h.fk_documento=d.id_documento
		")->query()->read();

       return $row;
	}

	public function getUsuariosGerencia($id_area){

		$connection= Yii::app()->db;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT id_usuario,nombre, cargo 
			   FROM usuarios
			   WHERE fk_area=$id_area
			   ");
        $dataReader=$command->query();

        return $dataReader;
	}

	public function getRecepcionBloque(){

		$connection= Yii::app()->db;
		$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * 
			   FROM seguimientos
			   WHERE derivado_a=$usuario
			   AND fk_estado=3
			   ");
        $dataReader=$command->query();

        return $dataReader;
	} // fin function

	public function countSeguimientoHojaRuta($id_seguimiento){

        $connection= Yii::app()->db;

		$count = HojasRuta::model()->countByAttributes(array(
            'nro'=> $id_seguimiento,
            'activo'=>1
        ));

        return $count;	


	} // fin function

	public function getCiteHojaRuta($id_seguimiento){

		$connection= Yii::app()->db;
		$command=$connection->createCommand("SELECT * 
			   FROM hojas_ruta 
				WHERE nro=$id_seguimiento
				AND activo=1
			   ");
	        $dataReader=$command->query();

	        return $dataReader;
	}

	public function countNuriPrincipal($nuri){

        $connection= Yii::app()->db;

		$count = Agrupaciones::model()->countByAttributes(array(
            'nur_padre'=>$nuri,
            'activo'=>1,
            //'oficial'=>1
        ));

        return $count;	


	} // fin function

	public function listaAgrupacion($nuri){

		$connection= Yii::app()->db;
		$command=$connection->createCommand("SELECT * 
			   FROM agrupaciones 
				WHERE nur_padre='$nuri'
				AND activo=1
			   ");
	        $dataReader=$command->query();

	        return $dataReader;	

	}

	public function countNuriSecundarioAgrupacion($nuri){

        $connection= Yii::app()->db;

		$count = Agrupaciones::model()->countByAttributes(array(
            'nur_hijo'=>$nuri,
            'activo'=>1,
        ));

        return $count;	


	} // fin function


	public function countNuriHojasRuta($nuri){

        $connection= Yii::app()->db;


        $count = HojasRuta::model()->count( 
    		'nur=:nur AND nro=:nro AND proceso=:proceso AND oficial=:oficial AND activo=:activo', 
    		array(
    				'nur'=>$nuri,
		            'nro'=>0,
		            'proceso'=>4,
		            'oficial'=>0,
		            'activo'=>1,
		            
    			)
		);

		/*$count = HojasRuta::model()->countByAttributes(array(
            'nur'=>$nuri,
            'nro'=>0,
            'proceso'=>4,
            'oficial'=>1,
            'activo'=>1,
        ));*/

        return $count;	


	} // fin function


	//contar si existe en el seguimiento
	public function countNuriHojasRutass($nuri){

        $connection= Yii::app()->db;

		$count = HojasRuta::model()->countByAttributes(array(
            'nur'=>$nuri,
            'nro'=>0,
            'proceso'=>4,
            'oficial'=>1,
            'activo'=>1,
        ));

        return $count;	


	} // fin function


	public function countSeguimientoNuevo($nuri){
        $connection= Yii::app()->db;

		$count = Seguimientos::model()->countByAttributes(array(
            'codigo'=>$nuri,
            'padre'=>0,
            'oficial'=>1,
            'activo'=>1,
        ));

        return $count;	
	} // fin function





	public function countSeguimientoPadre($nuri,$id_seguimiento){
        $connection= Yii::app()->db;

		$count = Seguimientos::model()->countByAttributes(array(
            'codigo'=>$nuri,
            'padre'=>$id_seguimiento,
            'oficial'=>1,
            'activo'=>1,
        ));

        return $count;	
	} // fin function

	public function countDerivados($nuri, $id_seguimiento){
        $connection= Yii::app()->db;

		$count = Seguimientos::model()->countByAttributes(array(
            'codigo'=>$nuri,
            'padre'=>$id_seguimiento,
            'activo'=>1,
            'derivado_por'=>Yii::app()->user->id_usuario,
        ));

        return $count;	
	} // fin function


	public function countIdSeguimiento($id_seguimiento){
        $connection= Yii::app()->db;

		$count = Seguimientos::model()->countByAttributes(array(
            'id_seguimiento'=>$id_seguimiento,
            'activo'=>1,
        ));

        return $count;	
	} // fin function

	public function countNoRecepcionados($nuri, $id_seguimiento){
        $connection= Yii::app()->db;

		$count = Seguimientos::model()->countByAttributes(array(
            'codigo'=>$nuri,
            'padre'=>$id_seguimiento,
            'activo'=>1,
            'fk_estado'=>3,
            'derivado_por'=>Yii::app()->user->id_usuario,
        ));

        return $count;	
	} // fin function


	public function countSeguimientoCopia($nuri,$id_seguimiento){
        $connection= Yii::app()->db;

		$count = Seguimientos::model()->countByAttributes(array(
            'codigo'=>$nuri,
            'padre'=>$id_seguimiento,
            'oficial'=>0,
            'activo'=>1,
        ));

        return $count;	
	} // fin function


	public function updateReestablecerNuevo($nur){
		
		$connection= Yii::app()->db;
		$connection->createCommand("UPDATE seguimientos SET confirmado=0 WHERE codigo='$nur'")->execute();
	}


	public function updateReestablecerPendiente($nur,$id_seguimiento){
		
		$connection= Yii::app()->db;
		$connection->createCommand("UPDATE seguimientos SET confirmado=0 WHERE codigo='$nur' AND padre=$id_seguimiento ")->execute();

		// codigo para restaurar a pendientes el nuri padre
		$seguimientos=Seguimientos::model()->findByPk($id_seguimiento);
		if ($seguimientos->oficial==1) {
			$seguimientos->fk_estado=1;
		}
		else{
			$seguimientos->fk_estado=2;
		}
		$seguimientos->save();


	}


	public function updateConfirmEnd($nur,$id_seguimiento){
		
		$connection= Yii::app()->db;
		$connection->createCommand("UPDATE seguimientos SET confirmado=1 WHERE codigo='$nur' AND padre=$id_seguimiento")->execute();
	}

	public function updateConfirmarTerminarNuevo($nur){
		
		$connection= Yii::app()->db;
		$connection->createCommand("UPDATE seguimientos SET confirmado=1 WHERE codigo='$nur' AND padre=0")->execute();
	}


	public function verificarNivelUsuario(){

        $connection= Yii::app()->db;
        //$usuario=Yii::app()->user->id_usuario;
		//$usuario=Yii::app()->user->id_usuario;
		//$regional=Yii::app()->user->regional;

		$usuarios=Usuarios::model()->findByPk(Yii::app()->user->id_usuario);

                                        
       
       if ($usuarios->fk_nivel==1 || $usuarios->fk_nivel==3) {
       		$valor=1;
       }
       else{
       		$valor=0;
       }

       return $valor;


	} // fin function



	public function getNuriPrincipal($nuri){

		$connection= Yii::app()->db;
		

	    $row=$connection->createCommand("SELECT * 
			   FROM agrupaciones 
				WHERE nur_hijo='$nuri'
				AND activo=1
		")->query()->read();

       return $row['nur_padre'];    	

	}


	public function getObtenerNuri($id_documento){

		$connection= Yii::app()->db;
	    $row=$connection->createCommand("SELECT * 
			   FROM hojas_ruta 
				WHERE fk_documento=$id_documento
				AND activo=1
		")->query()->read();

       return $row['nur'];    	

	}

	public function getAnadirRespuesta($id_seguimiento){

		$connection= Yii::app()->db;
                                        
        $command=$connection->createCommand("
        	SELECT * 
        	FROM hojas_ruta h, documentos d
        	WHERE h.nro=$id_seguimiento AND h.activo=1
        	AND h.fk_documento=d.id_documento
        ");
        $dataReader=$command->query();

        return $dataReader;
        	
	}


	public function getListCitesAsignados($id_seguimiento){

		$connection= Yii::app()->db;
                                        
        $command=$connection->createCommand("
        	SELECT * 
        	FROM hojas_ruta
        	WHERE nro=$id_seguimiento AND activo=1
        ");
        $dataReader=$command->query();

        return $dataReader;
        	
	}

	public function getListCitesNuevosAsignados($nur){

		$connection= Yii::app()->db;

		$usuario=Yii::app()->user->id_usuario;
                                        
        $command=$connection->createCommand("
        	SELECT * 
        	FROM hojas_ruta
        	WHERE nur='$nur' AND fk_usuario=$usuario AND activo=1 AND nro=0
        ");
        $dataReader=$command->query();

        return $dataReader;
        	
	}

//######################################################################################
	public function getAreasDependencia($area){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("
        	SELECT * 
        	FROM areas
        	WHERE dependencia=$area AND activo=1
        ");
        $dataReader=$command->query();
	    return $dataReader;
	}


	public function getUserAreas($area){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("
        	SELECT * 
        	FROM usuarios
        	WHERE fk_area=$area AND activo=1
        ");
        $dataReader=$command->query();
	    return $dataReader;
	}

	public function getMaxIdSeguimiento(){

		$connection= Yii::app()->db;
                                        

        $row=$connection->createCommand("
        	SELECT max(s.id_seguimiento) maximo 
        	FROM seguimientos s
			")->query()->read();
			$valor=$row['maximo']+1;
        return $valor;
	}

// CODIGO PARA OBTENER LOS PENDIENTES MENORES A 10 DIAS
	public function getPendientesdiezNoRecibidos($area){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$nueva_fecha=date("Y-m-d",strtotime($fecha_actual."+ 10 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 

		$connection= Yii::app()->db;
                                        

        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s, usuarios u
        	WHERE s.derivado_a=u.id_usuario
        	AND u.fk_area=$area
        	AND s.fk_estado=3
        	AND s.fecha_derivacion<'$nueva_fecha'
        	AND s.confirmado=1
        	AND s.activo=1 AND u.activo=1
			")->query()->read();
        return $row['total'];
	}

	public function getPendientesdiezPendientes($area,$estado,$oficial){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$nueva_fecha=date("Y-m-d",strtotime($fecha_actual."- 10 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 
		$connection= Yii::app()->db;
                                        
        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s, usuarios u
        	WHERE s.derivado_a=u.id_usuario
        	AND u.fk_area=$area
        	AND s.fk_estado=$estado
        	AND s.oficial=$oficial
        	AND s.fecha_recepcion>'$nueva_fecha'
        	AND s.confirmado=1
        	AND s.activo=1 AND u.activo=1
			")->query()->read();

        return $row['total'];
	}


	// CODIGO PARA OBTENER LOS PENDIENTES MAYORES A 50 DIAS
	public function getPendientesCincuentaNoRecibidos($area){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$nueva_fecha=date("Y-m-d",strtotime($fecha_actual."+ 50 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 

		$connection= Yii::app()->db;
                                        

        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s, usuarios u
        	WHERE s.derivado_a=u.id_usuario
        	AND u.fk_area=$area
        	AND s.fk_estado=3
        	AND s.fecha_derivacion>'$nueva_fecha'
        	AND s.confirmado=1
        	AND s.activo=1 AND u.activo=1
			")->query()->read();
        return $row['total'];
	}

	public function getPendientesCincuentaPendientes($area,$estado,$oficial){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$nueva_fecha=date("Y-m-d",strtotime($fecha_actual."- 50 days")); 

		//echo " nueva fecha ---> ".$nueva_fecha;
		//echo "<br> area ---> ".$area;
		//echo "<br> estado ---> ".$estado;
		//echo "<br> oficial ---> ".$oficial;
		//exit();
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 
		$connection= Yii::app()->db;
                                        
        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s, usuarios u
        	WHERE s.derivado_a=u.id_usuario
        	AND u.fk_area=$area
        	AND s.fk_estado=$estado
        	AND s.oficial=$oficial
        	AND s.fecha_recepcion<'$nueva_fecha'
        	AND s.confirmado=1
        	AND s.activo=1 AND u.activo=1
			")->query()->read();

        return $row['total'];
	}



	// CODIGO PARA OBTENER LOS PENDIENTES ENTRE 10 A 20 DIAS
	public function getPendientesdiezveinteNoRecibidos($area){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$inicio=date("Y-m-d",strtotime($fecha_actual."+ 10 days")); 
		$fin=date("Y-m-d",strtotime($fecha_actual."+ 20 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 

		$connection= Yii::app()->db;
                                        

        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s, usuarios u
        	WHERE s.derivado_a=u.id_usuario
        	AND u.fk_area=$area
        	AND s.fk_estado=3
        	AND s.fecha_derivacion>='$inicio' AND s.fecha_derivacion<'$fin'
        	AND s.confirmado=1
        	AND s.activo=1 AND u.activo=1
			")->query()->read();
        return $row['total'];
	}

	public function getPendientesdiezveintePendientes($area,$estado,$oficial){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$inicio=date("Y-m-d",strtotime($fecha_actual."- 20 days")); 
		$fin=date("Y-m-d",strtotime($fecha_actual."- 10 days")); 

		//echo " nueva fecha ---> ".$nueva_fecha;
		//echo "<br> area ---> ".$area;
		//echo "<br> estado ---> ".$estado;
		//echo "<br> oficial ---> ".$oficial;
		//exit();
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 
		$connection= Yii::app()->db;
                                        
        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s, usuarios u
        	WHERE s.derivado_a=u.id_usuario
        	AND u.fk_area=$area
        	AND s.fk_estado=$estado
        	AND s.oficial=$oficial
        	AND s.fecha_recepcion>='$inicio' AND s.fecha_recepcion<='$fin'
        	AND s.confirmado=1
        	AND s.activo=1 AND u.activo=1
			")->query()->read();

        return $row['total'];
	}



	// CODIGO PARA OBTENER LOS PENDIENTES ENTRE 20 A 50 DIAS
	public function getPendientesveintecincuentaNoRecibidos($area){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$inicio=date("Y-m-d",strtotime($fecha_actual."+ 20 days")); 
		$fin=date("Y-m-d",strtotime($fecha_actual."+ 50 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 

		$connection= Yii::app()->db;
                                        

        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s, usuarios u
        	WHERE s.derivado_a=u.id_usuario
        	AND u.fk_area=$area
        	AND s.fk_estado=3
        	AND s.fecha_derivacion>='$inicio' AND s.fecha_derivacion<='$fin'
        	AND s.confirmado=1
        	AND s.activo=1 AND u.activo=1
			")->query()->read();
        return $row['total'];
	}

	public function getPendientesveintecincuentaPendientes($area,$estado,$oficial){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$inicio=date("Y-m-d",strtotime($fecha_actual."- 50 days")); 
		$fin=date("Y-m-d",strtotime($fecha_actual."- 20 days")); 

		//echo " nueva fecha ---> ".$nueva_fecha;
		//echo "<br> area ---> ".$area;
		//echo "<br> estado ---> ".$estado;
		//echo "<br> oficial ---> ".$oficial;
		//exit();
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 
		$connection= Yii::app()->db;
                                        
        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s, usuarios u
        	WHERE s.derivado_a=u.id_usuario
        	AND u.fk_area=$area
        	AND s.fk_estado=$estado
        	AND s.oficial=$oficial
        	AND s.fecha_recepcion>='$inicio' AND s.fecha_recepcion<'$fin'
        	AND s.confirmado=1
        	AND s.activo=1 AND u.activo=1
			")->query()->read();

        return $row['total'];
	}

////////////////////////////////////////////////////////////////////////////////////////////
// CODIGO PARA MOSTRAR CONTEO POR USUARIO DE AREA ORGANIZACIONAL

// CODIGO PARA OBTENER LOS PENDIENTES MENORES A 10 DIAS
	public function getPendientesdiezNoRecibidos1($id_usuario){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$nueva_fecha=date("Y-m-d",strtotime($fecha_actual."+ 10 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 

		$connection= Yii::app()->db;
                                        

        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=3
        	AND s.fecha_derivacion<'$nueva_fecha'
        	AND s.confirmado=1
        	AND s.activo=1
			")->query()->read();
        return $row['total'];
	}

	public function getPendientesdiezPendientes1($id_usuario,$estado,$oficial){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$nueva_fecha=date("Y-m-d",strtotime($fecha_actual."- 10 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 
		$connection= Yii::app()->db;
                                        
        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=$estado
        	AND s.oficial=$oficial
        	AND s.fecha_recepcion>'$nueva_fecha'
        	AND s.confirmado=1
        	AND s.activo=1
			")->query()->read();

        return $row['total'];
	}


	// CODIGO PARA OBTENER LOS PENDIENTES MAYORES A 50 DIAS
	public function getPendientesCincuentaNoRecibidos1($id_usuario){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$nueva_fecha=date("Y-m-d",strtotime($fecha_actual."+ 50 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 

		$connection= Yii::app()->db;

        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=3
        	AND s.fecha_derivacion>'$nueva_fecha'
        	AND s.confirmado=1
        	AND s.activo=1
			")->query()->read();
        return $row['total'];
	}

	public function getPendientesCincuentaPendientes1($id_usuario,$estado,$oficial){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$nueva_fecha=date("Y-m-d",strtotime($fecha_actual."- 50 days")); 

		$connection= Yii::app()->db;
                                        
        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=$estado
        	AND s.oficial=$oficial
        	AND s.fecha_recepcion<'$nueva_fecha'
        	AND s.confirmado=1
        	AND s.activo=1
			")->query()->read();

        return $row['total'];
	}



	// CODIGO PARA OBTENER LOS PENDIENTES ENTRE 10 A 20 DIAS
	public function getPendientesdiezveinteNoRecibidos1($id_usuario){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$inicio=date("Y-m-d",strtotime($fecha_actual."+ 10 days")); 
		$fin=date("Y-m-d",strtotime($fecha_actual."+ 20 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 

		$connection= Yii::app()->db;
                                        

        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=3
        	AND s.fecha_derivacion>='$inicio' AND s.fecha_derivacion<'$fin'
        	AND s.confirmado=1
        	AND s.activo=1
			")->query()->read();
        return $row['total'];
	}

	public function getPendientesdiezveintePendientes1($id_usuario,$estado,$oficial){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$inicio=date("Y-m-d",strtotime($fecha_actual."- 20 days")); 
		$fin=date("Y-m-d",strtotime($fecha_actual."- 10 days")); 

		$connection= Yii::app()->db;
                                        
        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=$estado
        	AND s.oficial=$oficial
        	AND s.fecha_recepcion>='$inicio' AND s.fecha_recepcion<='$fin'
        	AND s.confirmado=1
        	AND s.activo=1
			")->query()->read();

        return $row['total'];
	}



	// CODIGO PARA OBTENER LOS PENDIENTES ENTRE 20 A 50 DIAS
	public function getPendientesveintecincuentaNoRecibidos1($id_usuario){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$inicio=date("Y-m-d",strtotime($fecha_actual."+ 20 days")); 
		$fin=date("Y-m-d",strtotime($fecha_actual."+ 50 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 

		$connection= Yii::app()->db;
                                        

        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=3
        	AND s.fecha_derivacion>='$inicio' AND s.fecha_derivacion<='$fin'
        	AND s.confirmado=1
        	AND s.activo=1
			")->query()->read();
        return $row['total'];
	}

	public function getPendientesveintecincuentaPendientes1($id_usuario,$estado,$oficial){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$inicio=date("Y-m-d",strtotime($fecha_actual."- 50 days")); 
		$fin=date("Y-m-d",strtotime($fecha_actual."- 20 days")); 

		$connection= Yii::app()->db;
                                        
        $row=$connection->createCommand("
        	SELECT count(s.id_seguimiento) total 
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=$estado
        	AND s.oficial=$oficial
        	AND s.fecha_recepcion>='$inicio' AND s.fecha_recepcion<'$fin'
        	AND s.confirmado=1
        	AND s.activo=1
			")->query()->read();

        return $row['total'];
	}


////////////////////////////////////////////////////////////////////////////////////////////
// CODIGO PARA MOSTRAR LOS NURIS PENDIENTES POR USUARIO DE AREA ORGANIZACIONAL

// CODIGO PARA OBTENER LOS PENDIENTES MENORES A 10 DIAS
	public function getPendientesdiezNoRecibidosUser($id_usuario){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$nueva_fecha=date("Y-m-d",strtotime($fecha_actual."+ 10 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 

		$connection= Yii::app()->db;


		$command=$connection->createCommand("
        	SELECT * 
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=3
        	AND s.fecha_derivacion<'$nueva_fecha'
        	AND s.confirmado=1
        	AND s.activo=1
        ");
        $dataReader=$command->query();

        return $dataReader;
                                        

        
	}

	public function getPendientesdiezPendientesUser($id_usuario,$estado,$oficial){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$nueva_fecha=date("Y-m-d",strtotime($fecha_actual."- 10 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 
		$connection= Yii::app()->db;

		$command=$connection->createCommand("
        	SELECT *
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=$estado
        	AND s.oficial=$oficial
        	AND s.fecha_recepcion>'$nueva_fecha'
        	AND s.confirmado=1
        	AND s.activo=1
        ");
        $dataReader=$command->query();

        return $dataReader;

                                        
        
	}


	// CODIGO PARA OBTENER LOS PENDIENTES MAYORES A 50 DIAS
	public function getPendientesCincuentaNoRecibidosUser($id_usuario){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$nueva_fecha=date("Y-m-d",strtotime($fecha_actual."+ 50 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 

		$connection= Yii::app()->db;

		$command=$connection->createCommand("
        	SELECT * 
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=3
        	AND s.fecha_derivacion>'$nueva_fecha'
        	AND s.confirmado=1
        	AND s.activo=1
        ");
        $dataReader=$command->query();

        return $dataReader;

       
	}

	public function getPendientesCincuentaPendientesUser($id_usuario,$estado,$oficial){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$nueva_fecha=date("Y-m-d",strtotime($fecha_actual."- 50 days")); 

		$connection= Yii::app()->db;

		$command=$connection->createCommand("
        	SELECT * 
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=$estado
        	AND s.oficial=$oficial
        	AND s.fecha_recepcion<'$nueva_fecha'
        	AND s.confirmado=1
        	AND s.activo=1
        ");
        $dataReader=$command->query();

        return $dataReader;
                                        
        
	}



	// CODIGO PARA OBTENER LOS PENDIENTES ENTRE 10 A 20 DIAS
	public function getPendientesdiezveinteNoRecibidosUser($id_usuario){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$inicio=date("Y-m-d",strtotime($fecha_actual."+ 10 days")); 
		$fin=date("Y-m-d",strtotime($fecha_actual."+ 20 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 

		$connection= Yii::app()->db;

		$command=$connection->createCommand("
        	SELECT *
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=3
        	AND s.fecha_derivacion>='$inicio' AND s.fecha_derivacion<'$fin'
        	AND s.confirmado=1
        	AND s.activo=1
        ");
        $dataReader=$command->query();

        return $dataReader;
                                        

        
	}

	public function getPendientesdiezveintePendientesUser($id_usuario,$estado,$oficial){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$inicio=date("Y-m-d",strtotime($fecha_actual."- 20 days")); 
		$fin=date("Y-m-d",strtotime($fecha_actual."- 10 days")); 

		$connection= Yii::app()->db;

		$command=$connection->createCommand("
        	SELECT * 
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=$estado
        	AND s.oficial=$oficial
        	AND s.fecha_recepcion>='$inicio' AND s.fecha_recepcion<='$fin'
        	AND s.confirmado=1
        	AND s.activo=1
        ");
        $dataReader=$command->query();

        return $dataReader;
                                        
        
	}



	// CODIGO PARA OBTENER LOS PENDIENTES ENTRE 20 A 50 DIAS
	public function getPendientesveintecincuentaNoRecibidosUser($id_usuario){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$inicio=date("Y-m-d",strtotime($fecha_actual."+ 20 days")); 
		$fin=date("Y-m-d",strtotime($fecha_actual."+ 50 days")); 
		//resto 1 día
		//echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 

		$connection= Yii::app()->db;

		$command=$connection->createCommand("
        	SELECT *
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=3
        	AND s.fecha_derivacion>='$inicio' AND s.fecha_derivacion<='$fin'
        	AND s.confirmado=1
        	AND s.activo=1
        ");
        $dataReader=$command->query();

        return $dataReader;
                                        

        
	}

	public function getPendientesveintecincuentaPendientesUser($id_usuario,$estado,$oficial){

		// codigo para sumar 10 dias a la fecha actual
		$fecha_actual = date("Y-m-d");
		//sumo 10 días
		$inicio=date("Y-m-d",strtotime($fecha_actual."- 50 days")); 
		$fin=date("Y-m-d",strtotime($fecha_actual."- 20 days")); 

		$connection= Yii::app()->db;

		$command=$connection->createCommand("
        	SELECT *
        	FROM seguimientos s
        	WHERE s.derivado_a=$id_usuario
        	AND s.fk_estado=$estado
        	AND s.oficial=$oficial
        	AND s.fecha_recepcion>='$inicio' AND s.fecha_recepcion<'$fin'
        	AND s.confirmado=1
        	AND s.activo=1
        ");
        $dataReader=$command->query();

        return $dataReader;
                                        
        
	}	







//#############################################################################################



	public function mensajeRecepcionBloque($nuris){

		 return Yii::app()->user->setFlash('successm', "<i class='fa fa-thumbs-o-up' id='mensaje_emergente' style='color:#086A87;'></i><br>
				Se procedio a realizar la recepción de los siguientes NUR/NURI(s) $nuris		 	
		 	");
	}

	public function mensajeVerificarOficial($nuris){

		 return Yii::app()->user->setFlash('errorm', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente' style='color:red;'></i><br>
				No puede terminar el procedimiento sin antes derivar el documento original		 	
		 	");
	}


	public function mensajeDerivarOficial($nuris){

		 return Yii::app()->user->setFlash('errorm', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente' style='color:red;'></i><br>
				No puede derivar mas de una vez el documento original		 	
		 	");
	}

	public function mensajeVerificarCopia($nuris){

		 return Yii::app()->user->setFlash('errorm', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente' style='color:red;'></i><br>
				No puede terminar el procedimiento sin antes derivar el NUR/NURI <b>$nuris</b>		 	
		 	");
	}

	public function mensajeErrorReestablecer($nuri){

		 return Yii::app()->user->setFlash('errorm', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente' style='color:red;'></i><br>
				No se puede reestablecer la derivación del NUR/NURI  <b>$nuri</b>. <br>
				Una de las derivaciones ya fue recepcionada.
			 	");
	}

	public function mensajeExitoReestablecer($nuri){

		 return Yii::app()->user->setFlash('successm', "<i class='fa fa-thumbs-o-up' id='mensaje_emergente' style='color:#086A87;'></i><br>
				La derivaci&oacute;n del NUR/NURI <b>$nuri</b> se reestablecio correctamente		 	
		 	");
	}

	public function mensajeNoSePuedeDerivar($nuri){

		 return Yii::app()->user->setFlash('errorm', "<i class='fa fa-exclamation-triangle' id='mensaje_emergente' style='color:red;'></i><br>
				No se puede realizar este procedimiento, el NUR/NURI <b>$nuri</b> ya fue derivado
			 	");
	}



	public function numeroCopiaSeguimiento($id_seguimiento){

		$connection= Yii::app()->db;
		// primero verificamos si el documento es original
		// si no es verificamos que tengas numero de copia
		$seguimientos= Seguimientos::model()->findByPk($id_seguimiento);
		if ($seguimientos->oficial==1) {

			$row=$connection->createCommand("SELECT max(correlativo_copia) as mayor 
			   FROM seguimientos 
				WHERE codigo='$seguimientos->codigo'
				AND activo=1
			")->query()->read();

	       $valor=$row['mayor'];
	       $valor++;
		 }
		 else{

		 	//$seguimientos= Seguimientos::model()->findByPk($id_seguimiento);
		 	$row=$connection->createCommand("SELECT max(correlativo_copia) as mayor 
			   FROM seguimientos 
				WHERE padre=$id_seguimiento AND activo=1
			")->query()->read();

	       $valor=$row['mayor'];
	       $valor++;
		 	
		 } 
	       return $valor;

	}

	public function numeroCopiaNuevoDocumento($nuri){

		$connection= Yii::app()->db;
	    $row=$connection->createCommand("SELECT max(correlativo_copia) as mayor 
			   FROM seguimientos 
				WHERE codigo='$nuri'
				AND activo=1
		")->query()->read();

       $valor=$row['mayor'];
       $valor++;
       return $valor;

	}

	public function derivacionesSeguimiento($nuri,$id_seguimiento){

		$sql = "SELECT * FROM derivaciones_seguimiento('$nuri',$id_seguimiento)";

		$rawdata = Yii::app()->db->createCommand($sql)->queryAll();
		return $rawdata;


	}
	public function derivacionesNuevo($nuri){

		$sql = "SELECT * FROM derivaciones_seguimiento_nuevo('$nuri')";

		$rawdata = Yii::app()->db->createCommand($sql)->queryAll();
		return $rawdata;
	}

	public function listaCartaExterna($nuri){

		$connection= Yii::app()->db;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * 
			   FROM lista_carta_externa('$nuri')");
        $dataReader=$command->query();

        return $dataReader;

	}


	public function documentosAtendidos($id_usuario){

		$connection= Yii::app()->db;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * 
			   FROM documentos_atendidos($id_usuario)");
        $dataReader=$command->query();

        return $dataReader;

	}




	public function generarHsInternoPDF($id_documento,$id_hoja_ruta)
	{
		//$documentos=$this->loadModel($id_documento);
		$documentos=Documentos::model()->findByPk($id_hoja_ruta);
		$hojasruta=HojasRuta::model()->findByPk($id_hoja_ruta);

        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'LETTER','','',8,8,10,12);
        $mPDF1->SetFooter('Original |'.$hojasruta->nur.' |SIACO');

        $mPDF1->SetWatermarkText("SIACO");
		$mPDF1->showWatermarkText = true;
		$mPDF1->watermark_font = 'DejaVuSansCondensed';
		$mPDF1->watermarkTextAlpha = 0.1;
		$mPDF1->SetDisplayMode('fullpage');

        $mPDF1->WriteHTML($this->renderPartial('hsInternoPDF', array('documentos'=>$documentos,'hojasruta'=>$hojasruta), true));
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->Output('HS.pdf','D');
		//exit;  
		
	}

	//####################################################################
	// codigo para obtenre informacion de la base de datos siaco MySQL y PostgreSQL al mismo tiempo 
	// codigo para obtener referencia y sintesis si existiera

	public function	getReferenciaSintesis($nuri,$proveido){

		//$connection_mysql= Yii::app()->dbmysql;
		$connection_postgres= Yii::app()->db;


		?>
		<table width="100%" align="center" cellpadding="0" cellspacing="0">
				
		<?php


		
		

			$row_post=$connection_postgres->createCommand("SELECT d.referencia, d.contenido, d.fk_tipo_documento 
														 FROM hojas_ruta h, documentos d
														 WHERE h.nur='$nuri' AND h.nro=0 AND h.fk_documento=d.id_documento 
														 ORDER BY h.fecha ASC
														")->query()->read();
			$referencia=$row_post['referencia'];
			?>
				<tr>
					<td width="15%"><b>Referencia: </b></td><td style="font-size:8.5pt; border-bottom:1px solid darkgray;"><?=$referencia?></td>
				</tr>
				<tr>
					<td width="15%"><b>Prove&iacute;do: </b></td><td style="font-size:8.5pt; border-bottom:1px solid darkgray;"><?=$proveido?></td>
				</tr>
			<?php
			if ($row_post['fk_tipo_documento']==7) {
				$sintesis=$row_post['contenido'];
				?>
				<tr>
				<td width="15%"><b>Sintesis: </b></td>
				<td style="font-size:8.5pt;">
					<?php
						$sintesis = str_replace("&NBSP;", "&nbsp;", $sintesis);
						echo trim($sintesis);
					?>
						
				</td>
				</tr>
				<?php
			}


		 // fin else

		?>
		</table>
		<?php


	}// fin function




	//####################################################################
	// codigo para obtener informacion de al base de datos siaco MySQL
	public function getSeguimientoMYSQL($nuri,$oficial)
	{
		$connection= Yii::app()->dbmysql;
		$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("CALL busqueda_nuri('$nuri',$oficial)");
        $dataReader=$command->query();

        return $dataReader;

	}


	public function getListaNurisAgrupadossSIACOCount($nuri)
	{
		$connection= Yii::app()->dbmysql;
		//$usuario=Yii::app()->user->id_usuario;
        $row=$connection->createCommand("SELECT count(nur_p) as total FROM agrupacion WHERE nur_p='$nuri' ")->query()->read();

	 	return $row['total'];

	}

	/*public function getNuriPrincipalMysql($nuri)
	{
		$connection= Yii::app()->dbmysql;
		//$usuario=Yii::app()->user->id_usuario;
        $row=$connection->createCommand("SELECT * FROM agrupacion WHERE nur_s='$nuri' ")->query()->read();

	 	return $row['nur_p'];

	}*/


	public function getListaNurisAgrupadosSegundarioSIACOCount($nuri)
	{
		$connection= Yii::app()->dbmysql;
		//$usuario=Yii::app()->user->id_usuario;
        $row=$connection->createCommand("SELECT count(nur_s)as total FROM agrupacion WHERE nur_s='$nuri' ")->query()->read();

	 	return $row['total'];

	}


	public function getListaNurisAgrupadossSIACO($nuri)
	{
		$connection= Yii::app()->dbmysql;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * FROM agrupacion WHERE nur_p='$nuri' ");
        $dataReader=$command->query();

        return $dataReader;

	}

    /*public function getCabeceraSeguimientoMYSQL($nuri){
        $connection= Yii::app()->dbmysql;
        $row=$connection->createCommand("CALL cabecera_seguimiento('$nuri')")->query()->read();

        return $row;
    }*/

	/*public function getBusquedaDocumentoMYSQL($cite){
		$connection= Yii::app()->dbmysql;
	 	$row=$connection->createCommand("CALL busqueda_documento('$cite')")->query()->read();

	 	return $row;
	}*/

	/*public function getNurisAsociadosMYSQL($nuri){

		$connection= Yii::app()->dbmysql;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * FROM hojas_ruta WHERE nur='$nuri' AND nro=-1");
        $dataReader=$command->query();

        return $dataReader;
	}*/

	/*public function getObtenerNuriMysql($cite){

		$connection= Yii::app()->dbmysql;
		//$usuario=Yii::app()->user->id_usuario;
	 	$row=$connection->createCommand("SELECT * FROM hojas_ruta WHERE codigo='$cite'")->query()->read();

	 	return $row['nur'];
        
	}*/

	//####################################################################

	//#######################################################################
	//#######################################################################

	// funcion para consultar la base de datos POSTGRESQL - SAD
	/*public function getInfoArchivo($id_seguimiento){

		//$connection=Yii::app()->dbsad;
	    $connection= Yii::app()->dbsad;
	 	$row=$connection->createCommand("SELECT ea.exp_id,ei.exp_titulo,d.fil_id,a.fil_titulo,a.fil_fecha, a.fil_obs, d.fil_nur, d.fil_estadoseguimiento from tab_doccorr d
                join tab_archivo a on a.fil_id = d.fil_id
                join tab_exparchivo ea on ea.fil_id = d.fil_id
                join tab_expediente e on e.exp_id = ea.exp_id
                join tab_expisadg ei on ei.exp_id = e.exp_id
                where a.fil_estado = 1 and
                fil_idseguimiento =$id_seguimiento")->query()->read();

	 	return $row;

        
	}*/

	
	//#######################################################################
	//#######################################################################


}
