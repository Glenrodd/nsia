<?php

/**
 * This is the model class for table "archivados_digitales".
 *
 * The followings are the available columns in table 'archivados_digitales':
 * @property integer $id_archivado_digital
 * @property string $codigo
 * @property string $fecha_archivo
 * @property string $hora_archivo
 * @property string $lugar
 * @property string $observaciones
 * @property integer $fk_usuario
 * @property integer $fk_seguimiento
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property integer $gestion
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property Seguimientos $fkSeguimiento
 * @property Usuarios $fkUsuario
 */
class ArchivadosDigitales extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'archivados_digitales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, fecha_archivo, hora_archivo, lugar, observaciones, fk_usuario, fk_seguimiento, fecha_registro, hora_registro, gestion, fk_regional', 'required'),
			array('fk_usuario, fk_seguimiento, gestion, activo, fk_regional', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>45),
			array('lugar', 'length', 'max'=>100),
			array('observaciones', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_archivado_digital, codigo, fecha_archivo, hora_archivo, lugar, observaciones, fk_usuario, fk_seguimiento, fecha_registro, hora_registro, gestion, activo, fk_regional', 'safe', 'on'=>'search'),
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
			'fkSeguimiento' => array(self::BELONGS_TO, 'Seguimientos', 'fk_seguimiento'),
			'fkUsuario' => array(self::BELONGS_TO, 'Usuarios', 'fk_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_archivado_digital' => 'Id Archivado Digital',
			'codigo' => 'Codigo',
			'fecha_archivo' => 'Fecha Archivo',
			'hora_archivo' => 'Hora Archivo',
			'lugar' => 'Lugar',
			'observaciones' => 'Observaciones',
			'fk_usuario' => 'Fk Usuario',
			'fk_seguimiento' => 'Fk Seguimiento',
			'fecha_registro' => 'Fecha Registro',
			'hora_registro' => 'Hora Registro',
			'fk_regional' => 'Regional',
			'gestion' => 'Gestion',
			'activo' => 'Activo',
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

		$activo=1;

		$criteria=new CDbCriteria;

		$criteria->compare('id_archivado_digital',$this->id_archivado_digital);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('fecha_archivo',$this->fecha_archivo,true);
		$criteria->compare('hora_archivo',$this->hora_archivo,true);
		$criteria->compare('lugar',$this->lugar,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('fk_usuario',$this->fk_usuario);
		$criteria->compare('fk_seguimiento',$this->fk_seguimiento);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('fk_regional',$this->fk_regional,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('activo',$activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ArchivadosDigitales the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function behaviors()
	{
	    return array(
	        // Classname => path to Class
	         'ActiveRecordLogableBehavior'=>
	            'application.behaviors.ActiveRecordLogableBehavior',
	    );
	}


	public function getArchivoGestion(){

		$connection= Yii::app()->db;
		$usuario=Yii::app()->user->id_usuario;
		
		$sql="SELECT DISTINCT gestion 
		   	FROM archivados_digitales
		   	WHERE fk_usuario=$usuario AND activo=1
		   	ORDER BY gestion DESC  
		   	";
				 			
		$command=$connection->createCommand($sql);
		return $command->query();

	}


	public function getDesarchivoGestion(){

		$connection= Yii::app()->db;
		
		$sql="SELECT DISTINCT gestion 
		   	FROM archivados_digitales
		   	WHERE activo=1
		   	ORDER BY gestion DESC  
		   	";
				 			
		$command=$connection->createCommand($sql);
		return $command->query();

	}

	public function getRegional($id){

		$regionales=Regionales::model()->findByPk($id);
		return $regionales->regional;
	}


}
