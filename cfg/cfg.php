<?php
ini_set('display_errors',0);
ini_set('magic_quotes_gpc',1);
ini_set("session.cookie_httponly", 1);
session_start();
$_SESSION['generated'] = time();
$GLOBALS['debug_sql'] = array();
 $sitedef = $_SERVER[ 'SERVER_NAME']; 
$twitterlink="#";
$fbLink="http://www.facebook.com/GigsterGo";
$twitterLink="http://twitter.com/GigsterGo";
$pintlink="#";
$rec_limit = 5;
$adminId=18;
if ("localhost" == $sitedef || $sitedef=="192.168.1.3")
{
	$__dbhost = "localhost";
	$__dbname = "gigster";
	$__dbuser = "root";
	$__dbpass = "deep";
	define( 'HTTP_ROOT', '/' );
	define( 'DEBUG', false );
	$serverpath = "http://".$_SERVER['HTTP_HOST']."/gigster2/";
	define( 'SERVERPATH', $serverpath );
	$innerpath = "http://".$_SERVER['HTTP_HOST']."/gigster2/inner/";
	define( 'INNERPATH', $innerpath );
	$adminpath = $serverpath."cadmin/";
	define( 'ADMINPATH', $adminpath );
	$upload_path=$_SERVER['DOCUMENT_ROOT']."/gigster2/uploads/";
	setcookie("serverpath",$serverpath);
	$sitename="Gigster";
	$currency="SGD";
	$fbAppId="257068767820426";
	$fbAppSecret="99498079d35ed268b434016f9893cf26";	
}
elseif ("www.infodreams.in" == $sitedef || $sitedef=="infodreams.in")
{
	 $__dbhost = "localhost";
	 $__dbname = "gigster";
	 $__dbuser = "gigster";
	$__dbpass = "4mAm8CYF4SA2Vh6h";
	define( 'HTTP_ROOT', '/' );
	define( 'DEBUG', false );
	$serverpath = "http://".$_SERVER['HTTP_HOST'];
	define( 'SERVERPATH', $serverpath );
	$innerpath = "http://".$_SERVER['HTTP_HOST']."/bettrinner/";
	define( 'INNERPATH', $innerpath );
	$adminpath = $serverpath."xadmin/";
	define( 'ADMINPATH', $adminpath );
	$upload_path=$_SERVER['DOCUMENT_ROOT']."/bettr/uploads/";
	setcookie("serverpath",$serverpath);
	$sitename="Bettr";
	$currency="SGD";
	$fbAppId="609235199196435";
	$fbAppSecret="f79a4cf4da4db6382605393c4b4f8bfb";	}
elseif ('gigster.fountaintechies.com' == $sitedef)
{
	 $__dbhost = "localhost";
	 $__dbname = "gigster";
	 $__dbuser = "gigster";
	$__dbpass = "4mAm8CYF4SA2Vh6h";
	define( 'HTTP_ROOT', '/' );
	define( 'DEBUG', false );
	 $serverpath = "http://".$_SERVER['HTTP_HOST']."/";
	define( 'SERVERPATH', $serverpath );
	 $innerpath = "http://".$_SERVER['HTTP_HOST']."/";
	define( 'INNERPATH', $innerpath );
	$adminpath = $serverpath."xadmin/";
	define( 'ADMINPATH', $adminpath );
	 $upload_path=$_SERVER['DOCUMENT_ROOT']."/uploads/";
	setcookie("serverpath",$serverpath);
	$sitename="Gigster";
	$currency="SGD";
	$fbAppId="846990408668822";
	$fbAppSecret="caefe0e5bf76054cc7f1edef85cc2674";	}
	
