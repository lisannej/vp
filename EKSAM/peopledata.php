<?php
    require ("examheader.php");
    require ("../config.php");

    $database = "if20_lisanne_ja_1";
    $genderfromdb;
    $countfromdb;
    $occupationfromdb;
    $notice;
    $SQLsentence="";

    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $database);

    $stmt = $conn->prepare ("SELECT count, gender, occupation FROM inimesed");
    
    //if(isset($_POST["datasubmit"]) and !empty($_POST ["datasubmit"])){
        //$SQLsentence = "SELECT count, gender, occupation FROM inimesed WHERE count = 5";
    //}
    //$stmt = $conn->prepare($SQLsentence);
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($countfromdb, $genderfromdb, $occupationfromdb);
    $stmt->execute ();
    $lines = "";
    while ($stmt->fetch ()) {
        $lines .= "<tr> \n";
        $lines .= "\t <td>" .$countfromdb ."</td>";
        $lines .= "\t <td>" .$genderfromdb ."</td>";
        $lines .= "\t <td>" .$occupationfromdb ."</td>";
        $lines .= "</tr> \n";
    }
    if(!empty($lines)){
        $notice = "<table> \n" ;
        $notice.= "<tr> \n";
        $notice .= "\n\t\t\t" .'<th>Inimesi hoones sees</th>';
        $notice .= "\n\t\t\t" .'<th>Sugu</th>';
        $notice .= "\n\t\t\t" .'<th>Ala</th>';
        $notice.= $lines;
        $notice.= "</tr> \n";
        $notice.= "</table> \n";
    }
    $stmt->close ();
    $conn->close ();
    
    echo $notice;

?>
