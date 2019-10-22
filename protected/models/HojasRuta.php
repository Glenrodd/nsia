<?php

/**
 * This is the model class for table "hojas_ruta".
 *
 * The followings are the available columns in table 'hojas_ruta':
 * @property integer $id_hoja_ruta
 * @property string $nur
 * @property string $codigo
 * @property integer $nro
 * @property string $fecha
 * @property string $hora
 * @property integer $proceso
 * @property string $fecha_registro
 * @property string $hora_registro
 * @property integer $fk_usuario
 * @property integer $gestion
 * @property integer $activo
 * @property integer $fk_documento
 *
 * The followings are the available model relations:
 * @property Usuarios $fkUsuario
 */
class HojasRuta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hojas_ruta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('nur','required','message'=>'El campo NUR/NURI no puede quedar vacío '),
			array('codigo','required','message'=>'El campo Código no puede quedar vacío'),
			array('nro','required','message'=>'El campo Nro no puede quedar vacío'),
			array('fecha','required','message'=>'El campo no puede quedar vacío'),
			array('fecha_registro','required','message'=>'El campo no puede quedar vacío'),


			array('hora, proceso, hora_registro, fk_usuario, gestion', 'required'),
			array('id_hoja_ruta, nro, proceso, fk_usuario, gestion, activo, fk_documento', 'numerical', 'integerOnly'=>true),
			array('nur, codigo', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_hoja_ruta, nur, codigo, nro, fecha, hora, proceso, fecha_registro, hora_registro, fk_usuario, gestion, activo, fk_documento, oficial', 'safe', 'on'=>'search'),
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
			'fkDocumento' => array(self::BELONGS_TO, 'Documentos', 'fk_documento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_hoja_ruta' => 'Id Hoja Ruta',
			'nur' => 'Nur',
			'codigo' => 'Codigo',
			'nro' => 'Nro',
			'fecha' => 'Fecha',
			'hora' => 'Hora',
			'proceso' => 'Proceso',
			'fecha_registro' => 'Fecha Registro',
			'hora_registro' => 'Hora Registro',
			'fk_usuario' => 'Fk Usuario',
			'gestion' => 'Gestion',
			'activo' => 'Activo',
			'fk_documento' => 'Fk Documento',
			'oficial' => 'Oficial',
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

		$criteria->compare('id_hoja_ruta',$this->id_hoja_ruta);
		$criteria->compare('nur',$this->nur,true);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('nro',$this->nro);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('proceso',$this->proceso);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('fk_usuario',$this->fk_usuario);
		$criteria->compare('gestion',$this->gestion);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('fk_documento',$this->fk_documento);
		$criteria->compare('oficial',$this->oficial);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchGestion($gestion)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$activo=1;
		$usuario=Yii::app()->user->id_usuario;

		$criteria=new CDbCriteria;

		$criteria->compare('id_hoja_ruta',$this->id_hoja_ruta);
		$criteria->compare('nur',$this->nur,true);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('nro',$this->nro);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('hora',$this->hora,true);
		$criteria->compare('proceso',$this->proceso);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hora_registro',$this->hora_registro,true);
		$criteria->compare('fk_usuario',$usuario);
		$criteria->compare('gestion',$gestion);
		$criteria->compare('activo',$activo);
		$criteria->compare('fk_documento',$this->fk_documento);
		$criteria->compare('oficial',$this->oficial);
		$criteria->order = "nur DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 20)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HojasRuta the static model class
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

	public function getGestion(){

		$connection= Yii::app()->db;
		$usuario=Yii::app()->user->id_usuario;
		
		$sql="SELECT DISTINCT gestion 
		   	FROM hojas_ruta
		   	WHERE fk_usuario=$usuario AND activo=1
		   	ORDER BY gestion DESC  
		   	";
				 			
		$command=$connection->createCommand($sql);
		return $command->query();

	}


	public function getCountDobleAsignacion($nuri){

		$usuario=Yii::app()->user->id_usuario;
		$connection= Yii::app()->db;

	 	$row=$connection->createCommand("SELECT COUNT(id_hoja_ruta) as total FROM hojas_ruta WHERE nur='$nuri' AND fk_usuario!=$usuario AND activo=1 AND nro=0 AND oficial=1 ")->query()->read();

	 	return $row['total'];
	}

	public function viewNurDobleAsignacion($nuri){

		$connection= Yii::app()->db;
		$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * FROM hojas_ruta h, usuarios u 
        									 WHERE h.nur='$nuri' 
        									 AND h.fk_usuario!=$usuario 
        									 AND u.id_usuario=h.fk_usuario
        									 AND h.activo=1 
        									 AND h.nro=0 
        									 AND h.oficial=1
        								");
        $dataReader=$command->query();

        return $dataReader;

	}



	public function getCountNuriDerivado($nuri){

		$count = Seguimientos::model()->countByAttributes(array(
            'codigo'=> $nuri,
            'activo'=>1,
            'confirmado'=>1
        ));

        return $count;
	}

	



	public function nurFechaExterno($id_usuario, $fecha_inicio, $fecha_fin){

		$connection= Yii::app()->db;
		//$usuario=Yii::app()->user->id_usuario;
        $command=$connection->createCommand("SELECT * 
			   FROM reporte_nur_externo($id_usuario,'$fecha_inicio','$fecha_fin')");
        $dataReader=$command->query();

        return $dataReader;

	}

	
}