elseif ('gigster2.fountaintechies.com' == $sitedef)
{
	 $__dbhost = "localhost";
	 $__dbname = "gigster";
	 $__dbuser = "root";
	$__dbpass = "10gXWOqeaf";
	define( 'HTTP_ROOT', '/' );
	define( 'DEBUG', false );
	 $serverpath = "http://".$_SERVER['HTTP_HOST']."/";
	define( 'SERVERPATH', $serverpath );
	 $innerpath = "http://".$_SERVER['HTTP_HOST']."/";
	define( 'INNERPATH', $innerpath );
	$adminpath = $serverpath."xadmin/";
	define( 'ADMINPATH', $adminpath );
	 $upload_path=$_SERVER['DOCUMENT_ROOT']."/uploads/";
	setcookie("serverpath",$serverpath);
	$sitename="Gigster";
	$currency="SGD";
	$fbAppId="846990408668822";
	$fbAppSecret="caefe0e5bf76054cc7f1edef85cc2674";
}	

elseif ("www.gigstergo.com" == $sitedef || $sitedef=="gigstergo.com")
{
	 $__dbhost = "localhost";
	 $__dbname = "gigster2";
	 $__dbuser = "gigster2";
	$__dbpass = "3gXWOqeaf";
	define( 'HTTP_ROOT', '/' );
	define( 'DEBUG', false );
	$serverpath = "http://".$_SERVER['HTTP_HOST']."/";
	define( 'SERVERPATH', $serverpath );
	$innerpath = "http://".$_SERVER['HTTP_HOST']."/";
	define( 'INNERPATH', $innerpath );
	$adminpath = $serverpath."xadmin/";
	define( 'ADMINPATH', $adminpath );
	$upload_path=$_SERVER['DOCUMENT_ROOT']."/uploads/";
	setcookie("serverpath",$serverpath);
	$sitename="Gigster";
	$currency="SGD";
	$fbAppId="846990408668822";
	$fbAppSecret="caefe0e5bf76054cc7f1edef85cc2674";	}

db_connect();

// base functions to follow this line ###################################################################
function db_connect() {

	$srv = $GLOBALS['__dbhost'];
	$unm = $GLOBALS['__dbuser'];
	$pwd = $GLOBALS['__dbpass'];
	$db  = $GLOBALS['__dbname'];
	$GLOBALS['db_con'] = mysqli_connect($srv,$unm,$pwd,$db);
	return is_object($GLOBALS['db_con']);
}

