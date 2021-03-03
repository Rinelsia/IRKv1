<?php
const DIR = __DIR__;

// запуск загрузчика
// require_once __DIR__."\loader\loader.php";
// require_once __DIR__.'\Controllers\start.php';
// запуск файла для работы с фар архивом. Это нужно для того чтобы извлечь данные из композера. 
// может быть верменным решением
// require_once __DIR__.'/phar.php';
// закуск композера
include DIR.'/Vendor/autoload.php';

$log = new Monolog\Logger('name');
$log->pushHandler(new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING));
$log->addWarning('Foo');

 ?>