<?php
class NewCommentAction extends XRenderAction
{
    public function run()
    {
        $comment=new Comment;
        if(isset($_POST['Comment']))
        {
            $comment->attributes=$_POST['Comment'];
            if($this->getController()->loadModel()->addComment($comment))
            {
                return true;
            }
            return false;
        }
        return false;
    }
}