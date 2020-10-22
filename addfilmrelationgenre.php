<?php
  require ("usesession.php");
   //loeme andmebaasi login ifo muutujad
  require ("config.php");
  require ("fnc_filmrelations.php");

   $genrenotice ="";
   $selectedfilm ="";
   $selectedgenre = "";
   $studionotice ="";
   $selectedstudio ="";
   $quotenotice="";
   $selectedquote="";
   $selectedperson="";
   $personnotice="";

   if(isset($_POST["filmrelationsubmit"])){
    if(!empty($_POST["filminput"])){
      $selectedfilm = intval($_POST["filminput"]);
    } else {
      $quotenotice = " Vali film!";
    }
    if(!empty($_POST["filmpersoninput"])){
      $selectedquote = intval($_POST["filmpersoninput"]);
    } else {
      $personnotice .= " Vali tegelane!";
      if(!empty($selectedfilm) and !empty($selectedperson)){
        $quotenotice = storenewpersonrelation($selectedfilm, $selectedperson);
      }
  }
   }
   if(isset($_POST["filmrelationsubmit"])){
    if(!empty($_POST["filminput"])){
      $selectedfilm = intval($_POST["filminput"]);
    } else {
      $quotenotice = " Vali film!";
    }
    if(!empty($_POST["filmquoteinput"])){
      $selectedquote = intval($_POST["filmquoteinput"]);
    } else {
      $quotenotice .= " Vali fraas!";
      if(!empty($selectedfilm) and !empty($selectedstudio)){
        $quotenotice = storenewquoterelation($selectedfilm, $selectedquote);
      }
  }
   }
   if(isset($_POST["filmrelationsubmit"])){
    //$selectedfilm = $_POST["filminput"];
    if(!empty($_POST["filminput"])){
      $selectedfilm = intval($_POST["filminput"]);
    } else {
      $genrenotice = " Vali film!";
    }
    if(!empty($_POST["filmstudioinput"])){
      $selectedstudio = intval($_POST["filmstudioinput"]);
    } else {
      $studionotice .= " Vali stuudio!";
      if(!empty($selectedfilm) and !empty($selectedstudio)){
        $studionotice = storenewstudiorelation($selectedfilm, $selectedstudio);
      }
  }
}

   if(isset($_POST["filmrelationsubmit"])){
 	//$selectedfilm = $_POST["filminput"];
 	if(!empty($_POST["filminput"])){
 		$selectedfilm = intval($_POST["filminput"]);
 	} else {
 		$genrenotice = " Vali film!";
 	}
 	if(!empty($_POST["filmgenreinput"])){
 		$selectedgenre = intval($_POST["filmgenreinput"]);
 	} else {
 		$genrenotice .= " Vali žanr!";
 	}
 	if(!empty($selectedfilm) and !empty($selectedgenre)){
 		$genrenotice = storenewrelation($selectedfilm, $selectedgenre);
 	}
   }

   $filmselecthtml = readmovietoselect($selectedfilm);
   $filmgenreselecthtml = readgenretoselect($selectedgenre);
   $filmstudioselecthtml = readstudiotoselect($selectedstudio);
   $filmquoteselecthtml = readquotetoselect($selectedquote);
   $filmpersonselecthtml = readpersontoselect($selectedperson);



  require ("header.php");
 ?>

   <img src="IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
   <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> programmeerib veebi</h1>
   <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
   <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>

   <h2> Määrame filmile tegelase</h2>
   <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
 		echo $filmselecthtml;
 	  echo $filmpersonselecthtml;
 	?>
   <input type="submit" name="filmrelationsubmit" value="Salvesta seos tegelasega"><span><?php echo $personnotice; ?></span>
  
   <h2> Määrame filmile fraasi</h2>
   <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
 		echo $filmselecthtml;
 	  echo $filmquoteselecthtml;
 	?>
   <input type="submit" name="filmrelationsubmit" value="Salvesta seos fraasiga"><span><?php echo $quotenotice; ?></span>
  
   </form>
   <h2> Määrame filmile stuudio</h2>
   <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
 		echo $filmselecthtml;
 	  echo $filmstudioselecthtml;
 	?>
   <input type="submit" name="filmrelationsubmit" value="Salvesta seos stuudioga"><span><?php echo $studionotice; ?></span>
  
   </form>

   <h2>Määrame filmile žanri</h2>
   <hr>
   <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     <?php
 		echo $filmselecthtml;
 		echo $filmgenreselecthtml;
 	?>

 	<input type="submit" name="filmrelationsubmit" value="Salvesta seos zanriga"><span><?php echo $genrenotice; ?></span>
   </form>

 </body>
 </html>
