<?php
class ViewAction extends XRenderAction
{
    public function run()
    {
        $ids=$_GET['id'];
        if(is_array($ids))
            $ids=implode('_',$ids);
        if(isset($ids) && count(explode('_',$ids))==1)
        {
            $post=$this->loadModel();
            $comment=$this->newComment($post);

            $this->render('view',array(
                    'model'=>$post,
                    'comment'=>$comment,
                    'ids'=>$ids,
            ));
            exit;
        }
        $this->render('view',array('ids'=>$ids));
    }
}