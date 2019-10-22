<?php

/**
 * This is the model class for table "corte".
 *
 * The followings are the available columns in table 'corte':
 * @property integer $id_corte
 * @property integer $nro_corte
 * @property string $fecha_corte
 * @property string $descripcion
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property integer $fk_usuario
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property Usuarios $fkUsuario
 * @property DetalleCorte[] $detalleCortes
 */
class Corte extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'corte';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nro_corte, fecha_corte, fecha_registro, hora_registro, fk_usuario', 'required'),
			array('nro_corte, fk_usuario, activo', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_corte, nro_corte, fecha_corte, descripcion, fecha_registro, hora_registro, fk_usuario, activo', 'safe', 'on'=>'search'),
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
			'detalleCortes' => array(self::HAS_MANY, 'DetalleCorte', 'fk_corte'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_corte' => 'Id Corte',
			'nro_corte' => 'Nro Corte',
			'fecha_corte' => 'Fecha Corte',
			'descripcion' => 'Descripcion',
			'fecha_registro' => 'Fecha Registro',
			'hora_registro' => 'Hora Registro',
			'fk_usuario' => 'Fk Usuario',
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

		$criteria->compare('id_corte',$this->id_corte);
		$criteria->compare('nro_corte',$this->nro_corte);
		$criteria->compare('fecha_corte',$this->fecha_corte,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('fk_usuario',$this->fk_usuario);
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Corte the static model class
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
