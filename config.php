<?php
    require_once 'jdf.php';
    define('DB_NAME' , 'task_manager');
    define('DB_USER' , 'root');
    define('DB_PASS' , '');
    define('DB_HOST' , '127.0.0.1'); // localhost
    const TASK_TBL = 'tasks' ;
    const BASE_URL = 'http://naghlani.mn/' ;
    $connect = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME);
    if($connect->connect_error){
        die("mysql connect fiald : " . $connect->connect_error) ;
    }
    $connect->query('SET CHARACTER SET utf8'); // set pershan char in BD .
    $task_status = [
        1 => 'در حال انجام' ,
        2 => 'انجام شد' ,
        3 => 'در دست بررسی',
        4 => 'پیشنویس',
    ];
    $situation_style = [
        1 => 'active-task' ,
        2 => 'green' ,
        3 => 'pending',
        4 => 'draft',
    ];