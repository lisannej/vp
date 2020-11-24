<?php
  require ("usesession.php");
  //require ("sessionmanager_class.php");
  //SessionManager::sessionStart("vp20", 0, "/~lisajar/", "greeny.cs.tlu.ee" ); 
  require ("config.php");
  //require ("fnc_photo.php");
  require ("fnc_common.php");
  //require ("photoupload_class.php");
	
  $tolink = "\t" .'<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>' ."\n";
  $tolink .= "\t" .'<script>tinymce.init({selector:"textarea#newsinput", plugins: "link", menubar: "edit",});</script>' ."\n";
  $inputerror = "";
  $notice = null;
  $news= null;
  //kui klikiti submit, siis ...
  if(isset($_POST["newssubmit"]))
	
  
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
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
    <label for="newstitleinput">Sisesta uudise pealkiri!</label>
	<input id="newstitleinput" name="newstitleinput" type="text" required>
	<br>
	<label for="newsinput">Kirjuta uudis</label>
	<textarea id="newsinput" name="newsinput" placeholder="Uudise sisu"><?php echo $news; ?>
	</textarea>
	<br>	
	<input type="submit" name="newssubmit" value="Salvesta uudis">
  </form>
  <p id="notice">
  <?php
	echo $inputerror;
	echo $notice;
  ?>
  </p>
  
</body>
</html>
