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


	 //'connectionString' => 'pgsql:host=192.168.131.135;port=5432;dbname=nsiaco',
	 'connectionString' => 'pgsql:host=127.0.0.1;port=5432;dbname=siaco',
     'username' => 'postgres',
	 'password' => 'S1stemas2019',
     'charset' => 'utf8',


     // codigo añadido por para la libreria yii-debug-toolbar
     'enableProfiling'=>true,
        'enableParamLogging'=>true,
);
