<?php
require ("examheader.php");
require ("../config.php");

$genderinput="";
$occupationinput="";

$occupationinputerror="";
$genderinputerror="";
$database = "if20_lisanne_ja_1";
//kui on andmed sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
if(isset($_POST["datasubmit"])){
    if (isset($_POST["genderinput"])){
        $genderinput = intval($_POST["genderinput"]);
      } else{
        $genderinputerror = "Sugu määramata! ";
      }
      if (isset($_POST["occupationinput"])){
        $occupationinput = intval($_POST["occupationinput"]);
      } else{
        $occupationinputerror = "Andmed määramata! ";
      }
    if (empty($genderinputerror) and empty($occupationinputerror)){
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
        echo "Andmed salvestati!";
    }
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label for="genderinput"> Kas siseneja on mees/naine? </label>
<br>
<input type="radio" name="genderinput" id="gendermale" value="1" <?php if($genderinput == "1"){echo " checked";}?>><label for="gendermale">Mees</label>
<input type="radio" name="genderinput" id="genderfemale" value="2" <?php if($genderinput == "2"){echo " checked";}?>><label for="genderfemale">Naine</label>
<span><?php echo $genderinputerror; ?></span>
<br>
<label for="occupationinput"> Kas ta on õpilane või õpetaja? </label>
<br>
<input type="radio" name="occupationinput" id="student" value="3" <?php if($occupationinput == "3"){echo " checked";}?>><label for="occupationstudent">Õpilane</label>
<input type="radio" name="occupationinput" id="teacher" value="4" <?php if($occupationinput == "4"){echo " checked";}?>><label for="occupationteacher">Õpetaja</label>
<br>
<input type="submit" name="datasubmit" value="Salvesta andmed">

<label for="genderinput"> Kas väljuja on mees/naine? </label>
<br>
<input type="radio" name="exitgenderinput" id="gendermale" value="1" <?php if($genderinput == "1"){echo " checked";}?>><label for="gendermale">Mees</label>
<input type="radio" name="exitgenderinput" id="genderfemale" value="2" <?php if($genderinput == "2"){echo " checked";}?>><label for="genderfemale">Naine</label>
<span><?php echo $genderinputerror; ?></span>
<br>
<label for="occupationinput"> Kas ta on õpilane või õpetaja? </label>
<br>
<input type="radio" name="occupationinput" id="student" value="3" <?php if($occupationinput == "3"){echo " checked";}?>><label for="occupationstudent">Õpilane</label>
<input type="radio" name="occupationinput" id="teacher" value="4" <?php if($occupationinput == "4"){echo " checked";}?>><label for="occupationteacher">Õpetaja</label>
<br>
<input type="submit" name="datasubmit" value="Salvesta andmed">

</form>