<?php
include('cfg/cfg.php');

$msgto=filter_text($_POST['touser']);
$msgfrom=filter_text($_POST['fromuser']);
$projectId=filter_text($_POST['projectId']);
$content=filter_text($_POST['description']);
$query="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId)values($msgfrom,$msgto,'$content',".gmmktime().",$projectId)";
$sql=@db_query($query,3);
if($sql)
{
	$updateQuery="update btr_projects set status='0' where prjId=$projectId";
	$updateSql=@db_query($updateQuery);
	$delQuery="delete from btr_assignment where projectId=$projectId";
	$delSql=@db_query($delQuery);
?>
<script type="text/javascript">
window.parent.location="<?=$serverpath;?>mygigs";
</script>
<?php	
}

?>