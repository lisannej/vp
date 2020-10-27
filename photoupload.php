<?php
require ("usesession.php");
require ("header.php");
require ("config.php");

$inputerror=""; 
$filetype=null;
$filesizelimit=1048576;
$photouploaddir_orig= "photoupload_orig/";
$filenameprefix= "vp_";
$filename= null;

//kui klikiti submit siis
if(isset($_POST["photosubmit"])){
    //var_dump($_POST);
    //var_dump($_FILES);
    $check = getimagesize(($_FILES["photoinput"]["tmp_name"]));
    if($check!== false){
        if($check["mime"]== "image/jpeg"){
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
        move_uploaded_file($_FILES["photoinput"]["tmp_name"], $photouploaddir_orig .$filename);
        }
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
<?php echo $inputerror ?>

</body>
</html>