<?php

require ("header.php");
require ("usesession.php");


  //annan ette lubatud piltivormingute loendi
  $picfiletypes = ["image/jpeg", "image/png"];
  // loeme piltide kataloogi sisu ja naitame pilte
  $allfiles = array_slice (scandir ("vp_pics/"), 2);
  //var_dump ($allfiles);
  //$picfiles = array_slice ($allfiles, 2);
  $picfiles = [];
  //var_dump ($picfiles);
  foreach ($allfiles as $thing) {
    $fileinfo = getImagesize ("vp_pics/" .$thing);
    if (in_array($fileinfo["mime"], $picfiletypes) == true) {
      array_push ($picfiles, $thing);
    }
  }

  //paneme koik pildid ekraanile
  $piccount = count ($picfiles);
  //$i = $i + 1;
  // $i ++
  // $i +=2
  $imghtml = "";
  //<img src="IMG/failinimi.png" alt="text">
  //for ($i = 0; $i < $piccount; $i ++) {
  $i = mt_rand(0, ($piccount - 1));
  $imghtml .= '<img src="vp_pics/' .$picfiles[$i].'"';
  $imghtml .= 'alt="Tallinna Ulikool">';
  //}
  
?>

  <img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p><a href="?logout=1">Logi valja</a></li>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>
  
  
  
  <?php echo $imghtml ; ?>
  
  
</body>
</html>