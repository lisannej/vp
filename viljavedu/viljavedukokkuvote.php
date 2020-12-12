<?php
    require ("../header.php");
    require ("../config.php");

    $database = "if20_lisanne_ja_1";
    $carfromdb;
    $entermass;
    $exitmass;
    $notice;
    $SQLsentence="";

    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $database);

    $SQLsentence = "SELECT auto_reg_number, sisenemismass, valjumismass FROM viljavedu";
    
    if(isset($_POST["datasubmit"]) and !empty($_POST ["datasubmit"]) and !empty($_POST ["filter"]) and isset($_POST["filter"])){
        $SQLsentence = "SELECT auto_reg_number, sisenemismass, valjumismass FROM viljavedu WHERE auto_reg_number = 4";
        //$SQLsentence .= $_GET["filter"];
    }

    //loen lehele koik olemasolevad motted
    //$conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database );
    $stmt = $conn->prepare($SQLsentence);
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($carfromdb, $entermass, $exitmass);
    $stmt->execute ();
    $carhtml = "";
    while ($stmt->fetch ()) {
        $carhtml .= "<tr> \n";
        $carhtml .= "\t <td>" .$carfromdb ."</td>";
        $carhtml .= "\t <td>" .$entermass ."</td>";
        $carhtml .= "\t <td>" .$exitmass ."</td>";
        $carhtml .= "</tr> \n";
    }
    if(!empty($carhtml)){
        $notice = "<table> \n" ;
        $notice.= "<tr> \n";
        $notice .= "\n\t\t\t" .'<th>Auto registreerimisnumber</th>';
        $notice .= "\n\t\t\t" .'<th>Sisseveo mass</th>';
        $notice .= "\n\t\t\t" .'<th>Valjumismass</th>';
        $notice.= $carhtml;
        $notice.= "</tr> \n";
        $notice.= "</table> \n";
    }
    $stmt->close ();
    $conn->close ();
    
    echo $notice;

?>

<form method="POST">
    <label for="filter"> Vali auto </label>
    <input type="text" name="carinput" id="filter" placeholder="Auto reg number" >
    <input type="submit" name="datasubmit" value="Salvesta filter">
</form>