<?php

if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1') {
    $db_config['host'] = 'localhost';
    $db_config['login'] = 'root';
    $db_config['password'] = 'root';
    $db_config['dbname'] = 'bddgr1004';
} else {
    $db_config['host'] = '192.168.4.88';
    $db_config['login'] = 'gr10049h7B';
    $db_config['password'] = 'Ui2pwFut';
    $db_config['dbname'] = 'bddgr1004';
}

//var_dump($_SERVER);



