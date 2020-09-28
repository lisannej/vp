<?php
  require ("header.php");

  $firstnameinput ="";
  $lastnameinput="";
  $genderinput="";
  $emailinput="";
  $passwordinput="";
  $passwordsecondaryinput="";
  $result="";

  $inputerror="";
  $firstnameinputerror="";
  $lastnameinputerror="";
  $genderinputerror="";
  $emailinputerror="";
  $passwordinputerror="";
  $passwordsecondaryinputerror="";

  function adduser(){
    $firstnameinput ="";
    $lastnameinput="";
    $genderinput="";
    $emailinput="";
    $passwordinput="";
    $passwordsecondaryinput="";
    $result = "Kasutaja edukalt lisatud!";
  }
  //if sisend aga idk mida ma teen

  //$firstname=$_POST["firstnameinput"];
  // mingi kood that seemed important
  //<input type="test" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi" value="<?php echo $lastname:
  if(isset($_POST["userinput"])){

    if (!empty($_POST["firstnameinput"])){
      $firstnameinput = $_POST["firstnameinput"];
    }
    else {
      $firstnameerror = "Palun sisesta eesnimi!";
    }
      
    if (!empty($_POST["lastnameinput"])){
      $lastnameinput = $_POST["lastnameinput"];
    } else {
      $lastnameerror = "Palun sisesta perekonnanimi!";
    }
  
    if (isset($_POST["genderinput"])){
      $genderinput = intval($_POST["genderinput"]);
    }
    else{
      $genderinputerror = "Sugu maaramata! ";
    }
    
    if (!empty($_POST["emailinput"])){
      $emailinput = $_POST["emailinput"];
    } else {
      $emailinputerror = "Palun sisesta email!";
    }

    if($_POST["passwordinput"] === $_POST["passwordsecondaryinput"]){
      $passwordinputerror .="Paroolid ei uhti";
    }
    else if(strlen($_POST["passwordinput"]) < 8){
      $passwordinputerror .="Parool on liiga luhike!";
    }

    adduser();
    //if (empty("".$inputerror.$firstnameinputerror.$lastnameinputerror.$genderinputerror.$emailinputerror.$passwordinputerror.$passwordsecondaryinputerror)){
    //  adduser();
    //}
    
  }

?>

<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?></h1>
  <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>


  <form method="POST">
    <label for="firstnameinput"> Eesnimi </label>
    <input type="text" name="firstnameinput" id="firstname" placeholder="Eesnimi" value="<?php echo $firstnameinput; ?>"><span><?php echo $firstnameinputerror; ?></span>
    <br>
    <label for="lastnameinput"> Perekonnanimi </label>
    <input type="text" name="lastnameinput" id="lastname" placeholder="Perekonnanimi" value="<?php echo $lastnameinput; ?>"><span><?php echo $lastnameinputerror; ?></span>
    <br> 
    <!-- SEE EI TEE MIDAGI KUI MA EI SISETA KUMBAGI genderit ... mul if vist vaja vb idk honestly-->
    
    <input type="radio" name="genderinput" id="gendermale" value="1" <?php if($genderinput == "1"){echo " checked";}?>><label for="gendermale">Mees</label>
    <input type="radio" name="genderinput" id="genderfemale" value="2" <?php if($genderinput == "2"){echo " checked";}?>><label for="genderfemale">Naine</label>
    <span><?php echo $genderinputerror; ?></span>
    <br>
    <label for="emailinput"> Email </label>
    <input type="email" name="emailinput" id="email" placeholder="Email" value="<?php echo $emailinput; ?>"><span><?php echo $emailinputerror; ?></span>
    <br>
    <label for="passwordinput"> Salasona </label>
    <input type="password" name="passwordinput" id="password" placeholder="Salasona" value="<?php echo $passwordinput; ?>"><span><?php echo $passwordinputerror; ?></span>
    <br>
    <label for="passwordsecondaryinput"> Salasona uuesti</label>
    <input type="password" name="passwordsecondaryinput" id="passwordsecondary" placeholder="Salasona uuesti" value="<?php echo $passwordsecondaryinput; ?>"><span><?php echo $passwordsecondaryinputerror; ?></span>
    <br>
    <input type="submit" name="userinput" value="Salvesta kasutaja andmed"><br><span><?php echo $result; ?></span>
  </form>
<?php echo $inputerror ?>

</body>
</html>