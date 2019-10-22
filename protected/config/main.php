<?php

$sessionTimeout = 9200; // 5 secondes

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sistema Automatizado de Correspondencia',
	'language' => 'es',
	'sourceLanguage'=>'en',
	'charset'=>'utf-8',
	'theme' => 'AdminLTE-3.0.0-alpha',
	'timeZone'=>'America/La_Paz',


	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		
		'application.controllers.*',
		// codigo añadido para la extension yii-debug-toolbar
		//'application.extensions.yii-debug-toolbar.*'

		//codigo añadido para auditoria
		//'application.modules.auditTrail.models.AuditTrail',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'qwerty',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
			'ipFilters'=>array('192.168.0.47','::1'),
		),

		'dashboard' => array(
		      'debug' => true,
		      'portlets' => array(
		        'News' => array('class' => 'News', 'visible' => true, 'weight' => 0), 
		        'Forums' => array('class' => 'Forums', 'visible' => true, 'weight' => 1), 
		        'Videos' => array('class' => 'Videos', 'visible' => true, 'weight' => 2), 
		        'Blogs' => array('class' => 'Blogs', 'visible' => true, 'weight' => 3), 
		        'Friends' => array('class' => 'Friends', 'visible' => true, 'weight' => 4),
		      ),
		    ),

		'admin',
		'backup',


		//'auditTrail'=>array(),
		
	),

	// application components
	'components'=>array(

		'session' => array(
             'class' => 'CDbHttpSession',
             'timeout' => $sessionTimeout,
        ),
	/*########################################################################*/


	'ePdf' => array(
        'class'         => 'ext.yii-pdf.EYiiPdf',
        'params'        => array(
            'mpdf'     => array(
                'librarySourcePath' => 'application.extensions.mpdf.*',
                'constants'         => array(
                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                ),
                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                    'mode'              => '', //  This parameter specifies the mode of the new document.
                    'format'            => 'A4', // format A4, A5, ...
                    'default_font_size' => 0, // Sets the default document font size in points (pt)
                    'default_font'      => '', // Sets the default font-family for the new document.
                    'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                    'mgr'               => 15, // margin_right
                    'mgt'               => 16, // margin_top
                    'mgb'               => 16, // margin_bottom
                    'mgh'               => 9, // margin_header
                    'mgf'               => 9, // margin_footer
                    'orientation'       => 'P', // landscape or portrait orientation
                )*/
            ),
            'Html2Pdf' => array(
                //'librarySourcePath' => 'application.vendors.html2pdf.*',
                'librarySourcePath' => 'application.extensions.html2pdf.src.*',
                'classFile'         => 'Html2Pdf.php', // For adding to Yii::$classMap
                //'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                    'orientation' => 'P', // landscape or portrait orientation
                    'format'      => 'A4', // format A4, A5, ...
                    'language'    => 'en', // language: fr, en, it ...
                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                )*/
	            ),
	        ),
	    ), //'ePdf' => array(
	/*########################################################################*/	

	// enables theme based JQueryUI's
		'widgetFactory' => array(
			'widgets' => array(
				/*'CJuiAutoComplete' => array(
					'themeUrl' => '/css/jqueryui',
					'theme' => 'theme_alvaro',
				),*/
				/*'CJuiDialog'=> array(
					'themeUrl' => 'jqueryui/',
					'theme' => 'theme_alvaro'),*/

				'CJuiTabs' => array(
					'themeUrl' => 'jqueryui/',
					'theme' => 'theme_alvaro',
				),
				/*'CJuiButton' => array(
					'themeUrl' => 'jqueryui/',
					'theme' => 'theme_alvaro',
				),
				'CJuiDatePicker' => array(
					'themeUrl' => 'jqueryui/',
					'theme' => 'theme_alvaro',
				),*/

				/*'CGridView' => array(
                    'htmlOptions' => array(
                        'class' => 'table-responsive'
                    ),
                    'pagerCssClass' => 'dataTables_paginate paging_bootstrap',
                    'itemsCssClass' => 'table table-striped table-hover',
                    'cssFile' => false,
                    'summaryCssClass' => 'dataTables_info',
                    'summaryText' => 'Showing {start} to {end} of {count} entries',
                    'template' => '{items}<div class="row"><div class="col-md-5 col-sm-12">{summary}</div><div class="col-md-7 col-sm-12">{pager}</div></div><br />',
                ),*/


				/*'CPortlet' => array(
					'themeUrl' => '/ficha_tecnica/css/jqueryui',
					'theme' => 'theme_alvaro',
				),*/
				/*'CJuiDatePicker' => array(
					'themeUrl' => '/css/jqueryui',
					'theme' => 'theme_alvaro',
				),*/
			),
		),


	/*########################################################################*/	
		'user'=>array(
			// enable cookie-based authentication
			//'allowAutoLogin'=>true,
			/*'allowAutoLogin' => true,
			// codigo añadido por alvaro canqui para el inicio de sesion
            'autoRenewCookie' => true,
            'authTimeout' => 315576000000,*/


            'class' => 'CWebUser',
		    'loginUrl' => array('site/login'),
		    'allowAutoLogin' => true,
		    'authTimeout' => 5400
            
		),

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/

		// database settings are configured in database.php
		// conexion base de datos siaco (version antigua)
		'db'=>require(dirname(__FILE__).'/database.php'),
		'dbmysql' => array(
		        //'class' => 'yii\db\Connection',
				//'tablePrefix'=>'',
				'class'=>'CDbConnection',
				//'connectionString' => 'mysql:host=192.168.4.162;dbname=siaco',
				'connectionString' => 'mysql:host=192.168.131.141;dbname=msiaco',
				'emulatePrepare' => true,
				//'username' => 'siaco',
				'username' => 'root',
				//'password' => '6Mr99yKZ7w3BaL4F',
				'password' => 'S1stemas',
				'charset' => 'utf8',

		    	),
		'dbsad' => array(

			 'class'=>'CDbConnection',
		     'connectionString' => 'pgsql:host=192.168.131.141;port=5432;dbname=nsiaco',
			 'username' => 'carla',
			 'password' => 'carla123',
			 'charset' => 'utf8',
		),

		/*'dbsad' => array(

			 'class'=>'CDbConnection',
		     'connectionString' => 'pgsql:host=192.168.4.232;port=5432;dbname=bd_sad',
			 'username' => 'jovando',
			 'password' => 'qwerty',
			 'charset' => 'utf8',
		),*/




		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				//array(
				//	'class'=>'CWebLogRoute',
				//),
			),

			 /*'routes'=>array(
            array(
                'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                'ipFilters'=>array('127.0.0.1','192.168.1.215'),

		            ),
		        ),*/
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'session_timeout'=> $sessionTimeout,
		'adminEmail'=>'blanco.carla@viasbolivia.gob.bo',
	),
);
