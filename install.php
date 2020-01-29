<?php
//error_reporting(0);
session_start();
include 'config.php';



function register(){
head('Halaman register');

global $_POST, $pdo;
if( isset($_POST['submit'])) {

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];
$c = $pdo->exec('INSERT INTO user (fullname,username,password) VALUES(\''.$fullname.'\', \''.$username.'\', \''.$password.'\')');
echo 'Ok '.$c.' row inserted....';
}

// https://www.php.net/manual/en/pdostatement.rowcount.php
$c = $pdo->query('SELECT COUNT(*) FROM user');
if($c->fetchColumn() > 0)
die ('Silahkan login... user sudah ada...');
echo'<br/><b>Silahkan daftar dulu gan...</b><br/>
<form action="install.php" method="POST">
Nama lengkap:<br/>
<input type="text" name="fullname"/><br/>
Username:<br/>
<input type="text" name="username"/><br/>
Password:<br/>
<input type="password" name="password"><br/>
<!--input type="hidden" name="act" value="doregister"/-->
<input type="submit" name="submit" value="Kirim"/>
</form>';
foot();
}

function doregister(){
}



$act = isset($_GET['act']) ? $_GET['act'] : '';

switch($act){
case 'doregister':
doregister();
break;
default:
register();
break;
}

print_r($_SESSION);
