<?php
require ("usesession.php");
require ("header.php");
require ("config.php");
require ("fnc_films.php");
require ("fnc_filmrelations.php");

$inputerror=""; 


 //Kui klikiti position submit, siis ...
 $quotehtml=readquotes();
//kui klikiti submit siis
if(isset($_POST["quotesubmit"])){
  echo"tegutsen";
    if(empty($_POST["quoteinput"])){
        $inputerror .="Osa infot on sisestamata! ";
    }
    if(empty($inputerror)){
        echo"salvestan";
        savequotes($_POST["quoteinput"]);
    }
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