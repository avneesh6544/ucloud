<?php include 'header.php'; 

$titleItems = array('Mr', 'Ms', 'Mrs', 'Miss', 'Miss', 'Dr');
$title = 'Mr';

?>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title:
                                </label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <select name="title" id="title" class="form-control">
                                        <?php
                                        foreach($titleItems AS $titleItem)
                                        {
                                            echo '<option value="' . $titleItem . '"';
                                            if(($title) && ($title == $titleItem))
                                            {
                                                echo ' SELECTED';
                                            }
                                            echo '>' . UCWords($titleItem) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
					<div class="form-group">
						<label for="first_name" class="col-md-3 control-label">First Name :</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="first_name" name="first_name" data-validation="required" placeholder="First Name">
						</div>
					</div>
					<div class="form-group">
						<label for="last_name" class="col-md-3 control-label">Last Name :</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="last_name" name="last_name" data-validation="required" placeholder="Last Name">
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
						<label for="username" class="col-md-3 control-label">Username :</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="username" name="username" data-validation="required" placeholder="Username">
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
							<input type="button" id="butsave" name="save" class="btn btn-info" value="Sign Up">
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
		// alert("asds");
		// $("#butsave").attr("disabled", "disabled");
		var title = $('#title').val();
		var first_name = $('#first_name').val();
		// var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var email = $('#email').val();
		var username = $('#username').val();
        var password = $('#password').val();
		var contact = $('#contact').val();
		$.ajax({
				url: "userregistraction.php",
				type: "POST",
				data: {
					title: title,
					first_name: first_name,
					last_name: last_name,
					email: email,
					contact: contact,
					username: username,
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
						$('#error').html(dataResult.message);
					}
				}
			});
	});
});
</script>

<?php include 'footer.php'; ?>
