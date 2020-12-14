<?php
require ("examheader.php");
require ("../config.php");

$countinput="";
$genderinput="";
$occupationinput="";
$countinputerror="";
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
      if (isset($_POST["countinput"])){
        $genderinput = intval($_POST["countinput"]);
      } else{
        $countinputerror = "Tegevus määramata! ";
      }
    if (empty($countinputerror) and empty($genderinputerror) and empty($occupationinputerror)){
        $conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database );
        //valmistan ette SQL kasu
        $stmt = $conn->prepare ("INSERT INTO inimesed (count, gender, occupation) VALUES (?,?,?) ");
        echo $conn->error;
        //seome kasuga meie parisandmed
        //i - integer, d- decimal, s - string
        $stmt->bind_param("iii", $_POST["countinput"], $_POST["genderinput"], $_POST["occupationinput"]);
        $stmt->execute ();
        $stmt->close ();
        $conn->close ();
        echo "Andmed salvestati!";
    }
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label for="countinput"> Kas siseneb/väljub? </label>
<br>
<input type="radio" name="countinput" id="countentry" value="5" <?php if($countinput == "5"){echo " checked";}?>><label for="countentry">Siseneb</label>
<input type="radio" name="countinput" id="countexit" value="6" <?php if($countinput == "6"){echo " checked";}?>><label for="countexit">Väljub</label>
<span><?php echo $countinputerror; ?></span>
<br>
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
<span><?php echo $occupationinputerror; ?></span>
<br>
<input type="submit" name="datasubmit" value="Salvesta andmed">


</form>