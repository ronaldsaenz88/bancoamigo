<?php


session_start();
if(session_id()=="")
{
  session_start(['cookie_lifetime' => 86400]);
}

session_unset();
session_destroy();

$newURL = '/login.php';
header('Location: '.$newURL);
?>
