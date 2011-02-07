<?php
$this->breadcrumbs=array(
	'Vars'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'列出变量', 'url'=>array('index')),
	array('label'=>'添加变量', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('vars-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理变量</h1>

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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'vars-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'summaryText'=>'这是 {start} 至 {end} 条，共 {count} 条记录',
	'columns'=>array(
		'id',
		'varname',
		'varvalue',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
