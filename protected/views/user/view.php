<?php
$this->breadcrumbs=array(
	'用户'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'列出用户', 'url'=>array('index')),
	array('label'=>'添加用户', 'url'=>array('create')),
	array('label'=>'更新用户', 'url'=>array('update', 'id'=>$model->id,'from'=>'dashboard')),
	array('label'=>'删除用户', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理用户', 'url'=>array('admin')),
);
if(!isset ($_GET['from']) || $_GET['from']!="dashboard"){
    $this->menu=array(
        array('label'=>'更新登陆信息','url'=>array('update','id'=>$model->id)),
        //array('label'=>'更新档案信息','url'=>array('/userProfile/update','id'=>$model->id)),
    );
    $appendArray=array(array('label'=>'填写档案信息','url'=>array('/userProfile/create','id'=>$model->id)));
    if($model->profile)
        $appendArray=array(array('label'=>'更新档案信息','url'=>array('/userProfile/update','id'=>$model->id)));
    $this->menu=array_merge($this->menu, $appendArray);
    $this->layout='userLayout';
}
?>

<h1>查看用户 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		//'password',
		'email',
		'created_time:date',
		'lastlogin_time:date',
	),
)); ?>
<h2>用户信息：</h2>
<?php
if($model->profile){
$avatar=$model->profile->avatar;
/* echo '<pre>';
var_dump($model->profile->avatar);
echo '</pre>';exit; */
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model->profile,
	'attributes'=>array(
		'blog',
		'qq',
		'msn',
		'signature',
		'birthday',
        'gender',
        //'avatar',
		array(               // related city displayed as a link
            'label'=>'avatar',
            'type'=>'raw',
            'value'=>"<img src='$avatar' />",
        ),
	),
));
}


//var_dump($model->profile);
?>