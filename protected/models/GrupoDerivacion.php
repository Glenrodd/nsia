<?php

/**
 * This is the model class for table "grupo_derivacion".
 *
 * The followings are the available columns in table 'grupo_derivacion':
 * @property integer $id_grupo_derivacion
 * @property string $nombre_grupo
 * @property integer $fk_area
 * @property integer $fk_usuario
 * @property integer $fk_regional
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property integer $activo
 */
class GrupoDerivacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'grupo_derivacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.


		return array(

			array('nombre_grupo','required','message'=>'El campo {attribute} no puede quedar vacío '),


			array('fk_area, fk_usuario, fk_regional, fecha_registro, hora_registro', 'required'),
			array('fk_area, fk_usuario, fk_regional, activo', 'numerical', 'integerOnly'=>true),
			array('nombre_grupo', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_grupo_derivacion, nombre_grupo, fk_area, fk_usuario, fk_regional, fecha_registro, hora_registro, activo', 'safe', 'on'=>'search'),
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
			'fkUsuario' => array(self::BELONGS_TO, 'Usuarios', 'fk_usuario'),
			'fkRegional' => array(self::BELONGS_TO, 'Regionales', 'fk_regional'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_grupo_derivacion' => 'Id Grupo Derivacion',
			'nombre_grupo' => 'Nombre Grupo',
			'fk_area' => 'Fk Area',
			'fk_usuario' => 'Fk Usuario',
			'fk_regional' => 'Fk Regional',
			'fecha_registro' => 'Fecha Registro',
			'hora_registro' => 'Hora Registro',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id_grupo_derivacion',$this->id_grupo_derivacion);
		$criteria->compare('nombre_grupo',$this->nombre_grupo,true);
		$criteria->compare('fk_area',$this->fk_area);
		$criteria->compare('fk_usuario',Yii::app()->user->id_usuario);
		$criteria->compare('fk_regional',$this->fk_regional);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GrupoDerivacion the static model class
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
}
