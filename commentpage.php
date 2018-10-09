<!DOCTYPE HTML>
<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("Location: login.php");
} else {
    $loginsuccess = "You are successfully logged in";
    echo "<script type='text/javascript'>alert('$loginsuccess');</script>";
}

if (isset($_POST['submit'])) {
    if (isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token']) {
        $name = filter($_POST['name']);
        $comment = filter($_POST['comment']);
        $msg = "success";
        echo "<script type='text/javascript'>alert('$msg')</script>";
    }
}

function filter($var) {
    return preg_replace('/[^a-zA-Z-0-9\s@.]/', '', $var);
}

$token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));

?>

<html>
<title>
Add a new comment!
</title>

<body>

<input type="button" value="Log out!" onclick="window.location.href='logout.php'"/>
<br/><br/>

<h2> Leave a comment Below </h2>

<form method="post" action="<?=$_SERVER['PHP_SELF']; ?>">
<table>
 <tr><td>Name:</td><td><input type="text" name="name"/></td></tr>
 <tr><td>Comment:</td><td><input type="text" name="comment"/></td></tr>
</table>
</br>
<input type="hidden" name="token" value="<?=$token; ?>">
<input type="submit" name="submit" value="Add comment"/>
</form>

</body>
</html>