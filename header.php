<!DOCTYPE html>
 <html lang="et">
 <head>
   <meta charset="utf-8">
   <title>Veebileht</title>
   <style>
   <?php
     echo "body { \n";
 	if(isset($_SESSION["bgcolor"])){
 		echo "background-color: " .$_SESSION["bgcolor"] ."; \n";
 	} else {
 		echo "background-color: #FFFFFF; \n";
 	}
 	if(isset($_SESSION["txtcolor"])){
 		echo "color: " .$_SESSION["txtcolor"] ."\n";
 	} else {
 		echo "color: #000000; \n";
 	}
 	echo "} \n";
   ?>
   </style>
 </head>
 <body> 
  <table>
    <tr>
      <td><a href="home.php">Kodu</a></td>
      <td><a href="mote.php">Mõte</a></td>
      <td><a href="motetabel.php">Mõtete tabel</a></td>
      <td><a href="filmlist.php">Filmlist</a></td>
      <td><a href="adddata.php">Lisa andmeid</a></td>
      <td><a href="addfilmrelationgenre.php">Loo filmiseoseid</a></td>
      <td><a href="listfilmpersons.php">Filmitegelased</a></td>
      <td><a href="listquotes.php">Filmi tsitaadid</a></td>
      <td><a href="userprofile.php">Minu kasutajaprofiil</a></td>
      <td><a href="photoupload.php">Piltide üleslaadimine</a></td>

    </tr>
  </table>

