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



<?php echo $ideahtml; ?>
</body>
</html>