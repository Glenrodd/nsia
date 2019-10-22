<?php

/**
 * This is the model class for table "institucion_remitente".
 *
 * The followings are the available columns in table 'institucion_remitente':
 * @property integer $id_institucion_remitente
 * @property string $institucion_remitente
 * @property string $descripcion
 * @property integer $activo
 */
class InstitucionRemitente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'institucion_remitente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('institucion_remitente', 'required'),
			array('activo', 'numerical', 'integerOnly'=>true),
			array('institucion_remitente', 'length', 'max'=>1000),
			array('descripcion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_institucion_remitente, institucion_remitente, descripcion, activo', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_institucion_remitente' => 'Id Institucion Remitente',
			'institucion_remitente' => 'Institucion Remitente',
			'descripcion' => 'Descripcion',
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

		$criteria->compare('id_institucion_remitente',$this->id_institucion_remitente);
		$criteria->compare('institucion_remitente',$this->institucion_remitente,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InstitucionRemitente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
