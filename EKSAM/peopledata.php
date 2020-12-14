<?php
    require ("examheader.php");
    require ("../config.php");

    $database = "if20_lisanne_ja_1";
    $genderfromdb;
    $maleteacherfromdb;
    $malestudentfromdb="";
    $femalestudentfromdb;
    $femaleteacherfromdb;

    $entryexitfromdb;
    $occupationfromdb;
    $notice;
    $SQLsentence="";

    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $database);
    $stmt = $conn->prepare ("SELECT count(entryexit) FROM inimesed WHERE entryexit=5");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($entryexitfromdb);
    $stmt->execute ();
    $entryexithtml = "";
    while ($stmt->fetch ()) {
        $entryexithtml .= "<p>" .$entryexitfromdb ."</p>";
    }
    $stmt->close ();
    //$conn->close ();

    $stmt = $conn->prepare ("SELECT count(gender) FROM inimesed WHERE gender=1 AND occupation=3");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($genderfromdb);
    $stmt->execute ();
    $malestudenthtml = "";
    while ($stmt->fetch ()) {
        $malestudenthtml .= "<p>" .$malestudentfromdb ."</p>";
    }
    $stmt->close ();
    //$conn->close ();

    $stmt= $conn->prepare ("SELECT count(gender) FROM inimesed WHERE gender=1 AND occupation=4");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($genderfromdb);
    $stmt->execute ();
    $maleteacherhtml = "";
    while ($stmt->fetch ()) {
        $maleteacherhtml .= "<p>" .$maleteacherfromdb ."</p>";
    }
    $stmt->close ();
    //$conn->close ();

    $stmt= $conn->prepare ("SELECT count(gender) FROM inimesed WHERE gender=2 AND occupation=3");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($genderfromdb);
    $stmt->execute ();
    $femalestudenthtml = "";
    while ($stmt->fetch ()) {
        $femalestudenthtml .= "<p>" .$femalestudentfromdb ."</p>";
    }
    $stmt->close ();
    //$conn->close ();

    $stmt= $conn->prepare ("SELECT count(gender) FROM inimesed WHERE gender=2 AND occupation=4");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($genderfromdb);
    $stmt->execute ();
    $femaleteacherhtml = "";
    while ($stmt->fetch ()) {
        $femaleteacherhtml .= "<p>" .$femaleteacherfromdb ."</p>";
    }
    $stmt->close ();
    $conn->close ();

    //echo $notice;

?>
<p> Meessoost õpilasi hoones: <?php echo $malestudenthtml?> <p>
<p> Meessoost õpetajaid hoones: <p>
