<?php

// Установка глобальных переменных и параметров отображения ошибок
define('TIME_START', microtime(true));

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('DIR_HOME', realpath(dirname(__FILE__)) . DS);
define('DIR_CORE', DIR_HOME . 'Core' . DS);
define('DIR_VIEW', DIR_HOME . 'views' . DS);


// Загрузка файла настроек
$ini = parse_ini_file('config.ini');

// Функция для получения значений настроек
function env(string $key): string {

    global $ini;

    if(array_key_exists($key, $ini))
        return $ini[$key];
    else
        return '';

}


// Функция вызов вьюхи
function view(string $view, array $strings = []) {

    $sPath = DIR_VIEW . $view . '.php';

    if(file_exists($sPath)) {
        extract($strings);
        ob_start();
        include $sPath;
        return ob_get_clean();
    }
    else
        die("View error: can't load view {$view}\n");

}


// Автозагрузчик классов
spl_autoload_register(function ($sClass) {

    $sPath = DIR_CORE . $sClass . '.php';

    if(file_exists($sPath))
        require_once $sPath;
    else
        die("Autoloader error: can't load class {$sClass}\n");

});
