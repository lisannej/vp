<?php
  require ("config.php");
  require ("fnc_common.php");
  require ("fnc_user.php");

  // login info
  $emailinput="";
  $passwordinput="";

  $emailinputerror="";
  $passwordinputerror="";
  $notice = "ok";

  if(isset($_POST["emailinput"])){
    if (!empty($_POST["emailinput"])){
      $emailinput = test_input ($_POST["emailinput"]);
    } else {
      $emailinputerror = "Email sisestamata!";
    }

    if(empty($_POST["passwordinput"])){
      $passwordinputerror = "Parool sisestamata!";
    } else {
      // check if password is correct, if not, give error about wrong password
    }
  }

  if (empty($emailinputerror) and empty($passwordinputerror)){
    // check user existence in db

    if($notice == "ok"){
      $result="Koik on korras, Sisse logitud";
      $emailinput="";
    } else {
      $result = "Tekkis tehniline torge: " .$notice;
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
    $partofday = "Aeg magama minna";
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
  <h4>Ole palun nii kena ja logi sisse, Kui sul kasutajat pole, siis palun registreeru <a href = "http://greeny.cs.tlu.ee/~lisajar/vp/addnewuser.php">siin</a></h4>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="emailinput"> Email</label>
    <input type="email" name="emailinput" id="email" placeholder="Email" value="<?php echo $emailinput; ?>"><span><?php echo $emailinputerror; ?></span>
    <br>
    <label for="passwordinput"> Salasona </label>
    <input type="password" name="passwordinput" id="password" placeholder="Salasona" value="<?php echo $passwordinput; ?>"><span><?php echo $passwordinputerror; ?></span>
    <br>
    <input type="submit" name="userinput" value="Logi sisse"><br><span><?php echo $result; ?></span>
  </form>
  <?php echo $imghtml ; ?>
</body>
</html>