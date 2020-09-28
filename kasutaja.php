<?php
  require ("header.php");

  /*$firstnameinput ="";
  $lastnameinput="";
  $genderinput="";
  $emailinput="";
  $passwordinput="";
  $passwordsecondaryinput="";*/

  $inputerror="";
  $firstnameinputerror="";
  $lastnameinputerror="";
  $genderinputerror="";
  $emailinputerror="";
  $passwordinputerror="";
  $passwordsecondaryinputerror="";

  //if sisend aga idk mida ma teen

  //$firstname=$_POST["firstnameinput"];
  // mingi kood that seemed important
  //<input type="test" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi" value="<?php echo $lastname:
  if(isset($_POST["userinput"])){

    if (!empty($_POST["firstnameinput"])){
      $firstname = $_POST["firstnameinput"];
    }
    else {
      $firstnameerror = "Palun sisesta eesnimi!";
    }
      
    if (!empty($_POST["lastnameinput"])){
      $lastname = $_POST["lastnameinput"];
    } else {
      $lastnameerror = "Palun sisesta perekonnanimi!";
    }
  
    if (isset($_POST["genderinput"])){
      $genderinput = intval($_GET["genderinput"]);
    }
    else{
      $genderinputerror = "Sugu maaramata! ";
    }
    
    if (!empty($_POST["emailinput"])){
      $emailinput = $_POST["emailinput"];
    } else {
      $emailinputerror = "Palun sisesta email!";
    }

    if($_POST["passwordinput"]=== $_POST["passwordsecondaryinput"]){
      $passwordinputerror .="Paroolid ei uhti";
    }
    else if(strlen($_POST["passwordinput"]) < 8){
      $passwordinputerror .="Parool on liiga luhike!";
    }


    
  }

?>

<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?></h1>
  <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>


  <form method="POST">
    <label for="firstnameinput"> Eesnimi </label>
    <input type="text" name="firstnameinput" id="firstname" value="<?php echo $firstnameinput; ?>"><span><?php echo $firstnameinputerror; ?></span>
    <br>
    <label for="lastnameinput"> Perekonnanimi </label>
    <input type="text" name="lastnameinput" id="lastname" value="<?php echo $lastnameinput; ?>"><span><?php echo $lastnameinputerror; ?></span>
    <br> 
    <!-- SEE EI TEE MIDAGI KUI MA EI SISETA KUMBAGI genderit ... mul if vist vaja vb idk honestly-->
    
    <input type="radio" name="genderinput" id="gendermale" value="1" <?php if($genderinput == "1"){echo " checked";}?>><label for="gendermale">Mees</label>
    <input type="radio" name="genderinput" id="genderfemale" value="2"<?php if($genderinput == "2"){echo " checked";}?>><label for="genderfemale">Naine</label>
    <span><?php echo $genderinputerror; ?></span>
    <br>
    <label for="emailinput"> Email </label>
    <input type="email" name="emailinput" id="email" value="<?php echo $emailinput; ?>"><span><?php echo $emailinputerror; ?></span>
    <br>
    <label for="passwordinput"> Salasona </label>
    <input type="password" name="passwordinput" id="password" value="<?php echo $passwordinput; ?>"><span><?php echo $passwordinputerror; ?></span>
    <br>
    <label for="passwordsecondaryinput"> Salasona uuesti</label>
    <input type="password" name="passwordsecondaryinput" id="passwordsecondary" value="<?php echo $passwordsecondaryinput; ?>"><span><?php echo $passwordsecondaryinputerror; ?></span>
    <br>
    <input type="submit" name="userinput" value="Salvesta kasutaja andmed">
  </form>
<?php echo $inputerror ?>

</body>
</html>