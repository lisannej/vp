<?php
$database = "if20_lisanne_ja_1" ;

function signup($firstnameinput, $lastnameinput, $emailinput, $genderinput, $birthdate, $passwordinput){
    $notice = null;
    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $GLOBALS ["database"] );
    $stmt = $conn->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES (?,?,?,?,?,?)");
    echo $conn->error;

    //krupteerime salasona
    $options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
    $pwdhash = password_hash($passwordinput, PASSWORD_BCRYPT, $options);

    $stmt->bind_param("sssiss", $firstnameinput, $lastnameinput, $birthdate, $genderinput, $emailinput, $pwdhash);

    if($stmt->execute()){
        $result = "ok";
    } else {
        $result = $stmt->error;
    }
    $stmt->close();
    $conn->close();
    return $result;
}

function signin($email, $password){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT password FROM vpusers WHERE email = ?");
	echo $conn->error;
	$stmt->bind_param("s", $email);
	$stmt->bind_result($passwordfromdb);
	
	if($stmt->execute()){
		//kui tehniliselt korras
		if($stmt->fetch()){
			//kasutaja leiti
			if(password_verify($password, $passwordfromdb)){
				//parool õige
				$stmt->close();
				
				//loen sisseloginud kasutaja infot
				$stmt = $conn->prepare("SELECT vpusers_id, firstname, lastname FROM vpusers WHERE email = ?");
				echo $conn->error;
				$stmt->bind_param("s", $email);
				$stmt->bind_result($idfromdb, $firstnamefromdb, $lastnamefromdb);
				$stmt->execute();
				$stmt->fetch();
				//salvestame sessioonimuutujad
				$_SESSION["userid"] = $idfromdb;
				$_SESSION["userfirstname"] = $firstnamefromdb;
				$_SESSION["userlastname"] = $lastnamefromdb;
				
				//värvid tuleb lugeda profiilist, kui see on olemas
				$stmt->close();
				$stmt = $conn->prepare("SELECT bgcolor, txtcolor FROM vpuserprofiles WHERE userid = ?");
				$stmt->bind_param("i", $_SESSION["userid"]);
				$stmt->bind_result($bgcolorfromdb, $txtcolorfromdb);
				$stmt->execute();
				if($stmt->fetch()){
					$_SESSION["usertxtcolor"] = $txtcolorfromdb;
					$_SESSION["userbgcolor"] = $bgcolorfromdb;
				} else {
					$_SESSION["usertxtcolor"] = "#000000";
					$_SESSION["userbgcolor"] = "#FFFFFF";
				}
				
				$stmt->close();
				$conn->close();
				header("Location: home.php");
				exit();
			} else {
				$notice = "Vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat (" .$email .") ei leitud!";
		}
	} else {
		//tehniline viga
		$notice = $stmt->error;
	}
	$stmt->close();
	$conn->close();
	return $notice;
  }


function readuserdescription (){
    //kui profiil on olemas, loeb kasutaja luhitutvustuse
    $notice = null;
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		//vaatame, kas on profiil olemas
		$stmt = $conn->prepare("SELECT description FROM vpuserprofiles WHERE userid = ?");
		echo $conn->error;
		$stmt->bind_param("i", $_SESSION["userid"]);
		$stmt->bind_result($descriptionfromdb);
		$stmt->execute();
		if($stmt->fetch()){
			$notice = $descriptionfromdb;
		}
		$stmt->close();
		$conn->close();
		return $notice;
}