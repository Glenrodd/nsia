<?php

/**
 * This is the model class for table "areas".
 *
 * The followings are the available columns in table 'areas':
 * @property integer $id_area
 * @property string $area
 * @property string $sigla
 * @property string $cite
 * @property string $descripcion
 * @property integer $dependencia
 * @property integer $fk_regional
 * @property integer $activo
 *
 * The followings are the available model relations:
 * @property Correlativos[] $correlativoses
 * @property Regionales $fkRegional
 * @property Usuarios[] $usuarioses
 * @property Documentos[] $documentoses
 */
class Areas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'areas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('area, sigla, cite, fk_regional', 'required'),
			array('dependencia, fk_regional, activo', 'numerical', 'integerOnly'=>true),
			array('area', 'length', 'max'=>200),
			array('sigla', 'length', 'max'=>45),
			array('cite', 'length', 'max'=>100),
			array('descripcion', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_area, area, sigla, cite, descripcion, dependencia, fk_regional, activo', 'safe', 'on'=>'search'),
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
			'correlativoses' => array(self::HAS_MANY, 'Correlativos', 'fk_area'),
			'fkRegional' => array(self::BELONGS_TO, 'Regionales', 'fk_regional'),
			'usuarioses' => array(self::HAS_MANY, 'Usuarios', 'fk_area'),
			'documentoses' => array(self::HAS_MANY, 'Documentos', 'fk_area'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_area' => 'Id Area',
			'area' => 'Area',
			'sigla' => 'Sigla',
			'cite' => 'Cite',
			'descripcion' => 'Descripcion',
			'dependencia' => 'Dependencia',
			'fk_regional' => 'Fk Regional',
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

		$activo=1;

		$criteria=new CDbCriteria;

		$criteria->compare('id_area',$this->id_area);
		$criteria->compare('area',strtoupper($this->area),true);
		$criteria->compare('sigla',$this->sigla,true);
		$criteria->compare('cite',$this->cite,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('dependencia',$this->dependencia);
		$criteria->compare('fk_regional',$this->fk_regional);
		$criteria->compare('activo',$activo);
		$criteria->order = "id_area ASC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Areas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getListRegionales(){

		return CHtml::listData(Regionales::model()->findAll("activo=?", array(1)), 'id_regional', 'regional');

	}

	public function getListAreaPadre(){

		//return CHtml::listData(Areas::model()->findAll("activo=? AND dependencia=?", array(1,0)), 'id_area', 'area');
		return CHtml::listData(Areas::model()->findAll("activo=? and dependencia=?", array(1,0)), 'id_area', 'area');

	}

	public function getArea($id){
		$model=Areas::model()->findByPk($id);

		return $model->area;

	}
	public function getAreaGrid($id){

		if ($id!=0) {
			$model=Areas::model()->findByPk($id);
			return $model->area;
		}
		else{
			return "SIN DEPENDENCIA";	
		}


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


	public function getPendientesAreas($area){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("SELECT * 
			   FROM pendientes_area($area)");
        $dataReader=$command->query();

        return $dataReader;
	}

	public function getPendientesGeneral(){

		$connection= Yii::app()->db;
        $command=$connection->createCommand("SELECT * 
			   FROM pendientes_general()");
        $dataReader=$command->query();

        return $dataReader;
	}


	public function getDetailUsuarios($id_area)
	{
		$connection= Yii::app()->db;
		
	 	$dataReader=$connection->createCommand("SELECT * 
			 			FROM usuarios
			 			WHERE fk_area=$id_area AND activo=1 ORDER BY id_usuario ASC ")->query();
		return $dataReader;

	} //fin function

	public function getCite($dependencia){
		
		$model=Areas::model()->findByPk($dependencia);
		
		return $model->cite;
		

	}// fin function

	public function generarCorrelativo($id_area,$id_regional){

		// array con parametros validos para generar 
		//el correlativo por tipo de documento
		$tipo=array(1,2,3,4,5,7,8);
		$gestion=date('Y');

		for ($i=0; $i <count($tipo) ; $i++) { 
			
			$model= new Correlativos();
			$model->correlativo=0;
			$model->gestion=$gestion;
			$model->fk_correlativo=0;
			$model->fk_area=$id_area;
			$model->fk_regional=$id_regional;
			$model->fk_tipo_documento=$tipo[$i];
			$model->insert();


		}




	}// fin function


}
