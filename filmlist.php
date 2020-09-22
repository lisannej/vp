<?php
require ("header.php");
require ("config.php");
require ("fnc_films.php");

$database = "if20_lisanne_ja_1" ;
//loen lehele koik olemasolevad motted
$filmhtml = readfilms ();

?>



<?php echo $filmhtml; ?>
</body>
</html>