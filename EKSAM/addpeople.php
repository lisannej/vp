<?php
require ("../header.php");
require ("../config.php");

$genderinput="";
$occupationinput="";
$genderinputerror="";
$database = "if20_lisanne_ja_1";
//kui on andmed sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
if(isset($_POST["datasubmit"]) and !empty($_POST["datasubmit"])){
    $conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database );
    //valmistan ette SQL kasu
    $stmt = $conn->prepare ("INSERT INTO inimesed (gender, occupation) VALUES (?,?) ");
    echo $conn->error;
    //seome kasuga meie parisandmed
    //i - integer, d- decimal, s - string
    $stmt->bind_param("ii", $_POST["genderinput"], $_POST["occupationinput"]);
    $stmt->execute ();
    $stmt->close ();
    $conn->close ();
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="radio" name="genderinput" id="gendermale" value="1" <?php if($genderinput == "1"){echo " checked";}?>><label for="gendermale">Mees</label>
<input type="radio" name="genderinput" id="genderfemale" value="2" <?php if($genderinput == "2"){echo " checked";}?>><label for="genderfemale">Naine</label>
<span><?php echo $genderinputerror; ?></span>
<br>
<input type="radio" name="occupationinput" id="student" value="3" <?php if($occupationinput == "3"){echo " checked";}?>><label for="occupationstudent">Õpilane</label>
<input type="radio" name="occupationinput" id="teacher" value="4" <?php if($occupationinput == "4"){echo " checked";}?>><label for="occupationteacher">Õpetaja</label>
<input type="submit" name="datasubmit" value="Salvesta andmed">
</form>