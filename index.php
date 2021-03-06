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
    $arr['jsModules'] = array('mod.timer','mod.taskFilter', 'mod.tasks', 'mod.categories');
    Flight::register('Categories', 'Categories',array(Flight::get('db')));
    $arr['categories'] = Flight::Categories()->getList();
    Flight::render("index",$arr,"body_content");
    Flight::render("layout");
});

Flight::route('/statistics', function(){
    Flight::register('Statistics', 'Statistics',array(Flight::get('db')));
    $arr = array();
    $arr['jsModules'] = array('mod.statistics');
    $arr['month'] = date('m');
    $arr['year'] = date('Y');
    if (isset($_REQUEST['month'])) {
        $arr['month'] =$_REQUEST['month'];
    }
    if (isset($_REQUEST['year'])) {
        $arr['year'] = $_REQUEST['year'];
    }
    $start = mktime(0,0,0,$arr['month'],1,$arr['year']);
    $end = mktime(0,0,0,$arr['month'],date('t',$start),$arr['year']);

    $arr['list'] = Flight::Statistics()->getTimeByProject($start, $end);
    Flight::render("statistics",$arr,"body_content");
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
                if (isset($_REQUEST['categories'])) {
                    $params['INcat_id'] = $_REQUEST['categories'];
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
            case 'update':
                $params = $_REQUEST;
                unset($params['action']);
                $res = $tasks->update($_REQUEST['id'], $params);
                break;
            case 'delete':
                $res = $tasks->delete($_POST['id']);
                if ($res) {
                    Flight::json(array("error"=>false));
                } else {
                    Flight::json(array("error"=>true, "errorDescription"=>'DB error'));
                }
                break;
            case 'getworktime':
                if (isset($_POST['date'])) {
                    $seconds = $tasks->getWorkTime($_POST['date']);
                    Flight::json(array('seconds'=>$seconds));
                } else {
                    Flight::json(array("error"=>true, "errorDescription"=>'date missing'));
                }
                break;
            case 'start':
                if (isset($_POST['id'])) {
                    $r = $tasks->startTask($_POST['id']);
                    Flight::json(array('result'=>$r));
                } else {
                    Flight::json(array("error"=>true, "errorDescription"=>'task id is missing'));
                }
                break;
            case 'pause':
                if (isset($_POST['id'])) {
                    $r = $tasks->pauseTask($_POST['id']);
                    Flight::json(array('result'=>$r));
                } else {
                    Flight::json(array("error"=>true, "errorDescription"=>'task id is missing'));
                }
                break;
            case 'finish':
                if (isset($_POST['id'])) {
                    $r = $tasks->finishTask($_POST['id']);
                    Flight::json(array('result'=>$r));
                } else {
                    Flight::json(array("error"=>true, "errorDescription"=>'task id is missing'));
                }
                break;
            case 'revert':
                if (isset($_POST['id'])) {
                    $r = $tasks->revertTask($_POST['id']);
                    Flight::json(array('result'=>$r));
                } else {
                    Flight::json(array("error"=>true, "errorDescription"=>'task id is missing'));
                }
                break;
            default:
                Flight::json(array("error"=>true,"errorDescription"=>"Unknown action"));
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