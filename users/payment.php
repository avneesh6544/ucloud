<!DOCTYPE html>
<html>
<head>
	<title>Insert data in MySQL database using Ajax</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div style="margin: auto;width: 60%;">
    <form action="userpayment.php" method="POST">
    <div class="form-group">
        <p>payment ammount (in razorpay amt to be in submit of current. eg. 1000 = Rs.100)</p>
        <input type="text" class="form-control" id="payment" name="payment">
    </div>
        <input type="submit" name="submit" class="btn btn-primary" value="payment" id="butsave">
	</form>
</div>
</body>
</html>    
