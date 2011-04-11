<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'album-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data') 
)); ?>
<?php
/*$artist_info=Artist::model()->findByPk($artist_id);
$artist_name=$artist_info->name;*/
?>
	<p class="note">字段 <span class="required">*</span> 是必需的。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_id'); ?>
		<?php //echo $form->textField($model,'menu_id'); 
			echo $form->dropDownList($model,'menu_id',Menu::getAll());
		?>
		<?php echo $form->error($model,'menu_id'); ?>
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
		<?php echo $form->labelEx($model,'artist_id'); ?>
		<?php //echo $form->textField($model,'artist_id'); 
			echo $form->dropDownList($model,'artist_id',Artist::getAll());
		?>
		<?php echo $form->error($model,'artist_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php echo $form->textField($model,'language',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'introduction'); ?>
                <?php $this->widget('ext.cleditor.ECLEditor',array('model'=>$model,'attribute'=>'introduction'))?>
		<?php echo $form->error($model,'introduction'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'picture'); ?>
		<?php //echo $form->textArea($model,'picture',array('rows'=>6, 'cols'=>50)); 
			echo $form->textField($model,'picture',array('size'=>50,'maxlength'=>255));
		?>
		<?php echo $form->error($model,'picture'); ?>
		<br />
		<?php echo $form->labelEx($model,'image'); ?>
		<?php
			echo $form->fileField($model,'image');
		?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pub_time'); ?>
		<?php //echo $form->textField($model,'pub_time'); ?>		
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'Album[pub_time]',
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
		<?php echo $form->error($model,'pub_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'top'); ?>
		<?php //echo $form->textField($model,'top',array('size'=>1,'maxlength'=>1)); 
			$data=array('0'=>'否',1=>'是');
			echo $form->radioButtonList($model,'top',$data,array('separator'=>'','labelOptions'=>array('style'=>'display:inline')));
		?>
		<?php echo $form->error($model,'top'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommend'); ?>
		<?php //echo $form->textField($model,'recommend',array('size'=>1,'maxlength'=>1)); 
			$data=array('0'=>'否',1=>'是');
			echo $form->radioButtonList($model,'recommend',$data,array('separator'=>'','labelOptions'=>array('style'=>'display:inline')));
		?>
		<?php echo $form->error($model,'recommend'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proved'); ?>
		<?php //echo $form->textField($model,'proved',array('size'=>1,'maxlength'=>1)); 
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
			'url'=>array('artist/suggestTags'),
			'minChars'=>1, 
			'multiple'=>true,
			'htmlOptions'=>array('size'=>30,'maxlength'=>50),
		)); ?>
		<?php echo $form->error($model,'_tags'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->