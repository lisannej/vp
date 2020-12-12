<?php
    require ("../header.php");
    require ("../config.php");

    $database = "if20_lisanne_ja_1" ;
    $carfromdb;
    $entermass;
    $exitmass;
    //loen lehele koik olemasolevad motted
    $conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database );
    $stmt = $conn->prepare ("SELECT auto_reg_number, sisenemismass, valjumismass FROM viljavedu");
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
    $stmt->close ();
    $conn->close ();

    //$filmhtml = readquotes();
    $sortby=0;
    $sortorder=0;

    if(isset($_GET["sortby"])and isset($_GET["sortorder"])){
        if($_GET["sortby"]>= 1 and $_GET["sortby"]<= 4){
            $sortby=$_GET["sortby"];
        }
        if($_GET["sortorder"]==1 or $_GET["sortorder"]){
            $sortorder=$_GET["sortorder"];
        }
    }
    //echo readquotes($sortby, $sortorder);
    echo $carhtml;

?>