<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  
  <title> Veebiprogrammeerimine</title>
  <stlye>
    <?php
      echo "body { \n";
        if(isset($_SESSION["userbgcolor"])){
          echo "\t background-color: " .$_SESSION["userbgcolor"] ."; \n";
        } else {
          echo "\t background-color: #FFFFFF; \n";
        }
        if(isset($_SESSION["usertxtcolor"])){
          echo "\t color: " .$_SESSION["usertxtcolor"] ."; \n";
        } else {
          echo "\t color: #000000; \n";
        }
        echo "\t } \n";
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
      <td><a href="addnewuser.php">Tee kasutaja</a></td>
      <td><a href="userprofile.php">Minu kasutajaprofiil</a></td>
      <td><a href="filmiseosed.php">Loo filmiseoseid</a></td>
    </tr>
  </table>

