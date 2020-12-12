<?php
    require ("../header.php");
    require ("../config.php");

    $database = "if20_lisanne_ja_1" ;
    $carfromdb;
    $entermass;
    $exitmass;
    $notice;
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

    function carloads ($sortby, $sortorder){
        require ("../config.php");
        $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $GLOBALS ["database"] );
        //$stmt = $conn->prepare ("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
        $SQLsentence= ("SELECT auto_reg_number, sisenemismass, valjumismass FROM viljavedu ");
        if($sortby == 0 and $sortorder == 0) {
            $stmt = $conn->prepare($SQLsentence);
        }
        if($sortby == 1) {
          if($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence ." ORDER BY auto_reg_number DESC"); 
          }
          else {
              $stmt = $conn->prepare($SQLsentence ." ORDER BY sisenemismass"); 
          }
        }
        if($sortby == 2) {
          if($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence ." ORDER BY valjumismass DESC"); 
          }
        }
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
        if(!empty($carhtml)){
            $notice = "<table> \n" ;
            $notice.= "<tr> \n";
            $notice .= "\n\t\t\t" .'<th>Auto registreerimisnumber &nbsp;<a href="?filmsortby=2&filmsortorder=1">&uarr;</a>&nbsp;<a href="?filmsortby=2&filmsortorder=2">&darr;</a></th>';
            $notice .= "\n\t\t\t" .'<th>Sisseveo mass &nbsp;<a href="?filmsortby=3&filmsortorder=1">&uarr;</a>&nbsp;<a href="?filmsortby=3&filmsortorder=2">&darr;</a></th>';
            $notice .= "\n\t\t\t" .'<th>Valjumismass &nbsp;<a href="?filmsortby=1&filmsortorder=1">&uarr;</a>&nbsp;<a href="?filmsortby=1&filmsortorder=2">&darr;</a></th>';
            $notice.= $carhtml;
            $notice.= "</table> \n";
        }
        $stmt->close ();
        $conn->close ();
        return $notice;
    }
    
    //echo readquotes($sortby, $sortorder);
    echo carloads($sortby, $sortorder);

?>