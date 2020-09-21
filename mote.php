<?php
    require ("header.php");
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
?>
        <form method = "POST">
            <label>Sisesta oma pahe tulnud mote!</label>
            <input type="text" name="ideainput" placeholder="Kirjuta siia mote!">
            <input type="submit" name="ideasubmit" value="Saada mote ara!"> 
        </form>
    </body>
</html>