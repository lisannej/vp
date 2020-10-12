<?php
require ("header.php");
require ("config.php");
require ("fnc_films.php");
require ("usesession.php");
?>





<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>

<form method="POST">
<label for="filminput">Film: </label>
<select name="filminput" id="filminput">
	<option value="" selected disabled>Vali film</option>
	<option value="1">Siin me oleme</option> 
	<option value="2">Don Juan Tallinnas</option>
	<option value="3">Hukkunud alpinisti hotell</option> 
	<option value="4">Viini postmark</option>
  <option value="5">Mehed ei nuta</option> 
	<option value="6">Noor pensionar</option>
</select>
<label for="filminput">Film: </label>
<select name="genreinput" id="genreinput">
	<option value="" selected disabled>Vali zanr</option>
	<option value="1">Komöödia</option> 
	<option value="2">Ulmefilm</option>
	<option value="3">Muusikal/tantsufilm</option> 
	<option value="4">Draama</option>
  <option value="5">Detektiivfilm</option> 
	<option value="6">Põnevusfilm</option>
</select>
<input type="submit" name="filmsubmit" value="Salvesta">
</body>
</html>