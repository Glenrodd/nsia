<?php

/**
 * This is the model class for table "detalle_corte".
 *
 * The followings are the available columns in table 'detalle_corte':
 * @property integer $id_corte
 * @property string $codigo
 * @property integer $derivado_por
 * @property integer $derivado_a
 * @property string $proveido
 * @property string $fecha_derivacion
 * @property string $hora_derivacion
 * @property string $fecha_recepcion
 * @property string $hora_recepcion
 * @property integer $fk_accion
 * @property integer $fk_estado
 * @property integer $padre
 * @property integer $oficial
 * @property string $hijo
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property integer $gestion
 * @property integer $confirmado
 * @property integer $fk_corte
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property Corte $fkCorte
 * @property Acciones $fkAccion
 * @property Estados $fkEstado
 * @property Usuarios $derivadoPor
 * @property Usuarios $derivadoA
 */
class DetalleCorte extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detalle_corte';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, derivado_por, derivado_a, proveido, fecha_derivacion, hora_derivacion, fecha_recepcion, hora_recepcion, fk_accion, fk_estado, padre, oficial, fecha_registro, hora_registro, gestion, fk_corte', 'required'),
			array('derivado_por, derivado_a, fk_accion, fk_estado, padre, oficial, gestion, confirmado, fk_corte, activo', 'numerical', 'integerOnly'=>true),
			array('codigo, hijo', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_corte, codigo, derivado_por, derivado_a, proveido, fecha_derivacion, hora_derivacion, fecha_recepcion, hora_recepcion, fk_accion, fk_estado, padre, oficial, hijo, fecha_registro, hora_registro, gestion, confirmado, fk_corte, activo', 'safe', 'on'=>'search'),
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
			'fkCorte' => array(self::BELONGS_TO, 'Corte', 'fk_corte'),
			'fkAccion' => array(self::BELONGS_TO, 'Acciones', 'fk_accion'),
			'fkEstado' => array(self::BELONGS_TO, 'Estados', 'fk_estado'),
			'derivadoPor' => array(self::BELONGS_TO, 'Usuarios', 'derivado_por'),
			'derivadoA' => array(self::BELONGS_TO, 'Usuarios', 'derivado_a'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_corte' => 'Id Corte',
			'codigo' => 'Codigo',
			'derivado_por' => 'Derivado Por',
			'derivado_a' => 'Derivado A',
			'proveido' => 'Proveido',
			'fecha_derivacion' => 'Fecha Derivacion',
			'hora_derivacion' => 'Hora Derivacion',
			'fecha_recepcion' => 'Fecha Recepcion',
			'hora_recepcion' => 'Hora Recepcion',
			'fk_accion' => 'Fk Accion',
			'fk_estado' => 'Fk Estado',
			'padre' => 'Padre',
			'oficial' => 'Oficial',
			'hijo' => 'Hijo',
			'fecha_registro' => 'Fecha Registro',
			'hora_registro' => 'Hora Registro',
			'gestion' => 'Gestion',
			'confirmado' => 'Confirmado',
			'fk_corte' => 'Fk Corte',
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
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('derivado_por',$this->derivado_por);
		$criteria->compare('derivado_a',$this->derivado_a);
		$criteria->compare('proveido',$this->proveido,true);
		$criteria->compare('fecha_derivacion',$this->fecha_derivacion,true);
		$criteria->compare('hora_derivacion',$this->hora_derivacion,true);
		$criteria->compare('fecha_recepcion',$this->fecha_recepcion,true);
		$criteria->compare('hora_recepcion',$this->hora_recepcion,true);
		$criteria->compare('fk_accion',$this->fk_accion);
		$criteria->compare('fk_estado',$this->fk_estado);
		$criteria->compare('padre',$this->padre);
		$criteria->compare('oficial',$this->oficial);
		$criteria->compare('hijo',$this->hijo,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('confirmado',$this->confirmado);
		$criteria->compare('fk_corte',$this->fk_corte);
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleCorte the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
