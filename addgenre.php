<?php
require ("usesession.php");
require ("header.php");
require ("config.php");
require ("fnc_films.php");
require ("fnc_filmrelations.php");

$inputerror=""; 

if(isset($_POST["genresubmit"])){
  echo"tegutsen";
    if(empty($_POST["genreinput"])){
        $inputerror .="Osa infot on sisestamata! ";
    }
    if(empty($inputerror)){
        echo"salvestan";
        savegenre($_POST["genreinput"]);
    }
}

?>


<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>

<form method="POST">
  <label for="genreinput"> Lisa stuudio </label>
  <input type="text" name="genreinput" id="genreinput" placeholder="Zanr" >
  <br>
  <input type="submit" name="genresubmit" value="Salvesta zanr">
</form>
<?php echo $inputerror ?>

</body>
</html>