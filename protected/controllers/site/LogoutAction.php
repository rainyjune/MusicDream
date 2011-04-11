<?php
class LogoutAction extends XRenderAction
{
    public function run()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}