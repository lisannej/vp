<?php
    require ("examheader.php");
    require ("../config.php");

    $database = "if20_lisanne_ja_1";
    $genderfromdb;
    $maleteacherfromdb="";
    $malestudentfromdb="";
    $femalestudentfromdb="";
    $femaleteacherfromdb="";

    $entryexitfromdb;
    $occupationfromdb;
    $notice;
    $SQLsentence="";

    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $database);
    $stmt = $conn->prepare ("SELECT entryexit FROM inimesed WHERE entryexit=5");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($entryexitfromdb);
    $stmt->execute ();
    $entryexithtml = "";
    while ($stmt->fetch ()) {
        $entryexithtml .= "<p> Inimesi kokku hoones" .$entryexitfromdb ."</p>";
    }
    //$stmt->close ();

    $stmt = $conn->prepare ("SELECT Count(gender) FROM inimesed WHERE gender=1 AND occupation=3");
    echo $conn->error;
    $stmt->bind_result ($genderfromdb);
    $stmt->execute ();
    $malestudenthtml = "";
    while ($stmt->fetch ()) {
        $malestudenthtml .= "<p> Meessoost õpilasi hoones: " .$malestudentfromdb ."</p>";
    }
    $stmt->close ();

    $stmt= $conn->prepare ("SELECT Count(gender) FROM inimesed WHERE gender=1 AND occupation=4");
    echo $conn->error;
    $stmt->bind_result ($genderfromdb);
    $stmt->execute ();
    $maleteacherhtml = "";
    while ($stmt->fetch ()) {
        $maleteacherhtml .= "<p> Meessoost õpetajaid hoones: " .$maleteacherfromdb ."</p>";
    }
    $stmt->close ();

    $stmt= $conn->prepare ("SELECT count(gender) FROM inimesed WHERE gender=2 AND occupation=3");
    echo $conn->error;
    $stmt->bind_result ($genderfromdb);
    $stmt->execute ();
    $femalestudenthtml = "";
    while ($stmt->fetch ()) {
        $femalestudenthtml .= "<p> Naissoost õpilasi hoones: " .$femalestudentfromdb ."</p>";
    }
    $stmt->close ();

    $stmt= $conn->prepare ("SELECT count(gender) FROM inimesed WHERE gender=2 AND occupation=4");
    echo $conn->error;
    $stmt->bind_result ($genderfromdb);
    $stmt->execute ();
    $femaleteacherhtml = "";
    while ($stmt->fetch ()) {
        $femaleteacherhtml .= "<p> Naissoost õpetajaid hoones: " .$femaleteacherfromdb ."</p>";
    }
    $stmt->close ();
    $conn->close ();


?>
<p> Meessoost õpilasi hoones: <?php echo $malestudenthtml?></p>
<p> Meessoost õpetajaid hoones: <?php echo $maleteacherhtml?></p>
<p> Naissoost õpilasi hoones: <?php echo $femalestudenthtml?></p>
<p> Naissoost õpetajaid hoones: <?php echo $femaleteacherhtml?></p>
