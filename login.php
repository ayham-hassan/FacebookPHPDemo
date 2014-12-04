<?php
// Starting Session
session_start();

// Import dependencies
require_once( 'config.php');
require_once( 'libraries/Facebook/FacebookSession.php' );
require_once( 'libraries/Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'libraries/Facebook/FacebookRequest.php' );
require_once( 'libraries/Facebook/FacebookResponse.php' );
require_once( 'libraries/Facebook/FacebookSDKException.php' );
require_once( 'libraries/Facebook/FacebookRequestException.php' );
require_once( 'libraries/Facebook/FacebookAuthorizationException.php' );
require_once( 'libraries/Facebook/GraphObject.php' );
require_once( 'libraries/Facebook/GraphUser.php' );
require_once( 'libraries/Facebook/GraphSessionInfo.php' );


// Define facebook namespaces
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;

// Setup Facebook 
FacebookSession::setDefaultApplication($appId, $appSecret);
$helper = new FacebookRedirectLoginHelper('http://localhost/sociatag/index.php');

// see if a existing session exists
if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
  // create new session from saved access_token
  $session = new FacebookSession( $_SESSION['fb_token'] );
	
  // validate the access_token to make sure it's still valid
  try {
    if ( !$session->validate() ) {
      $session = null;
	  $_SESSION['fb_token']=NULL;
    }
  } catch ( Exception $e ) {
    // catch any exceptions
	$_SESSION['fb_token']=NULL;
    $session = null;
  }

} else {
  // no session exists

  try {
    $session = $helper->getSessionFromRedirect();
  } catch( FacebookRequestException $ex ) {
    // When Facebook returns an error
  } catch( Exception $ex ) {
    // When validation fails or other local issues
    echo $ex->message;
  }

}

// see if we have a session
if ( isset( $session ) ) 
	{
	
	  // save the session
	  $_SESSION['fb_token'] = $session->getToken();
	  // create a session using saved token or the new one we generated at login
		header("Location: index.php");
	} 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title> SociaTag-login </title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<link rel="icon" href="images/logo1.jpg">
		<link rel="stylesheet prefetch" href="css/font-awesome.min.css">
		<link href="css/login.css" rel="stylesheet">
		<script>
			function CallAfterLogin(){
				window.location="<?php echo $helper->getLoginUrl($permissions); ?>";
			}
		</script>
		
	</head>
	
	<body>
		<div class="middle-page">
			<div  class="middle-div">
				<img src="images/logo2.png" style="width:100%"/>
			</div>
			<div id="loginform">
				<div id="facebook" onclick="javascript:CallAfterLogin();return false;">
					<i class="fa fa-facebook"></i>
					<div id="connect">Connect with Facebook</div>
				</div>
				<div id="mainlogin">
					<div id="or">or</div>
					<h1>Log in with SociaTag account</h1>
					<form action="#">
						<input type="text" placeholder="username" value="" required>
						<input type="password" placeholder="password" value="" required>
						<button type="submit"><i class="fa fa-arrow-right"></i></button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>