function db_query($sql='',$type=0)
{
	if (!is_object($GLOBALS['db_con']) || $sql == '')
	 {
		die('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Server Maintenance</title>
			</head>
			<body style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px;">
			The server is currently under maintenance.<br /><br />
			Please check back later.
			</body>
			</html>
		');
		exit;
	  } 
	else
		{
			$result = mysqli_query($GLOBALS['db_con'],$sql);
			if (eregi('^insert.*',$sql) || eregi('^update.*',$sql) || eregi('^delete.*',$sql)) 
			{
				$num_rows = mysqli_affected_rows($GLOBALS['db_con']);
			} 
			else
			{
				$num_rows = mysqli_num_rows($result);
			}
			if ($type == 0 || $type == 4)
			{  // return results & num of rows
				if ($num_rows)
				{
					if ($type == 0)
					{
						while ($row = mysqli_fetch_array($result))
						{
							if (count($row) > 1)
							{
								$rows[] = $row;
							}
							else
							{
								$rows[] = $row[0];
							}
						}
					 }
					 else
					 {
						while ($row = mysqli_fetch_row($result))
						{
							if (count($row) > 1)
							{
								$rows[] = $row;
							}
							else
							{
								$rows[] = $row[0];
							}
						}
					}
					$return_val = array(0=>true,'rows'=>$rows,'count'=>$num_rows);
				 }
				else
				{
					$return_val = array(0=>false,'count'=>0);
				}
			 }
			 elseif ($type == 1)
			 {  // return num of rows
				$return_val = $num_rows;
			 }
			 elseif ($type == 3)
			 {  // return last_insert_id
				$return_val = mysqli_insert_id($GLOBALS['db_con']);
			 } 
			 elseif($type==5)
			 {
				 $return_val=mysqli_affected_rows($GLOBALS['db_con']);
			 }
			 else
			 {
				$return_val = $num_rows;
			 }
			 // clean up my result set, eh?
			 @mysqli_free_result($result);
		}
	if (mysqli_error($GLOBALS['db_con']))
	{
		// there was an error, add it to the global array
		$GLOBALS['debug_sql'][] = array('PROBLEM SQL',$sql,mysqli_error($GLOBALS['db_con']));
	}
	return $return_val;
}
function db_close() {
        return mysqli_close($GLOBALS['db_con']);
}
function mysql_res($string='')
{
	// shorthand mysql_real_escape_string
	return mysqli_real_escape_string($GLOBALS['db_con'],$string);
}
function encrypt_str($str){
	$str=md5(md5(md5(md5($str))));
return $str;
}
function filter_text($str)
{
	$str=ltrim(rtrim($str));
	$str=strip_tags($str);
	$str=addslashes($str);
	

	return $str;
}
function filter_rich_text($str)
{
	$str=addslashes(ltrim(rtrim($str)));
	return $str;
}
function get_fb_url($murl)
{
	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,   $murl);

curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_exec($ch);

$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

curl_close($ch);

return $url;
	
}
function get_extension($str)
{
	$strarray=explode(".",$str);
	$ext=$strarray[sizeof($strarray)-1];
	$ext=strtolower($ext);
	if($ext)
	{
		return $ext;
	}
}
function get_user_Info($uId)
{
	$query="select * from btr_users where md5(md5(md5(md5(userId))))='$uId'";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		$query1="select * from btr_userprofile where userId=".$sql['rows']['0']['userId'];
		$sql1=@db_query($query1);
			if($sql1['count']>0)
			{
		return array_merge($sql['rows']['0'],$sql1['rows']['0']);	
			}
			else
			{
				return $sql['rows']['0'];
			}
	}
}
function get_countries()
{
$query="select * from btr_countries order by countryname";
$sql=@db_query($query);
if($sql['count']>0)
{
	return $sql;
}
}

function valid_pass($pwd) {
   
		$error = "ok";
		if(strlen($pwd) < 6)//to short
		{
			$error = "Error. Password must be 6-12 characters long";
		}
		if(strlen($pwd) > 12)//to long
		{
			$error = "Error. Password must be 6-12 characters long";
		}	
		if(!preg_match("#[0-9]+#", $pwd))//at least one number
		{
			$error = "Error. Password must contain at least one number.";
		}
		if(!preg_match("#[a-z]+#", $pwd))//at least one letter
		{
			$error = "Error. Password must contain at least one small case letter";
		}
		if(!preg_match("#[A-Z]+#", $pwd))//at least one capital letter
		{
			$error = "Error. Password must contain at least one upper case letter";
		}
		if(preg_match('![^a-z0-9]!i', $pwd))//at least one symbol
		{
			$error = "Error. Speial characters are not allowed.";
		}
		return $error;

}

function get_all_projects($uId,$isall){
	if($isall=='1')
	{
	$query="select * from btr_projects  where bidto>now() order by postedon DESC";
	}
	else
	{
		
	$query="select * from btr_projects where userId=".$uId."  order by postedon DESC";
	}
	//echo $query;
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql;
	}
}
function convert_time($time)
{
	return gmstrftime("%B %d %Y, %X ",$time);
}
function filter_description($str,$length)
{

	$str=str_split($str,$length);
	return $str[0]."...";
}
function mera_url_encode($str)
{
	
	$str=str_replace("+","-",$str);
	$str=str_replace("/","|",$str);
	$str=urlencode($str);
	return $str;
}
function mera_url_decode($str)
{
	$str=urldecode($str);
	$str=str_replace("-","+",$str);	
	$str=str_replace("|","/",$str);	
	return $str;
}
function get_gig_details($gigId)
{
	$query="select * from btr_projects where prjId=$gigId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql['rows']['0'];
	}
}
function get_project_bids($gigId)
{
	$query="select * from btr_bids where projectId=$gigId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql;
	}
}
function check_user_bid($gigid,$userid)
{
	
	$uInfo=get_user_Info($userid);
	$projectdetails=get_gig_details($uInfo['userId']);
	if($projectdetails['userId']!=$uInfo['userId'])
	{
		 $query="select * from btr_bids where projectId=$gigid and md5(md5(md5(md5(bidfrom))))='$userid'";
	
	$sql=@db_query($query);
			if($sql['count']>0)
				{
					return $sql['count'];
				}
	}

}
function get_user_name($uId)
{
$uInfo=get_user_Info(encrypt_str($uId));
$nametodisplay=$uInfo['fname']." ".$uInfo['lname'];
$nametodisplay1=str_replace(" ","",$nametodisplay);
if(!$nametodisplay1)
{
	$nametodisplay=$uInfo['username'];
}
return $nametodisplay;
}

