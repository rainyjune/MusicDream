<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vars-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">字段 <span class="required">*</span> 是必需的。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'varname'); ?>
		<?php echo $form->textField($model,'varname',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'varname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'varvalue'); ?>
		<?php echo $form->textField($model,'varvalue',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'varvalue'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->