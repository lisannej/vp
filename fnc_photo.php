<?php
	$database = "if20_lisanne_ja_1";
	
	function storePhotoData($filename, $alttext, $privacy){
		$notice = null;
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO vpphotos (userid, filename, alttext, privacy) VALUES (?, ?, ?, ?)");
		echo $conn->error;
		$stmt->bind_param("issi", $_SESSION["userid"], $filename, $alttext, $privacy);
		if($stmt->execute()){
			$notice = 1;
		} else {
			//echo $stmt->error;
			$notice = 0;
		}
		$stmt->close();
		$conn->close();
		return $notice;
	}

	function readPublicPhotoThumbs($privacy){
		$photohtml= null;
		$notice= null;
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare ("SELECT filename, alttext FROM vpphotos WHERE privacy>=? AND deleted IS NULL");
		echo $conn->error;
		$stmt->bind_param("i", $privacy);
		$stmt->bind_result($filenamefromdb, $alttextfromdb);
		$stmt->execute();
		$temphtml= null;
		while($stmt->fetch()){
			//<img src="failinimi.laiend" alt="alternatiivtekst">
			$temphtml.= '<img src=" '.$GLOBALS["photouploaddir_thumb"] .$filenamefromdb .' "alt=" '.$alttextfromdb .' ">' ."\n";
		}

		if(!empty($temphtml)){
			$photohtml = "<div> \n" .$temphtml ."\n <div> \n";
		} else {
			$photohtml = "<p> Kahjuks galeriipilte ei leitud </p> \n";
		}

		$stmt->close();
		$conn->close();
		return $notice;
	}

