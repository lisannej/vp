<?php
require ("header.php");
require ("config.php");
$database = "if20_lisanne_ja_1" ;
//loen lehele koik olemasolevad motted
$conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database );
//$stmt = $conn->prepare ("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
$stmt = $conn->prepare ("SELECT * FROM film");
echo $conn->error;
//seome tulemuse muutujaga
$stmt->bind_result ($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
$stmt->execute ();
$filmhtml = "<ol> \n";
while ($stmt->fetch ()) {
    $filmhtml .= "\t \t <li>".$titlefromdb ."\n";
    $filmhtml .= "\t \t \t <ul> \n";

    $filmhtml .= "\t \t \t </ul> \n";
    $filmhtml .= "\t \t </li> \n";
    $filmhtml .= "\t </ol> \n";
}
$stmt->close ();
  $conn->close ();
?>



<?php echo $filmhtml; ?>
</body>
</html>