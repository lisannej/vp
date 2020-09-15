<?php
$username = "Lisanne Järv";
$fulltimenow = date("d.m.Y H:i:s");
$hournow = date("H");
$partofday = "lihtsalt aeg";
$weekdaynameset= ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev",
 "reede", "laupäev", "pühapäev"];
$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai",
 "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
//echo $weekdaynamesET
var_dump ($weekdaynameset);
$weekdaynow = date ("N");
echo $weekdaynow ;

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
  echo "Semester pole alanud" ;
}
if ($today > $semesterend) {
  echo "Semester on läbi";
}
if ($semesterstart < $today && $today < $semesterend ) {
  echo "Semester käib";
}


?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title><?php echo $username; ?> programmeerib veebi</title>

</head>
<body>
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>
  <p>Lehe avamise hetk: <?php echo $weekdaynameset [$weekdaynow -1 ].", ".$fulltimenow; ?>.</p>
  <p><?php echo "Praegu on " .$partofday ."."; ?></p>
  <p><?php echo "Praegu on möödunud semestri algusest " .$daysnumber ." päeva, mis on " .$semesterpercent ." %"; ?><p>

  
</body>
</html>