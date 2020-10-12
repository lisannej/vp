<?php
    require ("header.php");
    require ("config.php");
    $database = "if20_lisanne_ja_1";
    //kui on idee sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
    if(isset($_POST["ideasubmit"]) and !empty($_POST ["ideainput"])){
        $conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database );
        //valmistan ette SQL kasu
        $stmt = $conn->prepare ("INSERT INTO myideas (idea) VALUES (?) ");
        echo $conn->error;
        //seome kasuga meie parisandmed
        //i - integer, d- decimal, s - string
        $stmt->bind_param("s", $_POST ["ideainput"]);
        $stmt->execute ();
        $stmt->close ();
        $conn->close ();
    }
    
//link avalehele
//<ul>
//<li><a href="home.php" <Avaleht> midagi veel
?>
<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>
  
        <form method = "POST">
            <label>Sisesta oma pahe tulnud mote!</label>
            <input type="text" name="ideainput" placeholder="Kirjuta siia mote!">
            <input type="submit" name="ideasubmit" value="Saada mote ara!"> 
        </form>
    </body>
</html>