<div class="view">

	<?php echo CHtml::link(CHtml::image($data->picture,CHtml::encode($data->picture),array('height'=>'100px','width'=>'80px')),$data->url); ?>
	<br />

	<?php echo CHtml::link("《".CHtml::encode($data->name)."》",array('album/view','id'=>$data->id)); ?>
	<br />

	<p><?php echo Chtml::encode($data->artist->name);?> 于 <?php echo $data->pub_time;?> 推出.其中包含：
		<?php foreach($data->musics as $music):?>
			<?php echo $music->name."&nbsp;";?>
		<?php endforeach;?>
	</p>
</div>
