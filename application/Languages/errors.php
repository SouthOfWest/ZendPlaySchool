<?php 

/**
 * Файл с переводами сообщений об ошибках
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */

return $errors = array (

    Zend_Validate_Alnum::NOT_ALNUM     => "Значение содержит запрещенные символы. Разрешены символы латиници, кирилици, цифры и пробел",
    Zend_Validate_Alnum::STRING_EMPTY  => "Поле не может быть пустым",

    Zend_Validate_Date::INVALID        => 'Неверная дата',   
    Zend_Validate_Date::FALSEFORMAT    => 'Значение не соответствует указанному формату',   
     
    Zend_Validate_EmailAddress::INVALID            => "Не верный формат адреса электронной почты. Введите почту в формате local-part@hostname",
    Zend_Validate_EmailAddress::INVALID_HOSTNAME   => "'%hostname%' не верный домен для адреса электронной почты '%value%'",
    Zend_Validate_EmailAddress::INVALID_MX_RECORD  => "'%hostname%' не имеет MX-записи об адресе электронной почты '%value%'",
    Zend_Validate_EmailAddress::DOT_ATOM           => "'%localPart%' не соответствует формату dot-atom",
    Zend_Validate_EmailAddress::QUOTED_STRING      => "'%localPart%' не соответствует формату quoted-string",
    Zend_Validate_EmailAddress::INVALID_LOCAL_PART => "'%localPart%' не верное имя для адреса электронной почты '%value%'",
    Zend_Validate_EmailAddress::INVALID_FORMAT     => "Неверный формат email адреса",

    Zend_Validate_Int::NOT_INT => 'Значение не является целочисленным значением',   
     
    Zend_Validate_NotEmpty::IS_EMPTY => 'Поле не может быть пустым',
     
    Zend_Validate_StringLength::TOO_SHORT => 'Длина введённого значения меньше чем %min% символов',   
    Zend_Validate_StringLength::TOO_LONG  => 'Длина введённого значения больше чем %max% символов',   

    Zend_Captcha_Word::BAD_CAPTCHA   => 'Вы указали не верные символы',
    Zend_Captcha_Word::MISSING_VALUE => 'Поле не может быть пустым',


    Zend_Validate_Regex::NOT_MATCH => 'Вы использовали недопустимый символ',

 );
