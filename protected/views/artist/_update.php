<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'artist-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data') 
)); ?>

	<p class="note">字段 <span class="required">*</span> 是必需的。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type_id'); ?>
		<?php //echo $form->textField($model,'type_id'); 
			echo $form->dropDownList($model,'type_id',ArtistType::getAll());
		?>
		<?php echo $form->error($model,'type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'area_id'); ?>
		<?php //echo $form->textField($model,'area_id'); 
			echo $form->dropDownList($model,'area_id',ArtistArea::getAll());
		?>
		<?php echo $form->error($model,'area_id'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'picture'); ?>
		<?php //echo $form->textArea($model,'picture',array('rows'=>6, 'cols'=>50)); 
			echo $form->textField($model,'picture',array('size'=>50,'maxlength'=>255));
		?>
		<br />
		<?php echo $form->labelEx($model,'image'); ?>
		<?php
			echo $form->fileField($model,'image');
		?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php //echo $form->textField($model,'birthday',array('size'=>60,'maxlength'=>255)); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'Artist[birthday]',
	'value'=>$model->birthday,
    // additional javascript options for the date picker plugin
    'options'=>array(
        //'showAnim'=>'fold',
        'dateFormat'=>'yy-mm-dd',
        'showAnim'=>'slideDown',
        'showButtonPanel'=>'true',
        'constrainInput'=>'false',

    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'native_place'); ?>
		<?php echo $form->textField($model,'native_place',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'native_place'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'intro'); ?>
		<?php $this->widget('ext.cleditor.ECLEditor',array('model'=>$model,'attribute'=>'intro'))?>
		<?php echo $form->error($model,'intro'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'proved'); ?>
		<?php
			$data=array('0'=>'否',1=>'是');
			echo $form->radioButtonList($model,'proved',$data,array('separator'=>'','labelOptions'=>array('style'=>'display:inline')));
		?>
		<?php echo $form->error($model,'proved'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'_tags'); ?>
		<?php $this->widget('CAutoComplete', array(
			'model'=>$model,
			'attribute'=>'_tags',
			'url'=>array('suggestTags'),
			'minChars'=>1,
			'multiple'=>true,
			'htmlOptions'=>array('size'=>30,'maxlength'=>50),
		)); ?>
		<?php echo $form->error($model,'_tag'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
