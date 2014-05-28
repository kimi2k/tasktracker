<?php
/**
 * User: Sergey Prokhorov <sergey_prokhorov@list.ru>
 * Date: 28.05.14
 * Time: 13:35
 */
Flight::register('db', 'PDO', array('mysql:host=localhost;dnbname=test','root','1'));