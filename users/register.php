<?php include 'header.php'; ?>
<div class="container">
	<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<div class="panel panel-info">
			<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			</div>
			<div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			</div>
			<div class="panel-heading">
				<div class="panel-title">Sign Up</div>
				<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="login.php" >Sign In</a></div>
			</div>  
			<div class="panel-body" >
				<form id="register_form" class="form-horizontal" role="form" method="post">
					<div id="signupalert" style="display:none" class="alert alert-danger">
						<p>Error:</p>
						<span></span>
					</div>
					<div class="form-group">
						<label for="name" class="col-md-3 control-label">Full Name :</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="name" name="name" data-validation="required" placeholder="Full Name">
						</div>
					</div>	
					<div class="form-group">
						<label for="email" class="col-md-3 control-label">Email :</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="email" name="email" data-validation="required email" placeholder="Email Address">
						</div>
					</div>
					<div class="form-group">
						<label for="contact" class="col-md-3 control-label">Contact NO :</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="contact" name="contact" data-validation="required number" placeholder="Contact NO">
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-md-3 control-label">Password :</label>
						<div class="col-md-9">
							<input type="password" class="form-control" id="password" name="password" data-validation="required" placeholder="Password">
						</div>
					</div>
					<!-- <div class="form-group">
						<label for="cpassword" class="col-md-3 control-label">Confirm Password :</label>
						<div class="col-md-9">
							<input type="password" class="form-control" id="cpasswod" name="cpasswod" data-validation="required" data-rule-equalTo="#password" placeholder="Confirm Password">
						</div>
					</div> -->
					<div class="form-group">
						<!-- Button -->                                        
						<div class="col-md-offset-3 col-md-9">
							<!-- <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button> -->
							<input type="submit" id="butsave" name="save" class="btn btn-info" value="Sign Up">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div> 
</div>

<script>

$(document).ready(function(){

	$('#butsave').on('click', function() {
		// $("#butsave").attr("disabled", "disabled");
		var name = $('#name').val();
		var email = $('#email').val();
        var password = $('#password').val();
        var contact = $('#contact').val();
		if(name!="" && email!="" && password!="" ){
			$.ajax({
				url: "userregistraction.php",
				type: "POST",
				data: {
					name: name,
					email: email,
					contact: contact,
					password: password					
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						location.href = "login.php";
						$("#butsave").attr("disabled", "disabled");
						$('#register_form').find('input:text').val('');
						$("#success").show();
						$('#success').html('Registration successful !'); 						
					}
					else if(dataResult.statusCode==201){
						$("#error").show();
						$('#error').html('Email ID already exists !');
					}
				}
			});
		}
		else{
			$.validate();
		}
	});
});
</script>

<?php include 'footer.php'; ?>
