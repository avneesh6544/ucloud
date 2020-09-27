<?php include 'header.php'; ?>
<div class="container">
	<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
		<div class="panel panel-info" >
			<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			</div>
			<div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			</div>
			<div class="panel-heading">
				<div class="panel-title">Sign In</div>
				<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
			</div>     
			<div style="padding-top:30px" class="panel-body" >
				<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>		
					<form id="login_form" class="form-horizontal" role="form" method="post">
						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" class="form-control" id="email" name="email" value="" placeholder="Username">                                        
						</div>	
						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="password" type="password" class="form-control" name="password" placeholder="Password">
						</div>
						<div style="margin-top:10px" class="form-group">
							<div class="col-sm-12 controls">
								<input type="button" name="save" class="btn btn-success" value="Login" id="butlogin">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12 control">
								<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
									Don't have an account! 
									<a href="register.php"> &nbsp Sign Up Here</a>
								</div>
							</div>
						</div>    
					</form>
				</div>
		</div>                     
	</div>  
</div>


<script>
$(document).ready(function() {
	$('#butlogin').on('click', function() {
		var email = $('#email').val();
		var password = $('#password').val();
		// if(email!="" && password!="" ){
			$.ajax({
				url: "userLogin.php",
				type: "POST",
				data: {
					email: email,
					password: password						
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						location.href = "twilio/send.php";						
					}
					else if(dataResult.statusCode==201){
						$("#error").show();
						$('#error').html(dataResult.message);
						// $('#error').html(dataResult.message);
						// $('#error').html('Invalid EmailId or Password !');
					}	
				}
			});
		// }
		// else{
		// 	alert('all feild is required');
		// }
	});
});
</script>
<?php include 'footer.php'; ?>
