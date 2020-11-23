<?php
  //session_start();
  require ("sessionmanager_class.php");
  SessionManager::sessionStart("vp", 0, "/~lisajar/", "greeny.cs.tlu.ee" );

  //kas on sessioon olemas
  if(!isset($_SESSION["userid"])){
    //jouga suunatake sisselogimise lehele
    header("Location: page.php");
    exit();
  }
  //LOGIME VALJA
  if(isset($_GET["logout"])){
    session_destroy();
    header("Location: page.php");
    exit();
  }
    