function get_bid_info($gigid,$userid)
{
	
	$uInfo=get_user_Info($userid);
	$projectdetails=get_gig_details($uInfo['userId']);
	if($projectdetails['userId']!=$uInfo['userId'])
	{
		 $query="select * from btr_bids where projectId=$gigid and md5(md5(md5(md5(bidfrom))))='$userid'";
	
	$sql=@db_query($query);
			if($sql['count']>0)
				{
					return $sql['rows']['0'];
				}
	}

}
function get_project_messages($pId,$msgto,$msgfrom)
{
$query="select * from btr_messages where projectId=$pId and ((msgto=$msgto and msgfrom=$msgfrom) or (msgto=$msgfrom and msgfrom=$msgto)) order by msgon DESC";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql;
	}
}
function check_user_messages($userId,$projectId)
{
	$uInfo=get_user_Info($userId);
	$uId=$uInfo['userId'];
	 $checkQuery="select * from btr_messages where msgto=$uId and projectId=$projectId";
	$checkSql=@db_query($checkQuery);
	if($checkSql['count']>0)
	{
		return $checkSql;
	}
}
function get_username($email)
{
$str=explode("@",$email);
return filter_text($str[0]);	
}
function get_time_from_range($time)
{
	$starray=explode("-",$time);
	$from=filter_text($starray[0]);
	$to=filter_text($starray[01]);	
	$fromarray=explode(" ",$from);
	$from=filter_text($fromarray[0]);
	$fromarray=explode("/",$from);
	$from=$fromarray[2]."-".$fromarray[0]."-".$fromarray[1];
	$return['from']=$from;
	
	$toarray=explode(" ",$to);
	$to=filter_text($toarray[0]);
	$toarray=explode("/",$to);
	$to=$toarray[2]."-".$toarray[0]."-".$toarray[1];

	$return['to']=$to;
	return $return;
	
	
}
function send_my_mail($mailto,$mailmatter,$mailsubject)
{/*
require 'PHPMailerAutoload.php';
	$mail = new PHPMailer();
  $mail->Host = 'mail.80startups.com';                       // Specify main and backup server
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'bettr@80startups.com';                   // SMTP username
  $mail->Password = 'bettr@123';               // SMTP password
  $mail->Port = 26;                                    //Set the SMTP port number - 587 for authenticated TLS
  $mail->WordWrap = 500;      
  $mail->setFrom('bettr@80startups.com', 'Bettr');
  $mail->addReplyTo('bettr@80startups.com', 'Bettr');
  
  $mail->addAddress($mailto, '');
  $mail->Subject = $mailsubject;
  $mail->msgHTML($mailmatter);								
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->isHTML(true);                                  // Set email format to HTML*/
  $url = 'https://api.sendgrid.com/';
$user = 'tourbookings';
$pass = '9cXWOqeaf';

$params = array(
    'api_user'  => $user,
    'api_key'   => $pass,
    'to'        => $mailto,
    'subject'   => $mailsubject,
    'html'      => $mailmatter,
    'text'      => $mailmatter,
    'from'      => 'gigster@gigstergo.com',
  );


$request =  $url.'api/mail.send.json';

// Generate curl request
$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
// Tell PHP not to use SSLv3 (instead opting for TLS)
curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);
curl_close($session);

