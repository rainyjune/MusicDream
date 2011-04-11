<?php
$this->breadcrumbs=array(
	'音乐'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'列出音乐', 'url'=>array('index')),
	array('label'=>'管理音乐', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('music-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理音乐</h1>

<p>
你可以在每个搜索值之前输入一个对比符 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
或 <b>=</b>) ，以指定对比如何完成。
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'music-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'summaryText'=>'这是 {start} 到 {end} 共 {count} 条记录',
	'columns'=>array(
		//'id',
		'name',
		array(
			'name'=>'menu_id',
			'value'=>'Menu::item($data->menu_id)',
			'filter'=>Menu::items(),
		),
		//'album_id',
		//'artist_id',
		//'add_uid',
		/*
		'order',
		'click',
		'add_time',
		'lyric',
		'url',
		'recommend',
		'top',
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
