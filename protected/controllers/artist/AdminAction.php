<?php
class AdminAction extends XRenderAction
{
    public function run()
    {
        $model=new Artist('search');
        //用于高级搜索时制定查询参数
        if(isset($_GET['Artist']))
                $model->attributes=$_GET['Artist'];
        $this->render('admin',array(
                'model'=>$model,
        ));
    }
}