// print everything out

}
function check_project($projectId)
{
	$checkQuery="select * from btr_assignment where projectId=$projectId";
	$checkSql=@db_query($checkQuery);
	if($checkSql['count']>0)
	{
		return "yes";
	}
	else
	{
		return "no";
	}
}
function convert_date($str)
{
	$str=explode("-",$str);
	$day=$str[2];
	$month=$str[1];
	$year=$str[0];		
	$newdate=gmstrftime("%B %d %Y",mktime(0,0,0,$month,$day,$year));
	return $newdate;
}
function get_project_status($str)
{
	if($str)
	{
		if($str==1)
		{
			return "under progress";	
		}
		elseif($str==2)
		{
			return "under progress";	
		}

	}
	else
	{
		return "unapproved";
	}
}
function get_p_status($prjId)
{
	 $query="select * from btr_projects where prjId=$prjId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		
		$status=$sql['rows']['0']['status'];
		if($status=="0" || !$status)
		{
			return "Select Bidder";
		}
		elseif($status=="1")
		{
			return "Awarded - Awaiting Acceptance";
		}
		elseif($status=="2")
		{
			return "Awarded - In progress";
		}
		elseif($status=="3")
		{
			return "Completed";
		}
		elseif($status=="4")
		{
			return "Cancelled";
		}
	}
	
}
function get_p_status1($prjId)
{
	 $query="select * from btr_projects where prjId=$prjId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		$status=$sql['rows']['0']['status'];
		return $status;
	}
	
}
function get_project_owner($prjId)
{
	 $projectdetails=get_gig_details($prjId);
	 $projectuserdetails=get_user_Info(encrypt_str($projectdetails['userId']));
	 return $projectuserdetails['username'];
	
}

