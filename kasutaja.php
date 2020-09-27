<?php
require ("header.php");

$firstnameinput ="";
$lastnameinput="";
$genderinput="";
$emailinput="";
$passwordinput="";

//if sisend aga idk mida ma teen

//$firstname=$_POST["firstnameinput"];
// mingi kood that seemed important
//<input type="test" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi" value="<?php echo $lastname:



?>

<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?></h1>
  <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>


  <form method="POST">
  <label for="firstnameinput"> Eesnimi </label>
  <input type="text" name="firstnameinput" id="firstname" value="<?php echo $firstname; ?>">
  <br>
  <label for="lastnameinput"> Perekonnanimi </label>
  <input type="text" name="lastnameinput" id="lastname" value="<?php echo $lastname; ?>">
  <br>
  <label for="genderinput"> Sugu </label>
  <input type="radio" name="genderinput" id="gendermale" value="1"><label for="gendermale">Mees</label><?php if($gender == "1"){echo " checked";}?>>
  <input type="radio" name="genderinput" id="genderfemale" value="2"><label for="genderfemale">Naine</label><?php if($gender == "2"){echo " checked";}?>>
  <br>
  <label for="emailinput">  </label>
  <input type="email" name="emailinput" id="email" ;>
  <br>
  <label for="passwordinput"> Filmistuudio </label>
  <input type="password" name="passwordinput" id="password" ;>
  <br>
  <label for="passwordsecondaryinput"> Filmi lavastaja</label>
  <input type="password" name="passwordsecondaryinput" id="passwordsecondary" ;>
  <br>
  <input type="submit" name="userinput" value="Salvesta kasutaja andmed">
</form>
<?php echo $inputerror ?>

</body>
</html>