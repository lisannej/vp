<?php

require ("usesession.php");
require ("header.php");
require ("config.php");

?>

<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p><a href="http://greeny.cs.tlu.ee/~lisajar/vp/addfilms.php">Lisa filme</a></li>
  <br>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>
  
  
  
 
  
  
</body>
</html>