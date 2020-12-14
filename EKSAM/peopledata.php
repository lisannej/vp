<?php
    require ("examheader.php");
    require ("../config.php");

    $database = "if20_lisanne_ja_1";
    $genderfromdb;
    $entryexitfromdb;
    $occupationfromdb;
    $notice;
    $SQLsentence="";

    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $database);
    $stmt = $conn->prepare ("SELECT count(entryexit), gender, occupation FROM inimesed WHERE entryexit=5");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($entryexitfromdb, $genderfromdb, $occupationfromdb);
    $stmt->execute ();
    $lines = "";
    while ($stmt->fetch ()) {
        $lines .= "<tr> \n";
        $lines .= "\t <td>" .$entryexitfromdb ."</td>";
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
