<?php
  require ("usesession.php");
  require ("header.php");
  require ("config.php");
  require ("fnc_films.php");
  

  $database = "if20_lisanne_ja_1" ;
  //loen lehele koik olemasolevad motted
  $filmhtml = readfilms ();

  ?>


  <img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
    <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
    <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
    <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
    Digitehnoloogiate instituudis.</p>

  <?php echo readfilms($sortby, $sortorder); ?>
</body>
</html>