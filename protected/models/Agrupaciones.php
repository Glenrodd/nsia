<?php

/**
 * This is the model class for table "agrupaciones".
 *
 * The followings are the available columns in table 'agrupaciones':
 * @property integer $id_agrupacion
 * @property string $nur_padre
 * @property string $nur_hijo
 * @property integer $oficial
 * @property integer $fk_seguimiento_padre
 * @property integer $fk_seguimiento_hijo
 * @property integer $fk_usuario
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property Seguimientos $fkSeguimientoPadre
 */
class Agrupaciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'agrupaciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nur_padre, nur_hijo, oficial, fk_seguimiento_padre, fk_seguimiento_hijo, fk_usuario, fecha_registro, hora_registro', 'required'),
			array('oficial, fk_seguimiento_padre, fk_seguimiento_hijo, fk_usuario, activo', 'numerical', 'integerOnly'=>true),
			array('nur_padre, nur_hijo', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_agrupacion, nur_padre, nur_hijo, oficial, fk_seguimiento_padre, fk_seguimiento_hijo, fk_usuario, fecha_registro, hora_registro, activo', 'safe', 'on'=>'search'),
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
			'fkSeguimientoPadre' => array(self::BELONGS_TO, 'Seguimientos', 'fk_seguimiento_padre'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_agrupacion' => 'Id Agrupacion',
			'nur_padre' => 'Nur Padre',
			'nur_hijo' => 'Nur Hijo',
			'oficial' => 'Oficial',
			'fk_seguimiento_padre' => 'Fk Seguimiento Padre',
			'fk_seguimiento_hijo' => 'Fk Seguimiento Hijo',
			'fk_usuario' => 'Fk Usuario',
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

		$criteria->compare('id_agrupacion',$this->id_agrupacion);
		$criteria->compare('nur_padre',$this->nur_padre,true);
		$criteria->compare('nur_hijo',$this->nur_hijo,true);
		$criteria->compare('oficial',$this->oficial);
		$criteria->compare('fk_seguimiento_padre',$this->fk_seguimiento_padre);
		$criteria->compare('fk_seguimiento_hijo',$this->fk_seguimiento_hijo);
		$criteria->compare('fk_usuario',$this->fk_usuario);
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
	 * @return Agrupaciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function mensajeExitoDesagrupar($nuri){

		 return Yii::app()->user->setFlash('successm', "<i class='fa fa-thumbs-o-up' id='mensaje_emergente' style='color:#086A87;'></i><br>
				El NUR/NURI <b>$nuri</b> fue desagrupado correctamente.		 	
		 	");
	}
}
