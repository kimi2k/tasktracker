<?php
/**
 * User: Sergey Prokhorov <sergey_prokhorov@list.ru>
 * Date: 28.05.14
 * Time: 13:38
 */

$request = Flight::request();
Flight::set('flight.views.path', getenv('DOCUMENT_ROOT') . $request->base . '/protected/views');
Flight::path(getenv('DOCUMENT_ROOT') . 'protected/models');

if (is_readable('config.php')) {
    require_once 'config.php';
} else {
    Flight::render("error",array('File config.php not found'));
}

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=tasktrack','root','1'));
Flight::set('db', $db=Flight::db());