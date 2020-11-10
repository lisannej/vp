<?php
  
  require ("sessionmanager_class.php");
  SessionManager::sessionStart("vp20", 0, "/~lisajar/", "greeny.cs.tlu.ee" );
  require ("config.php");
  require ("fnc_photo.php");
    
  
  $notice = null;
  $filenameprefix = "vp_";
  $photouploaddir_orig = "../photoupload_orig/";
  $photouploaddir_normal = "../photoupload_normal/";
  $photouploaddir_thumb = "../photoupload_thumb/";
  $filename = null;
  
  require("header.php");
?>
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
    <li><a href="?logout=1">Logi välja</a>!</li>
    <li><a href="home.php">Avaleht</a></li>
  </ul>
  
  <hr>
  <h2>Fotogalerii</h2>
  </p>
  
</body>
</html>
