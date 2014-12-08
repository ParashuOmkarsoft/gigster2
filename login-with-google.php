<?php

/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
include('cfg/cfg.php');
include_once "templates/base.php";
require_once ('autoload.php');

/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/
 $client_id = '365892962432-h062bakvhfujq1itspoe635h4bfj7a2u.apps.googleusercontent.com';
 $client_secret = 's-QepkoZtp-2dtUROoKrWpqc';
 $redirect_uri = 'http://gigstergo.com/login-with-google.php';

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("https://www.googleapis.com/auth/plus.profile.emails.read");

/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
$service = new Google_Service_Urlshortener($client);

/************************************************
  If we're logging out we just need to clear our
  local access token in this case
 ************************************************/
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
 ************************************************/
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

/************************************************
  If we're signed in and have a request to shorten
  a URL, then we create a new URL object, set the
  unshortened URL, and call the 'insert' method on
  the 'url' resource. Note that we re-store the
  access_token bundle, just in case anything
  changed during the request - the main thing that
  might happen here is the access token itself is
  refreshed if the application has offline access.
 ************************************************/
if ($client->getAccessToken() && isset($_GET['url'])) {
  $url = new Google_Service_Urlshortener_Url();
  $url->longUrl = $_GET['url'];
  $short = $service->url->insert($url);
  $_SESSION['access_token'] = $client->getAccessToken();
  $token_data = $client->verifyIdToken()->getAttributes();
//print_r($token_data);
}


 
if (isset($authUrl)) {
   ?>
   <script type="text/javascript">
   window.location="<?php echo $authUrl;?>";
   </script>
   <?php 
} else {
	
// further on down in the example code...
// my new code...
$plus = new Google_Service_Plus( $client );
$me = $plus->people->get('me');
$userId=$me->id;
$usermail=$me->emails;
$memail=$usermail[0]->value;
$userimage=$me->image;
$imgurl=$userimage->url;
$imgurl=str_replace("sz=50","sz=200",$imgurl);
$checkquery="select * from btr_users where gId='$userId' or usermail='$memail'";
$checksql=@db_query($checkquery);
if($checksql['count']>0)
	  {
		if($checksql['rows']['0']['fbId'] != $userId)
		  {
			  $updQuery="update btr_users set gId='$userId' where userId=".$checksql['rows']['0']['userId'];
			  $updSql=@db_query($updQuery);
		  }
		  if($checksql['rows']['0']['syncimage']=="1")
		  {
			if($imgurl)
		  		{
						  $ext="jpg";
						  $newname=$checksql['rows']['0']['userId'].".$ext";
						  if(file_exists("uploads/profileimage/$newname"))
						  {
							  unlink("uploads/profileimage/$newname");
						  }
						  $mcopy=copy($imgurl,"uploads/profileimage/$newname");
						  if($mcopy)
						  {
							  $upQuery="update btr_users set profileimage='$newname' where userId=".$checksql['rows']['0']['userId'];
							  $upQuery=@db_query($upQuery);
						  }
		 		 }
		  }
		  
				  $_SESSION['uId']=encrypt_str(filter_text($checksql['rows']['0']['userId']));
			?>
				<script type="text/javascript">
				window.location="<?php echo $serverpath;?>";
				</script>
				<?php	
		  }
	  	else
	  	  {
			  $insert_query="insert into btr_users(usermail,gId,usertype,joinedon,username)";
			  $insert_query.="values('$memail','$userId','u',".gmmktime().",'".get_username($memail)."')";
			  $insert_sql=@db_query($insert_query,3);
			  if($insert_sql)
			  {
				  $updateQ=@db_query("update btr_users set authkey='".encrypt_str($insert_sql)."',isactive='1' where userId=$insert_sql");
				  $delprofilequery=@db_query("delete from btr_userprofile where userId=$insert_sql");
				  $profilequery="insert into btr_userprofile(userId)";
				  $profilequery.="values($insert_sql)";
				  $profilesql=@db_query($profilequery);
				  if($imgurl)
				  {
				  
				  $ext="jpg";
				  $newname=$insert_sql.".$ext";
				  $mcopy=copy($imgurl,"uploads/profileimage/$newname");
					  if($mcopy)
					  {
					  $upQuery="update btr_users set profileimage='$newname' where userId=$insert_sql";
					  $upQuery=@db_query($upQuery);
					  }
				  }
				  $_SESSION['uId']=encrypt_str(filter_text($insert_sql));		
				?>
				<script type="text/javascript">
				window.location="<?php echo $serverpath;?>";
				</script>
				<?php
			  }
			  else
			  {
				  
			  }
	  		}

	
}
?>