function is_project_awarded($projectId)
{
	  $checkQuery="select * from btr_assignment where projectId=$projectId";
	$checkSql=@db_query($checkQuery);
	if($checkSql['count']>0)
	{
		return "1";
	}
	else
	{
		return 0;
	}
}
function is_project_awarded_to_user($projectId,$userId)
{
	$checkQuery="select * from btr_assignment where projectId=$projectId and awardedto=$userId";
	$checkSql=@db_query($checkQuery);
	if($checkSql['count']>0)
	{
		return "1";
	}
	else
	{
		return 0;
	}
}
function check_for_date($gigId)
{
	$gigdetails=get_gig_details($gigId);
	$giglastdate=$gigdetails['bidto'];
	$gigdatearray=explode("-",$giglastdate);
	
	$gigtimestamp=gmmktime(0,0,0,$gigdatearray[1],$gigdatearray[2],$gigdatearray[0]);

	$currenttime=gmmktime(0,0,0,date('m'),date('d'),date('Y'));
	$difference=$currenttime-$gigtimestamp;

	if($gigtimestamp>=$currenttime)
	{
		return "true";
	}
	else
	{
		return "false";
	}
	
}
function get_gig_name($projectId)
{
	$query="select prjTitle from btr_projects where prjId=$projectId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql['rows']['0']['prjTitle'];
	}
}
function add_keywords($keywords)
{
$keywords=explode(",",$keywords);
	foreach($keywords as $keyword)
		{
			$keyword=strtolower($keyword);
			$checkQuery="select * from btr_tags where tag='$keyword'";
			$checkSql=@db_query($checkQuery);
			if($checkSql['count']>0)
			{
			}
			else
			{
				$insertQuery="insert into btr_tags(tag)values('$keyword')";
				$insertSql=@db_query($insertQuery);
			}
		}
}
function latest_gigs()
{
	$query="select * from btr_projects order by prjId DESC LIMIT 0 , 3";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql;
	}
}
function get_awarded_details($gigId)
{
	$query="select * from btr_assignment where projectId=$gigId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql['rows']['0'];
	}
}
function get_feedback($projectId,$userId)
{
	$checkquery="select * from btr_reviews where rateto=$userId and projectId=$projectId";
	$checkSql=@db_query($checkquery);
	if($checkSql['count']>0)
	{
		return $checkSql['rows']['0'];
	}
}
function get_project_winner_name($projectId)
{
	$query="select * from btr_assignment where projectId=$projectId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		$projectUser=get_user_Info(encrypt_str($sql['rows']['0']['awardedto']));
		if($projectUser)
		{
			return $projectUser['username'];
		}
		else
		{
			return "---";
		}
	}
	else
	{
		return "---";
	}
}
function get_project_winner_details($projectId)
{
$query="select * from btr_assignment where projectId=$projectId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql['rows']['0'];
	}
}
function get_project_review($projectId)
{
$query="Select * from btr_reviews where projectId=$projectId";
$sql=@db_query($query);
if($sql['count']>0)
{
	return $sql['rows']['0'];
}
}
function get_all_gigsters()
{
	$query="select b.* from btr_users as b,btr_userprofile as p where b.userId<>18 and b.userId=p.userId and p.skills is not null order by userId DESC";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql;
	}
}
function get_user_rating($userId)
{
	$query="select * from btr_reviews where rateto=$userId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		$a=0;
		$t=0;
		for($i=0;$i<$sql['count'];$i++)
		{
			$t=$t+$sql['rows'][$i]['rating'];
		}
		$myval=$t/$sql['count'];

		 $myval=round($myval);
		
		return $myval;
	}
	else
	{
		return "0";
	}
}
function get_user_assigned_projects($userId)
{
$query="select * from btr_assignment where awardedto=$userId order by id DESC";	
$sql=@db_query($query);
if($sql['count']>0)
{
	return $sql;
}
}
function get_user_project_rating($projectId,$userId)
{
	$query="Select * from btr_reviews where rateto=$userId and projectId=$projectId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql['rows']['0']['rating'];
	}
	else
	{
		return "0";
	}
}
function get_project_feedback($projectId)
{
	$query="Select * from btr_reviews where projectId=$projectId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql['rows']['0'];
	}
	else
	{
		return "0";
	}
}
function strip_slashes($str)
{
	
	return stripslashes(stripslashes($str));
}
function is_invited($from,$to)
{

	$checkQuery="select * from btr_invites where invitefrom=$from and inviteto=$to ";
	$sql=@db_query($checkQuery);
	if($sql['count']>0)
	{
	return "1";
	}
	
}
function get_user_gigs($userId)
{
	 $query="select * from btr_projects where status='2'  and userId=$userId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql;
	}
	else
	{
	}
}
function is_project_bided_by_user($prjId,$userId)
{
	$checkQuery="select * from btr_bids where projectId=$prjId and bidfrom=$userId";
						$checkSql=@db_query($checkQuery);
						if($checkSql['count']>0)
						{
							return 1;
						}
						else
						{
							return 0;
						}
}
function convert_db_date($date)
{
	$date=explode("/",$date);

	$date=$date[2]."-".$date[1]."-".$date[0];
	return $date;
}
function is_message_thread_initiated($projectId,$bidderid)
{
	 $query="select * from btr_messages where (msgfrom=$bidderid or msgto=$bidderid) and projectId=$projectId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return 1;
	}
	else
	{
		return "0";
	}
}
function get_status_details($projectId,$userId)
{
	 $checkQuery="select max(completion) as mcompleted from btr_reports where projectId=$projectId and reportfrom=$userId ";
	$checkSql=@db_query($checkQuery);
	if($checkSql['count']>0)
	{
		return $checkSql['rows']['0']['mcompleted'];
	}
	else
	{
		return "0";
	}
}
function get_report_details($reportId)
{
	$query="select * from btr_reports where rpId=$reportId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql['rows']['0'];
	}

}

