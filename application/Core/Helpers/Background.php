<?php

class Core_Helpers_Background extends Zend_View_Helper_Abstract
{

    public function background()
    {
        $textures = $this->_getAllTextures();
        $html='<ul class="toggle-background">';
        foreach ($textures as $key=>$texture)
        {
            $img = '<img src="/public/textures/'.$texture.'">';
            $span = '<span>'.$key.'</span>';
            $html.='<li id="texture-'.$key.'" title="'.$texture.'">'.$span.$img.'</li>';
        }
        return $html.'</ul>';
    }

    protected function _getAllTextures()
    {
        $texturePath = Zend_Registry::get('config')->textures->path;
        $files = scandir($texturePath);
        $textures = array();
        foreach ($files as $file)
        {
            if (($file!='..') && ($file!='.'))
            {
                $textures[]=$file;
            }
        }
        return $textures;
    }
}