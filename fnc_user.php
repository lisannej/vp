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

function signin ($emailinput, $passwordinput) {
    $result = null;
    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $GLOBALS ["database"] );
    $stmt = $conn->prepare("SELECT password FROM vpusers WHERE email = ?");
    echo $conn->error;
    $stmt->bind_param("s", $emailinput);
    $stmt->bind_result ($passwordfromdb);
    if($stmt->execute()){
        //kui tehniliselt korras
        if($stmt->fetch()){
            //kasutaja leiti
            if(password_verify($passwordinput, $passwordfromdb)){
                //parool oige
                $stmt->close();
                //loen sisseloginud kasutaja infot
                $stmt=$conn->prepare("SELECT vpusers_id, firstname, lastname FROM vpusers WHERE email = ?");
                echo $conn->error;
                $stmt->bind_param("s", $emailinput);
                $stmt->bind_result ($idfromdb, $firstnamefromdb, $lastnamefromdb);
                $stmt->execute();
                $stmt->fetch();
                //salvestame sessiooni muutujad
                $_SESSION["userid"] = $idfromdb;
                $_SESSION["userfirstname"]= $firstnamefromdb;
                $_SESSION["userlastname"]= $lastnamefromdb;
//varvid tuleb lugeda profiilist, kui see on olemas
                $_SESSION["userbgcolor"] = "#FFFFFF";
                $_SESSION["usertxtcolor"] = "#000000";

                $stmt->close();
                $conn->close();
                header("Location: home.php");
                exit();
            } else {
                $result = "Vale salasona";
            }
        } else {
            $result = "Sellist kasutajat (" .$emailinput .") ei leitud";
        }
    } else {
        //tehniline viga
        $result= $stmt->error;
    }
    $stmt->close();
    $conn->close();
    return $result;
}

function storeuserprofile ($description, $bgcolor, $txtcolor){
    $conn = new mysqli ($GLOBALS ["serverhost"], $GLOBALS ["serverusername"], $GLOBALS ["serverpassword"], $GLOBALS ["database"] );
    $stmt = $conn->prepare("SELECT vpuserprofiles_id FROM vpuserprofiles WHERE userid = ?");
    echo $conn->error;
    //SQL 
    //kontrollime kas profiil on olemas
    //SELECT vpuserprofiles_id FROM vpuserprofiles WHERE userid = ?
    ///kusimark asendada vaartusega
    //$_SESSION["userid]

    //kui profiili pole olemas siis loome
    //INSERT INTO vpuserprofiles (userid, description, bgcolor, txtcolor) VALUES (?,?,?,?) 

    //kui profiil on olemas siis uuendame
    //UPDATE vpuserprofiles SET description=?, bgcolor= ?, txtcolor= ? WHERE userid = ?

    //execute jms voib loomisel/uuendamisel uhine olla
    $stmt->bind_param("i", $_SESSION["userid"]);
	$stmt->execute();
	if($stmt->fetch()){
		$stmt->close();
		//uuendame profiili
		$stmt= $conn->prepare("UPDATE vpuserprofiles SET description = ?, bgcolor = ?, txtcolor = ? WHERE userid = ?");
		echo $conn->error;
		$stmt->bind_param("sssi", $description, $bgcolor, $txtcolor, $_SESSION["userid"]);
	} else {
		$stmt->close();
		//tekitame uue profiili
		$stmt = $conn->prepare("INSERT INTO vpuserprofiles (userid, description, bgcolor, txtcolor) VALUES(?,?,?,?)");
		echo $conn->error;
		$stmt->bind_param("isss", $_SESSION["userid"], $description, $bgcolor, $txtcolor);
	}
	if($stmt->execute()){
		$notice = "Profiil edukalt salvestatud";
	} else {
		$notice = "Profiili salvestamisel tekkis viga: " .$stmt->error;
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