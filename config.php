<?php

$server = "127.0.0.1";
$user = "root";
$pass = "1";
$db = "blog";



// settimg pdd
try {
$pdo = new PDO('mysql: host='.$server.'; dbname='.$db, $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

}catch(PDOException $e){
die('Error Database kimak: '.$e->getMessage());
}


function cmtcount($blogid){
global $pdo;
$q = $pdo->query('SELECT COUNT(*) FROM comment WHERE blogid='.$blogid);
return $q->fetchColumn();
}

function head($title='Ini judul'){
echo '
  <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="asset/material-icons.css" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="asset/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
<style>
#toast-container {
top: 0%;
right: auto !important; 
bottom: auto !important;
left:0%; }
a {
color: #e57373 !important;
}
</style>

    <body>
<script>
document.addEventListener("DOMContentLoaded",  function() {
    var elems = document.querySelectorAll(".sidenav");
    var instances = M.Sidenav.init(elems);
  });
</script>


  <nav>
    <div class="nav-wrapper">
      <a href="/" class="brand-logo white-text">ACKDT Blog</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="white-text material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Admin</a></li>
        <li><a href="collapsible.html">Facebook</a></li>
        <li><a href="mobile.html">Others</a></li>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a href="/">Home</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="">Contact Me</a></li>
    <li><a href="mobile.html">Social Media</a></li>
<li><input type="text"></li>
  </ul>

';
}

function foot(){
global $pdo, $_SESSION;
$pdo = null;
echo '
<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">About Me</h5>
                <p class="grey-text text-lighten-4">Acakadut Blog is trademark of Acakadut Corp</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Navigation</h5>
                <ul>';

if(isset($_SESSION['user'])){

                  echo '<li><a class="grey-text text-lighten-3" href="panel.php">Panel</a></li>';
                  echo '<li><a class="grey-text text-lighten-3" href="logout.php">Logout</a></li>'; }
else
                echo '  <li><a class="grey-text text-lighten-3" href="login.php">Login</a></li>';
echo '
                  <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Others</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2019 Acakadut Corp
            <a class="grey-text text-lighten-4 right" href="#!">Contact Me</a>
            </div>
          </div>
        </footer>
            

      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="asset/js/materialize.min.js"></script>
    </body>
  </html>';


}