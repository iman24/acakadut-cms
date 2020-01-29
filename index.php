<?php
session_start();
include 'config.php';

head('Welcome boyyy');

$j = $pdo->query('SELECT COUNT(*) FROM post');
if($j->fetchColumn() == 0){
echo '

  <div class="row">
    <div class="col s12 m6">
      <div class="card">
        <div class="card-content">
Data kosong...

</div></div></div>
';
}else{

$q = $pdo->query('SELECT * FROM post ORDER BY id DESC');
$q->execute();

foreach($q->fetchAll() as $b){
//echo '<b><a href="read.php?id='.$b['id'].'">'.$b['title'].'</a></b><br>';
//echo date('d-M-Y H:i', $b['time']).'<br>';
//echo $b['content'].'<hr>';


echo '

  <div class="row">
    <div class="col s12 m6">
      <div class="card">
        <div class="card-content">
          <span class="card-title"><a href="read.php?id='.$b['id'].'">'.$b['title'].'</a></span>
<p><i class="material-icons sm">account_circle</i> admin  <i class="material-icons sm">access_time</i> '.date('d-M-Y', $b['time']).'</p>
<hr>
          <p>'.substr($b['content'], 0, 200).'...</p>
        </div>
        <div class="card-action">
        <a href="read.php?id='.$b['id'].'"><i class="material-icons sm">book</i></a> <a href="comment.php?blogid='.$b['id'].'">';

$cmtc = cmtcount($b['id']);
echo '<i class="material-icons sm">insert_comment</i> '.$cmtc;

echo'</a>';

if(isset($_SESSION['user']))
echo '<a href="manage.php?act=edit&id='.$b['id'].'"><i class="material-icons sm">edit</i></a>   <a onclick="return konfirm();" href="manage.php?act=delete&id='.$b['id'].'"><i class="material-icons sm">delete</i></a>';

echo'     </div>
      </div>
    </div>
  </div>
';





}
}

foot();