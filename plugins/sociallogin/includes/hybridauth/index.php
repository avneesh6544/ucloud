<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html 
*/

// ------------------------------------------------------------------------
//	HybridAuth End Point
// ------------------------------------------------------------------------

require_once('../../../../core/includes/master.inc.php');

require_once( "Hybrid/Auth.php" );
require_once( "Hybrid/Endpoint.php" ); 

//if (isset($_REQUEST['hauth_start']) || isset($_REQUEST['hauth_done'])) {
	Hybrid_Endpoint::process();
//}