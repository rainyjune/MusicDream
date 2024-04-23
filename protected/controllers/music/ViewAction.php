<?php
class ViewAction extends XRenderAction
{
    public function getTrackData($id) {
        $this->getController()->_model=Music::model()->findbyPk($id);
        return array(
            "id" => $this->getController()->_model->id,
            "title" => $this->getController()->_model->name,
            "lyric" => $this->getController()->_model->lyric,
            "src" => $this->getController()->_model->url
        );
    }
    public function run()
    {
        $ids=$_GET['id'];
        $ans = array();
        if(is_array($ids)) {
            foreach($ids as $id)
            {
                array_push($ans, $this->getTrackData($id));
            }
            $ids=implode('_',$ids);
        } else if (isset($ids)) {
            array_push($ans, $this->getTrackData($ids));
        }
        if(isset($ids) && count(explode('_',$ids))==1)
        {
            $post=$this->loadModel();
            $comment=$this->newComment($post);

            $this->render('view',array(
                    'model'=>$post,
                    'comment'=>$comment,
                    'ids'=>$ids,
                    'playlist' => $ans,
            ));
            exit;
        }
        $this->render('view',array('ids'=>$ids, 'playlist' => $ans));
    }
}