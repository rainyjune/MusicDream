<ul>
<?php
$artistAreas=ArtistArea::model()->findAll();
//echo '<pre>';
//var_dump($artistAreas);
foreach($artistAreas as $area)
{
	echo '<li>';
	echo '<ul>';
	echo '<b>'.$area->name.'</b>';
	echo '<li>';
	echo CHtml::link('女歌手',array('artist/index','region'=>$area->id,'type'=>2));
	echo '</li>';
	echo '<li>';
	echo CHtml::link('男歌手',array('artist/index','region'=>$area->id,'type'=>1));
	echo '</li>';
	echo '<li>';
	echo CHtml::link('乐队组合',array('artist/index','region'=>$area->id,'type'=>3));
	echo '</li>';
	echo '</ul>';
	echo '</li>';
}
?>
</ul>