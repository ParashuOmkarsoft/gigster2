<?php
include('cfg/cfg.php');
include('cfg/more-functions.php');
	   $userId=$_GET['userId'];
	   $fname=$_GET['fname'];
	   $lname=$_GET['lname'];
   	   $email=$_GET['email'];
	  
	  $fbImage=get_fb_url("http://graph.facebook.com/".$userId."/picture?type=large");
      $checkquery="select * from btr_users where fbId='$userId' or usermail='$email'";
	  $checksql=@db_query($checkquery);
	  if($checksql['count']>0)
	  {
		if($checksql['rows']['0']['fbId'] != $userId)
		  {
			  $updQuery="update btr_users set fbId='$userId' where userId=".$checksql['rows']['0']['userId'];
			  $updSql=@db_query($updQuery);
		  }
		if($fbImage)
		  {
			  $ext=get_extension($fbImage);
			  $ext=explode("?",$ext);
			  $ext=$ext[0];
			  $newname=$checksql['rows']['0']['userId'].".$ext";
			  if(file_exists("uploads/profileimage/$newname"))
			  {
				  unlink("uploads/profileimage/$newname");
			  }
			  $mcopy=copy($fbImage,"uploads/profileimage/$newname");
			  if($mcopy)
			  {
				  $upQuery="update btr_users set profileimage='$newname' where userId=".$checksql['rows']['0']['userId'];
				  $upQuery=@db_query($upQuery);
			  }
		  }
		  if($checksql['rows']['0']['isactive']=="0")
			  {
				  $_SESSION['uId']=encrypt_str(filter_text($checksql['rows']['0']['userId']));
					echo "ok";
			  }
		  else
			  {

				  $_SESSION['uId']=encrypt_str(filter_text($checksql['rows']['0']['userId']));
					echo "ok";
			  }		
		  }
	  	else
	  	  {
			  $insert_query="insert into btr_users(usermail,fbId,usertype,joinedon,username)";
			  $insert_query.="values('$email','$userId','u',".gmmktime().",'".get_username($email)."')";
			  $insert_sql=@db_query($insert_query,3);
			  if($insert_sql)
			  {
				  $updateQ=@db_query("update btr_users set authkey='".encrypt_str($insert_sql)."',isactive='1' where userId=$insert_sql");
				  $delprofilequery=@db_query("delete from btr_userprofile where userId=$insert_sql");
				  $profilequery="insert into btr_userprofile(userId,fname,lname)";
				  $profilequery.="values($insert_sql,'$fName','$lName')";
				  $profilesql=@db_query($profilequery);
				  if($fbImage)
				  {
				  $ext=get_extension($fbImage);
				  $ext=explode("?",$ext);
				  $ext=$ext[0];
				  $newname=$insert_sql.".$ext";
				  $mcopy=copy($fbImage,"uploads/profileimage/$newname");
					  if($mcopy)
					  {
					  $upQuery="update btr_users set profileimage='$newname' where userId=$insert_sql";
					  $upQuery=@db_query($upQuery);
					  }
				  }
				  $_SESSION['uId']=encrypt_str(filter_text($insert_sql));		
				echo "ok";
			  }
			  else
			  {
				  
			  }
	  		}
?>