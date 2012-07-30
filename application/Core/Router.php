<?php

$router = new Zend_Controller_Router_Rewrite();

// Инициализация маршрутов с БД
$modelCleanUrls = new Models_Db_CleanUrls();
$cleanUrlsList = $modelCleanUrls->getList();

foreach ($cleanUrlsList as $value)
{
    $routeArray=array();
    $url = $value['url'];
    foreach ($value as $key=>$item)
    {
        if($value) $routeArray[$key]=$item;
    }
    $route = new Zend_Controller_Router_Route($url, $routeArray);

    $router->addRoute($url,$route);

}

