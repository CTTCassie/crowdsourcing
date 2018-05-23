
<?php
    session_start();
     //error_reporting(0);
    if (!empty($_SESSION['username'])){
    	unset($_SESSION['username']);
    }

    echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";

?> 