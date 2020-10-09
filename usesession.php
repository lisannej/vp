<?php
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
  