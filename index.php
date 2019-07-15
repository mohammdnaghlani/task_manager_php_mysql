
<?php
   require_once 'config.php' ;
   $where = null ;
   if(isset($_GET['action']) && isset($_GET['id']) && !empty($_GET['id']) && !empty($_GET['action'])){
     if($_GET['action'] <= 4){
       $update = "UPDATE ".TASK_TBL." SET status=". $_GET['action']. " WHERE id=" . $_GET['id'];
       $r = $connect->query($update) ;  
     }
   }
   if(isset($_GET['situation']) && !empty($_GET['situation']) && $_GET['situation'] <= 4){
    $where = 'WHERE status=' . intval($_GET['situation']) ;
   }
  $query = 'SELECT * FROM `'.TASK_TBL .'`' . $where;
  $result = $connect->query($query);
  $rows =$result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Task manager UI</title>
     <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/fontiran.css">  
</head>
<body>  
<div class="page">
  <div class="pageHeader">
    <div class="title">داشبورد</div>
    <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">محمد نقلانی</span><img src="http://1.gravatar.com/avatar/acadf155a779f5d1f1d2e1ab942d469c?s=96&d=mm&r=g" width="40" height="40"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="جست و جو..."/>
        </div>
      </div>
      <div class="add-new-task">
        <span class="title" >اضافه کردن وظیفه</span>
          <form action="process/add_task.php" method="post">
            <div class="input-group">
              <input type="text" class="searchbox" placeholder="عنوان کار" name="task_title">
            </div>
            <div class="input-group">
              <select name="task_owner" >
                <option value="محمد">محمد</option>
                <option value="علی رضا"> علی رضا</option>
                <option value="مهران">مهران</option>
                <option value="الهام">الهام</option>
              </select>
            </div>
            <div class="input-group">
              <input type="date" class="searchbox" name="date">
            </div>
            <div class="input-group">
              <input type="submit" class="searchbox green" value="اضافه کردن" name="submit">
            </div>
          </form>
        </div>
      <div class="menu">
        <div class="title">منوی برنامه</div>
        <ul>
          <li><i class="fa fa-home"></i>صفحه اصلی</li>
          <li><i class="fa fa-signal"></i>فعالیت ها</li>
          <li class="active"> <i class="fa fa-tasks"></i>مدیریت وظایف</li>
          <li> <i class="fa fa-envelope"></i>پیام ها</li>
        </ul>
      </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title">مدیریت وظایف</div>
        <div class="functions">
          <div class="button active">درخواست جدید</div>
          <div class="button green">کامل شده</div>
          <div class="button inverz"><i class="fa fa-trash-o"></i></div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">
            امروز            
            <div class="title_filter">
              <a href="./" class="all-task">همه</a>              
              <a href="?situation=1" class="active-task">در حال انجام</a>
              <a href="?situation=2" class="green">انجام شده</a>
              <a href="?situation=3" class="pending">در دست بررسی</a>
              <a href="?situation=4" class="draft">پیشنویس</a>
            </div>
          </div>
          <ul>
            <?php foreach($rows as  $task) : $task = (object) $task ;?>
            <li class="<?=($task->status == 2 ? 'checked' : '') ;?>">
              <?php if($task->status == 2) : ?>  
                <i class="fa fa-check-square-o"></i>
              <?php else :?>
                <i class="fa fa-square-o"></i>
              <?php endif ;?>              
              <span><?= $task->title ?> | متعلق به : <?=$task->owner?></span>              
              <div class="info">
                <div class="button <?= $situation_style[$task->status] ;?>">
                <?= $task_status[$task->status] ;?>
              </div>
              <span>  تاریخ انجام :  <?=jdate( 'd-m-Y',strtotime($task->run_date)) ;?></span>
              <span class="operator">
                <a href="?action=1&id=<?=$task->id?>">درحال انجام</a> |
                <a href="?action=2&id=<?=$task->id?>">انجام شد</a> |
                <a href="?action=4&id=<?=$task->id?>">پیشنویس</a> |
                <a href="?action=3&id=<?=$task->id?>">در دست بررسی</a>                
              </span>            
              </div>
            </li>
            <?php endforeach ; ?>
          </ul>
        </div>        
        <div class="list">
          <div class="title">روز بعد</div>
          <ul>
            <li><i class="fa fa-square-o"></i><span>استخدام برنامه نویسی تجربه کاربری</span>
              <div class="info"></div>
            </li>
            <li><i class="fa fa-square-o"></i><span>فارسی شده توسط محمد نقلانی  - نوشته شده توسط John Doe </span>
              <div class="info"></div>
            </li>
          </ul>
        </div>
        
      </div>
    </div>

  </div>
  
</div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> 
    <script  src="assets/js/script.js"></script>
</body>
</html>
