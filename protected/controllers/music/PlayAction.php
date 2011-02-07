<?php
/**
 * 生成 CMP4 所需的播放列表
 */
class PlayAction extends XRenderAction
{
    public function run()
    {
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        if(isset($_GET['id']))
        {
            $code = chr(239).chr(187).chr(191)."<list>\n";
            $code .= "<m opened=\"1\" label=\"播放列表\">\n";
            $ids = explode("_",trim($_GET['id']));
            foreach($ids as $id)
            {
                $this->getController()->_model=Music::model()->findbyPk($id);
                $url =  rawurlencode($this->getController()->_model->url);
                $url = preg_replace(array('/%3A/i','/%2F/i','/%3D/i','/%27/i','/%22/i', '/%2A/i'), array(':','/','=','\'','+'), $url);
                $siteUrl='http://'.$_SERVER['HTTP_HOST'].Yii::app()->urlManager->baseUrl;
                $code .= "\t<m type=\"\" src=\"{$url}\" lrc=\"{$siteUrl}?r=music/lrc&id={$this->getController()->_model->id}\" label=\"{$this->getController()->_model->name}-{$this->getController()->_model->artist->name}\" />\n";
            }
            $code .= "</m>\n";
            $code .= "</list>";
            echo $code;
        }
        if($this->getController()->_model==null)
            throw new CHttpException(404,'您请求的页面不存在。');
    }
}