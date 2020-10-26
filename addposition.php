 <?php
 require ("usesession.php");
 require ("header.php");
 require ("config.php");
 require ("fnc_films.php");
 require ("fnc_filmrelations.php");
 
 $inputerror=""; 
 //Kui klikiti position submit, siis ...
  if(isset($_POST["positionsubmit"]))  {
    $positiondescription = test_input($_POST["positiondescriptioninput"]);
    if(empty($_POST["positioninput"])){
        $positionerror = "Ameti nimetus sisestamata!";
    }
    else {
        $position = test_input($_POST["positioninput"]);
    }
    if(empty($positionerror)){
        $result = saveposition($position, $positiondescription);
        if($result == "OK") {
          $positionnotice = "Ametikoht salvestatud!";
          $position = "";
          $positiondescription = "";
        }
        else {
          $positionnotice = $result;
        }
    }
  }
  
  ?>


  <img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
    <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
    <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
    Digitehnoloogiate instituudis.</p>
  
  <form method="POST">
    <label for="positioninput"> Lisa ametikoht </label>
    <input type="text" name="positioninput" id="positioninput" placeholder="Ametikoht" >
    <br>
    <input type="submit" name="positionsubmit" value="Salvesta ametikoht">
  </form>
  <?php echo $inputerror ?>
  
  </body>
  </html>

