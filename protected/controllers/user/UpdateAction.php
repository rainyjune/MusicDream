<?php
class UpdateAction extends XRenderAction
{
    public function run()
    {
        $model=$this->loadModel();

        //提供当前用户的信息

        $params=array('user'=>$model->id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['User']))
        {
            if($_POST['User']['password']!=''){
                    $_POST['User']['password']=md5($_POST['User']['password']);
            }
            else{
                    $_POST['User']['password']=$model->password;
            }
            $model->attributes=$_POST['User'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
                'model'=>$model,
        ));
    }
}