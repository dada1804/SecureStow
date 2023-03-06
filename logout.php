<?php
session_cache_limiter("nocache");
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
echo '<script>if(confirm("Logging you out.....")){setTimeout(function(){ history.replaceState(null, null, "index.php"); window.location.href = "index.php";}, 500);}</script>';

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
exit;
?>
