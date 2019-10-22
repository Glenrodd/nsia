

<?php
class ActiveRecordLogableBehavior extends CActiveRecordBehavior
{
    private $_oldattributes = array();
 
    public function afterSave($event)
    {
        if (!$this->Owner->isNewRecord) {
 
            // new attributes
            $newattributes = $this->Owner->getAttributes();
            $oldattributes = $this->getOldAttributes();
 
            // compare old and new
            foreach ($newattributes as $name => $value) {
                if (!empty($oldattributes)) {
                    $old = $oldattributes[$name];
                } else {
                    $old = '';
                }
 
                if ($value != $old) {
                    //$changes = $name . ' ('.$old.') => ('.$value.'), ';
 
                    $log=new ActiveRecordLog;
                    $log->description=  'Usuario: '.Yii::app()->user->usuario
                                            . ' modifico ' . $name . ' en '
                                            . get_class($this->Owner)
                                            . '[' . $this->Owner->getPrimaryKey() .'].';
                    $log->action=       'MODIFICAR/ACTUALIZAR';
                    $log->model=        get_class($this->Owner);
                    $log->idmodel=      $this->Owner->getPrimaryKey();
                    $log->field=        $name;
                    $log->creationdate= new CDbExpression('NOW()');
                    $log->userid=       Yii::app()->user->id_usuario;
                    $log->old_value = $old;
                    $log->new_value = $value;
                    $log->save();
                }
            }
        } else {
            $log=new ActiveRecordLog;
            $log->description=  'Usuario: ' . Yii::app()->user->usuario
                                    . ' Registro Nuevo dato en ' . get_class($this->Owner)
                                    . '[' . $this->Owner->getPrimaryKey() .'].';
            $log->action=       'CREAR/NUEVO';
            $log->model=        get_class($this->Owner);
            $log->idmodel=      $this->Owner->getPrimaryKey();
            $log->field=        '';
            $log->creationdate= new CDbExpression('NOW()');
            $log->userid=       Yii::app()->user->id_usuario;
            $log->old_value = '';
            $log->new_value = '';
            $log->save();
        }
    }
 
    public function afterDelete($event)
    {
        $log=new ActiveRecordLog;
        $log->description=  'Usuario: ' . Yii::app()->user->usuario . ' ELIMINO '
                                . get_class($this->Owner)
                                . '[' . $this->Owner->getPrimaryKey() .'].';
        $log->action=       'DELETE';
        $log->model=        get_class($this->Owner);
        $log->idmodel=      $this->Owner->getPrimaryKey();
        $log->field=        '';
        $log->creationdate= new CDbExpression('NOW()');
        $log->userid=       Yii::app()->user->id_usuario;
        $log->save();
    }
 
    public function afterFind($event)
    {
        // Save old values
        $this->setOldAttributes($this->Owner->getAttributes());
    }
 
    public function getOldAttributes()
    {
        return $this->_oldattributes;
    }
 
    public function setOldAttributes($value)
    {
        $this->_oldattributes=$value;
    }
}