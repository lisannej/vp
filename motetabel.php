<?php
require ("header.php");
require ("config.php");
$database = "if20_lisanne_ja_1" ;
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
?>

<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>

<?php echo $ideahtml; ?>
</body>
</html>