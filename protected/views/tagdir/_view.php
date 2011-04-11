<div class="view">

	<p><strong><?php echo CHtml::encode($data->name); ?></strong></p>
	<br />
	<?php
	foreach($data->tags as $tag)
	{
		echo CHtml::link($tag->name,array('tag/view','id'=>$tag->id))."(".count($tag->items).")";
	}
	?>
</div>
