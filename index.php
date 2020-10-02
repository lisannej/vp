<?php
  require ("config.php");
  require ("fnc_common.php");
  require ("fnc_user.php");

  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai",
  "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  $firstnameinput ="";
  $lastnameinput="";
  $genderinput="";
  $birthday=null;
  $birthmonth=null;
  $birthyear=null;
  $birthdate=null;
  $emailinput="";

  $passwordinput="";
  $passwordsecondaryinput="";
  $result="";
  $redirect = "";

  $inputerror="";
  $firstnameinputerror="";
  $lastnameinputerror="";
  $genderinputerror="";
  $emailinputerror="";
  $birthdayerror=null;
  $birthmontherror=null;
  $birthyearerror=null;
  $birthdateerror=null;
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
  
  if(isset($_POST["userinput"])){
    if (!empty($_POST["firstnameinput"])){
      $firstnameinput = test_input ($_POST["firstnameinput"]);
    } else {
      $firstnameinputerror = "Palun sisesta eesnimi!";
    }
      
    if (!empty($_POST["lastnameinput"])){
      $lastnameinput = test_input ($_POST["lastnameinput"]);
    } else {
      $lastnameinputerror = "Palun sisesta perekonnanimi!";
    }
  
    if (isset($_POST["genderinput"])){
      $genderinput = intval($_POST["genderinput"]);
    } else{
      $genderinputerror = "Sugu maaramata! ";
    }

    if (!empty($_POST["birthdayinput"])){
      $birthday = intval ($_POST["birthdayinput"]);
    } else {
      $birthdayerror= " Palun vali sunnikuupaev";
    }

    if (!empty($_POST["birthmonthinput"])){
      $birthmonth = intval ($_POST["birthmonthinput"]);
    } else {
      $birthmontherror= " Palun vali sunnikuu";
    }

    if (!empty($_POST["birthyearinput"])){
      $birthyear = intval ($_POST["birthyearinput"]);
    } else {
      $birthyearerror= " Palun vali sunniaasta";
    }

    //kontrollime kuupaeva oigsusst
    if(!empty($birthday) and !empty($birthmonth) and !empty($birthyear)){
      if(checkdate($birthmonth, $birthday, $birthyear)){
          $tempdate = new DateTime($birthyear ."-" .$birthmonth ."-" .$birthday);
          $birthdate = $tempdate->format("Y-m-d");
      } else {
          $birthdateerror = "Kuupaev ei ole reaalne!";
      }
    }

    if (!empty($_POST["emailinput"])){
      $emailinput = test_input ($_POST["emailinput"]);
    } else {
      $emailinputerror = "Palun sisesta email!";
    }

    if(empty($_POST["passwordinput"])){
      $passwordinputerror = "Parool sisestamata!";
    } else {
      if(strlen($_POST["passwordinput"]) < 8){
        $passwordinputerror .="Parool on liiga luhike!";
      }
    }

    if(empty($_POST["passwordsecondaryinput"])){
      $passwordsecondaryinputerror = "Sisesta parool teist korda!";
    } else {
      if($_POST["passwordinput"] != $_POST["passwordsecondaryinput"]){
        $passwordinputerror .="Paroolid ei uhti";
      }
    }

    if (empty($inputerror) and empty($firstnameinputerror) and empty($lastnameinputerror) and empty($genderinputerror) and empty($birthdayerror) and empty($birthmontherror) and empty($birthdyearerror) and empty($emailinputerror) and empty($passwordinputerror) and empty($passwordsecondaryinputerror)){
      $notice = signup($firstnameinput, $lastnameinput, $emailinput, $genderinput, $birthdate, $_POST["passwordinput"]);
      $redirect = "http://greeny.cs.tlu.ee/~lisajar/vp/home.php";

      if($notice == "ok"){
        $result="Koik on korras, kasutaja loodud";
        $firstnameinput ="";
        $lastnameinput="";
        $genderinput="";
        $birthday="";
        $birthmonth="";
        $birthyear="";
        $birthdate="";
        $emailinput="";
      } else {
        $result = "Tekkis tehniline torge: " .$notice;
      }
    } else {
      $redirect = htmlspecialchars($_SERVER["PHP_SELF"]);
    }
  }

  $daydate = date("d");
  $yearnow = date ("Y");
  $hournow = date("H");
  $fulltimenow = date ("H.i.s");
  $partofday = "lihtsalt aeg";
  $weekdaynameset= ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev",
  "reede", "laupäev", "pühapäev"];
  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai",
  "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  //echo $weekdaynamesET
  //var_dump ($weekdaynameset);
  $weekdaynow = date ("N");
  //echo $weekdaynow ;
  $monthnow = date ("m");
  $monthnowint= (int) $monthnow;

  if($hournow < 6){
    $partofday = "uneaeg";
  } // enne 6
  if($hournow >= 6.01 and $hournow <= 9) {
    $partofday = "hommik";
  }
  if($hournow > 9.01 and $hournow <=16) {
    $partofday = "kooliaeg";
  } // 
  if($hournow > 16.01 and $hournow <= 18) {
    $partofday = "õppimise aeg";
  } // oppimine
  if($hournow > 18.01 and $hournow <= 21) {
    $partofday = "ohtu";
  } // ohtu
  if($hournow >21.01 and $hournow < 23.59){
    $partofday = "mine magama";
  } // magama

  // vaatame semestri kulgemist 
  $semesterstart = new DateTime ("2020-8-31"); 
  $semesterend = new DateTime ("2020-12-13"); 
  $semesterduration = $semesterstart->diff($semesterend); 
  $semesterdurationdays = $semesterduration->format ("%r%a"); 
  $today = new DateTime ("now"); 
  $temp = $semesterstart->diff($today); 
  $daysnumber = $temp->days; 
  $semesterpercent = $daysnumber/$semesterdurationdays * 100 ; 
  $semesterpercent = round ($semesterpercent, 2);

  if ($semesterpercent < 0 ) { 
    $semesterpercent = 0; 
  } 
  if ($semesterpercent > 100 ) { 
    $semesterpercent = 1; 
  }
  if ($today < $semesterstart ) {
    echo " Semester pole alanud" ;
  }
  if ($today > $semesterend) {
    echo " Semester on läbi";
  }
  if ($semesterstart < $today && $today < $semesterend ) {
    echo " Semester käib <br>";

  }
  //annan ette lubatud piltivormingute loendi
  $picfiletypes = ["image/jpeg", "image/png"];
  // loeme piltide kataloogi sisu ja naitame pilte
  $allfiles = array_slice (scandir ("vp_pics/"), 2);
  $picfiles = [];
  foreach ($allfiles as $thing) {
    $fileinfo = getImagesize ("vp_pics/" .$thing);
    if (in_array($fileinfo["mime"], $picfiletypes) == true) {
      array_push ($picfiles, $thing);
    }
  }

  //paneme koik pildid ekraanile
  $piccount = count ($picfiles);
  $imghtml = "";
  $i = mt_rand(0, ($piccount - 1));
  $imghtml .= '<img src="vp_pics/' .$picfiles[$i].'"';
  $imghtml .= 'alt="Tallinna Ulikool">';
