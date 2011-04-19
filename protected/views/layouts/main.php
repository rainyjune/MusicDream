<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<!-- fancybox -->
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fancybox/jquery.fancybox-1.3.1.css" />

</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'主页', 'url'=>array('/')),
//				array('label'=>'关于', 'url'=>array('/site/page', 'view'=>'about')),
//				array('label'=>'栏目', 'url'=>array('/menu/index'),'visible'=>Yii::app()->user->name=="admin"),
				array('label'=>'用户', 'url'=>array('/user/index'),'visible'=>Yii::app()->user->name=="admin"),
				array('label'=>'歌手库', 'url'=>array('/artist/index')),
				array('label'=>'艺术家地区', 'url'=>array('/artistArea/index'),'visible'=>Yii::app()->user->name=="admin"),
				array('label'=>'艺术家类型', 'url'=>array('/artistType/index'),'visible'=>Yii::app()->user->name=="admin"),
				array('label'=>'专辑', 'url'=>array('/album/index')),
				array('label'=>'音乐', 'url'=>array('/music/index'),'visible'=>Yii::app()->user->name=="admin"),
				array('label'=>'标签', 'url'=>array('/tagdir/index')),
				array('label'=>'系统变量', 'url'=>array('/vars/index'),'visible'=>Yii::app()->user->name=="admin"),
				array('label'=>'我的播放列表','url'=>array('/playlist/index'),'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'管理面板','url'=>array('/dashboard/index'),'visible'=>Yii::app()->user->name=="admin"),
                array('label'=>'我的信息','url'=>array('/user/view','id'=>Yii::app()->user->id),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'注册','url'=>array('/user/register'),'visible'=>Yii::app()->user->isGuest),
				array('label'=>'登录', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'注销 ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
		'homeLink'=>CHtml::link('主页',Yii::app()->homeUrl),
//		'separator'=>'->'
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div id="footer">
		<?php echo  Yii::app()->params['footerinfo'];?>&nbsp;<a href="index.php?r=site/contact">意见反馈</a><br />
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
