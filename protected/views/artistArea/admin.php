<?php
$this->breadcrumbs=array(
	'艺术家地区'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'列出艺术家地区', 'url'=>array('index')),
	array('label'=>'增加艺术家地区', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('artist-area-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理艺术家地区</h1>

<p>
你可以在搜索值之前使用对比符 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) 以指定如何完成对比。
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="flash-success"><?php echo Yii::app()->user->getFlash('success'); ?></div>
<?php elseif(Yii::app()->user->hasFlash('error')): ?>
    <div class="flash-error"><?php echo Yii::app()->user->getFlash('error'); ?></div>
<?php endif;?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'artist-area-grid',
	'ajaxUpdate'=>false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'summaryText'=>'这是 {start} 到 {end} 共 {count} 条记录',
	'columns'=>array(
		'id',
		'name',
		'intro',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
