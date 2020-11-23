<?php
  //require ("usesession.php");
  require ("sessionmanager_class.php");
  SessionManager::sessionStart("vp20", 0, "/~lisajar/", "greeny.cs.tlu.ee" );
   
  require ("config.php");
  require ("fnc_photo.php");
  require ("fnc_common.php");
  require ("photoupload_class.php");
	
  $tolink = '<script src="javascript/checkfilesize.js" defer></script> ."\n"';
  $inputerror = "";
  $notice = null;
  $filetype = null;
  $filenameprefix = "vp_";
  $filesizelimit = 2097152;//1048576;
  $filetype = null;
  $photouploaddir_orig = "photoupload_orig/";
  $photouploaddir_normal = "photoupload_normal/";
  $photouploaddir_thumb = "photoupload_thumb/";
  $filename = null;
  $photomaxwidth = 600;
  $photomaxheight = 400;
  $thumbsize = 100;
  $privacy = 1;
  $alttext = null;
    
  //kui klikiti submit, siis ...
  if(isset($_POST["photosubmit"])){
	$privacy = intval($_POST["privinput"]);
	$alttext = test_input($_POST["altinput"]);
	//var_dump($_POST);
	//var_dump($_FILES);
	//kas on pilt ja mis tüüpi
	$check = getimagesize($_FILES["photoinput"]["tmp_name"]);
	if($check !== false){
		//var_dump($check);
		if($check["mime"] == "image/jpeg"){
			$filetype = "jpg";
		}
		if($check["mime"] == "image/png"){
			$filetype = "png";
		}
		if($check["mime"] == "image/gif"){
			$filetype = "gif";
		}
	} else {
		$inputerror = "Valitud fail ei ole pilt! ";
	}
	
	//kas on sobiva failisuurusega
	if(empty($inputerror) and $_FILES["photoinput"]["size"] > $filesizelimit){
		$inputerror = "Liiga suur fail!";
	}
	
	//loome uue failinime
	$timestamp = microtime(1) * 10000;
	$filename = $filenameprefix .$timestamp ."." .$filetype;
	
	//ega fail äkki olemas pole
	if(file_exists($photouploaddir_orig .$filename)){
		$inputerror = "Selle nimega fail on juba olemas!";
	}
	
	//kui vigu pole ...
	if(empty($inputerror)){
		
		//võtame kasutusele klassi
		$myphoto = new Photoupload($_FILES["photoinput"], $filetype);
		//teeme pildi väiksemaks
		$myphoto->resizePhoto($photomaxwidth, $photomaxheight, true);
		//lisame vesimärgi
		$myphoto->addWatermark($watermark);
		//salvestame vähendatud pildi
		$result = $myphoto->saveimage($photouploaddir_normal .$filename);
		if($result == 1){
			$notice .= " Vähendatud pildi salvestamine õnnestus!";
		} else {
			$inputerror .= " Vähendatud pildi salvestamisel tekkis tõrge!";
		}
		
		//teeme pisipildi
		$myphoto->resizePhoto($thumbsize, $thumbsize);
		$result = $myphoto->saveimage($photouploaddir_thumb .$filename);
		if($result == 1){
			$notice .= " Pisipildi salvestamine õnnestus!";
		} else {
			$inputerror .= "Pisipildi salvestamisel tekkis tõrge!";
		}
		//eemaldan klassi
		unset($myphoto);
		
		//salvestame originaalpildi
		if(empty($inputerror)){
			if(move_uploaded_file($_FILES["photoinput"]["tmp_name"], $photouploaddir_orig .$filename)){
				$notice .= " Originaalfaili üleslaadimine õnnestus!";
			} else {
				$inputerror .= " Originaalfaili üleslaadimisel tekkis tõrge!";
			}
		}
		
		if(empty($inputerror)){
			$result = storePhotoData($filename, $alttext, $privacy);
			if($result == 1){
				$notice .= " Pildi info lisati andmebaasi!";
				$privacy = 1;
				$alttext = null;
			} else {
				$inputerror .= "Pildi info andmebaasi salvestamisel tekkis tõrge!";
			}
		} else {
			$inputerror .= " Tekkinud vigade tõttu pildi andmeid ei salvestatud!";
		}
		
	}
  }
  /*if(isset($_POST["photosubmit"])){
	//var_dump($_POST);
	//var_dump($_FILES);
	//kas on pilt ja mis tüüpi
	$file = $_FILES["photoinput"];
	//võtame kasutusele klassi
	$myphoto = new Photoupload();
	// kas on uldse pilt ja sobiva suurusega
	if ($myphoto->isImage($file)){
		$inputerror .= "Valitud fail ei ole pilt! ";
	}
	elseif ($myphoto->isAllowedSize($file)){
		$inputerror .= "Valitud fail on liiga suur! ";
	}
	elseif ($myphoto->alreadyExsists($file)){
		$inputerror .= "Sellise nimega fail juba eksisteerib! ";
	}

	// saame failile nime
	$filename = $myphoto->createName($filenameprefix, $filetype);
	if(empty($filename)){
		$inputerror .= "Faili nimetamine ebaonnestus! ";
	}

	// loon klassi temp faili
	$myphoto->createImageFromFile();

	//teeme pildi väiksemaks
	if(empty($inputerror)){
		$myphoto->resizePhoto($photomaxwidth, $photomaxheight, true);
		//lisame vesimärgi
		$myphoto->addWatermark($watermark);
		//salvestame vähendatud pildi
		$result = $myphoto->saveimage($photouploaddir_normal .$filename);
		if($result == 1){
			$notice .= " Vähendatud pildi salvestamine õnnestus!";
		} else {
			$inputerror .= " Vähendatud pildi salvestamisel tekkis tõrge!";
		}
	}

	//teeme pisipildi
	if(empty($inputerror)){
		$myphoto->resizePhoto($thumbsize, $thumbsize);
		$result = $myphoto->saveimage($photouploaddir_thumb .$filename);
		if($result == 1){
			$notice .= " Pisipildi salvestamine õnnestus!";
		} else {
			$inputerror .= "Pisipildi salvestamisel tekkis tõrge!";
		}
	}
	//eemaldan klassi
	unset($myphoto);
	
	//salvestame originaalpildi
	if(empty($inputerror)){
		if(move_uploaded_file($_FILES["photoinput"]["tmp_name"], $photouploaddir_orig .$filename)){
			$notice .= " Originaalfaili üleslaadimine õnnestus!";
		} else {
			$inputerror .= " Originaalfaili üleslaadimisel tekkis tõrge!";
		}
	}
	
	if(empty($inputerror)){
		$result = storePhotoData($filename, $alttext, $privacy);
		if($result == 1){
			$notice .= " Pildi info lisati andmebaasi!";
			$privacy = 1;
			$alttext = null;
		} else {
			$inputerror .= "Pildi info andmebaasi salvestamisel tekkis tõrge!";
		}
	} else {
		$inputerror .= " Tekkinud vigade tõttu pildi andmeid ei salvestatud!";
	}
  }
  */
  
  require("header.php");
?>
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
    <li><a href="?logout=1">Logi välja</a>!</li>
    <li><a href="home.php">Avaleht</a></li>
  </ul>
  
  <hr>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
    <label for="photoinput">Vali pildifail!</label>
	<input id="photoinput" name="photoinput" type="file" required>
	<br>
	<label for="altinput">Lisa pildi lühikirjeldus (alternatiivtekst)</label>
	<input id="altinput" name="altinput" type="text">
	<br>
	<label>Privaatsustase</label>
	<br>
	<input id="privinput1" name="privinput" type="radio" value="1">
	<label for="privinput1">Privaatne (ainult ise näen)</label>
	<input id="privinput2" name="privinput" type="radio" value="2">
	<label for="privinput2">Klubi liikmetele (sisseloginud kasutajad näevad)</label>
	<input id="privinput3" name="privinput" type="radio" value="3">
	<label for="privinput3">Avalik (kõik näevad)</label>
	<br>	
	<input type="submit" name="photosubmit" value="Lae foto üles">
  </form>
  <p>
  <?php
	echo $inputerror;
	echo $notice;
  ?>
  </p>
  
</body>
</html>
