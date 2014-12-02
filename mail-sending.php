<?php 
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 

$uname=filter_text($_POST['uname']);
$umail=filter_text($_POST['umail']);
$contactno=filter_text($_POST['contactno']);
$mailsubject=filter_text($_POST['mailsubject']);
$maildesc=filter_text($_POST['maildesc']);

$to="infodreamssolutions@gmail.com";
$from="notifications@gigster.com";
$subject="You have received a new message on Gigster";
$mailmatter='<p>Hello Administrator</p>
<p>You have received a new message on gigster.</p>
<p>Please have a look</p>
<p>&nbsp;</p>
<p><strong>From</strong></p>
<p>'.$uname.'('.$umail.')</p>
<p><strong>Contact No</strong></p>
<p>'.$contactno.'</p>
<p><strong>Subject</strong></p>
<p>'.$mailsubject.'</p>
<p><strong>Message</strong></p>
<p>'.$mailsubject.'</p>
<p>&nbsp;</p>
<p><strong>Regards</strong></p>
<p><strong>'.$sitename.'</strong></p>
';

$sendmail=send_my_mail($to,$mailmatter,$mailsubject);
$sendmail2=send_my_mail("james@gigstergo.com",$mailmatter,$mailsubject);
$sendmail3=send_my_mail("contact@gigstergo.com",$mailmatter,$mailsubject);

 //james@parasolwonder.com
?><script type="text/javascript">
alert("Thanks for contacting Gigster.");
window.parent.location="<?php echo$_SERVER['HTTP_REFERER'];?>";
</script>