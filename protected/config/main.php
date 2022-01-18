<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Imaves',
        'theme'=>'glavna',
        'timeZone'=>'Europe/Zagreb',
        'language'=>'hr',
        'sourceLanguage'=>'hr',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                //'application.components.html.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'password',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('93.138.53.238','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'loginUrl'=>array('admin/login'),
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
'urlFormat'=>'path',
'rules'=>array(    
'admin'=>'admin/index',
'gii'=>'gii',
'gii/<controller:\w+>'=>'gii/<controller>',
'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',


//meni hrvatski

'/<lang>/'=>'site/index',
'/kontakt'=>'site/kontakt',
'/<lang>/<id:\d+>/<title>'=>'site/izbornik',
'/<lang>/tehinicka_podrska_neregistrirani_korisnici'=>'site/neregistrirani',
'/<lang>/tehinicka_podrska_registrirani_korisnici'=>'site/registrirani',
'/<lang>/novosti_prijava'=>'site/novosti_prijava',
'/<lang>/pretraga'=>'site/pretraga',



'<controller:\w+>/<action:\w+>/<id:\d+>/<name>/<view>/<redirect>'=>'<controller>/<action>',    
'<controller:\w+>/<action:\w+>/<name>/<view>/<redirect>'=>'<controller>/<action>',    
'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',     
),
'showScriptName'=>false,
),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		//  MySQL baza, podaci za spajanje:
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=imaveshr_imaves',
			'emulatePrepare' => true,
			'username' => 'imaveshr_imaves',
			'password' => 'imaves123',
			'charset' => 'utf8',
		),
		
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
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// Glavni parametri web aplikacija
	// using Yii::app()->params['webURL']
	'params'=>array(
		// podaci za administriranje sustava
		'adminEmail'=>'alen.kulenovic@gmail.com',
                'webURL'=>'http://www.imaves.hr/',
                'theme'=>'imaves',
                'emailZaObavijesti'=>'info@imaves.hr',
                'emailZaKontakt'=>'info@imaves.hr',
                
                
                
                
                //podaci o klijentu
                'nazivTvrtke'=>'Imaves',
                'opisTvrtke'=>'#',
                'adresaTvrtke'=>'#',
                'gradTvrtke'=>'#',
                'emailTvrtke'=>'#',
                'mobTvrtke'=>'#',
                'koordinateTvrtke'=>'#',
                'isoTvrtke'=>'En iso 9001:2015',
                
	),
);