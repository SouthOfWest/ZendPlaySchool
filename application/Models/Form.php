<?php

/**
 * Models_Form
 * 
 * Все формы будут наследоваться от этого класса.
 *
 */
class Models_Form extends Zend_Form
{
    /**
     * Инициализация формы
     * 
     * return void
     */  
    public function init()
    {
        // Вызов родительского метода
        parent::init();
        
        // Создаем объект переводчика, он нам необходим для перевода сообщений об ошибках.
        // В качестве адаптера используется php массив
        $translator = new Zend_Translate('array', Zend_Registry::get('config')->path->languages . 'errors.php');
        
        // Задаем объект переводчика для формы
        $this->setTranslator($translator);
        
    }
}