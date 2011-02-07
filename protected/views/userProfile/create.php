<?php
$this->breadcrumbs=array(
	'用户信息'=>array('index'),
	'添加',
);

$this->menu=array(
	array('label'=>'List UserProfile', 'url'=>array('index')),
	array('label'=>'Manage UserProfile', 'url'=>array('admin')),
);
?>

<h1>填写个人信息</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>