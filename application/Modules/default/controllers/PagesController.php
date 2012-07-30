<?php

class PagesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

    }

    public function viewAction()
    {
        $id = $this->_request->getParam('value');
        $modelPages=new Models_Db_Pages();
        $result = $modelPages->findById($id);
        $this->view->content=$result;
        $this->view->headTitle($result['name']);
    }
}

