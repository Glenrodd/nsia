<?php

/**
 * This is the model class for table "alias".
 *
 * The followings are the available columns in table 'alias':
 * @property integer $id_alias
 * @property string $nombre
 * @property string $cargo
 * @property string $descripcion
 * @property integer $fk_usuario
 * @property integer $activo
 * @property string $fecha_registro
 * @property string $hora_registro
 *
 * The followings are the available model relations:
 * @property Usuarios $fkUsuario
 */
class Alias extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, cargo, fk_usuario', 'required'),
			array('fk_usuario, activo', 'numerical', 'integerOnly'=>true),
			array('nombre, descripcion', 'length', 'max'=>500),
			array('cargo', 'length', 'max'=>300),
			array('fecha_registro, hora_registro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_alias, nombre, cargo, descripcion, fk_usuario, activo, fecha_registro, hora_registro', 'safe', 'on'=>'search'),
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
			'fkUsuario' => array(self::BELONGS_TO, 'Usuarios', 'fk_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_alias' => 'Id Alias',
			'nombre' => 'Nombre',
			'cargo' => 'Cargo',
			'descripcion' => 'Descripcion',
			'fk_usuario' => 'Fk Usuario',
			'activo' => 'Activo',
			'fecha_registro' => 'Fecha Registro',
			'hora_registro' => 'Hora Registro',
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

		$criteria->compare('id_alias',$this->id_alias);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('cargo',$this->cargo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fk_usuario',$this->fk_usuario);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Alias the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function updateAlias($id){
		
		$connection= Yii::app()->db;
		$connection->createCommand("UPDATE alias SET activo=0 WHERE fk_usuario=$id")->execute();
	}
}
