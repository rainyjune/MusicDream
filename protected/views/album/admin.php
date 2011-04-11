<?php
$this->breadcrumbs=array(
	'专辑'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'列出专辑', 'url'=>array('index')),
	array('label'=>'创建专辑', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('album-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理专辑</h1>

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
	'id'=>'album-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'summaryText'=>'这是 {start} 到 {end} 共 {count} 条记录',
	'columns'=>array(
		//'id',
		//'menu_id',
		array(
			'name'=>'menu_id',
			'value'=>'Menu::item($data->menu_id)',
			'filter'=>Menu::items(),
		),
		//'add_uid',
		//'sort',
		'name',
		//'artist_id',
		/*
		'company',
		'language',
		'introduction',
		'picture',
		'pub_time',
		'top',
		'recommend',
		'click',
		'add_time',
		'proved',
		
		'tag',
		*/
		array(
			'name'=>'proved',
			'value'=>'Lookup::item("PROVED",$data->proved)',
			'filter'=>Lookup::items('PROVED'),
		),
		array(
			'name'=>'add_time',
			'type'=>'datetime',
			'filter'=>false,
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
