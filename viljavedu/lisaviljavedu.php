<?php
    require ("header.php");
    require ("config.php");
    
    $database = "if20_lisanne_ja_1";
    //kui on idee sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
    if(isset($_POST["datasubmit"]) and !empty($_POST ["datasubmit"])){
        $conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database );
        //valmistan ette SQL kasu
        $stmt = $conn->prepare ("INSERT INTO viljavedu (auto_reg_number, sisenemismass, valjumismass) VALUES (?,?,?) ");
        echo $conn->error;
        //seome kasuga meie parisandmed
        //i - integer, d- decimal, s - string
        $stmt->bind_param("s,i,i", $_POST ["datasubmit"]);
        $stmt->execute ();
        $stmt->close ();
        $conn->close ();
    }
?>

<form method="POST">
<label for="carinput"> Lisa auto </label>
    <input type="text" name="carinput" id="carinput" placeholder="Auto" >
    <br>
    <label for="loadinput"> Lisa mis koorma auto toob </label>
    <input type="text" name="loadinput" id="loadinput" placeholder="Koorem" >
    <br>
    <label for="carnumberinput"> Lisa autonumber </label>
    <input type="text" name="carnumberinput" id="carnumberinput" placeholder="Auto number" >
    <br>
    <label for="fullloadinput"> Lisa auto sisenemismass</label>
    <input type="text" name="fullloadinput" id="fullloadinput" placeholder="Auto sisenemismass" >
    <br>
    <label for="emptyloadinput"> Lisa auto valjumismass</label>
    <input type="text" name="emptyloadinput" id="emptyloadinput" placeholder="Auto sisenemismass" >
    <br>
    <input type="submit" name="datasubmit" value="Salvesta andmed">
  </form>
  <?php echo $inputerror ?>