<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'R语言数据建模竞赛平台',
	'language'=>'zh_cn',
	'preload'=>array('log'),
	'defaultController'=>'quiz',
	'import'=>array(
		'application.models.*',
		'application.services.*',
		'application.components.*',
		'application.extensions.*',
	),
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'gii',
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),
	'components'=>array(
		'user'=>array(
			'allowAutoLogin'=>true,
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
			
		'authManager'=>array(
				'class'=>'CDbAuthManager',
				'connectionID'=>'db',
				'defaultRoles'=>array('guest'),//默认角色
				'itemTable' => 'authitem',//认证项表名称
				'itemChildTable' => 'authitemchild',//认证项父子关系
				'assignmentTable' => 'authassignment',//认证项赋权关系
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=competition',
			'emulatePrepare' => true,
			'username' => 'comp',
			'password' => 'comp',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				array(
					'class'=>'CWebLogRoute',
				),
			),
		),
	),
		
	'params'=>array(
		'adminEmail'=>'bsspirit@gmail.com',
	),
);