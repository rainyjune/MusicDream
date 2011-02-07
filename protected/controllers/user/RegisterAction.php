<?php
class RegisterAction extends XRenderAction
{
    public function run()
    {
        if(!Yii::app()->user->isGuest)//若用户不是匿名用户，转到主页
        {
                $this->redirect('index.php');
        }
        $form = new CForm('application.views.user.registerForm');
        $form['user']->model = new User('register');
        $form['profile']->model = new UserProfile();
        if($form->submitted('register') && $form->validate())
        {
            $user = $form['user']->model;
            $profile = $form['profile']->model;
            if($user->save(false))
            {
                $profile->id = $user->id;
                $profile->save(false);
                $this->redirect(array('site/index'));
            }
        }
         else{
            $this->render('register', array('form'=>$form));
        }
    }
}