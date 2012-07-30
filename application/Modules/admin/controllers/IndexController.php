<?php

class Admin_IndexController extends Core_Controller_Action
{
    protected function _replaceEol($text)
    {
        return str_replace(array("\n", "\r"), array("", ""), $text);
    }

    protected function _appendScripts()
    {
        $scripts=array();
        $scripts[] = '/manage/menu-grid.js';
        $scripts[] = '/manage/clean-url-grid.js';
        $scripts[] = '/manage/tellme-grid.js';
        $scripts[] = '/manage/consult-grid.js';
        $scripts[] = '/manage/subscription-grid.js';
        $scripts[] = '/manage/partners-grid.js';
        $scripts[] = '/manage/pages-grid.js';
        $scripts[] = '/manage/banner-grid.js';
        $scripts[] = '/manage/poll-grid.js';
        $scripts[] = '/manage/magazine-grid.js';
        $scripts[] = '/manage/magazine-previews-grid.js';

        foreach ($scripts as $value) {
            $this->view->headScript()->appendFile($this->view->layout()->appConfig->url->base . 'js' . $value, 'text/javascript');
        }
    }

    public function preDispatch()
    {
        $this->_appendScripts();
    }

    public function init()
    {
        /* Initialize action controller here */
    }

    public function     indexAction()
    {
        // action body
    }

    //Журналы
    //Работа с пользователями
    //Прочее

    private function _getOtherItems()
    {
        $menuItems = array(
            array(
                'module' => 'admin',
                'controller' => 'menu',
                'action' => 'get-menu-items',
                'result' => array(
                    'text' => 'Меню',
                    'id' => 'get-menu-items',
                    'iconCls' => 'scores-tab-icon',
                    'handler' => new Zend_Json_Expr('doAction'),
                    'disabled' => true
                )
            ),
            array(
                'module' => 'admin',
                'controller' => 'clean-url',
                'action' => 'get-clean-url-list',
                'result' => array(
                    'text' => 'Чистые ссылки',
                    'id' => 'get-clean-url',
                    'iconCls' => 'operators-tab-icon',
                    'handler' => new Zend_Json_Expr('doAction'),
                    'disabled' => true
                )
            ),
            array(
                'module' => 'admin',
                'controller' => 'partners',
                'action' => 'get-partners-list',
                'result' => array(
                    'text' => 'Партнеры',
                    'id' => 'get-partners-list',
                    'iconCls' => 'users-menu-icon',
                    'handler' => new Zend_Json_Expr('doAction'),
                    'disabled' => true
                )
            ),
            array(
                'module' => 'admin',
                'controller' => 'pages',
                'action' => 'get-pages-list',
                'result' => array(
                    'text' => 'Статические страницы',
                    'id' => 'get-pages-list',
                    'iconCls' => 'projects-menu-icon',
                    'handler' => new Zend_Json_Expr('doAction'),
                    'disabled' => true
                ),
            ),
            array(
                'module' => 'admin',
                'controller' => 'logs',
                'action' => 'get-banner-list',
                'result' => array(
                    'text' => 'Баннеры',
                    'id' => 'get-banner-list',
                    'iconCls' => 'logs-menu-icon',
                    'handler' => new Zend_Json_Expr('doAction'),
                    'disabled' => true
                ),
            ),
            array(
                'module' => 'admin',
                'controller' => 'poll',
                'action' => 'get-poll-list',
                'result' => array(
                    'text' => 'Опросы',
                    'id' => 'get-poll-list',
                    'iconCls' => 'logs-menu-icon',
                    'handler' => new Zend_Json_Expr('doAction'),
                    'disabled' => true
                ),
            ),
        );
        $this->view->menu = $this->_arrayToJson($menuItems);
        $this->view->otherMenu = $this->_replaceEol($this->view->render('index/menu.phtml'));
    }

    private function _getUserItems()
    {
        $menuItems = array(
            array(
                'module' => 'admin',
                'controller' => 'consulting',
                'action' => 'get-list',
                'result' => array(
                    'text' => 'Консультации',
                    'id' => 'get-consulting-items',
                    'iconCls' => 'scores-tab-icon',
                    'handler' => new Zend_Json_Expr('doAction'),
                    'disabled' => true
                )
            ),
            array(
                'module' => 'admin',
                'controller' => 'subscription',
                'action' => 'get-list',
                'result' => array(
                    'text' => 'Подписка',
                    'id' => 'get-subscription-items',
                    'iconCls' => 'operators-tab-icon',
                    'handler' => new Zend_Json_Expr('doAction'),
                    'disabled' => true
                )
            ),
            array(
                'module' => 'admin',
                'controller' => 'tellme',
                'action' => 'get-list',
                'result' => array(
                    'text' => 'Сообщить мне',
                    'id' => 'get-tellme-list',
                    'iconCls' => 'users-menu-icon',
                    'handler' => new Zend_Json_Expr('doAction'),
                    'disabled' => true
                )
            )
        );
        $this->view->menu = $this->_arrayToJson($menuItems);
        $this->view->userMenu = $this->_replaceEol($this->view->render('index/menu.phtml'));
    }

    private function _getMagazineItems()
    {
        $menuItems = array(
            array(
                'module' => 'admin',
                'controller' => 'magazine',
                'action' => 'get-magazine-list',
                'result' => array(
                    'text' => 'Журналы',
                    'id' => 'get-magazine-list',
                    'iconCls' => 'scores-tab-icon',
                    'handler' => new Zend_Json_Expr('doAction'),
                    'disabled' => true
                )
            ),
            array(
                'module' => 'admin',
                'controller' => 'magazine-previews',
                'action' => 'get-magazine-previews-list',
                'result' => array(
                    'text' => 'Анонсы к журналам',
                    'id' => 'get-magazine-previews-list',
                    'iconCls' => 'operators-tab-icon',
                    'handler' => new Zend_Json_Expr('doAction'),
                    'disabled' => true
                )
            )
        );
        $this->view->menu = $this->_arrayToJson($menuItems);
        $this->view->magazineMenu = $this->_replaceEol($this->view->render('index/menu.phtml'));
    }

    private function _arrayToJson($menuItems)
    {
        $resultArray = array();

            foreach ($menuItems as $value) {
                        $value['result']['disabled'] = false;
                        $resultArray[] = Zend_Json::encode(
                            $value['result'],
                            false,
                            array('enableJsonExprFinder' => true)
                        );
            }


        return $resultArray;
    }

    public function viewAction()
    {
        // Build menus with considering permissions
        $this->_getOtherItems();
        $this->_getUserItems();
        $this->_getMagazineItems();
      /*  $this->_getManageMenuItems($userId);
        $this->_getTournamentsMenuItems($userId);
        $this->_getAdminMenuItems($userId);
        $this->_getTournamentsStatsMenuItems($userId);
        $this->_getStatsMenuItems($userId);
        $this->_getReportMenuItems($userId); */
        $this->view->headTitle = 'Операторская FxFactor';
    }




}

