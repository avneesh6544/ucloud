<?php
session_start();
var_dump($_session['otp']);
die();
?>
<!DOCTYPE html>
<html>
<title>Form</title>
<body>
<form action="otpprocess.php" method="post">
<input type="text" name="otpvalue"/>
<input type="submit" value="submit" />
</form>
</body>
</html>