<?php 
  require ("usesession.php");
  require ("config.php");
  require ("fnc_common.php");
  require ("fnc_user.php");
  

  $notice= "";
  $userdescription = readuserdescription();
  if(isset($_POST["profilesubmit"])){
    $userdescription = test_input($_POST["descriptioninput"]);

    $notice= storeuserprofile($userdescription, $_POST["bgcolorinput"], $_POST["txtcolorinput"]);
    $_SESSION["userbgcolor"] = $_POST["bgcolorinput"];
    $_SESSION["usertxtcolor"] = $_POST["txtcolorinput"];
  }
  require ("header.php");
?>


<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="descriptioninput"> Minu luhikirjeldus </label>
  <br>
  <textarea rows="10" cols="80" name="descrptioninput" id="descriptioninput" placeholder="Minu luhikirjeldus..."><?php echo $userdescription ?></textarea>
  <br>
	<label for="bgcolorinput">Minu valitud taustavärv: </label>
	<input type="color" name="bgcolorinput" id="bgcolorinput" value="<?php echo $_SESSION["userbgcolor"]; ?>">
	<br>
	<label for="txtcolorinput">Minu valitud tekstivärv: </label>
	<input type="color" name="txtcolorinput" id="txtcolorinput" value="<?php echo $_SESSION["usertxtcolor"]; ?>">
	<br>
  <input type="submit" name="profilesubmit" value="Salvesta profiil">
</form>
<?php echo $notice ?>

</body>
</html>