?>

<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <?php $username = "Lisanne Järv"; ?>
  <title><?php echo $username; ?> programmeerib veebi</title>
</head>
<body>
  <img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>
  <p>Lehe avamise hetk: <?php echo $weekdaynameset [$weekdaynow -1 ],", ".$daydate, ", ".$monthnameset [$monthnowint-1],", ".$yearnow,", " .$fulltimenow; ?>.</p>
  <p><?php echo "Praegu on " .$partofday ."."; ?></p>
  <p><?php echo "Praegu on möödunud semestri algusest " .$daysnumber ." päeva, mis on " .$semesterpercent ." %"; ?><p>
  <h1>Ole palun nii kena ja registreeru</h1>
  <form method="POST" action="<?php echo $redirect; ?>">
    <label for="firstnameinput"> Eesnimi </label>
    <input type="text" name="firstnameinput" id="firstname" placeholder="Eesnimi" value="<?php echo $firstnameinput; ?>"><span><?php echo $firstnameinputerror; ?></span>
    <br>
    <label for="lastnameinput"> Perekonnanimi </label>
    <input type="text" name="lastnameinput" id="lastname" placeholder="Perekonnanimi" value="<?php echo $lastnameinput; ?>"><span><?php echo $lastnameinputerror; ?></span>
    <br> 
    <input type="radio" name="genderinput" id="gendermale" value="1" <?php if($genderinput == "1"){echo " checked";}?>><label for="gendermale">Mees</label>
    <input type="radio" name="genderinput" id="genderfemale" value="2" <?php if($genderinput == "2"){echo " checked";}?>><label for="genderfemale">Naine</label>
    <span><?php echo $genderinputerror; ?></span>
    <br>
    <label for="birthdayinput">Sünnipäev: </label>
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
    <span><?php echo $birthdateerror ." " .$birthdayerror ." " .$birthmontherror ." " .$birthyearerror; ?></span>
    <label for="emailinput"> Email (kasutajatunnus)</label>
    <input type="email" name="emailinput" id="email" placeholder="Email" value="<?php echo $emailinput; ?>"><span><?php echo $emailinputerror; ?></span>
    <br>
    <label for="passwordinput"> Salasona (min 8 tahemarki) </label>
    <input type="password" name="passwordinput" id="password" placeholder="Salasona" value="<?php echo $passwordinput; ?>"><span><?php echo $passwordinputerror; ?></span>
    <br>
    <label for="passwordsecondaryinput"> Salasona uuesti</label>
    <input type="password" name="passwordsecondaryinput" id="passwordsecondary" placeholder="Salasona uuesti" value="<?php echo $passwordsecondaryinput; ?>"><span><?php echo $passwordsecondaryinputerror; ?></span>
    <br>
    <input type="submit" name="userinput" value="Loo kasutaja"><br><span><?php echo $result; ?></span>
  </form>
  <?php echo $inputerror ; ?>
  <?php echo $imghtml ; ?>
  
  
</body>
</html>