<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Глобальная конфигурация приложения считанная из конфигурационного файла.
     *
     * @var Zend_Config
     */
    protected $_config = null;

    /**
     * @var Zend_Db_Adapter_Abstract
     */
    protected $_dbAdapter = null;


    /**
     * Инициализация автозагрузки классов. Подключение дополнительных неймспейсов.
     *
     */
    protected function _initAppAutoload()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('Core_');
        $autoloader->registerNamespace('Models_');
    }

    protected function _initConfig()
    {
        $this->_config = new Zend_Config($this->getOptions());
        Zend_Registry::set('config', $this->_config);
    }

    /**
     * Производит инициализацию адаптера базы данных.
     *
     */
    protected function _initDbAdapter()
    {
        $this->_dbAdapter = Zend_Db::factory($this->_config->db);
        Zend_Db_Table_Abstract::setDefaultAdapter($this->_dbAdapter);
        Zend_Registry::set('db', $this->_dbAdapter);
    }

    /**
     * Метод инициализирует роутер.
     *
     */
    protected function _setRouter()
    {
        require(Zend_Registry::get('config')->path->core . 'Router.php');
        return $router;
    }
    /*
    * Инициализируем объект навигатора и передаем его в View
    *
    * @return Zend_Navigation
    */
    public function _initNavigation()
    {
        // Бутстрапим View
        $this->bootstrapView();
        $view = $this->getResource('view');

        // Структура простого меню (можно вынести в XML)
        $pages = array(
            array(
                'controller'	=> 'index',
                'label'         => _('Главная страница'),
            ),
            array(
                'controller'	=> 'users',
                'action'        => 'index',
                'label'         => _('Обо мне'),
            ),
            array (
                'controller'	=> 'users',
                'action'        => 'registration',
                'label'         => _('Полезный код'),
            ),
            array (
                'controller'	=> 'users',
                'action'        => 'login',
                'label'         => _('Полезные ссылки'),
            ),
            array (
                'controller'	=> 'users',
                'action'        => 'logout',
                'label'         => _('Игра'),
            )
        );

        // Создаем новый контейнер на основе нашей структуры
        $container = new Zend_Navigation($pages);
        // Передаем контейнер в View
        $view->menu = $container;

        return $container;
    }

    protected function _initMain()
    {
        Zend_Session::start();

        $router = $this->_setRouter();
        $front = Zend_Controller_Front::getInstance();
        $front->setBaseUrl(Zend_Registry::get('config')->url->base)
            ->throwexceptions(true)
            ->setRouter($router);

        //Устнавливаем doctype
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');

        //Инициализируем хелперы
        $view->setHelperPath(APPLICATION_PATH.'/Core/Helpers', 'Core_Helpers');
    }
}

