<?php
require ("header.php");
require ("config.php");
require ("fnc_films.php");

$inputerror =""; 
//$database = "if20_lisanne_ja_1" ;

//loen lehele koik olemasolevad motted
$filmhtml = readfilms ();
//kui klikiti submit siis
if(isset($_POST["filmsubmit"])){
  if(empty ($_POST ["titleinput"]) or empty ($_POST ["genreinput"]) or empty ($_POST ["studioinput"]) or
   empty ($_POST ["directorinput"])){
      $inputerror .= "Osa infot on sisestamata!";
   }
   if($_POST ["yearinput"]> date ("Y") or $_POST ["yearinput"] < 1895){
     $inputerror .= "Ebareaalne valmimisaasta!";
   }
   if((empty ($inputerror)){
      savefilm ($_POST ["titleinput"], $_POST ["yearinput"], $_POST ["durationinput"], $_POST ["genreinput"], $_POST ["studioinput"], $_POST ["directorinput"] )
   }
}

?>


<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>

<form method = "POST">
  <label for= "titleinput"> Filmi pealkiri </label>
  <input type= "text" name = "titleinput" id = "titleinput" placeholder = "peakiri" >
  </form>
  <br>
  <label for= "yearinput"> Filmi valmimisaasta </label>
  <input type= "number" name = "yearinput" id = "yearinput" value= "<?php echo date ("Y"); ?>">
  <br>
  <label for= "durationinput"> Filmi kestus minutites </label>
  <input type= "number" name = "durationinput" id = "durationinput" value= "80">
  <br>
  <label for= "genreinput"> Filmi zanr </label>
  <input type= "text" name = "genreinput" id = "genreinput" ;>
  <br>
  <label for= "studioinput"> Filmistuudio </label>
  <input type= "text" name = "studioinput" id = "studioinput" ;>
  <br>
  <label for= "directorinput"> Filmi lavastaja</label>
  <input type= "text" name = "directorinput" id = "directorinput" ;>
  <br>
  <input type= "submit" name = "filmsubmit" value = "Salvesta filmi info">
<form>
<?php echo $inputerror ?>

</body>
</html>