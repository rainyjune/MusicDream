<?php
class ForgotpasswordAction extends XRenderAction
{
    public function run()
    {
        $model=new Forgotpassword;
        if(isset ($_POST['Forgotpassword']))
        {
            $model->attributes=$_POST['Forgotpassword'];
            if($model->validate() && $model->emailregistered())
            {
                $newpwd=$model->resetpwd();
                $body='Your new password:'.$newpwd;
                $subject='Your new password at MusicDream';
                require_once(Yii::getPathOfAlias('application').'/components/functions.php');
                if(!mailer_mail($model->email, $subject, $body)) {
                    $contactMsg='Error.';
                }
                else {
                    $contactMsg='您的密码已经发送到信箱，请注意查收。';
                }
                Yii::app()->user->setFlash('forgotpassword',$contactMsg);
                $this->refresh();
            }   
            else
                $model->addError ('email', 'Email 不存在');
        }
        $this->render('forgotpassword',array('model'=>$model));
    }
}