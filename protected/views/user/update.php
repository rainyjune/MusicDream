<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'列出用户', 'url'=>array('index')),
	array('label'=>'添加用户', 'url'=>array('create')),
	array('label'=>'查看用户', 'url'=>array('view', 'id'=>$model->id,'from'=>'dashboard')),
	array('label'=>'管理用户', 'url'=>array('admin')),
);
if(!isset ($_GET['from']) || $_GET['from']!="dashboard"){
    $this->menu=array(
        array('label'=>'更新登陆信息','url'=>array('update','id'=>$model->id)),
        array('label'=>'更新档案信息','url'=>array('/userProfile/update','uid'=>$model->id)),
    );
    $this->layout='userLayout';
}
?>

<h1>更新用户 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>