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
      <td><a href="page.php">ESILEHT</a></td>
      <td><a href="home.php">Kodu</a></td>
      <td><a href="mote.php">Mote</a></td>
      <td><a href="motetabel.php">Tabel</a></td>
      <td><a href="filmlist.php">Filmlist</a></td>
      <td><a href="addfilms.php">Lisa filme</a></td>
      <td><a href="addperson.php">Lisa tegelasi</a></td>
      <td><a href="addfilmrelationgenre.php">Loo filmiseoseid</a></td>
      <td><a href="listfilmpersons.php">Filmitegelased</a></td>
      <td><a href="addnewuser.php">Tee kasutaja</a></td>
      <td><a href="userprofile.php">Minu kasutajaprofiil</a></td>

    </tr>
  </table>

