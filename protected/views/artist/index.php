<?php
$this->breadcrumbs=array(
	'艺术家',
);

$this->menu=array(
	array('label'=>'增加艺术家', 'url'=>array('create')),
	array('label'=>'管理艺术家', 'url'=>array('admin')),
);

$artists=array();
foreach ($dataProvider->rawData as &$value)
{
    $artists[$value->sort][]=$value;
}
foreach ($artists as $sort=>$artist) {
    echo '<div class="view">';
    echo "<h3>$sort</h3>";
    foreach ($artist as $artist_item) {
        echo CHtml::link(CHtml::encode($artist_item->name),array('artist/view','id'=>$artist_item->id));
        echo '&nbsp;';
    }
    echo '</div>';
}
?>