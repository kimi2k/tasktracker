<?php
/**
 * User: Sergey Prokhorov <sergey_prokhorov@list.ru>
 * Date: 28.05.14
 * Time: 13:35
 */

require 'protected/flight/Flight.php';
require 'protected/init.php';

Flight::route('/', function(){
    echo 'Welcome to TaskTracker!';
});

Flight::start();
?>
