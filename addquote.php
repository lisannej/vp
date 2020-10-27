<?php
require ("usesession.php");
require ("header.php");
require ("config.php");
require ("fnc_films.php");
require ("fnc_filmrelations.php");

$inputerror=""; 

$quotehtml=readquotes();
//kui klikiti submit siis
if(isset($_POST["quotesubmit"]) and !empty($_POST ["quoteinput"])){
  $conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database );
  //valmistan ette SQL kasu
  $stmt = $conn->prepare ("INSERT INTO quote (quote_text) VALUES (?) ");
  echo $conn->error;
  //seome kasuga meie parisandmed
  //i - integer, d- decimal, s - string
  $stmt->bind_param("s", $_POST ["quoteinput"]);
  $stmt->execute ();
  $stmt->close ();
  $conn->close ();
}

?>


<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>

<form method="POST">
  <label for="quoteinput"> Lisa tsitaat </label>
  <input type="text" name="quoteinput" id="quoteinput" placeholder="Tsitaat" >
  <br>
  <input type="submit" name="quotesubmit" value="Salvesta tsitaat">
</form>
<?php echo $inputerror ?>

</body>
</html>