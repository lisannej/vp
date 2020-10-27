<?php
require ("usesession.php");
require ("header.php");
require ("config.php");

$inputerror=""; 
$notice= null;
$filetype=null;
$filesizelimit=1048576;
$photouploaddir_orig= "photoupload_orig/";
$photouploaddir_normal= "photoupload_normal/";
$filenameprefix= "vp_";
$filename= null;
$photomaxwidth= 600;
$phtotmaxheight=400;

//kui klikiti submit siis
if(isset($_POST["photosubmit"])){
    //var_dump($_POST);
    //var_dump($_FILES);
    $check = getimagesize(($_FILES["photoinput"]["tmp_name"]));
    if($check!== false){
        if($check["mime"]== "image/jpg"){
            $filetype="jpg";
        }
        if($check["mime"]== "image/png"){
            $filetype="png";
    }
    if($check["mime"]== "image/gif"){
        $filetype="gif";
    } else {
    $inputerror="Valitud fail ei ole pilt! ";
    }
}
}
    //kontrollime faili suurust
    if(empty($inputerror) and $_FILES["photoinput"]["size"]> $filesizelimit){
    $inputerror="Liiga suur fail! ";
    }
    //loome uue failinime
    $timestamp = microtime(1)*10000;
    $filename = $filenameprefix .$timestamp ."." .$filetype;

    //kontrollime kas fail on olemas juba
    if(file_exists($photouploaddir_orig .$filename)){
        $inputerror="Selle nimega fail on juba olemas! ";
    }
        if(empty($inputerror)){
            $target = $photouploaddir_orig;
            //muudame suurust
            //loome pikslikogumi, pildi objekti
            if($filetype=="jpg"){
                $mytempimage = imagecreatefromjpeg($_FILES["photoinput"]["tmp_name"]);
            }
            if($filetype=="png"){
                $mytempimage = imagecreatefrompng($_FILES["photoinput"]["tmp_name"]);
            }
            if($filetype=="gif"){
                $mytempimage = imagecreatefromgif($_FILES["photoinput"]["tmp_name"]);
            }
        
            //teeme kindlaks originaalsuuruse
            $imagew = imagesx($mytempimage);
            $imageh = imagesy($mytempimage);
            if($imagew > $photomaxwidth or $imageh > $photomaxheight){
                if($imagew / $photomaxwidth > $imageh / $photomaxheight){
                    $photosizeratio = $imagew / $photomaxwidth;
                } else {
                    $photosizeratio = $imageh / $photomaxheight;
                }
            
                //arvutame uued moodud
                $neww = round($imagew / $photosizeratio);
                $newh = round($imageh / $photosizeratio);
                //teeme uue pikslikogumi
                $mynewtempimage = imagecreatetruecolor($neww, $newh);
                //kirjutame jarelejaavad pikslid uuele pildile
                imagecopyresampled($mynewtempimage, $mytempimage, 0, 0, 0, 0, $neww, $newh, $imagew, $imageh);
                //salvestame faili
               
            //kui pole vaja muuta suurust
            } else {
                $notice = saveimage ($mytempimage, $filetype);
            }
                imagedestroy($mynewtempimage);
            
        if(move_uploaded_file($_FILES["photoinput"]["tmp_name"], $photouploaddir_orig .$filename)){
            $notice .= "Originaalpildi salvestamine onnestus! ";

        }else {
            $notice .= "Originaalpildi salvestamisel tekkis viga! ";
        }
        }
            

function saveimage($mytempimage, $filetype, $filename){
    $notice = null;
    if($filetype=="jpg"){
        if(imagejpeg($mynewtempimage, $photouploaddir_normal .$filename, 90)){
            $notice = "Vahendatud pildi salvestamine onnestus!";
        } else {
            $notice = "Vahendatud pildi salvestamisel tekkis viga";
        }
    if($filetype=="png"){
        if(imagepng($mynewtempimage, $photouploaddir_normal .$filename, 6)){
            $notice = "Vahendatud pildi salvestamine onnestus!";
        } else {
            $notice = "Vahendatud pildi salvestamisel tekkis viga";
        }
    if($filetype=="gif"){
        if(imagegif($mynewtempimage, $photouploaddir_normal .$filename)){
            $notice = "Vahendatud pildi salvestamine onnestus!";
        } else {
            $notice = "Vahendatud pildi salvestamisel tekkis viga";
        }
    }
}
    }
    return $notice;
}
    
?>


<img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See konkreetne veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p> See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli </a> 
  Digitehnoloogiate instituudis.</p>

<form method="POST" action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"])?>" enctype="value">
  <label for="photoinput">Vali pildifail</label>
  <input id="photoinput" name="photoinput" type="file" required>
  <br>
  <label for="altinput">Lisa pildi luhikirjeldus (alternatiivtekst)</label>
  <input id="altinput" name="altinput" type="text">
  <br>
  <label>Privaatsustase</label>
  <br>
  <input id="privinput1" name="privinput" type="radio" value="1">
  <label for="privinput1">Privaatne (ainult sina naed)</label>
  <input id="privinput2" name="privinput" type="radio" value="2">
  <label for="privinput2">Klubi liikmetele (Ainult sisseloginud kasutajad naevad))</label>
  <input id="privinput3" name="privinput" type="radio" value="3">
  <label for="privinput3">Avalik (koik naevad)</label>
  <br>
  <input type="submit" name="photosubmit" value="Lae foto ules">
</form>
<?php 
    echo $inputerror; 
    echo $notice; ?>

</body>
</html>