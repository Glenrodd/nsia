<?php

/**
 * This is the model class for table "correlativos".
 *
 * The followings are the available columns in table 'correlativos':
 * @property integer $id_correlativo
 * @property integer $correlativo
 * @property integer $gestion
 * @property integer $fk_correlativo
 * @property integer $fk_area
 * @property integer $fk_regional
 * @property integer $activo
 * @property integer $fk_tipo_documento
 *
 * The followings are the available model relations:
 * @property Areas $fkArea
 * @property Regionales $fkRegional
 */
class Correlativos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'correlativos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gestion, fk_area, fk_regional, fk_tipo_documento', 'required'),
			array('correlativo, gestion, fk_correlativo, fk_area, fk_regional, activo, fk_tipo_documento', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_correlativo, correlativo, gestion, fk_correlativo, fk_area, fk_regional, activo, fk_tipo_documento', 'safe', 'on'=>'search'),
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
			'fkRegional' => array(self::BELONGS_TO, 'Regionales', 'fk_regional'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_correlativo' => 'Id Correlativo',
			'correlativo' => 'Correlativo',
			'gestion' => 'Gestion',
			'fk_correlativo' => 'Fk Correlativo',
			'fk_area' => 'Fk Area',
			'fk_regional' => 'Fk Regional',
			'activo' => 'Activo',
			'fk_tipo_documento' => 'Fk Tipo Documento',
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

		$criteria->compare('id_correlativo',$this->id_correlativo);
		$criteria->compare('correlativo',$this->correlativo);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('fk_correlativo',$this->fk_correlativo);
		$criteria->compare('fk_area',$this->fk_area);
		$criteria->compare('fk_regional',$this->fk_regional);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('fk_tipo_documento',$this->fk_tipo_documento);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Correlativos the static model class
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
