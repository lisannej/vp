<?php
    require ("examheader.php");
    require ("../config.php");

    $database = "if20_lisanne_ja_1";
    $genderfromdb="";
    $maleteacherfromdb="";
    $malestudentfromdb="";
    $femalestudentfromdb="";
    $femaleteacherfromdb="";

    $entryexitfromdb="";
    $occupationfromdb="";


    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $database);
    $stmt = $conn->prepare ("SELECT count(entryexit) FROM inimesed WHERE entryexit=5");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result($entryexitfromdb);
    $stmt->execute();
    $entryexithtml = "";
    while ($stmt->fetch()) {
        $entryexithtml .= "<p> Inimesi kokku hoones: " .$entryexitfromdb ."</p>";
    }
    $stmt->close();
    
    
    $stmt = $conn->prepare ("SELECT count(entryexit) FROM inimesed WHERE entryexit=5 AND gender=1 AND occupation=3");
    echo $conn->error;
    $stmt->bind_result($entryexitfromdb);
    $stmt->execute();
    $malestudenthtml = "";
    while ($stmt->fetch()) {
        $malestudenthtml .= "<p> Meessoost õpilasi hoones: " .$entryexitfromdb ."</p>";
    }
    $stmt->close ();
    
    $stmt= $conn->prepare ("SELECT count(entryexit) FROM inimesed WHERE entryexit=5 AND gender=1 AND occupation=4");
    echo $conn->error;
    $stmt->bind_result($entryexitfromdb);
    $stmt->execute();
    $maleteacherhtml = "";
    while ($stmt->fetch()) {
        $maleteacherhtml .= "<p> Meessoost õpetajaid hoones: " .$entryexitfromdb ."</p>";
    }
    //$stmt->close ();

    $stmt= $conn->prepare ("SELECT count(entryexit) FROM inimesed WHERE entryexit=5 AND gender=2 AND occupation=3");
    echo $conn->error;
    $stmt->bind_result($entryexitfromdb);
    $stmt->execute();
    $femalestudenthtml = "";
    while ($stmt->fetch()) {
        $femalestudenthtml .= "<p> Naissoost õpilasi hoones: " .$entryexitfromdb ."</p>";
    }
    //$stmt->close ();

    $stmt= $conn->prepare ("SELECT count(entryexit) FROM inimesed WHERE entryexit=5 AND gender=2 AND occupation=4");
    echo $conn->error;
    $stmt->bind_result($entryexitfromdb);
    $stmt->execute();
    $femaleteacherhtml = "";
    while ($stmt->fetch()) {
        $femaleteacherhtml .= "<p> Naissoost õpetajaid hoones: " .$entryexitfromdb ."</p>";
    }
    $stmt->close();
    $conn->close();


 echo $entryexithtml;
 echo $malestudenthtml;
 echo $maleteacherhtml;
 echo $femalestudenthtml;
 echo $femaleteacherhtml;
