<?php

// var_dump($_POST);
  require("usesession.php");
  require("../../../config.php");
  require("fnc_films.php");
  
  $inputerror = "";
  // Kui klikiti submit, siis ...
  if(isset($_POST["filmsubmit"])) {
	if(empty($_POST["titleinput"]) or empty($_POST["genreinput"]) or empty($_POST["studioinput"]) or empty($_POST["directorinput"])) {
		$inputerror .= "Osa infot on sisestamata! ";
	}
	if($_POST["yearinput"] > date("Y") or $_POST["yearinput"] < 1895) {
		$inputerror .= "Ebareaalne valmimisaasta!";
	}
	if(empty($inputerror)) {
		savefilm($_POST["titleinput"], $_POST["yearinput"], $_POST["durationinput"], $_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);
	}
  }
  
  // $username = "Marilii Saar";

  require("header.php");
  
  ?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See leht on tehtud veebiprogrammeerimise kursusel 2020. aasta sügissemestril <a href="https://www.tlu.ee" target="_blank">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <ul>
	<li><a href="home.php">Esilehele</a></li>
	<li><a href="oldlinks.php">Vanad Failid</a></li>
	<li><a href="?logout=1">Logi välja!</a></li>
  </ul>
  <hr />
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="titleinput">Filmi pealkiri</label>
	<input type="text" name="titleinput" id="titleinput" placeholder="Pealkiri">
	<br />
	<label for="yearinput">Filmi valmimisaasta</label>
	<input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
	<br />
	<label for="durationinput">Filmi kestus minutites</label>
	<input type="number" name="durationinput" id="durationinput" value="80">
	<br />
	<label for="genreinput">Filmi žanr(id)</label>
	<input type="text" name="genreinput" id="genreinput" placeholder="Žanr(id)">
	<br />
	<label for="studioinput">Filmi tootja / struudio</label>
	<input type="text" name="studioinput" id="studioinput" placeholder="Tootja / stuudio">
	<br />
	<label for="directorinput">Filmi lavastaja</label>
	<input type="text" name="directorinput" id="directorinput" placeholder="Lavastaja">
	<br />
	<input type="submit" name="filmsubmit" value="Salvesta filmi info">
  </form>
  <p><?php echo $inputerror; ?></p>
</body>
</html>