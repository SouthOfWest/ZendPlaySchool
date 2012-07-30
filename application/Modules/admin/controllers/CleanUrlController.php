<?php

class Admin_CleanUrlController extends Core_Controller_Action
{
    public function preDispatch()
    {
        $this->_helper->layout->disableLayout(); // layout
        $this->_helper->viewRenderer->setNoRender(); // action render
    }

    /*Метод который возвращает пары ключ-значение, предназначен для админки-меню*/

    public function getUrlsAction()
    {
        $modelCleanUrls = new Models_Db_CleanUrls();
        $items = $modelCleanUrls->getUrlsList();
        $count = $modelCleanUrls->getCount();

        foreach($items as $item)
        {
            foreach ($item as $key=>$value)
            {
                $temp[$key]=$value;
            }
            $array[]=$temp;
        }
        $this->data = array('clean-url' => $array, 'count' => $count);
        return;
    }

    public function getItemsAction()
    {
        $arrSortFields = array('id', 'module', 'controller','action','value','url');
        $start = intval($this->_request->getParam('start'));
        if($start < 0){
            $start = 0;
        }
        $limit = intval($this->_request->getParam('limit'));
        if($limit <= 0){
            $limit = 20;
        }
        $sort = strtolower(trim($this->_request->getParam('sort')));
        if(empty($sort) || array_search($sort, $arrSortFields) === false){
            $sort = 'id';
        }
        $direction = trim($this->_request->getParam('dir'));
        if(empty($direction)){
            $direction = 'DESC';
        }
        $modelCleanUrls = new Models_Db_CleanUrls();
        $items = $modelCleanUrls->getListAjax($start,$limit,$sort,$direction);
        $count = $modelCleanUrls->getCount();

        $this->data = array('items' => $items, 'count' => $count);
        return;
    }

    public function saveItemAction()
    {

        $post = $this->_request->getParams();
        $modelCleanUrl = new Models_Db_CleanUrls();
        $this->data = $modelCleanUrl->saveItem($post);
        return;
    }

    public function deleteItemAction()
    {
        $id = $this->_request->getParam('id');
        $modelCleanUrl = new Models_Db_CleanUrls();
        $this->data = $modelCleanUrl->deleteItem($id);
        return;
    }
}
