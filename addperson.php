<?php
require ("usesession.php");
require ("header.php");
require ("config.php");
require ("fnc_films.php");
require ("fnc_filmrelations.php");

$inputerror=""; 

$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai",
  "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
    $birthday=null;
    $birthmonth=null;
    $birthyear=null;
    $birthdate=null;

$personhtml=readpeople();
//kui klikiti submit siis
if(isset($_POST["personsubmit"])){
  echo"tegutsen";
    if(empty($_POST["firstnameinput"]) or empty($_POST["lastnameinput"]) or empty($_POST["birthdayinput"])){
        $inputerror .="Osa infot on sisestamata! ";
    }
    if(!empty($birthday) and !empty($birthmonth) and !empty($birthyear)){
        if(checkdate($birthmonth, $birthday, $birthyear)){
            $tempdate = new DateTime($birthyear ."-" .$birthmonth ."-" .$birthday);
            $birthdate = $tempdate->format("Y-m-d");
        } else {
            $birthdateerror = "Kuupaev ei ole reaalne!";
        }
    }
    if(empty($inputerror)){
        echo"salvestan";
        saveperson($_POST["firstnameinput"], $_POST["lastnameinput"], $_POST["birthdayinput"] );
    }
}

?>


<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>

<form method="POST">
  <label for="titleinput"> Eesnimi </label>
  <input type="text" name="firstnameinput" id="firstnameinput" placeholder="Eesnimi" >
  <br>
  <label for="yearinput"> Perekonnanimi </label>
  <input type="text" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi">
  <br>
  <label for="birthdayinput">Sünnikuupäev: </label>
  <?php
    echo '<select name="birthdayinput" id="birthdayinput">' ."\n";
    echo "\t \t" .'<option value="" selected disabled>päev</option>' ."\n";
    for ($i = 1; $i < 32; $i ++){
      echo "\t" .'<option value="' .$i .'"';
      if ($i == $birthday){
        echo " selected ";
      }
      echo ">" .$i ."</option> \n";
    }
    echo  "</select> \n";
    ?>
  <label for="birthmonthinput">Sünnikuu: </label>
  <?php
    echo '<select name="birthmonthinput" id="birthmonthinput">' ."\n";
    echo "\t \t" .'<option value="" selected disabled>kuu</option>' ."\n";
    for ($i = 1; $i < 13; $i ++){
      echo '<option value="' .$i .'"';
      if ($i == $birthmonth){
        echo " selected ";
      }
      echo ">" .$monthnameset[$i - 1] ."</option> \n";
    }
    echo " \t </select> \n";
  ?>
  <label for="birthyearinput">Sünniaasta: </label>
  <?php
    echo "\t" .'<select name="birthyearinput" id="birthyearinput">' ."\n";
    echo "\t \t" .'<option value="" selected disabled>aasta</option>' ."\n";
    for ($i = date("Y") - 15; $i >= date("Y") - 110; $i --){
      echo '<option value="' .$i .'"';
      if ($i == $birthyear){
        echo " selected ";
      }
      echo ">" .$i ."</option> \n";
    }
    echo "\t </select> \n";
  ?>
  <br>
  <br>
  <input type="submit" name="personsubmit" value="Salvesta tegelase info">
</form>
<?php echo $inputerror ?>

</body>
</html>