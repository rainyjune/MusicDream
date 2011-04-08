<?php
// change the following paths if necessary
//error_reporting(0);
$yii=dirname(__FILE__).'/yiiframework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
require_once($yii);
$app=Yii::createWebApplication($config);
$app->run();
