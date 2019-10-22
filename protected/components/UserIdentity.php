<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
/*class UserIdentity extends CUserIdentity
{
	
	public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}*/

class UserIdentity extends CUserIdentity
 {
	 private $_id;

	 public function authenticate()
	 {
		 $username=strtolower($this->username);
		 $user=Usuarios::model()->find('LOWER(usuario)=? AND activo=?',array($username,1));

		 if($user===null){
			 $this->errorCode=self::ERROR_USERNAME_INVALID;
		 }
		 else if(!$user->validatePassword($this->password)){
			 $this->errorCode=self::ERROR_PASSWORD_INVALID;
		 }
		 else
		 {
		 	// codigo para obtener los valores del ususario logueado
		 	// usamos $user por que a traves de esa variable realizamos la consulta al a tabl usuarios
		 	//	$user=Usuarios::model()->find('LOWER(usuario)=?',array($username));
		 	$this->setState('usuario', $user->usuario);
		 	$this->setState('id_nivel', $user->fk_nivel);
		 	$this->setState('id_usuario', $user->id_usuario);
			$this->setState('id_perfil', $user->fk_perfil);
			$this->setState('regional', $user->fk_regional);
			$this->setState('id_area', $user->fk_area);
			$this->setState('area_sad', $user->area_sad);
			//$this->setState('id_regional', $user->fk_regional);
			//$this->setState('id_area', $user->fk_area);

		 	 // aqui se ponen los valor de la tabla usuarios	
			 $this->_id=$user->id_usuario;
			 $this->username=$user->usuario;
			 $this->errorCode=self::ERROR_NONE;
		 }
		 return $this->errorCode==self::ERROR_NONE;
	 }

	 public function getId()
	 {
		 return $this->_id;
	 }
 }