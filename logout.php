<?php
	session_start();
	session_destroy();
	unset($_SESSION['username']);
	$_SESSION['message'] = "You are successfully Logged out";
	header("Location: login.php");	
?>

<html>
<body>
<script>
	alert("You are Successfully Logged out!");
</script>
</body>
</html>