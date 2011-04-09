<p><strong>最新专辑</strong></p>
<div style="clear:both;width:100%">
<?php foreach(Album::model()->published()->recently()->findAll() as $album):?>
	<div style="float:left;text-align:center;">
		<?php echo CHtml::link(CHtml::image($album->picture,$album->name,array('width'=>'90','height'=>'90')),array('album/view','id'=>$album->id));?>
		<p><?php echo CHtml::link($album->name,array('album/view','id'=>$album->id));?></p>
		<p><?php echo CHtml::link($album->artist->name,array('artist/view','id'=>$album->artist->id));?></p>
	</div>
<?php endforeach;?>
</div>
<hr />
