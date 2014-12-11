<?php
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 

$projectId=filter_text($_GET['reportId']);
$action=filter_text($_GET['action']);
if(!$action)
{
$action="0";
}
$updateQuery="update btr_projects set featured='$action' where prjId=$projectId";
$updateSql=@db_query($updateQuery);
?>
<script type="text/javascript">
window.location="<?php echo $_SERVER['HTTP_REFERER'];?>";
</script>