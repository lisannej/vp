<?php
  require ("header.php");

  $firstnameinput ="";
  $lastnameinput="";
  $genderinput="0";
  $emailinput="";
  $passwordinput="";
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
    echo"tegutsen";
    if(empty($_POST["firstnameinput"]) or empty($_POST["lastnameinput"]) or empty($_POST["emailinput"]) or empty($_POST["passwordinput"]) or empty($_POST["secondarypasswordinput"])){
        $inputerror .="Osa infot on sisestamata! ";
     }
     if($_POST["genderinput"]!=1 and $_POST["genderinput"]!=2 ){
      $genderinputerror .="Sugu maaramata! ";
     }
     if($_POST["passwordinput"]!= $_POST["secondarypasswordinput"]){
       $passwordinputerror .="Paroolid ei uhti";
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
    <label for="genderinput"> Sugu </label>
    <input type="radio" name="genderinput" id="gendermale" value="1"><label for="gendermale">Mees</label><span><?php echo $genderinputerror; ?></span><?php if($genderinput == "1"){echo " checked";}?>
    <input type="radio" name="genderinput" id="genderfemale" value="2"><label for="genderfemale">Naine</label><span><?php echo $genderinputerror; ?></span><?php if($genderinput == "2"){echo " checked";}?>
    <br>
    <label for="emailinput"> Email </label>
    <input type="email" name="emailinput" id="email" ;><span><?php echo $emailinputerror; ?></span>
    <br>
    <label for="passwordinput"> Salasona </label>
    <input type="password" name="passwordinput" id="password" ;><span><?php echo $passwordinputerror; ?></span>
    <br>
    <label for="passwordsecondaryinput"> Salasona uuesti</label>
    <input type="password" name="passwordsecondaryinput" id="passwordsecondary" ;><span><?php echo $passwordsecondaryinputerror; ?></span>
    <br>
    <input type="submit" name="userinput" value="Salvesta kasutaja andmed">
  </form>
<?php echo $inputerror ?>

</body>
</html>