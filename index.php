<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Synchronizer Token Pattern</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<?php
    session_start();

    //Setting the session ID cookie

    //getting the session id
    $sessionID = session_id();

    $expireTime = time() + 60*60; // expire time 1 hour
	$cookieName = "sessionCookie"; 
	
    setcookie ($cookieName, $sessionID, $expireTime, "/","localhost", FALSE, TRUE);
?>

	<body>
		<div class="container" style="margin-top: 100px">
			<h2 class="text-center">Login</h2>
			<div class="row justify-content-center">

				<div class="col-md-9">
					<form method="post" action="server.php" name="loginform">
						Username:<br/>
						<input type="text" name="username" class="form-control" placeholder="Username" required><br/>
						Password:<br/>
						<input type="password" name="password"class="form-control" placeholder="Password" required><br/>

						<input type="submit" name="submit" value="Login"  class="btn btn-success"/>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>