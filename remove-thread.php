<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 

$delId=$_GET['delId'];
if($delId)
{
	$query="select * from btr_messages where msgId=$delId";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		$project=$sql['rows']['0']['projectId'];
		$msgfrom=$sql['rows']['0']['msgfrom'];
		$msgto=$sql['rows']['0']['msgto'];		
		$delQuery="delete from btr_messages where projectId=$project and ((msgfrom=$msgfrom and msgto=$msgto) or (msgfrom=$msgto and msgto=$msgfrom))";
		$delSql=@db_query($delQuery);
		if(sizeof($GLOBALS['debug_sql'])<=0)
		{
			?>
			<script type="text/javascript">
			window.parent.location="<?php echo $serverpath;?>inbox";
			</script>
			<?php
		}
	}
}
?>