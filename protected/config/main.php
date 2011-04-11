<?php
function endRequest($event)
{
    $app=Yii::app();
    if($app->createUrl($app->user->loginUrl[0])!=$app->request->getUrl()){
        //If querystring contains string 'captcha',redirect to index.php
        if(strstr($app->request->getQueryString(),'captcha'))
            $app->user->setReturnUrl('index.php');
        else
            $app->user->setReturnUrl($app->request->getUrl());
    }
}
function beginRequest($event)
{
    $app=Yii::app();
    $app->name=Vars::model()->find("varname='SITE_NAME'")->varvalue;
    $app->params['adminEmail']=Vars::model()->find("varname='adminEmail'")->varvalue;
    $app->params['footerinfo']=Vars::model()->find("varname='FOOTERINFO'")->varvalue;
}
# 定义一个路径别名
// Yii::setPathOfAlias('local','path/to/local-folder');

# 这里配置的主体部分。任何可写的 CWebApplication 属性可以在这里配置。
return array(
	'onEndRequest'=>'endRequest',
	'onBeginRequest'=>'beginRequest',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',//注意：应用程序没有使用此处的值
	
	# 默认的 controller
	//'defaultController'=>'user',

	# 捕获所有请求,通常用户维护站点时通知访问者
	//'catchAllRequest'=>array('site/offline'),
	
	# preloading 'log' component
	'preload'=>array('log'),

	# 自动载入的模型和组件类
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
	
	# 站点使用的语言
	'language'=>'zh_cn',
	
	# 应用组件部分的配置
	'components'=>array(
	
		#1.user
		'user'=>array(
			# 启用基于 cookie 的认证
			'allowAutoLogin'=>true,
		),
		
		#2 取消下行的注释以启用 path-format 的URL
		//'urlManager'=>require(dirname(__FILE__).'/urlManager.php'),

		#3 数据库连接信息，这里使用了 MySQL 作为存储媒介
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=musicdream',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
                        'schemaCachingDuration'=>3600,
		),
		
		#4
		'errorHandler'=>array(
                    'errorAction'=>'site/error',
                ),
		
		#5
		'coreMessages'=>array(
                    'basePath'=>'protected/messages',
                ),
		
		#6
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

	# 可以使用 Yii::app()->params['paramName'] 访问 application-level 参数
	'params'=>require(dirname(__FILE__).'/params.php'),
	
	# 模块部分的配置
	'modules'=>array(
            # Gii 是基于 web 的代码生成工具
            'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'ps',
                // 'ipFilters'=>array(...a list of IPs...),
                // 'newFileMode'=>0666,
                // 'newDirMode'=>0777,
            ),
        ),
	
);
