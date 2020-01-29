<?php

include 'config.php';

head('Comment kuy...');





$blogid = intval($_GET['blogid']);


function strip($txt){ return addslashes(trim($txt)); } 

if(isset($_POST['submit'])){

$name = strip($_POST['name']);
$content = strip($_POST['content']);
$id = intval($_GET['blogid']);
if(empty($content)){
print('kuy konten gak boleh kosong jelembot <a href="write.php">Tulis lagi..</a>...');
foot();
exit();
}
$q = $pdo->prepare('INSERT INTO comment (name, content, time, blogid) VALUES(?,?,?,?)');
if($q->execute(array($name, $content, time()+3600*7,$id)))
echo 'Terposting...';
else
echo 'Gagal tenar...';

}



// kount
echo '<div class="row">
    <div class="col s12 m6">
      <div class="card">
<div class="card-content">';

$cc = $pdo->query('SELECT COUNT(*) FROM comment WHERE blogid='.$blogid);
if ( $cc->fetchColumn() == 0){
echo 'Gak ada komen buat blog ini';
} else {

$c = $pdo->prepare("SELECT * FROM comment WHERE blogid=?");
$c->execute(array($blogid));
echo '<ul class="collection">';
foreach($c->fetchAll() as $g){

echo '
    <li class="collection-item avatar">
      <img src="images/avatar.png" alt="" class="circle">
      <span class="title"><b>'.$g['name'].'</b></span>
      <p>
         '.$g['content'].'
      </p>
      <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
    </li>';
}
echo '</ul>';
}

echo '</div></div></div></div>';

echo'
<div class="row">
    <div class="col s12 m6">
      <div class="card">
<div class="card-content">
<span class="card-title">Tulis komen Biar gak.Goblok</span>
<div class="row"> 
<b>Silahkan tulis unek unek lu dulu gan...</b><br/>
<form action="comment.php?blogid='.$blogid.'" method="POST">
<div class="row"> <div class="input-field col s12">
<input id="name" type="text" name="name"/>
<label for="title">Nama</label>
</div></div>
<div class="row"> <div class="input-field col s12">
<textarea id="content" class="materialize-textarea" rows="10" cols="35" name="content"></textarea>
<label for="content">Content</label>
</div></div>
<button type="submit" name="submit" class="waves-effect waves-light btn">Posting Komentar</button>
</form>
</div></div></div></div></div>
';
foot();