<?php
require ("usesession.php");
require ("header.php");
require ("config.php");
require ("fnc_films.php");
require ("fnc_filmrelations.php");

$inputerror=""; 

if(isset($_POST["studiosubmit"])){
  echo"tegutsen";
    if(empty($_POST["studioinput"])){
        $inputerror .="Osa infot on sisestamata! ";
    }
    if(empty($inputerror)){
        echo"salvestan";
        savestudio($_POST["studioinput"]);
    }
}

?>


<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>

<form method="POST">
  <label for="studioinput"> Lisa stuudio </label>
  <input type="text" name="studioinput" id="studioinput" placeholder="Stuudio nimi" >
  <br>
  <input type="submit" name="studiosubmit" value="Salvesta stuudio">
</form>
<?php echo $inputerror ?>

</body>
</html>