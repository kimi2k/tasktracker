<?php
/**
 * User: Sergey Prokhorov <sergey_prokhorov@list.ru>
 * Date: 28.05.14
 * Time: 13:35
 */

require 'protected/flight/Flight.php';
require 'protected/init.php';

Flight::route('/', function(){
    $arr = array();
    $arr['jsModules'] = array('mod.taskFilter', 'mod.tasklist');

    Flight::render("index",$arr,"body_content");
    Flight::render("layout");
});
//POST
Flight::route('POST /ajax/tasks', function(){

    Flight::register('Tasks', 'Tasks',array(Flight::get('db')));
    $tasks = Flight::Tasks();
    if (isset($_REQUEST['action'])) {
        switch($_REQUEST['action']) {
            case 'getList':
                $params = array();
                if (isset($_REQUEST['created'])) {
                    $params['%created'] = $_REQUEST['created'];
                }
                $list = $tasks->getList($params);
                Flight::json($list);
                break;
            case 'add':

                break;
            case 'delete':

                break;
            case 'update':

                break;
        }
    }
});

Flight::start();