<?php
  //session_start();
  require ("sessionmanager_class.php");
  SessionManager::sessionStart("vp20", 0, "/~lisajar/", "greeny.cs.tlu.ee");
  
  //kas on sisse loginud
  if(!isset($_SESSION["userid"])){
	//jõuga suunatakse sisselogimise lehele
	header("Location: page.php");
	exit();
  }
  
  //logime välja
  if(isset($_GET["logout"])){
	//lõpetame sessiooni
	session_destroy();
	//jõuga suunatakse sisselogimise lehele
	header("Location: page.php");
	exit();
  }