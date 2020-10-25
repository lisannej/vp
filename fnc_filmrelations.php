<?php
 $database = "if20_lisanne_ja_1";

 function readpersontoselect($selectedperson){
	$notice = "<p>Kahjuks tegelast ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT person_id, first_name, last_name FROM person");
	echo $conn->error;
	$stmt->bind_result($idfromdb, $firstnamefromdb, $lastnamefromdb);
	$stmt-> execute ();
	$person = "";
	while($stmt->fetch()){
		$person .= '<option value=" ' .$idfromdb .'"';
		if ($idfromdb == $selectedperson) {
			$person.= " selected";
		}
		$person.= ">" .$firstnamefromdb ." " .$lastnamefromdb ."</option> \n";
	}
	if(!empty($person)){
		$notice = '<select name="personinput" id="personinput">' ."\n";
		$notice .= '<option value="" selected disabled> Vali tegelane</option>' ."\n";
		$notice .= $person;
		$notice .= "</select> \n";
	}
	$stmt->close();
 	$conn->close();
 	return $notice;
 } 
 function storenewpersonrelation ($selectedfilm, $selectedperson){
	$notice = "";
 	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
 	$stmt = $conn->prepare("SELECT person_id FROM person WHERE person_id = ? AND movie_id = ?");
 	echo $conn->error;
 	$stmt->bind_param("ii", $selectedfilm, $selectedperson);
 	$stmt->bind_result($idfromdb);
	$stmt->execute();
 	if($stmt->fetch()){
 		$notice = "Selline seos on juba olemas!";
 	} else {
 		$stmt->close();
 		$stmt = $conn->prepare("INSERT INTO person (movie_id, person_id) VALUES(?,?)");
 		echo $conn->error;
 		$stmt->bind_param("ii", $selectedfilm, $selectedperson);
 		if($stmt->execute()){
 			$notice = "Uus seos edukalt salvestatud!";
 		} else {
 			$notice = "Seose salvestamisel tekkis tehniline tõrge: " .$stmt->error;
 		}
 	}

 	$stmt->close();
 	$conn->close();
 	return $notice;
 } 

 function readquotetoselect($selectedquote){
	$notice = "<p>Kahjuks fraasi ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT quote_id, quote_text FROM quote");
	echo $conn->error;
	$stmt->bind_result($idfromdb, $quotefromdb);
	$stmt-> execute ();
	$quotes = "";
	while($stmt->fetch()){
		$quotes .= '<option value=" ' .$idfromdb .'"';
		if ($idfromdb == $selectedquote) {
			$quotes.= " selected";
		}
		$quotes.= ">" .$quotefromdb ."</option> \n";
	}
	if(!empty($quotes)){
		$notice = '<select name="quoteinput" id="quoteinput">' ."\n";
		$notice .= '<option value="" selected disabled> Vali fraas</option>' ."\n";
		$notice .= $quotes;
		$notice .= "</select> \n";
	}
	$stmt->close();
 	$conn->close();
 	return $notice;
 } 
 function storenewquoterelation ($selectedfilm, $selectedquote){
	$notice = "";
 	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
 	$stmt = $conn->prepare("SELECT quote_id FROM quote WHERE quote_id = ? AND movie_id = ?");
 	echo $conn->error;
 	$stmt->bind_param("ii", $selectedfilm, $selectedquote);
 	$stmt->bind_result($idfromdb);
 	$stmt->execute();
 	if($stmt->fetch()){
 		$notice = "Selline seos on juba olemas!";
 	} else {
 		$stmt->close();
 		$stmt = $conn->prepare("INSERT INTO quote (movie_id, quote_id) VALUES(?,?)");
 		echo $conn->error;
 		$stmt->bind_param("ii", $selectedfilm, $selectedquote);
 		if($stmt->execute()){
 			$notice = "Uus seos edukalt salvestatud!";
 		} else {
 			$notice = "Seose salvestamisel tekkis tehniline tõrge: " .$stmt->error;
 		}
 	}

 	$stmt->close();
 	$conn->close();
 	return $notice;
 } 

 function readstudiotoselect($selectedstudio){
	$notice = "<p>Kahjuks stuudioid ei leitud!</p> \n";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT production_company_id, company_name FROM production_company");
	echo $conn->error;
	$stmt->bind_result($idfromdb, $companyfromdb);
	$stmt-> execute ();
	$studios = "";
	while($stmt->fetch()){
		$studios .= '<option value=" ' .$idfromdb .'"';
		if ($idfromdb == $selectedstudio) {
			$studios.= " selected";
		}
		$studios.= ">" .$companyfromdb ."</option> \n";
	}
	if(!empty($studios)){
		$notice = '<select name="studioinput" id="studioinput">' ."\n";
		$notice .= '<option value="" selected disabled> Vali stuudio</option>' ."\n";
		$notice .= $studios;
		$notice .= "</select> \n";
	}
	$stmt->close();
 	$conn->close();
 	return $notice;
 } 
 function storenewstudiorelation ($selectedfilm, $selectedstudio){

}
 

 function readmovietoselect($selected){
 	$notice = "<p>Kahjuks filme ei leitud!</p> \n";
 	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
 	$stmt = $conn->prepare("SELECT movie_id, title FROM movie");
 	echo $conn->error;
 	$stmt->bind_result($idfromdb, $titlefromdb);
 	$stmt->execute();
 	$films = "";
 	while($stmt->fetch()){
 		$films .= '<option value="' .$idfromdb .'"';
 		if(intval($idfromdb) == $selected){
 			$films .=" selected";
 		}
 		$films .= ">" .$titlefromdb ."</option> \n";
 	}
 	if(!empty($films)){
 		$notice = '<select name="filminput" id="filminput">' ."\n";
 		$notice .= '<option value="" selected disabled>Vali film</option>' ."\n";
 		$notice .= $films;
 		$notice .= "</select> \n";
 	}
 	$stmt->close();
 	$conn->close();
 	return $notice;
 }

 function readgenretoselect($selected){
 	$notice = "<p>Kahjuks žanre ei leitud!</p> \n";
 	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
 	$stmt = $conn->prepare("SELECT genre_id, genre_name FROM genre");
 	echo $conn->error;
 	$stmt->bind_result($idfromdb, $genrefromdb);
 	$stmt->execute();
 	$genres = "";
 	while($stmt->fetch()){
 		$genres .= '<option value="' .$idfromdb .'"';
 		if(intval($idfromdb) == $selected){
 			$genres .=" selected";
 		}
 		$genres .= ">" .$genrefromdb ."</option> \n";
 	}
 	if(!empty($genres)){
 		$notice = '<select name="filmgenreinput" id="filmgenreinput">' ."\n";
 		$notice .= '<option value="" selected disabled>Vali žanr</option>' ."\n";
 		$notice .= $genres;
 		$notice .= "</select> \n";
 	}
 	$stmt->close();
 	$conn->close();
 	return $notice;
 }
 function storenewgenrerelation($selectedfilm, $selectedgenre){
	$notice = "";
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT movie_genre_id FROM movie_genre WHERE movie_id = ? AND genre_id = ?");
	echo $conn->error;
	$stmt->bind_param("ii", $selectedfilm, $selectedgenre);
	$stmt->bind_result($idfromdb);
	$stmt->execute();
	if($stmt->fetch()){
		$notice = "Selline seos on juba olemas!";
	} else {
		$stmt->close();
		$stmt = $conn->prepare("INSERT INTO movie_genre (movie_id, genre_id) VALUES(?,?)");
		echo $conn->error;
		$stmt->bind_param("ii", $selectedfilm, $selectedgenre);
		if($stmt->execute()){
			$notice = "Uus seos edukalt salvestatud!";
		} else {
			$notice = "Seose salvestamisel tekkis tehniline tõrge: " .$stmt->error;
		}
	}

	$stmt->close();
	$conn->close();
	return $notice;
} 
function readpersonsinfilm($sortby, $sortorder){
	$notice = "<p>Kahjuks tegelasi ei leitud!</p> \n";
	 $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	 $SQLsentence= "SELECT first_name, last_name, role, title FROM person JOIN person_in_movie ON person.person_id = person_in_movie.person_id JOIN movie ON movie.movie_id = person_in_movie.movie_id
	 ";
	if($sortby==0 and $sortorder== 0){
		$stmt = $conn->prepare($SQLsentence);
	 }
	 if($sortby==4){
		 if($sortorder==2){
			$stmt = $conn->prepare($SQLsentence ." ORDER BY title DESC");
		 } else {
			$stmt = $conn->prepare($SQLsentence);
		 }
	 }
 	
	 echo $conn->error;
	 $stmt->bind_result($firstnamefromdb, $lastnamefromdb, $rolefromdb, $titlefromdb);
	 $stmt->execute();
	 $lines="";
	 while($stmt->fetch()){
		$lines.= "<tr> \n";
		$lines.= "\t <td>" .$firstnamefromdb ." " .$lastnamefromdb ."</td>";
		$lines.= "<td>" .$rolefromdb ."</td>";
		$lines.= "<td>" .$titlefromdb ."</td> \n";
		$lines.= "</tr> \n";
	 }
	 if(!empty($lines)){
		 $notice = "<table> \n" ;
		 $notice.= "<tr> \n";
		 $notice.= "<th>Isiku nimi</th><th>Roll filmis</th>" .'<th>Film &nbsp;<a href="?sortby=4&sortorder=1">&uarr;</a> &nbsp;<a href="?sortby=4&sortorder=2">&darr;</a></th>' ."\n";
		$notice.= $lines;
		$notice.= "</table> \n";
	 }
	 $stmt->close();
 	$conn->close();
 	return $notice;
 
}

function old_version_readpersonsinfilm(){
	$notice = "<p>Kahjuks tegelasi ei leitud!</p> \n";
 	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
 	$stmt = $conn->prepare("SELECT first_name, last_name, role, title FROM person JOIN person_in_movie ON person.person_id = person_in_movie.person_id JOIN movie ON movie.movie_id = person_in_movie.movie_id
	 ");
	 echo $conn->error;
	 $stmt->bind_result($firstnamefromdb, $lastnamefromdb, $rolefromdb, $titlefromdb);
	 $stmt->execute();
	 $lines="";
	 while($stmt->fetch()){
		 $lines.="<p>" .$firstnamefromdb ." " .$lastnamefromdb;
		 if(!empty($rolefromdb)){
			 $lines.= " on tegelane " .$rolefromdb;
		 }
		 $lines.= ' filmis " ' .$titlefromdb .'" .' ."\n";
	 }
	 if(!empty($lines)){
		 $notice = $lines ;

	 }
	 $stmt->close();
 	$conn->close();
 	return $notice;
 
}

 