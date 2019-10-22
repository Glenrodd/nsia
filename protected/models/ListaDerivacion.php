<?php

/**
 * This is the model class for table "lista_derivacion".
 *
 * The followings are the available columns in table 'lista_derivacion':
 * @property integer $id_lista_derivacion
 * @property integer $activo
 * @property integer $usuario_origen
 * @property integer $usuario_destino
 *
 * The followings are the available model relations:
 * @property Usuarios $usuarioOrigen
 * @property Usuarios $usuarioDestino
 */
class ListaDerivacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lista_derivacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario_origen, usuario_destino', 'required'),
			array('activo, usuario_origen, usuario_destino', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_lista_derivacion, activo, usuario_origen, usuario_destino', 'safe', 'on'=>'search'),
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
			'usuarioOrigen' => array(self::BELONGS_TO, 'Usuarios', 'usuario_origen'),
			'usuarioDestino' => array(self::BELONGS_TO, 'Usuarios', 'usuario_destino'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_lista_derivacion' => 'Id Lista Derivacion',
			'activo' => 'Activo',
			'usuario_origen' => 'Usuario Origen',
			'usuario_destino' => 'Usuario Destino',
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

		$criteria->compare('id_lista_derivacion',$this->id_lista_derivacion);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('usuario_origen',$this->usuario_origen);
		$criteria->compare('usuario_destino',$this->usuario_destino);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ListaDerivacion the static model class
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
