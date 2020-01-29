<?php

session_start();
include 'config.php';

$id=intval($_GET['id']);


$j = $pdo->query('SELECT COUNT(*) FROM post where id='.$id);
if($j->fetchColumn() == 0){
head('hehehe');
echo 'Not found...';
}else{

$q = $pdo->prepare('SELECT * FROM post WHERE id = ?');
$q->execute(array($id));
$b = $q->fetch();

head($b['title']);

echo '<script>
function konfirm(txt){
x = confirm(\'Yakuin nganu \'+txt+\'?\');
if(x)
return true;
else
return false;
}

</script>';


echo '

  <div class="row">
    <div class="col s12 m6">
      <div class="card">
        <div class="card-content">
          <span class="card-title">'.$b['title'].'</span>

<p><i class="material-icons sm">account_circle</i> admin <i class="material-icons sm">access_time</i> '.date('d-M-Y', $b['time']).'</p>

          <p>'.nl2br(stripslashes($b['content'])).'</p>
        </div>
        <div class="card-action">

        <a href="read.php?id='.$b['id'].'"><i class="material-icons sm">book</i></a> <a href="comment.php?blogid='.$b['id'].'">';

$cmtc = cmtcount($b['id']);
echo '<i class="material-icons sm">insert_comment</i> '.$cmtc;

echo'</a>';

if(isset($_SESSION['user']))
echo '<a href="manage.php?act=edit&id='.$b['id'].'"><i class="material-icons sm">edit</i></a>   <a onclick="return konfirm();" href="manage.php?act=delete&id='.$b['id'].'"><i class="material-icons sm">delete</i></a>';



     echo'   </div>
      </div>
    </div>
  </div>
';

}

foot();
