<?php
class LrcAction extends XRenderAction
{
    public function run()
    {
        #if($this->_model===null)
        if($this->getController()->_model===null)
        {
            if(isset($_GET['id']))
                $this->getController()->_model=Music::model()->findbyPk($_GET['id']);
            if($this->getController()->_model==null)
                throw new CHttpException(404,'您请求的页面不存在。');
        }
        echo chr(239).chr(187).chr(191).$this->getController()->_model->lyric;
    }
}