<?php
require ("../header.php");
require ("../config.php");

$genderinput="";
$studentinput="";
$teacherinput="";

$database = "if20_lisanne_ja_1";
//kui on idee sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
if(isset($_POST["datasubmit"]) and !empty($_POST["datasubmit"])){
    $conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database );
    //valmistan ette SQL kasu
    $stmt = $conn->prepare ("INSERT INTO inimesed (female, male, student, teacher) VALUES (?,?,?,?) ");
    echo $conn->error;
    //seome kasuga meie parisandmed
    //i - integer, d- decimal, s - string
    $stmt->bind_param("iiii", $_POST["genderinput"], $_POST["studentinput"], $_POST["teacherinput"]);
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
<input type="radio" name="studentinput" id="student" value="3" <?php if($studentinput == "3"){echo " checked";}?>><label for="student">Õpilane</label>
<input type="radio" name="teacherinput" id="teacher" value="4" <?php if($teacherinput == "4"){echo " checked";}?>><label for="teacher">Õpetaja</label>
<input type="submit" name="datasubmit" value="Salvesta andmed">
</form>