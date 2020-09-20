<?php
//var_dump ($_POST);
require ("config.php");
$database = "if20_lisanne_ja_1" ;
//kui on idee sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
if(isset($_POST["ideasubmit"]) and !empty($_POST ["ideainput"])){
  $conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database );
  //valmistan ette SQL kasu
  $stmt = $conn->prepare ("INSERT INTO myideas (idea) VALUES (?) ");
  echo $conn->error;
  //seome kasuga meie parisandmed
  //i - integer, d- decimal, s - string
  $stmt->bind_param("s", $_POST ["ideainput"]);
  $stmt->execute ();
  $stmt->close ();
  $conn->close ();
} 
//loen lehele koik olemasolevad motted
$conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database );
$stmt = $conn->prepare ("SELECT idea FROM myideas");
echo $conn->error;
//seome tulemuse muutujaga
$stmt->bind_result ($ideafromdb);
$stmt->execute ();
$ideahtml = "";
while ($stmt->fetch ()) {
    $ideahtml .= "<p>" .$ideafromdb ."</p>";
}
$stmt->close ();
  $conn->close ();


$username = "Lisanne Järv";
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
$monthnow = date ("F");

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
<<<<<<< Updated upstream
  echo " Semester käib <br>";
=======
  echo " Semester käib?<br>";
>>>>>>> Stashed changes
}
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
for ($i = 0; $i < $piccount; $i ++) {
    $imghtml .= '<img src="vp_pics/' .$picfiles[$i].'"';
    $imghtml .= 'alt="Tallinna Ulikool">';
}
require ("header.php");
?>

  <img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>
  <p>Lehe avamise hetk: <?php echo $weekdaynameset [$weekdaynow -1 ],", ".$daydate, ", ".$monthnameset [$monthnow -1 ],", ".$yearnow,", " .$fulltimenow; ?>.</p>
  <p><?php echo "Praegu on " .$partofday ."."; ?></p>
  <p><?php echo "Praegu on möödunud semestri algusest " .$daysnumber ." päeva, mis on " .$semesterpercent ." %"; ?><p>
  <hr>
  <?php echo $imghtml ; ?>
  
  <hr>
  <form method = "POST">
    <label>Sisesta oma pahe tulnud mote!</label>
    <input type="text" name="ideainput" placeholder="Kirjuta siia mote!">
    <input type="submit" name="ideasubmit" value="Saada mote ara!"> 
  </form>
  <hr>
  <?php echo $ideahtml; ?>
</body>
</html>