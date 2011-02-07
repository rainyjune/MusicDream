<?php
class ContactAction extends XRenderAction
{
    public function  run()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                require_once(Yii::getPathOfAlias('application').'/components/functions.php');
                if(!mailer_mail(Yii::app()->params['adminEmail'], $model->subject, $model->body,$model->email,$model->name)) {
                    $contactMsg='Error.';
                }
                else {
                    $contactMsg='Thank you for contacting us. We will respond to you as soon as possible.';
                }
                Yii::app()->user->setFlash('contact',$contactMsg);
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }
}