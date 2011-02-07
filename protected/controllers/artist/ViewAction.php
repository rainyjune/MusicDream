<?php
class ViewAction extends XRenderAction
{
    public function run()
    {
        $post=$this->loadModel();//载入当前的 model
        $comment=$this->newComment($post);

        $this->render('view',array(
                'model'=>$post,
                'comment'=>$comment,
        ));
    }
}