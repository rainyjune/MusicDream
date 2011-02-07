<?php
class Forgotpassword extends CFormModel
{
    public $email;
    //private $_identity;

    public function  rules()
    {
        return array(
            array('email','required'),
            array('email','email'),
            //array('email','emailregistered'),
            //array('email','emailregistered'),
        );
    }
    public function emailregistered()
    {
        $user=User::model()->findByAttributes(array('email'=>$this->email));
        return $user;
    }
    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
                'email'=>'Email',
        );
    }
    public  function resetpwd()
    {
        $newPwdSource=substr(md5(rand()), 0, 11);
        $newPwd=md5($newPwdSource);
        User::model()->updateAll(array('password'=>$newPwd), "email='$this->email'");
        return $newPwdSource;
    }
}