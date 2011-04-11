<?php
$this->menu=array(
    array('label'=>'创建用户', 'url'=>array('create')),
    array('label'=>'管理用户', 'url'=>array('admin')),
    );
$this->layout="column2";
?>
<h1>用户注册</h1>
<?php
Yii::app()->clientScript->registerScript('register_toggle', "
$('#userprofileForm').hide();
$('#profileToggle').click(function(){
	$('#userprofileForm').toggle();
	return false;
});
");
?>

<div class="form">
<?php echo $form; ?>
</div>