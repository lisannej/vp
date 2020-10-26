<?php

$database = "if20_lisanne_ja_1" ;
$sortby=0;
$sortorder=0;

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
    } 
    $filmhtml .= "\t </ol> \n";

        $stmt->close ();
      $conn->close ();
      return $filmhtml;
} //readfilms loppeb

function savefilm ($titleinput, $yearinput, $durationinput, $genreinput, $studioinput, $directorinput ){
    echo"olen siin";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], 
    $GLOBALS["database"] );
    $stmt = $conn->prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
    echo $conn->error;
    $stmt->bind_param("siisss", $titleinput, $yearinput, $durationinput, $genreinput, $studioinput, $directorinput);
    $stmt->execute ();
    $stmt->close ();
    $conn->close ();
} // savefilm loppeb

function readpersons (){
    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $GLOBALS ["database"] );
    //$stmt = $conn->prepare ("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
    $stmt = $conn->prepare ("SELECT first_name, last_name FROM person");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($firstnamefromdb, $lastnamefromdb);
    $stmt->execute ();
    $personhtml = "<ol> \n";
    while ($stmt->fetch ()) {
        $personhtml .= "\t \t <li>".$firstnamefromdb .$lastnamefromdb ."\n";
		$personhtml .= "\t \t \t <ul> \n";
        $personhtml .= "\t \t </li> \n";
    } 
    $personhtml .= "\t </ol> \n";

        $stmt->close ();
        $conn->close ();
        return $personhtml;
}

function saveperson ($personinput ){
    echo"olen siin";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], 
    $GLOBALS["database"] );
    $stmt = $conn->prepare("INSERT INTO person (first_name, last_name) VALUES(?,?)");
    echo $conn->error;
    $stmt->bind_param("ss", $firstnameinput, $lastnameinput);
    $stmt->execute ();
    $stmt->close ();
    $conn->close ();
} 


function readquotes (){
    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $GLOBALS ["database"] );
    //$stmt = $conn->prepare ("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
    $stmt = $conn->prepare ("SELECT quote_text FROM quote");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($quotefromdb);
    $stmt->execute ();
    $quotehtml = "<ol> \n";
    while ($stmt->fetch ()) {
        $quotehtml .= "\t \t <li>".$quotefromdb ."\n";
        $quotehtml .= "\t \t \t <ul> \n";
        $quotehtml .= "\t \t </li> \n";
    } 
    $quotehtml .= "\t </ol> \n";

        $stmt->close ();
        $conn->close ();
        return $quotehtml;
}

function savequotes ($quoteinput ){
    echo"olen siin";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], 
    $GLOBALS["database"] );
    $stmt = $conn->prepare("INSERT INTO quote (quote_text) VALUES(?)");
    echo $conn->error;
    $stmt->bind_param("s", $quoteinput);
    $stmt->execute ();
    $stmt->close ();
    $conn->close ();
} 

function readpositions (){
    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $GLOBALS ["database"] );
    //$stmt = $conn->prepare ("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
    $stmt = $conn->prepare ("SELECT position_name FROM position");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($positionfromdb);
    $stmt->execute ();
    $positionhtml = "<ol> \n";
    while ($stmt->fetch ()) {
        $positionhtml .= "\t \t <li>".$positionfromdb ."\n";
        $positionhtml .= "\t \t \t <ul> \n";
        $positionhtml .= "\t \t </li> \n";
    } 
    $positionhtml .= "\t </ol> \n";

        $stmt->close ();
        $conn->close ();
        return $positionhtml;
}

function saveposition ($positioninput ){
    echo"olen siin";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], 
    $GLOBALS["database"] );
    $stmt = $conn->prepare("INSERT INTO position (position_name) VALUES(?)");
    echo $conn->error;
    $stmt->bind_param("s", $positioninput);
    $stmt->execute ();
    $stmt->close ();
    $conn->close ();
} 

function readstudio (){
    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $GLOBALS ["database"] );
    //$stmt = $conn->prepare ("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
    $stmt = $conn->prepare ("SELECT company_name FROM production_company");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($studiofromdb);
    $stmt->execute ();
    $studiohtml = "<ol> \n";
    while ($stmt->fetch ()) {
        $studiohtml .= "\t \t <li>".$studiofromdb ."\n";
        $studiohtml .= "\t \t \t <ul> \n";
        $studiohtml .= "\t \t </li> \n";
    } 
    $studiohtml .= "\t </ol> \n";

        $stmt->close ();
        $conn->close ();
        return $studiohtml;
}

function savestudio ($studioinput ){
    echo"olen siin";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], 
    $GLOBALS["database"] );
    $stmt = $conn->prepare("INSERT INTO production_company (company_name) VALUES(?)");
    echo $conn->error;
    $stmt->bind_param("s", $studioinput);
    $stmt->execute ();
    $stmt->close ();
    $conn->close ();
} 
function readgenre (){
    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $GLOBALS ["database"] );
    //$stmt = $conn->prepare ("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
    $stmt = $conn->prepare ("SELECT genre_name FROM genre");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($genrefromdb);
    $stmt->execute ();
    $genrehtml = "<ol> \n";
    while ($stmt->fetch ()) {
        $genrehtml .= "\t \t <li>".$genrefromdb ."\n";
        $genrehtml .= "\t \t \t <ul> \n";
        $genrehtml .= "\t \t </li> \n";
    } 
    $genrehtml .= "\t </ol> \n";

        $stmt->close ();
        $conn->close ();
        return $genrehtml;
}

function savegenre ($genreinput ){
    echo"olen siin";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], 
    $GLOBALS["database"] );
    $stmt = $conn->prepare("INSERT INTO genre (genre_name) VALUES(?)");
    echo $conn->error;
    $stmt->bind_param("s", $genreinput);
    $stmt->execute ();
    $stmt->close ();
    $conn->close ();
} 
?>