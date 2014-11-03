<?php
ob_start();
require_once 'linkedinSdk/linkedin.php';
$email =  $_GET['email'];
$linkedin = new LinkedIn(array(
	'apiKey' => '75nce3oxg53sku',
	'apiSecret' => 'De2XwMWVij076URD',
	'callbackUrl' => 'http://gigster2.fountaintechies.com/loginwithtlinkedin?email='.$email,
));
$token = '';
if (isset($_GET['code']))
	{
  // Check to see if our states match
	//if ($_SESSION['state'] == $_GET['state']) {
	  // If alls good the pass the code to the get assess token function; returns (String) accesstoken
            $token = $linkedin->getAccessToken($_GET['code']);
            $linkedin->setAccessToken($token);
            $options = ":(id,first-name,last-name,email-address)";
            $userData = $linkedin->get('/people/~', $options);
            $usermail = $userData->emailAddress;
			$registration_name = $userData->firstName;					
			$registration_password = $userData->id; 
            include('cfg/cfg.php'); 
			$fname=$userData->firstName;
			$lname=$userDAta->lastName;
			$userId=$userDAta->id;
			$checkQuery="select * from btr_users where usermail='$usermail' or linkedinid='$userId'";
			$checkSql=@db_query($checkQuery);
			if($checkSql['count']>0)
				{
				$updateQuery="update btr_users set linkedinid='$userId' ,usermail='$usermail' where userId=".$checkSql['rows']['0']['userId'];
				$updateSql=@db_query($updateQuery);
				$user=encrypt_str($checkSql['rows']['0']['userId']);
				$_SESSION['uId']=$user;
?>
				<script type="text/javascript">
				window.location="<?php echo $serverpath;?>";
				</script>
<?php
				die();
				}
			else
				{
				$insert_query="insert into btr_users(usermail,linkedinid,usertype,joinedon,username)";
				$insert_query.="values('$usermail','$userId','u',".gmmktime().",'".get_username($usermail)."')";
				$insert_sql=@db_query($insert_query,3);
					if($insert_sql)
					{
					$_SESSION['uId']=encrypt_str($insert_sql);
					$delQuery=@db_query("delete from btr_userprofile where userId=".$insert_sql);
					$insertQuery1="insert into btr_userprofile(userId,fname,lname)";
					$insertQuery1.="values($insert_sql,'$fname','$lname')";
					$insertSql1=@db_query($insertQuery1);
?>
					<script type="text/javascript">
					window.location="<?php echo $serverpath;?>allgigs";
					</script>
<?php
					die();
					}
				}
	}
	else
		{ 
			// If we do not have an access token, send the user through the authenication process
			if (empty($_SESSION['access_token']))
			{
				// Define the scope for what permissions we need to access the data we want
				$scope = "r_fullprofile r_emailaddress r_basicprofile  ";
				// $linkedin->getLoginUrl() will build our url and pass it back to our script
				$url = $linkedin->getLoginUrl($scope); 
				// Redirect the browser to LinkedIn for authenication
				header("Location: " . $url);        
			}
		}
?>