<?php

session_start();
include 'config.php';

if(!isset($_SESSION['user'])){
header('Location: login.php');
exit();
}

head('Panel....');
?>


<div class="row"> 
<div class="col s12 m6"> 
<div class="card"> 
<div class="card-content">
<ul class="collection with-header">
        <li class="collection-header"><b>Menu Panel</b></li>
        <li class="collection-item"><i class="sm material-icons">edit</i> <a href="write.php">Tulis blogs....</a></li>
        <li class="collection-item"><a href="manage.php">Manage blogs...</a></li>
        <li class="collection-item">Manage Comment</li>
        <li class="collection-item">Manage User</li>
      </ul>
</div>
</div>
</div>
</div>
<?php
foot();
