<?php

class Admin_PagesController extends Core_Controller_Action
{
    public function preDispatch()
    {
        $this->_helper->layout->disableLayout(); // layout
        $this->_helper->viewRenderer->setNoRender(); // action render
    }

    public function getItemsAction()
    {
        $arrSortFields = array('id','name','text');
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
        $modelPages = new Models_Db_Pages();
        $items = $modelPages->getListAjax($start,$limit,$sort,$direction);
        $count = $modelPages->getCount();

        $this->data = array('items' => $items, 'count' => $count);
        return;
    }
    public function saveItemAction()
    {
        $post = $this->_request->getParams();
        $modelPages = new Models_Db_Pages();
        $result = $modelPages->saveItem($post);
        if ($result) {
            $this->data = array('success'=>true);
        } else {
            $this->data = array('error'=>'Сохранение не удалось');
        }
    }

    public function deleteItemAction()
    {
        $id = $this->_request->getParam('id');
        $modelPages = new Models_Db_Pages();
        $this->data = $modelPages->deleteItem($id);
        return;
    }

    public function getItemAction()
    {
        $id = $this->_request->getParam('id');
        $modelPages = new Models_Db_Pages();
        $modelCleanUrl = new Models_Db_CleanUrls();
        $this->data = $modelPages->getItem($id);
        $this->data['url']= $modelCleanUrl->getUrlByValue($id);
        return;
    }
}
