<?php
$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    '联系',
);
?>
<?php
//自定义的位置导航，可用，但没有启用
/*$this->widget('application.components.BreadCrumb', array(
  'crumbs' => array(
    array('name' => '主页', 'url' => array('site/index')),
    array('name' => '联系'),
  ),
  //'delimiter' => ' &rarr; ', // if you want to change it
));*/
?>
  <h1>联系我们</h1>

<?php if (Yii::app()->user->hasFlash('contact')): ?>

  <div class="flash-success">
      <?php echo Yii::app()->user->getFlash('contact'); ?>
  </div>

<?php else: ?>

  <p>
    If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
  </p>

  <div class="form">

      <?php $form = $this->beginWidget('CActiveForm'); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

      <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'subject'); ?>
        <?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'body'); ?>
        <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
    </div>

      <?php if (extension_loaded('gd')): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'verifyCode'); ?>
          <div>
              <?php $this->widget('CCaptcha'); ?>
              <?php echo $form->textField($model, 'verifyCode'); ?>
          </div>
          <div class="hint">Please enter the letters as they are shown in the image above.
            <br />Letters are not case-sensitive.
          </div>
        </div>
      <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

      <?php $this->endWidget(); ?>

  </div><!-- form -->

<?php endif; ?>