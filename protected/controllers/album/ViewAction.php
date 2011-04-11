<?php
class ViewAction extends XRenderAction
{
    public function run()
    {
        $post=$this->loadModel();
        $comment=$this->newComment($post);

        $this->render('view',array(
                'model'=>$post,
                'comment'=>$comment,
        ));
    }
}