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
