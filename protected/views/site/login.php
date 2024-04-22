<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<h1>登录</h1>

<p>请添加如下表单登录：</p>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableAjaxValidation' => true,
    )); ?>

  <p class="note">字段 <span class="required">*</span> 是必需的。</p>

  <div class="row">
      <?php echo $form->labelEx($model, 'username'); ?>
      <?php echo $form->textField($model, 'username'); ?>
      <?php echo $form->error($model, 'username'); ?>
  </div>

  <div class="row">
      <?php echo $form->labelEx($model, 'password'); ?>
      <?php echo $form->passwordField($model, 'password'); ?>
      <?php echo $form->error($model, 'password'); ?>
    <p class="hint">
      提示: 你可以使用 <tt>admin/admin</tt> 或 <tt>test/test</tt> 登录。
    </p>
  </div>

  <div class="row rememberMe">
      <?php echo $form->checkBox($model, 'rememberMe'); ?>
      <?php echo $form->label($model, 'rememberMe'); ?>
      <?php echo $form->error($model, 'rememberMe'); ?>
  </div>

  <div class="row buttons">
      <?php echo CHtml::submitButton('Login'); ?>
      <?php
      if (Yii::app()->user->isGuest) {
          echo Chtml::link(CHtml::button('?'), array('user/forgotpassword'));
          echo CHtml::link('Register', array('user/register'));
      }
      ?>
  </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
