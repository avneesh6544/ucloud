<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<div id="login_page">
    <h2>User Login</h2>
    <form action="users/userregistraction.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
        </div>

        <button type="submit" class="btn btn-primary" name="login">Submit</button>
        <h5 class="float-right registration_page_show" style="cursor:pointer" >Rigister Now</h5>
        

    </form>
    </div>

    <div id="register_page" style="display:none">
    <h2>User Register</h2>
    <form action="users/userregistraction.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
        </div>
        <div class="form-group">
            <label for="cpassword">Confirm Password:</label>
            <input type="password" class="form-control" id="cpassword" placeholder="Enter Confirm Password" name="cpassword">
        </div>

        <button type="submit" class="btn btn-primary" name="save">Submit</button>
        <h5 class="float-right login_page_show" style="cursor:pointer"> Login</h5>
        
    </form>
    </div>
</div>
<script>
$(document).ready(function(){

  $(".registration_page_show").click(function(){
    
    $("#register_page").show();
    $("#login_page").hide();
  });

  $(".login_page_show").click(function(){
    $("#login_page").show();
    $("#register_page").hide();

  });
  

});
</script>
</body>
</html> -->