function get_status_reports($projectId)
{
	$query="select * from btr_reports where projectId=$projectId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql;
	}
}
function get_message_details($msgId)
{
	$query="select * from btr_messages where msgId=$msgId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql['rows']['0'];
	}
}
function message_thread_started($projectId,$uId)
{
	
$projectInfo=get_gig_details($projectId);
$uInfo=get_user_Info($uId);

if($projectInfo['prjId'])
{
	 $checkQuery="select * from btr_messages where projectId=$projectId and msgfrom=".$projectInfo['userId']." and msgto=".$uInfo['userId'];
	$checkSql=@db_query($checkQuery);

		if($checkSql['count']>0)
		{
			
			return $uInfo['userId'];
		}
		else{
			return 0;
		}

}
}
function is_user_admin($projectId,$userId)
{
$userInfo=get_user_Info($userId);
$projectInfo=get_gig_details($projectId);
if($projectInfo['userId']==$userInfo['userId'])
{
	return 1;
}
else{
	return 0;
}

}
function get_gigsters_on_skill($skills,$user)
{
	$skills=strtolower($skills);
	$skillsarray=explode(",",$skills);
	$g=0;
	for($i=0;$i<sizeof($skillsarray);$i++)
	{
		$skill=$skillsarray[$i];
		$gigsterQuery="select u.userId from btr_users as u,btr_userprofile as p where u.userId=p.userId and u.userId<>18 and u.userId<>$user and p.skills like '%$skill%'";
		$gigsterSql=@db_query($gigsterQuery);
		if($gigsterSql['count']>0)
		{
			for($t=0;$t<$gigsterSql['count'];$t++)
			{
			$gigsterId[$g]=$gigsterSql['rows'][$t]['userId'];
			$g++;
			}
		}
	}
	return $gigsterId;
}
function user_replied($projectId,$user,$msgId)
{
	
	$query1="select * from btr_messages where msgId=$msgId";
	$sql1=@db_query($query1);
	if($sql1['count']>0)
	{
		if($sql1['rows']['0']['msgfrom']==$user)
		{
			$oponent=$sql1['rows']['0']['msgto'];
		}
		else
		{
			$oponent=$sql1['rows']['0']['msgfrom'];
		}
	}
	 $query="select * from btr_messages where msgId>$msgId and msgfrom=$user and msgto=$oponent and projectId=$projectId";
	$sql=@db_query($query);
	
	if($sql['count']>0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
function get_profile_link($serverpath,$userId)
{
	if($userId != 18)
	{
	$gigsterInfo=get_user_Info(encrypt_str($userId));
			$nametodisplay="";
			$nametodisplay=$gigsterInfo['fname'].' '.$gigsterInfo['lname'];
			$nametodisplay1=str_replace(" ","",$nametodisplay);
			if(!$nametodisplay1)
			{
				$nametodisplay=$gigsterInfo['username'];
			}
	$userlink=$serverpath."gigsterInfo/".mera_url_encode($nametodisplay)."/".$gigsterInfo['userId'];
	}
	else
	{
		$userlink="#";
	}
	return $userlink;

}
function is_feedback_given($projectId,$userId)
{
	$query="select * from btr_reviews where ratefrom=$userId and projectId=$projectId" ;
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql['rows']['0']['id'];
	}
	
}
function get_project_feedback_1($projectId,$userId)
{
	$query="select * from btr_reviews where rateto=$userId and projectId=$projectId" ;
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql['rows']['0'];
	}
}
function is_in_array($string,$marray)
{
	return in_array($string,$marray);
}
function my_ucwords($string){
$str=str_split($string,1);
$mstr="";
for($i=0;$i<sizeof($str);$i++)
{
	if($i==0)
	{
		$mstr.=ucwords($str[$i]);
	}
	else
	{
	$mstr.=$str[$i];
	}
}
return $mstr;
}
function get_unread_bids($userId)
{
	 $query="select * from btr_bids where projectId in (select prjId from btr_projects where userId=$userId) and isread='0'";
	 $sql=@db_query($query);
	 if($sql['count']>0)
	 {
		 return $sql;
	 }
	
}
function get_unread_bids_project($projectId)
{
	 $query="select * from btr_bids where projectId=$projectId and isread='0'";
	 $sql=@db_query($query);
	 if($sql['count']>0)
	 {
		 return $sql['count'];
	 }
}
function get_unread_awards($userId)
{
	 $query="select * from btr_assignment where awardedto=$userId and isread='0'";
	 $sql=@db_query($query);
	 if($sql['count']>0)
	 {
		 return $sql;
	 }
	
}
function get_unread_awards_project($projectId)
{
	 $query="select * from btr_assignment where projectId=$projectId and isread='0'";
	 $sql=@db_query($query);
	 if($sql['count']>0)
	 {
		 return $sql['count'];
	 }
}
function get_project_link($serverpath,$gigId)
{
	$gigdetails=get_gig_details($gigId);
	$link=$serverpath."gigDetails/".mera_url_encode($gigdetails['prjTitle'])."/".$gigdetails['prjId'];
	return $link;
}
function get_final_price($projectId,$user)
{
$query="select * from btr_assignment where awardedto=$user and projectId=$projectId";
$sql=@db_query($query);
if($sql['count'])
return $sql['rows']['0']['amount'];	
else
return "0";

}
function get_unread_reports($userId)
{
	 $query="select * from btr_messages where projectId in (select prjId from btr_projects where userId=$userId and status='2') and msgtype='s' and isread='0'";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql['count'];
	}
}
function get_unread_project_report($projectId)
{
	 $query="select * from btr_messages where projectId=$projectId and msgtype='s' and isread='0'";
	 $sql=@db_query($query);
	 if($sql['count']>0)
	 {
		 return $sql['count'];
	 }
}
function get_rating_stars($serverpath,$rating){
	$mstr="";
	for($i=0;$i<$rating;$i++)
	{
		$mstr.="<img src='".$serverpath."images/star_1.png'/>";
	}
	for($i=$rating;$i<5;$i++)
	{
		$mstr.="<img src='".$serverpath."images/star_2.png'/>";
	}
	return $mstr;
}
function send_notifications($skills,$loggedinuser,$projectId,$serverpath)
{
	$users=get_gigsters_on_skill($skills,$loggedinuser);

	$projectDetails=get_gig_details($projectId);
	$prjTitle=$projectDetails['prjTitle'];
	$prjDesc=strip_string($projectDetails['prjTitle'],100);
	$prjDesc.="...";	
	$mailsubject="A new gig matching your skills is posted over GigsterGo";
	if(sizeof($users)>0)
	{
		foreach($users as $user)
		{
			$userInfo="";
			$userInfo=get_user_Info(encrypt_str($user));
			$usermail="";
			$usermail=$userInfo['usermail'];
			$username="";
			$username=$userInfo['username'];
			if(!$username)
			{
				$username=$usermail;
			}
			$mailmatter="";
			$mailmatter='<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="center">
<a href="'.$serverpath.'"><img src="'.$serverpath.'images/logo-1.png" /></a>
</td>
</tr>
</table>
<br/><br/>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td>
Hello <strong>'.$username.'</strong>
</td>
</tr>
<tr>
<td>
&nbsp;
</td>
</tr>
<tr>
<td>
A New gig on Gigster '.$prjTitle.' is posted and it matches to your skillset. 
</td>
</tr>
<tr>
<td>
&nbsp;
</td>
</tr>
<tr>
<td>
<strong>Skills Required : </strong> '.$skills.'
</td>
</tr>

<tr>
<td>
<strong>Details Are</strong>
</td>
</tr>
<tr>
<td>'.$prjDesc.'</td>
</tr>
<tr>
<td>
If you are interested in this Gig , please submit your bid by <a href="'.get_project_link($serverpath,$projectId).'">clicking over here</a>.
</td>
</tr>
</table>
<br/><br/>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td><strong>GigsterGo.com</strong></td>
</tr>
</table>';
$mailmatter=send_my_mail($usermail,$mailmatter,$mailsubject);
			
		}
	}
}
?>