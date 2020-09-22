<?php
require ("header.php");
$database = "if20_lisanne_ja_1" ;

//var_dump ($GLOBALS);
//funktsionn mis loeb koikide filmide info
function readfilms (){
    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $GLOBALS ["database"] );
    //$stmt = $conn->prepare ("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
    $stmt = $conn->prepare ("SELECT * FROM film");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
    $stmt->execute ();
    $filmhtml = "<ol> \n";
    while ($stmt->fetch ()) {
        $filmhtml .= "\t \t <li>".$titlefromdb ."\n";
        $filmhtml .= "\t \t \t <ul> \n";
        $filmhtml .= "\t \t \t \t <li>Valmimisaasta: " .$yearfromdb ."</li> \n";
        $filmhtml .= "\t \t \t \t <li>Kestus minutites: " .$durationfromdb ." minutit</li> \n";
        $filmhtml .= "\t \t \t \t <li>Zanr: " .$genrefromdb ."</li> \n";
        $filmhtml .= "\t \t \t \t <li>Tootja: " .$studiofromdb ."</li> \n";
        $filmhtml .= "\t \t \t \t <li>Lavastaja: " .$directorfromdb ."</li> \n";
        $filmhtml .= "\t \t \t </ul> \n";
        $filmhtml .= "\t \t </li> \n";
        $filmhtml .= "\t </ol> \n";
    }
    $stmt->close ();
      $conn->close ();
} //readfilms loppeb
?>