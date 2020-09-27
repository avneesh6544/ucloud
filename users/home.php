<?php include 'header.php';
require_once('../core/includes/master.inc.php');
$AuthUser = Auth::getAuth();
$db = Database::getDatabase();
if(!$AuthUser->id){
    coreFunctions::redirect(WEB_ROOT.'/users/login.php');
}
?>
<body>
<div style="margin: auto;width: 40%;">
    
        <h2 class="text-center">payment</h2><br><br>
        <!-- <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <p><h3><b>VIP</b></h3></p>
                        <p>
                            <span class="price-icon"><b>₹</b></span>
                            <span class="plan-price">399</span>
                        </p>
                        <p><input type="radio" id="payment" name="payment" value="39900" checked></p>   
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <p><h3><b>PREMIUM</b></h3></p>
                            <p>
                                <span class="price-icon"><b>₹</b></span>
                                <span class="plan-price">1499</span>
                            </p>
                            <p><input type="radio" id="payment" name="payment" value="14990"></p>   
                        </div>
                    </div>
                </div>
            </div>
        </div>    <br><br> -->
        <p class="text-center"><a href="payment.php"><input type="submit" name="submit" class="btn btn-primary" value="Proceed To Payment" id="butsave"></a></p>

        <p class="text-center"><a href="logout.php"><input type="submit" name="logout" class="btn btn-primary" value="Logout" id="logout"></a></p>
	
</div>
</body>
<?php include 'footer.php'; ?>
