<?php
/**
 * User: Sergey Prokhorov <sergey_prokhorov@list.ru>
 * Date: 28.05.14
 * Time: 13:35
 */

require 'protected/flight/Flight.php';
require 'protected/init.php';

Flight::set('flight.views.path', getenv('DOCUMENT_ROOT') . $request->base . '/protected/views');

Flight::route('/', function(){
    $arr = array();
    $arr['jsModules'] = array('mod.taskFilter');
    Flight::render("index",$arr,"body_content");
    Flight::render("layout");
});

Flight::start();