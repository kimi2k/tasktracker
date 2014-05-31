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
    $arr['jsModules'] = array('mod.taskFilter', 'mod.tasks', 'mod.categories');
    Flight::register('Categories', 'Categories',array(Flight::get('db')));
    $categories = Flight::Categories();
    $arr['categories'] = $categories->getList();
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
                $params = $_REQUEST;
                unset($params['action']);
                $res = $tasks->add($params);
                if ($res) {
                    Flight::json(array("error"=>false));
                } else {
                    Flight::json(array("error"=>true, "errorDescription"=>'DB error'));
                }
                break;
            case 'delete':
                $res = $tasks->delete($_POST['id']);
                if ($res) {
                    Flight::json(array("error"=>false));
                } else {
                    Flight::json(array("error"=>true, "errorDescription"=>'DB error'));
                }
                break;
            case 'update':

                break;
        }
    }
});

Flight::route('/ajax/categories', function() {
    Flight::register('Categories', 'Categories',array(Flight::get('db')));
    $categories = Flight::Categories();
    switch($_REQUEST['action']) {
        case 'getList':
            $params = array();
            if (isset($_REQUEST['created'])) {
                $params['%created'] = $_REQUEST['created'];
            }
            $list = $categories->getList($params);
            Flight::json($list);
            break;
        case 'add':
            $r = $categories->add(array('title'=>$_REQUEST['title'], 'description'=>$_REQUEST['description']));
            var_dump($r);
            break;
        case 'delete':

            break;
        case 'update':

            break;
    }
});

Flight::start();