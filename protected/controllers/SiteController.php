<?php
class SiteController extends Controller
{
    //public  $defaultAction='page';
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
                // captcha action renders the CAPTCHA image displayed on the contact page
                'captcha'=>array(
                        'class'=>'CCaptchaAction',
                        'backColor'=>0xFFFFFF,
                ),
                // page action renders "static" pages stored under 'protected/views/site/pages'
                // They can be accessed via: index.php?r=site/page&view=FileName
                'page'=>array(
                        'class'=>'CViewAction',
                        'defaultView'=>'about',
                ),
                'index'=>array('class'=>'application.controllers.site.IndexAction'),
                'contact'=>array('class'=>'application.controllers.site.ContactAction'),
                'login'=>array('class'=>'application.controllers.site.LoginAction'),
                'logout'=>array('class'=>'application.controllers.site.LogoutAction'),
                'offline'=>array('class'=>'application.controllers.site.OfflineAction'),
                'error'=>array('class'=>'application.controllers.site.ErrorAction'),
        );
    }

}
