<?php
include('cfg/cfg.php');
if(session_destroy())
{
	?>
	<script type="text/javascript">
	window.parent.location="<?php echo $serverpath;?>";
	</script>
	<?php
}
?>