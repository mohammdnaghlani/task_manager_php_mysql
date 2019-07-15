
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
require_once '../config.php';
    $inputs = [
        'title' => 'task_title' ,
        'owner' => 'task_owner' ,
        'run_date' => 'date',
    ];
    $success_tmp = null ;
    $error_tmp = null ;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        foreach($inputs as $key => $input){
            if(isset($_POST[$input]) && !empty($_POST[$input])){
                $success_tmp[$key] = "'" . $_POST[$input] . "'"; 
            }else{
                $error_tmp[$key] = $input ;
            }
        }
        if(empty($error_tmp)){
            $items = implode(',' , $success_tmp);
            $connect->query('SET CHARACTER SET utf8');
            $query = 'INSERT INTO ' . TASK_TBL .'(title,owner,run_date) VALUES('.$items.')';
            $insert = $connect->query( $query);
            if($insert){
                header('location:' . BASE_URL . '?add_task=OK');
                exit();
            }
        }
    }
    ?>
</body>
</html>
