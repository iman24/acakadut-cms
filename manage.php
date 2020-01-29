<?php

session_start();
include 'config.php';


if(!isset($_SESSION['user'])){ header('Location: login.php'); exit(); }

function strip($txt){
return addslashes(trim($txt));
}

switch($_GET['act']){
default:
head('Manage nganu...');
echo '<script>
function konfirm(){
x = confirm(\'Yakuin nganu..?\');
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
<ul class="collection with-header">
        <li class="collection-header"><b>Daftar Post</b></li>';

$j = $pdo->query('SELECT COUNT(*) FROM post');
if($j->fetchColumn() == 0){
echo 'Data kosong...';
}else{

$q = $pdo->query('SELECT * FROM post');
$q->execute();

foreach($q->fetchAll() as $b){
echo '<li class="collection-item"><h5>';
echo '<a href="read.php?blogid='.$b['id'].'">'.$b['title'].'</a></h5>';
echo '<a class="white-text waves-effect waves-light btn" href="manage.php?act=edit&id='.$b['id'].'">Edit </a> <a class="white-text waves-effect waves-light btn" onclick="return konfirm();" href="manage.php?act=delete&id='.$b['id'].'">Delete</a></li>';

}
echo '   </ul>
</div>
</div>
</div>
</div>';

}

foot();
break;

case 'edit':

$idb=$_GET['id'];

if(isset($_POST['submit'])){

$title = strip($_POST['title']);
$content = strip($_POST['content']);
$id=$_POST['id'];
if(empty($content)){
print('kuy konten gak boleh kosong jelembot <a href="manage.php?act=edit&id='.$id.'">Back lagi..</a>...');
foot();
exit();
}
$q = $pdo->prepare('UPDATE post SET title = ?, content = ?, time = ? WHERE id = ?');
if($q->execute(array($title, $content, time()+3600*7, $id)))
header('Location: read.php?id='.$id);
else
echo 'Gagal tenar...';

}

$q = $pdo->prepare('SELECT * FROM post WHERE id = ?');
$q->execute(array($idb));
$p = $q->fetch();
head('Editttt...');

echo'
<div class="row">
    <div class="col s12 m6">
      <div class="card">
<div class="card-content">
<span class="card-title">Tulis Blog Biar gak.Goblok</span>
<div class="row"> 
<b>Silahkan tulis unek unek lu dulu gan...</b><br/>
<form action="manage.php?act=edit" method="POST">
<div class="row"> <div class="input-field col s12">
<input id="title" value="'.$p['title'].'" type="text" name="title"/>
<label for="title">Judul</label>
</div></div>
<div class="row"> <div class="input-field col s12">
<textarea id="content" class="materialize-textarea" rows="10" cols="35" name="content">'.stripslashes($p['content']).'</textarea>
<label for="content">Content</label>
</div></div>
<input type="hidden" value="'.$p['id'].'" name="id"/>
<button type="submit" name="submit" class="waves-effect waves-light btn">Posting</button>
</form>
</div></div></div></div></div>
';
foot();
break;

case 'delete':
$id=$_GET['id'];
$q = $pdo->exec('DELETE FROM post where id = '.$id);
$pdo->exec('DELETE FROM comment where blogid = '.$id);
echo $q.' Terdelet..';

break;

}



