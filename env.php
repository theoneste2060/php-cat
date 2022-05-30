
<?php
   
   session_start();
   
   require_once 'autoload.php';
   use Facebook\FacebookSession;
   use Facebook\FacebookRedirectLoginHelper;
   use Facebook\FacebookRequest;
   use Facebook\FacebookResponse;
   use Facebook\FacebookSDKException;
   use Facebook\FacebookRequestException;
   use Facebook\FacebookAuthorizationException;
   use Facebook\GraphObject;
   use Facebook\Entities\AccessToken;
   use Facebook\HttpClients\FacebookCurlHttpClient;
   use Facebook\HttpClients\FacebookHttpable;
   
   FacebookSession::setDefaultApplication( '496544657159182','e6d239655aeb3e496e52fabeaf1b1f93' );
   
   $helper = new FacebookRedirectLoginHelper('http://www.tutorialspoint.com/' );
   
   try {
      $session = $helper->getSessionFromRedirect();
   }catch( FacebookRequestException $ex ) {
 
   }catch( Exception $ex ) {

   }
   
   if ( isset( $session ) ) {
    
      $request = new FacebookRequest( $session, 'GET', '/me' );
      $response = $request->execute();
      
    
      $graphObject = $response->getGraphObject();
      $fbid = $graphObject->getProperty('id');           
      $fbfullname = $graphObject->getProperty('name');   
      $femail = $graphObject->getProperty('email');    
      
     
      $_SESSION['FBID'] = $fbid;
      $_SESSION['FULLNAME'] = $fbfullname;
      $_SESSION['EMAIL'] =  $femail;
      
    
      header("Location: login.php");
   }else {
      $loginUrl = $helper->getLoginUrl();
      header("Location: ".$loginUrl);
   }
?>