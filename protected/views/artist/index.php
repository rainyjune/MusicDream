<?php
$this->breadcrumbs=array(
	'艺术家',
);

$this->menu=array(
	array('label'=>'增加艺术家', 'url'=>array('create')),
	array('label'=>'管理艺术家', 'url'=>array('admin')),
);

$artists=array();
$sortData=array();
foreach ($dataProvider->rawData as &$value)
{
	$sortData[]=$value->sort;
    $artists[$value->sort][]=$value;
}

$nav=range('A','Z');
array_unshift($nav,'0-9');
echo "<div class='view'>";
echo $regionData->name.$typeData->name."&nbsp;";
foreach($nav as $_a)
{
	if(in_array($_a,$sortData))
		echo "<a href='#$_a'>$_a</a>&nbsp;&nbsp;";
	else
		echo $_a."&nbsp;&nbsp;";
}
echo "</div>";

foreach ($artists as $sort=>$artist) {
    echo '<div class="view">';
	echo "<a name='$sort'></a>";
    echo "<h3>$sort</h3>";
    foreach ($artist as $artist_item) {
        echo CHtml::link(CHtml::encode($artist_item->name),array('artist/view','id'=>$artist_item->id));
        echo '&nbsp;';
    }
    echo '</div>';
}
?>
