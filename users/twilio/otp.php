<?php include '../header.php'; ?>
<div class="container">
	<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
		<div class="panel panel-info" >
			<div class="panel-heading">
				<div class="panel-title">Please Enter OTP</div>
				<div style="float:right; font-size: 80%; position: relative; top:-10px"></div>
			</div>     
			<div style="padding-top:30px" class="panel-body" >
				<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>		
					<form action="otpprocess.php" id="otp_form" class="form-horizontal" role="form" method="post">
						<div style="margin-bottom: 25px" class="input-group">
							
							<input type="text" class="form-control" id="otp" name="otp" value="" placeholder="Enter OTP">                                        
						</div>	
						
						<div style="margin-top:10px" class="form-group">
							<div class="col-sm-12 controls">
								<input type="submit" name="submit" class="btn btn-success" value="Submit" id="submit">
							</div>
						</div>
						   
					</form>
				</div>
            </div>
		</div>                     
	</div>  
</div>

<?php include '../footer.php'; ?>
