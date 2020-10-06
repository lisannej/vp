<?php
require ("header.php");
require ("config.php");
require ("fnc_common.php");

$notice= "";
$userdescription = "";
if(isset($_POST["profilesubmit"])){
    $userdescription = test_input($_POST["descriptioninput"]);

    $notice= storeuserprofile($userdescription, $_POST["bgcolorinput"], 
    $_POST["txtcolorinput"]);
    $_SESSION["userbgcolor"];
}

?>


<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?></h1>
  <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="descriptioninput"> Minu luhikirjeldus </label>
  <br>
  <textarea rows="10" cols="80" name="descrptioninput" id="descriptioninput" placeholder="Minu luhikirjeldus..."><?php echo $userdescription ?></textarea>
  <label for="yearinput"> Filmi valmimisaasta </label>
  <input type="number" name="yearinput" id="yearinput" value="<?php echo date ("Y"); ?>">
  <br>
  <label for="durationinput"> Filmi kestus minutites </label>
  <input type="number" name="durationinput" id="durationinput" value="80">
  <br>
  <label for="genreinput"> Filmi zanr </label>
  <input type="text" name="genreinput" id="genreinput" ;>
  <br>
  <label for="studioinput"> Filmistuudio </label>
  <input type="text" name="studioinput" id="studioinput" ;>
  <br>
  <label for="directorinput"> Filmi lavastaja</label>
  <input type="text" name="directorinput" id="directorinput" ;>
  <br>
  <input type="submit" name="filmsubmit" value="Salvesta filmi info">
</form>
<?php echo $inputerror ?>

</body>
</html>