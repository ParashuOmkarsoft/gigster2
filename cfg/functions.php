<?php

function get_user_messages($userId)
{
$query="select * from btr_messages where msgto=$userId and isread='0' order by msgId DESC";
$sql=@db_query($query);
if($sql['count']>0)
{
	return $sql;
}
}

function get_all_user_messages($userId)
{
$query="select * from btr_messages where msgto=$userId order by msgId DESC";
$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql;
	}
}

function strip_string($string,$length)
{
	$string=filter_text($string);
	$str=str_split($string,$length);
	return $str[0];
}

function get_time($addtime)
{
	//type cast, current time, difference in timestamps
  $timestamp      = (int) $addtime;
  $current_time   = time();
  $diff           = $current_time - $timestamp;
  
  //intervals in seconds
  $intervals      = array (
   'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
  );
  
  //now we just find the difference
  if ($diff == 0)
  {
   return 'just now';
  }    
 
  if ($diff < 60)
  {
   return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
  }        
 
  if ($diff >= 60 && $diff < $intervals['hour'])
  {
   $diff = floor($diff/$intervals['minute']);
   return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
  }        
 
  if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
  {
   $diff = floor($diff/$intervals['hour']);
   return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
  }    
 
  if ($diff >= $intervals['day'] && $diff < $intervals['week'])
  {
   $diff = floor($diff/$intervals['day']);
   return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
  }    
 
  if ($diff >= $intervals['week'] && $diff < $intervals['month'])
  {
   $diff = floor($diff/$intervals['week']);
   return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
  }    
 
  if ($diff >= $intervals['month'] && $diff < $intervals['year'])
  {
   $diff = floor($diff/$intervals['month']);
   return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
  }    
 
  if ($diff >= $intervals['year'])
  {
   $diff = floor($diff/$intervals['year']);
   return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
  }
}
function get_oponent($pId,$puId)
{
	$query="select * from btr_messages where msgId=$pId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		if($sql['rows']['0']['msgto']==$puId)
		{
			return $sql['rows']['0']['msgfrom'];
		}
		else
		{
			return $sql['rows']['0']['msgto'];
		}
	}

}
function get_user_image($userId)
{
	$query="select * from btr_users where userId=$userId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		if($sql['rows']['0']['profileimage'])
		{
		return "uploads/profileimage/".$sql['rows']['0']['profileimage'];
		}else
		{
			return "img/avatar.png";
		}
	}
		else
		{
			return "img/avatar.png";
		}
}
function get_tags()
{
	$query="select * from btr_tags order by tag";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		for($i=0;$i<$sql['count'];$i++)
		{
			$marray[$i]='"'.$sql['rows'][$i]['tag'].'"';
		}
		return $marray;
	}
}
?>