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
      <td><a href="addfilms.php">Lisa filme</a></td>
      <td><a href="addperson.php">Lisa tegelasi</a></td>
      <td><a href="addquote.php">Lisa tsitaate</a></td>
      <td><a href="addproductioncompany.php">Lisa filmistuudio</a></td>
      <td><a href="addgenre.php">Lisa zanr</a></td>
      <td><a href="addfilmrelationgenre.php">Loo filmiseoseid</a></td>
      <td><a href="listfilmpersons.php">Filmitegelased</a></td>
      <td><a href="listquotes.php">Filmi tsitaadid</a></td>
      <td><a href="userprofile.php">Minu kasutajaprofiil</a></td>

    </tr>
  </table>

