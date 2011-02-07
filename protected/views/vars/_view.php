<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('varname')); ?>:</b>
	<?php echo CHtml::encode($data->varname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('varvalue')); ?>:</b>
	<?php echo CHtml::encode($data->varvalue); ?>
	<br />


</div>