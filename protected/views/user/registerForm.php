<?php
return array(
    'elements'=>array(
        'user'=>array(
            'type'=>'form',
            'title'=>'登陆信息',
            'elements'=>array(
                'username'=>array(
                    'type'=>'text',
                    'maxlength'=>30,
                ),
                'password'=>array(
                    'type'=>'password',
                    'maxlength'=>40,
                ),
                'password_repeat'=>array(
                    'type'=>'password',
                    'maxlength'=>40,
                ),
                'email'=>array(
                    'type'=>'text',
                    'maxlength'=>100,
                ),
                'verifyCode'=>array(
                    'type'=>'text',
                    'maxlength'=>100,
                ),
                //UserController::widget('CCaptcha'),
                Yii::app()->controller->widget("CCaptcha",array(), true),
            ),
        ),
        Chtml::link('详细信息','#',array('id'=>'profileToggle')),
        '<div id="userprofileForm">',
        'profile'=>array(
            'type'=>'form',
            'title'=>'详细信息',
            'elements'=>array(
                'blog'=>array(
                    'type'=>'text',
                ),
                'qq'=>array(
                    'type'=>'text',
                ),
                'msn'=>array(
                    'type'=>'text',
                ),
                'signature'=>array(
                    'type'=>'text',
                ),
                'birthday'=>array(
                    'type'=>'text',
                ),
                'gender'=>array(
                    'type'=>'radiolist',
                    'items'=>  UserProfile::model()->getGenderOptions(),
                    'prompt'=>'Please select:',
                    'separator'=>'',
                    'labelOptions'=>array('style'=>'display:inline')
                ),
                'avatar'=>array(
                    'type'=>'text',
                ),
            ),
        ),
        '</div>',
    ),
    
    'buttons'=>array(
        'register'=>array(
            'type'=>'submit',
            'label'=>'Register',
        ),
    ),

);
?>