<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu_id')); ?>:</b>
	<?php echo CHtml::encode($data->menu->menu_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add_uid')); ?>:</b>
	<?php echo CHtml::encode($data->addUser->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('artist_id')); ?>:</b>
	<?php echo CHtml::encode($data->artist->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company')); ?>:</b>
	<?php echo CHtml::encode($data->company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('picture')); ?>:</b>
	<?php //echo CHtml::encode($data->picture); ?>
	<?php echo CHtml::link(CHtml::image($data->picture,CHtml::encode($data->picture),array('height'=>'100px','width'=>'80px')),$data->url); ?>
	<br />

</div>