<?php
session_start();
include 'config.php';
if (isset($_SESSION['user'])){
header('Location: panel.php');
exit();
}
head('Login gan..');
if (isset($_POST['submit'])) {
$username = $_POST['username'];
$password = $_POST['password'];
$cek = $pdo->prepare('SELECT * FROM user WHERE username = ?');
$cek->execute(array($username));
$dt = $cek->fetch();
// prosss otentikasi...
if($dt['password'] == trim($password)){
$_SESSION['user'] = $dt['username'];
echo '<script>
window.location="panel.php";
</script>';
}
else{

echo '
<script>
alert(\'Gagal login ag\');
</script>';
}
}




echo '<div class="row">
    <div class="col s12 m6">
      <div class="card">
<div class="card-content">
<span class="card-title">Login User</span>
<div class="row"> 
<form class="col s12" action="login.php" method="POST">
  <div class="row">
        <div class="input-field col s12">
          <input name="username" id="email" type="text" class="validate">
          <label for="email">Username</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input name="password" id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
<button class="waves-effect waves-light btn" type="submit" name="submit">Login</button>
</div>
      </div>
</form>
</div>
</div></div>
</div>
</div>

';
foot();