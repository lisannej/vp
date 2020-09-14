<?php
$username = "Lisanne Järv";
$fulltimenow = date("d.m.Y H:i:s");
$hournow = date("H");
$partofday = "lihtsalt aeg";
if($hournow < 6){
	$partofday = "uneaeg";
} // enne 6
if($hournow >= 8 and $hournow <= 18) {
	$partofday = "õppimise aeg";
}
// vaatame semestri kulgemist 
$semesterstart = new DateTime ("2020-8-31"); 
$semesterend = new DateTime ("2020-12-13"); 
$semesterduration = $semesterstart->diff($semesterend); 
$semesterdurationdays = $semesterduration->format ("%r%a"); 
$today = new DateTime ("now"); 
$temp = $semesterstart->diff($today); 
$daysnumber = $temp->days; 
$semesterpercent = $daysnumber/$semesterdurationdays * 100 ; 
 
if ($semesterpercent < 0 ) { 
   $semesterpercent = 0; 
} 
if ($semesterpercent > 1 ) { 
$semesterpercent = 1; 
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
  <p>Lehe avamise hetk: <?php echo $fulltimenow; ?>.</p>
  <p><?php echo "Praegu on " .$partofday ."."; ?></p>
  <p><?php echo "Praegu on moodunud semestri algusest " .$daysnumber ." paeva, mis on ." .$semesterpercent  ?><p>

  <p><?php echo "daysnumber " .$daysnumber ;?></p>
  <p><?php echo "semesterpercent " .$semesterpercent ;?></p>
  <p><?php echo "semesterdurationdays " .$semesterdurationdays ;?></p>
</body>
</html>