<?php

/**
 * This is the model class for table "regionales".
 *
 * The followings are the available columns in table 'regionales':
 * @property integer $id_regional
 * @property string $regional
 * @property string $sigla
 * @property string $descripcion
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property Correlativos[] $correlativoses
 * @property Areas[] $areases
 * @property Usuarios[] $usuarioses
 */
class Regionales extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'regionales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('regional, sigla', 'required'),
			array('activo', 'numerical', 'integerOnly'=>true),
			array('regional', 'length', 'max'=>200),
			array('sigla', 'length', 'max'=>45),
			array('descripcion', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_regional, regional, sigla, descripcion, activo', 'safe', 'on'=>'search'),
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
			'correlativoses' => array(self::HAS_MANY, 'Correlativos', 'fk_regional'),
			'areases' => array(self::HAS_MANY, 'Areas', 'fk_regional'),
			'usuarioses' => array(self::HAS_MANY, 'Usuarios', 'fk_regional'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_regional' => 'Id Regional',
			'regional' => 'Regional',
			'sigla' => 'Sigla',
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

		$criteria->compare('id_regional',$this->id_regional);
		$criteria->compare('regional',$this->regional,true);
		$criteria->compare('sigla',$this->sigla,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('activo',$this->activo);
		$criteria->order = "id_regional ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Regionales the static model class
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
