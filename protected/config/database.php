<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	/*
	'connectionString' => 'mysql:host=localhost;dbname=testdrive',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	*/


	 'connectionString' => 'pgsql:host=192.168.131.141;port=5432;dbname=nsiaco',
     'username' => 'carla',
	 'password' => 'carla123',
     'charset' => 'utf8',


     // codigo añadido por para la libreria yii-debug-toolbar
     'enableProfiling'=>true,
        'enableParamLogging'=>true,
);
