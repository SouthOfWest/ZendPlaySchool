<?php

class Core_Helpers_Config extends Zend_View_Helper_Abstract
{
    public function config()
    {
        return Zend_Registry::get('config');
    }
}