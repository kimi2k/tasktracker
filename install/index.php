<?php
/**
 * User: Sergey Prokhorov <sergey_prokhorov@list.ru>
 * Date: 28.05.14
 * Time: 13:49
 */

require '../protected/flight/Flight.php';
require '../protected/init.php';

Flight::set('flight.views.path', getenv('DOCUMENT_ROOT') . $request->base . '/views');

Flight::route('/', function(){
    $arr = array('title'=>'Welcome to TaskTracker Installer');
    $arr['step'] = 0;
    Flight::render("welcome",$arr,'body_content');
    Flight::render("layout");
});

Flight::route('/step1', function(){
    $arr = array('title'=>'Step1 connect with DB');
    $arr['step'] = 1;
    Flight::render("step1",$arr,'body_content');
    Flight::render("layout");
});

Flight::route('/finish', function(){
    $arr = array('title'=>'Step1 connect with DB');

    Flight::render("finish",$arr,'body_content');
    Flight::render("layout");
});
Flight::start();