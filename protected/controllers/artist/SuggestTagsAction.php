<?php
class SuggestTagsAction extends XRenderAction
{
    public function run()
    {
        if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
        {
            $tags=Tag::model()->suggestTags($keyword);
            if($tags!==array())
                echo implode("\n",$tags);
        }
    }
}