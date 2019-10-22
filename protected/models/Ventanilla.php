<?php

/**
 * This is the model class for table "ventanilla".
 *
 * The followings are the available columns in table 'ventanilla':
 * @property integer $id_ventanilla
 * @property integer $correlativo
 * @property integer $gestion
 * @property integer $fk_usuario
 * @property integer $activo
 * @property integer $fk_regional
 * @property string $sigla
 *
 * The followings are the available model relations:
 * @property Usuarios $fkUsuario
 */
class Ventanilla extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ventanilla';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_ventanilla, correlativo, gestion, fk_usuario, fk_regional', 'required'),
			array('id_ventanilla, correlativo, gestion, fk_usuario, activo, fk_regional', 'numerical', 'integerOnly'=>true),
			array('sigla', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ventanilla, correlativo, gestion, fk_usuario, activo, fk_regional, sigla', 'safe', 'on'=>'search'),
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
			'id_ventanilla' => 'Id Ventanilla',
			'correlativo' => 'Correlativo',
			'gestion' => 'Gestion',
			'fk_usuario' => 'Fk Usuario',
			'activo' => 'Activo',
			'fk_regional' => 'Fk Regional',
			'sigla' => 'Sigla',
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

		$criteria->compare('id_ventanilla',$this->id_ventanilla);
		$criteria->compare('correlativo',$this->correlativo);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('fk_usuario',$this->fk_usuario);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('fk_regional',$this->fk_regional);
		$criteria->compare('sigla',$this->sigla,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ventanilla the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
