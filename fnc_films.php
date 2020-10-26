<?php

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

function readpeople (){
    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $GLOBALS ["database"] );
    //$stmt = $conn->prepare ("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
    $stmt = $conn->prepare ("SELECT first_name, last_name, birth_date FROM person");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result ($firstnamefromdb, $lastnamefromdb, $birthdayfromdb);
    $stmt->execute ();
    $personhtml = "<ol> \n";
    while ($stmt->fetch ()) {
        $personhtml .= "\t \t <li>".$firstnamefromdb ."" .$lastnamefromdb ."\n";
        $personhtml .= "\t \t \t <ul> \n";
        $personhtml .= "\t \t \t <li>Sunniaasta: " .$birthdayfromdb ."</li> \n";
        $personhtml .= "\t \t \t </ul> \n";
        $personhtml .= "\t \t </li> \n";
    } 
    $personhtml .= "\t </ol> \n";

        $stmt->close ();
        $conn->close ();
        return $personhtml;
}

function saveperson ($firstnameinput, $lastnameinput, $birthdayinput ){
    echo"olen siin";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], 
    $GLOBALS["database"] );
    $stmt = $conn->prepare("INSERT INTO person (first_name, last_name, birth_date) VALUES(?,?,?)");
    echo $conn->error;
    $stmt->bind_param("ssd", $firstnameinput, $lastnameinput, $birthdayinput);
    $stmt->execute ();
    $stmt->close ();
    $conn->close ();
} 

function readquotes($sortby, $sortorder) {
	$notice = "<p>Kahjuks tsitaate ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$SQLsentence = "SELECT first_name, last_name, role, title, quote_text FROM quote JOIN person_in_movie ON quote.person_in_movie_id = person_in_movie.person_in_movie_id JOIN person ON person.person_id = person_in_movie.person_id JOIN movie ON movie.movie_id = person_in_movie.movie_id";

	if($sortby == 0 and $sortorder == 0) {
		$stmt = $conn->prepare($SQLsentence);
	}
	if($sortby == 1) {
	  if($sortorder == 2) {
		$stmt = $conn->prepare($SQLsentence ." ORDER BY role DESC"); 
	  }
	  else {
		  $stmt = $conn->prepare($SQLsentence ." ORDER BY role"); 
	  }
	}
	if($sortby == 2) {
	  if($sortorder == 2) {
		$stmt = $conn->prepare($SQLsentence ." ORDER BY last_name DESC"); 
	  }
	  else {
		  $stmt = $conn->prepare($SQLsentence ." ORDER BY last_name"); 
	  }
	}
	if($sortby == 3) {
	  if($sortorder == 2) {
		$stmt = $conn->prepare($SQLsentence ." ORDER BY title DESC"); 
	  }
	  else {
		  $stmt = $conn->prepare($SQLsentence ." ORDER BY title"); 
	  }
	}
	
	echo $conn->error; // <-- ainult õppimise jaoks!
	$stmt->bind_result($firstnamefromdb, $lastnamefromdb, $rolefromdb, $titlefromdb, $quotefromdb);
	$stmt->execute();
	$lines = "";
	while($stmt->fetch()) {
		$lines .= "\t<tr>\n\t\t\t<td>" .'"' .$quotefromdb .'"' ."</td>\n";
		$lines .= "\t\t\t<td>" .$rolefromdb ."</td>\n";
		$lines .= "\t\t\t<td>" .$firstnamefromdb . " " .$lastnamefromdb ."</td>\n";
		$lines .= "\t\t\t<td>" .$titlefromdb ."</td>\n\t\t</tr>\n\t";		
	}
	if(!empty($lines)) {
		$notice = "<table>\n\t\t<tr>\n\t\t\t<th>Tsitaat</th>";
		$notice .= "\n\t\t\t" .'<th>Roll &nbsp;<a href="?quotesortby=1&quotesortorder=1">&uarr;</a>&nbsp;<a href="?quotesortby=1&quotesortorder=2">&darr;</a></th>';
		$notice .= "\n\t\t\t" .'<th>Näitleja &nbsp;<a href="?quotesortby=2&quotesortorder=1">&uarr;</a>&nbsp;<a href="?quotesortby=2&quotesortorder=2">&darr;</a></th>';
		$notice .= "\n\t\t\t" .'<th>Film &nbsp;<a href="?quotesortby=3&quotesortorder=1">&uarr;</a>&nbsp;<a href="?quotesortby=3&quotesortorder=2">&darr;</a></th>' ."\n\t";
		$notice .= "\t</tr>\n\t" .$lines ."</table>\n";
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
} // readquotes lõpeb

function savequote ($quoteinput ){
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

function readpositions($sortby, $sortorder) {
	$notice = "<p>Kahjuks ametikohti ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$SQLsentence = "SELECT position_name, description FROM position";

	if($sortby == 0 and $sortorder == 0) {
		$stmt = $conn->prepare($SQLsentence);
	}
	if($sortby == 1) {
	  if($sortorder == 2) {
		$stmt = $conn->prepare($SQLsentence ." ORDER BY position_name DESC"); 
	  }
	  else {
		  $stmt = $conn->prepare($SQLsentence ." ORDER BY position_name"); 
	  }
	}
	
	echo $conn->error; // <-- ainult õppimise jaoks!
	$stmt->bind_result($namefromdb, $descfromdb);
	$stmt->execute();
	$lines = "";
	while($stmt->fetch()) {
		$lines .= "\t<tr>\n\t\t\t<td>" .$namefromdb ."</td>\n";
		if(!empty($descfromdb)) {
			$lines .= "\t\t\t<td>" .$descfromdb ."</td>\n\t\t</tr>\n\t";
		}
		else {
			$lines .= "\t\t\t<td> </td>\n\t\t</tr>\n\t";
		}	
	}
	if(!empty($lines)) {
		$notice = "<table>\n\t\t<tr>\n\t\t\t" .'<th>Ametikoht &nbsp;<a href="?positionsortby=1&positionsortorder=1">&uarr;</a>&nbsp;<a href="?positionsortby=1&positionsortorder=2">&darr;</a></th>';
		$notice .= "\n\t\t\t<th>Lühikirjeldus</th>\n\t";
		$notice .= "\t</tr>\n\t" .$lines ."</table>\n";
	}
	
	$stmt->close();
	$conn->close();
	return $notice;
} // readpositions lõpeb

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
?>