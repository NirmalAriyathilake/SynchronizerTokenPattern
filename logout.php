<?php
	session_start();
    session_destroy();
    $cookieName = "sessionCookie"; 
    unset($_COOKIE[$cookieName]);
    setcookie($cookieName, null, -1, '/');
?>

<html>
<body>
<script>
	alert("You are Successfully Logged out!");
    window.location.href = "index.php";
</script>
</body>
</html>