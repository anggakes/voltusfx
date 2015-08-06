<?php 
$user = unserialize($_SESSION['login_user']); 
echo $user->getMember()->dataMember->status;
?>
