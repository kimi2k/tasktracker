<?php
/**
 * User: Sergey Prokhorov <sergey_prokhorov@list.ru>
 * Date: 28.05.14
 * Time: 13:38
 */
$request = Flight::request();
Flight::set('flight.views.path', getenv('DOCUMENT_ROOT') . $request->base . '/protected/views');
Flight::path(getenv('DOCUMENT_ROOT') . $request->base . '/protected/models');


if (is_readable('config.php')) {
    require_once 'config.php';
} else {

}