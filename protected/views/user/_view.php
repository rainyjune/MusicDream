<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php //echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); 
		echo CHtml::link(CHtml::encode($data->id),$data->url);
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_time')); ?>:</b>
	<?php echo CHtml::encode(date('Y-m-d',$data->created_time)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastlogin_time')); ?>:</b>
	<?php echo CHtml::encode(date('Y-m-d',$data->lastlogin_time)); ?>
	<br />


</div>