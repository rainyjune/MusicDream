<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-profile-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">标识为 <span class="required">*</span> 的字段必填。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'blog'); ?>
		<?php echo $form->textField($model,'blog',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'blog'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq'); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'msn'); ?>
		<?php echo $form->textField($model,'msn',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'msn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'signature'); ?>
		<?php echo $form->textField($model,'signature',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'signature'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday'); ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->radioButtonList($model,'gender',array('M'=>'男','F'=>'女','U'=>'保密'),array('separator'=>'','labelOptions'=>array('style'=>'display:inline')));?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php echo $form->textField($model,'avatar',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->