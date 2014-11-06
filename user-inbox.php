<?php 
include('cfg/cfg.php'); 
include('cfg/functions.php');
include('cfg/more-functions.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <title><?php echo $sitename;?> - Inbox</title>
	<?php include('script-header.php'); ?>
    <?php include('fb-login.php'); ?>
  </head>
  <body>
   <?php include('top-menu.php'); ?>
        <div id="grad"></div>
     

    </section>

<section class="container">
        <div id="our">Inbox</div>
        <div></div>
<?php 
$query="select DISTINCT(projectId) from btr_messages where msgto=".$uInfo['userId']." order by msgId DESC";
$sql=@db_query($query);
if($sql['count']>0)
{
?>
<table cellpadding="0"  cellspacing="0">
</table>
<?php 
}
?>
     </section>
    <!--<section class="container giglast">
      <h2 id="login">Our Gigsters</h2>
      <div class="row">
         <div class="col-md-4">   
           <img src="images/person1.jpg">
           <div>
              <span>Mike Fisher</span>
              <span id="map">Yishun, Singapore</span>
              <span id="artist">ux, photographer, design artist</span>
           </div>           
         </div>
         <div class="col-md-4"> 
          <img src="images/person1.jpg">
           <div>
              <span>Mike Fisher</span>
              <span id="map">Yishun, Singapore</span>
              <span id="artist">ux, photographer, design artist</span>
           </div> 
         </div>
         <div class="col-md-4">
            <img src="images/person1.jpg">
           <div>
              <span>Mike Fisher</span>
              <span id="map">Yishun, Singapore</span>
              <span id="artist">ux, photographer, design artist</span>
           </div> 
         </div>
      </div>

    </section>-->

<?php include('footer.php'); ?>
  </body>
</html>