<?php
session_start();
include 'config.php';

// tendang penysup
if(!isset($_SESSION['user'])){
header('Location: login.php');
exit();
}

function strip($txt){
return addslashes(trim($txt));
}

head('Nulis dolo koy...');
if(isset($_POST['submit'])){

$title = strip($_POST['title']);
$content = strip($_POST['content']);
if(empty($content)){
print('kuy konten gak boleh kosong jelembot <a href="write.php">Tulis lagi..</a>...');
foot();
exit();
}
$q = $pdo->prepare('INSERT INTO post (title, content, time) VALUES(?,?,?)');
if($q->execute(array($title, $content, time()+3600*7)))
echo 'Terposting...';
else
echo 'Gagal tenar...';

}


echo'
<div class="row">
    <div class="col s12 m6">
      <div class="card">
<div class="card-content">
<span class="card-title">Tulis Blog Biar gak.Goblok</span>
<div class="row"> 
<b>Silahkan tulis unek unek lu dulu gan...</b><br/>
<form action="write.php" method="POST">
<div class="row"> <div class="input-field col s12">
<input id="title" type="text" name="title"/>
<label for="title">Judul</label>
</div></div>
<div class="row"> <div class="input-field col s12">
<textarea id="content" class="materialize-textarea" rows="10" cols="35" name="content"></textarea>
<label for="content">Content</label>
</div></div>
<button type="submit" name="submit" class="waves-effect waves-light btn">Posting</button>
</form>
</div></div></div></div></div>
';
foot();
?>