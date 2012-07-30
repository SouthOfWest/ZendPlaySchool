<?php

class Admin_ContentTypeController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $this->view->headTitle('Типы материалов');
        $modelContentType = new Models_Db_ContentType();
        $this->view->listContentType = $modelContentType->getList();

        //Список всех типов материалов с кнопками редактировать и удалить + кнопка добавить новый тип материала
    }

    public function addAction()
    {
        $this->view->form = new Models_Form_ContentType();

        //Добавление нового типа материала. Сразу обязательные поля title, description, machine_name
        //Добавлять новое поле Javascript`ом
    }

    public function editAction()
    {
        //Добавление нового типа материала. Сразу обязательные поля title, description, machine_name
        //Добавлять новое поле Javascript`ом
    }

    public function deleteAction()
    {
        //Добавление нового типа материала. Сразу обязательные поля title, description, machine_name
        //Добавлять новое поле Javascript`ом
    }

    /**
     * Shows the dynamic form demonstration page
     */
    public function dynamicFormElementsAction() {

        $form = new Models_Form_ContentType();
        // Form has not been submitted - pass to view and return
        if (!$this->getRequest()->isPost()) {
            $this->view->form = $form;
            return;
        }


        // Form has been submitted - run data through preValidation()
        $form->preValidation($_POST);

        // If the form doesn't validate, pass to view and return
        if (!$form->isValid($_POST)) {
            $this->view->form = $form;
            return;
        }

        // Form is valid
        $this->view->form = $form;
    }

    /**
     * Ajax action that returns the dynamic form field
     */
    public function newfieldAction() {

        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('newfield', 'html')->initContext();

        $id = $this->_getParam('id', null);

        $element = new Zend_Form_Element_Text("newName$id");
        $element->setRequired(true)->setLabel('Name');

        $this->view->field = $element->__toString();
    }
}
