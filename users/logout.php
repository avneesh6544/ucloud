<?php 
// setup includes
require_once('../core/includes/master.inc.php');

$Auth->logout();
coreFunctions::redirect(WEB_ROOT.'/users/login.php');
exit;
?>