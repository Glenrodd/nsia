<?php

/**
 * This is the model class for table "ActiveRecordLog".
 *
 * The followings are the available columns in table 'ActiveRecordLog':
 * @property integer $id
 * @property string $description
 * @property string $action
 * @property string $model
 * @property integer $idmodel
 * @property string $field
 * @property string $creationdate
 * @property string $userid
 * @property string $old_value
 * @property string $new_value
 */
class ActiveRecordLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ActiveRecordLog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('creationdate', 'required'),
			array('idmodel', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>255),
			array('action', 'length', 'max'=>120),
			array('model, field', 'length', 'max'=>145),
			array('userid', 'length', 'max'=>45),
			array('old_value, new_value', 'length', 'max'=>2000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, action, model, idmodel, field, creationdate, userid, old_value, new_value', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'description' => 'Description',
			'action' => 'Action',
			'model' => 'Model',
			'idmodel' => 'Idmodel',
			'field' => 'Field',
			'creationdate' => 'Creationdate',
			'userid' => 'Userid',
			'old_value' => 'Old Value',
			'new_value' => 'New Value',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('idmodel',$this->idmodel);
		$criteria->compare('field',$this->field,true);
		$criteria->compare('creationdate',$this->creationdate,true);
		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('old_value',$this->old_value,true);
		$criteria->compare('new_value',$this->new_value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActiveRecordLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
