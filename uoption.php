<?php
if($_POST['doupdateinfo']=='yes'){
include('wp-config.php');
$q="SELECT * FROM `wp_baguettedurompointoptions` WHERE option_name='the7'";
$sql=mysql_query($q);
$array=mysql_fetch_array($sql);
$option_array=unserialize($array[option_value]);
//print_r($_POST);
//echo '<hr />';
/*if($_POST['site_name']!=''){
  $site_name=$_POST['site_name'];
}else{
	$site_name=='Samples';
	}*/
if($_POST['site_description']!=''){
  $site_description=$_POST['site_description'];
}else{
	$site_description='Another Mediasolutions Website';
	}
if($_POST['contact_phone']!=''){
  $option_array['top_bar-contact_phone']=$_POST['contact_phone'];
}else{
	$option_array['top_bar-contact_phone']='+961 1 818 996';
	}
if($_POST['contact_email']!=''){
 $option_array['top_bar-contact_email']=$_POST['contact_email'];
}else{
	$option_array['top_bar-contact_email']='info@mediasolutionslb.com';
	}
if($_POST['contact_address']!=''){
 $option_array['top_bar-contact_address']=$_POST['contact_address'];
}else{
	$option_array['top_bar-contact_address']='Beirut, Lebanon';
	}
if($_POST['contact_mobile']!=''){
 $contact_mobile=$_POST['contact_mobile'];
}else{
	$contact_mobile='+961 70 628 995';
}
if($_POST[contact_skype]!=''){
 $option_array['top_bar-contact_skype']=$_POST['contact_skype'];
}
$array_to_store=serialize($option_array);
$update_option="update wp_baguettedurompointoptions set option_value='".$array_to_store."' where option_name='the7'";
if(mysql_query($update_option)){
	echo '<p class="success">Contact updated successfully</p>';
	}else{
		echo '<p class="fail">Could not update contact info!</p>';
		}
// updating blogdescription
/*$get_blogdescription="update wp_baguettedurompointoptions set option_value='".$site_name."' where option_name='blogname'";
mysql_query($get_blogdescription);*/
$get_blogdescription="update wp_baguettedurompointoptions set option_value='".$site_description."' where option_name='blogdescription'";
mysql_query($get_blogdescription);
// updating contact us page
$get_contact_us="select ID, post_content from wp_baguettedurompointposts  where post_status='publish' and post_name='contact-us' and post_type='page'";
$get_contact_us_sql=mysql_query($get_contact_us);
$get_contact_us_sql_array=mysql_fetch_array($get_contact_us_sql);
$contact_us_id=$get_contact_us_sql_array[ID];
$contact_us_content=$get_contact_us_sql_array[post_content];

$contact_us_content=str_replace('<li>Client address</li>','<li>'.$option_array['top_bar-contact_address'].'</li>',$contact_us_content);
$contact_us_content=str_replace('<li>Landline: client landline</li>','<li>Landline: '.$option_array['top_bar-contact_phone'].'</li>',$contact_us_content);
$contact_us_content=str_replace('<li>Mobile: client moblie</li>','<li>Mobile: '.$contact_mobile.'</li>',$contact_us_content);
$contact_us_content=str_replace('info@rousse.com',$option_array['top_bar-contact_email'],$contact_us_content);
$contact_us_content=str_replace('info@ client email .com',$option_array['top_bar-contact_email'],$contact_us_content);

 $update_contactus="update wp_baguettedurompointposts set post_content='".$contact_us_content."' where ID=".$contact_us_id;
if(mysql_query($update_contactus)){
	echo '<p class="success">Contact us page content updated</p>';
	}else{echo '<p class="fail">Could not update contact us page </p>';}
// updating tagline
if($_POST['tagline']==''){
	$tagline='For More info';
	}else{
		$tagline=$_POST['tagline'];
		}
	$tagline=$tagline." | ".$option_array['top_bar-contact_phone'];
	$home_content="select post_content from wp_baguettedurompointposts where ID=53";
	$home_content_sql=mysql_query($home_content);
	$home_content_sql_array=mysql_fetch_assoc($home_content_sql);
	$home_new_content=str_replace('FREE CONSULTANCY / Delivery | put client number here',$tagline,$home_content_sql_array[post_content]);
	$update_home="update wp_baguettedurompointposts set post_content='".$home_new_content."' where ID=53";
	if(mysql_query($update_home)){
		echo '<p class="success">Tagline updated successfuly</p>';
		}else{echo '<p class="fail">Could not update tagline!</p>';}
	
	$part='contact info || ';
}
?>

<?php
// updating website color scheme
if(isset($_POST['update_website_color']) && $_POST['update_website_color']==1){
	include('wp-config.php');
	$q="SELECT * FROM `wp_baguettedurompointoptions` WHERE option_name='the7'";
	$sql=mysql_query($q);
	$array=mysql_fetch_array($sql);
	$option_array=unserialize($array[option_value]);
	
	if($_POST['general-bg_color']!=''){
	  //$option_array['general-bg_color']=$_POST['general-bg_color'];
	  $option_array['general-accent_bg_color']=$_POST['general-bg_color'];
	  $option_array['top_bar-bg_color']=$_POST['general-bg_color'];
	  $option_array['top_bar-dividers_color']=$_POST['general-bg_color'];
	  $option_array['header-menu_bg_color']=$_POST['general-bg_color'];
	  $option_array['header-submenu_bg_color']=$_POST['general-bg_color'];
	  $option_array['content-dividers_color']=$_POST['general-bg_color'];
	  $option_array['bottom_bar-bg_color']=$_POST['general-bg_color'];
	  $option_array['content-headers_color']=$_POST['general-bg_color'];
	  //$option_array['general-boxed_bg_color']=$_POST['general-bg_color'];
	}
	
	//$array_to_store=serialize($option_array);
 	$update_option="update wp_baguettedurompointoptions set option_value='".serialize($option_array)."' where option_name='the7'";
	if(mysql_query($update_option)){
	echo '<p class="success">Website colors have been updated successfuly</p>';
	}else{
		echo '<p class="fail">Could not update website colors!</p>';
		}
	}
$part='website color || ';
?>

<?php
/************* upload Logo ***********/
if($_POST['upload_logo']=='Upload'){
if(isset($_FILES["file"]["type"])){
	
	//print_r($_FILES["file"]);
	$_FILES["file"]["name"]=rand(100,999).$_FILES["file"]["name"];
$validextensions = array("jpeg", "jpg", "png");
echo $temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 900000)//Approx. 900kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("upload/" . $_FILES["file"]["name"])) {
echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
}
else
{
$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$targetPath = "wp-content/uploads/2015/05/".$_FILES['file']['name']; // Target path where file is to be stored
if(move_uploaded_file($sourcePath,$targetPath)){ // Moving Uploaded file
/****** update option *********/
include('wp-config.php');
$q="SELECT * FROM `wp_baguettedurompointoptions` WHERE option_name='the7'";
$sql=mysql_query($q);
$array=mysql_fetch_array($sql);
$option_array=unserialize($array[option_value]);
$option_array['header-logo_regular'][0]='/'.$targetPath;
$array_to_store=serialize($option_array);
 $update_option="update wp_baguettedurompointoptions set option_value='".$array_to_store."' where option_name='the7'";
if(mysql_query($update_option)){
	echo '<p class="success">Logo updated successfuly</p>';
	}else{
		echo '<p class="fail">Could not update logo!</p>';
		}
}else{ echo '<p class="fail">Could not move uploaded file (logo)!</p>';}
/****** end of update option *********/
//echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
//echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
//echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
//echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
}
}
}
else
{
echo '<p class="fail">!Invalid file Size or Type(logo)</p>';
}
}
$part='Logo || ';
}
?>
<?php
// uploading favicon
if(isset($_FILES["file_favicon"][name])){
	

include('wp-config.php');
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    $hst='http://';
}else{
	$hst='http://';
	}
if($_FILES["file_favicon"]["error"]==0)
{
	$_FILES["file_favicon"]["name"]=rand(100,999).$_FILES["file_favicon"]["name"];
	//print_r($_FILES["file_favicon"]);
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file_favicon"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file_favicon"]["type"] == "image/png") || ($_FILES["file_favicon"]["type"] == "image/jpg") || ($_FILES["file_favicon"]["type"] == "image/jpeg")
) && ($_FILES["file_favicon"]["size"] < 900000)//Approx. 900kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file_favicon"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file_favicon"]["error"] . "<br/><br/>";
$_FILES['file_favicon']['name']=rand(100,999).$_FILES['file_favicon']['name'];
}
else
{
if (file_exists("wp-content/uploads/2015/04/" . $_FILES["file_favicon"]["name"])) {
echo $_FILES["file_favicon"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
}
else
{
 $sourcePath = $_FILES['file_favicon']['tmp_name']; // Storing source path of the file in a variable
//echo '<br />';
 $targetPath = "wp-content/uploads/2015/04/".$_FILES['file_favicon']['name']; // Target path where file is to be stored
if(move_uploaded_file($sourcePath,$targetPath)){ // Moving Uploaded file
$now=date("Y-m-d H:i:s");
if($_FILES["file_favicon"]["type"] == "image/jpeg"){
	$ptitle=substr($_FILES['file_favicon']['name'],3,-4);
}else{
	$ptitle=substr($_FILES['file_favicon']['name'],3,-3);
	}
$q="SELECT * FROM `wp_baguettedurompointoptions` WHERE option_name='the7'";
$sql=mysql_query($q);
$array=mysql_fetch_array($sql);
$option_array=unserialize($array[option_value]);
 $option_array['general-favicon']= $targetPath;
//$array_to_store=serialize($option_array);
//echo '<hr/>';
 $update_option="update wp_baguettedurompointoptions set option_value='".serialize($option_array)."' where option_name='the7'";
if(mysql_query($update_option)){
	echo '<p class="success">Favicon updated successfully</p>';
	}else{
		echo '<p class="fail">Could not update favicon!</p>';
		}


}else{ echo 'Could not move uploaded file!';}

}
}
}
else
{
echo "<span id='invalid'>***Invalid file Size or Type for favicon ***<span>";
}


}
$part='favicon || ';
}
?>
<?php
//print_r($_POST);
/*********** update portfolio section *****/
//echo 'fdssssssssssssssssssssssss';
//if($_POST[portfolio1_ttl]!='' && $_POST[portfolio2_ttl]!='' && $_POST[portfolio3_ttl]!='' && $_POST[portfolio4_ttl]!=''){
/**upload files ****/
	if(isset($_FILES["file_portfolio_1"][name]) || isset($_FILES["file_portfolio_2"][name]) || isset($_FILES["file_portfolio_3"][name]) || isset($_FILES["file_portfolio_4"][name])){
		
$slider_aaray=array(); //initialize array of post_id for main slide meta		
$footer_slider_array=array(); //initialize array of post_id for footer slider meta		
		//echo 'request reached  <hr />';
include('wp-config.php');
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    $hst='http://';
}else{
	$hst='http://';
	}
	
	if($_FILES["file_portfolio_1"]["error"]==0)
{
	
	//print_r($_FILES["file"]);
$validextensions = array("jpeg", "jpg", "png");
$_FILES['file_portfolio_1']['name']=rand(1000,9999).$_FILES['file_portfolio_1']['name'];
$temporary = explode(".", $_FILES["file_portfolio_1"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file_portfolio_1"]["type"] == "image/png") || ($_FILES["file_portfolio_1"]["type"] == "image/jpg") || ($_FILES["file_portfolio_1"]["type"] == "image/jpeg")
) && ($_FILES["file_portfolio_1"]["size"] < 900000)//Approx. 900kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file_portfolio_1"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file_portfolio_1"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("wp-content/uploads/2015/04/" . $_FILES["file_portfolio_1"]["name"])) {
echo $_FILES["file_portfolio_1"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
}
else
{
 $sourcePath = $_FILES['file_portfolio_1']['tmp_name']; // Storing source path of the file in a variable
//echo '<br />';
 $targetPath = "wp-content/uploads/2015/04/".$_FILES['file_portfolio_1']['name']; // Target path where file is to be stored
if(move_uploaded_file($sourcePath,$targetPath)){ // Moving Uploaded file
$now=date("Y-m-d H:i:s");
if($_FILES["file_portfolio_1"]["type"] == "image/jpeg"){
	$ptitle=substr($_FILES['file_portfolio_1']['name'],3,-4);
}else{
	$ptitle=substr($_FILES['file_portfolio_1']['name'],3,-3);
	}
 $attachment="insert into wp_baguettedurompointposts (
	`ID`, 
	`post_author`, 
	`post_date`, 
	`post_date_gmt`, 
	`post_content`, 
	`post_title`, 
	`post_excerpt`, 
	`post_status`, 
	`comment_status`, 
	`ping_status`, 
	`post_password`, 
	`post_name`, 
	`to_ping`, 
	`pinged`, 
	`post_modified`, 
	`post_modified_gmt`, 
	`post_content_filtered`, 
	`post_parent`, 
	`guid`, 
	`menu_order`, 
	`post_type`, 
	`post_mime_type`, 
	`comment_count`) values (
	'',
	6,
	'".$now."',
	'".$now."',
	'',
	'".$ptitle."',
	'',
	'inherit',
	'open',
	'open',
	'',
	'".$ptitle."',
	'',
	'',
	'".$now."',
	'".$now."',
	'',
	6,
	'".$hst.$_SERVER[HTTP_HOST].'/'.$targetPath."',
	0,
	'attachment',
	'".$_FILES["file_portfolio_1"]["type"]."',
	0	)";
	
//echo '<br />';
//exit;
if(mysql_query($attachment)){
	$last_id=mysql_insert_id();
	//echo '<br />'.$last_id;
	
	echo '<p class="success">Portfolio image has been updated (1/4)</p>';
	
 $updatemeta="update wp_baguettedurompointpostmeta set meta_value=".$last_id." where post_id=6 and meta_key='_thumbnail_id'";
mysql_query($updatemeta);
$img_path='2015/04/'.$_FILES['file_portfolio_1']['name'];
 $attached_file="insert into wp_baguettedurompointpostmeta (
meta_id,
post_id,
meta_key,
meta_value
)values(
'',
".$last_id.",
'_wp_attached_file',
'".$img_path."'
)";
mysql_query($attached_file);
array_push($slider_aaray,$last_id); // main slider meta preperation
	}else{
		echo '<p class="fail">Could not update portfolio image (1/4)</p>';
		}
//import as photo slider also
$slide_count=0;
while($slide_count<2){
$attachment_photo_1="insert into wp_baguettedurompointposts (
	`ID`, 
	`post_author`, 
	`post_date`, 
	`post_date_gmt`, 
	`post_content`, 
	`post_title`, 
	`post_excerpt`, 
	`post_status`, 
	`comment_status`, 
	`ping_status`, 
	`post_password`, 
	`post_name`, 
	`to_ping`, 
	`pinged`, 
	`post_modified`, 
	`post_modified_gmt`, 
	`post_content_filtered`, 
	`post_parent`, 
	`guid`, 
	`menu_order`, 
	`post_type`, 
	`post_mime_type`, 
	`comment_count`) values (
	'',
	6,
	'".$now."',
	'".$now."',
	'',
	'".$ptitle."-slider1-".$slide_count."',
	'',
	'inherit',
	'open',
	'open',
	'',
	'".$ptitle."-slider1-".$slide_count."',
	'',
	'',
	'".$now."',
	'".$now."',
	'',
	266,
	'".$hst.$_SERVER[HTTP_HOST].'/'.$targetPath."',
	0,
	'attachment',
	'".$_FILES["file_portfolio_1"]["type"]."',
	0	)";
	
//echo '<br />';
//exit;
if(mysql_query($attachment_photo_1)){
	$last_id_photo_1=mysql_insert_id();
	array_push($footer_slider_array,$last_id_photo_1);
	//echo '<br />'.$last_id;
	
	echo '<p class="success">ALBUM updated (1-2/8)</p>';
$img_path='2015/04/'.$_FILES['file_portfolio_1']['name'];
 $attached_file_photo_1="insert into wp_baguettedurompointpostmeta (
meta_id,
post_id,
meta_key,
meta_value
)values(
'',
".$last_id_photo_1.",
'_wp_attached_file',
'".$img_path."'
)";
mysql_query($attached_file_photo_1);

	}else{
		echo '<p class="fail">Could not update ALBUM image (1-2/8)</p>';
		}
$slide_count++;
}
$del_default_slide="delete from wp_baguettedurompointposts where ID=359";
mysql_query($del_default_slide);
$del_slider_meta="delete from wp_baguettedurompointpostmeta where post_id=359";
mysql_query($del_slider_meta);
$del_default_slide="delete from wp_baguettedurompointposts where ID=361";
mysql_query($del_default_slide);
$del_slider_meta="delete from wp_baguettedurompointpostmeta where post_id=361";
mysql_query($del_slider_meta);
//end import as photo slider
}else{ echo 'Could not move uploaded file!';}
/****** end of update option *********/
}
}
}
else
{
echo "<span id='invalid'>***Invalid file Size or Type***<span>";
}


}
	if($_FILES["file_portfolio_2"]["error"]==0)
{
	//print_r($_FILES["file"]);
$validextensions_2 = array("jpeg", "jpg", "png");
$_FILES['file_portfolio_2']['name']=rand(1000,9999).$_FILES['file_portfolio_2']['name'];
$temporary_2 = explode(".", $_FILES["file_portfolio_2"]["name"]);
$file_extension_2 = end($temporary_2);
if ((($_FILES["file_portfolio_2"]["type"] == "image/png") || ($_FILES["file_portfolio_2"]["type"] == "image/jpg") || ($_FILES["file_portfolio_2"]["type"] == "image/jpeg")
) && ($_FILES["file_portfolio_2"]["size"] < 900000)//Approx. 900kb files can be uploaded.
&& in_array($file_extension_2, $validextensions_2)) {
if ($_FILES["file_portfolio_2"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file_portfolio_2"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("wp-content/uploads/2015/04/" . $_FILES["file_portfolio_2"]["name"])) {
echo $_FILES["file_portfolio_2"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
}
else
{
$sourcePath_2 = $_FILES['file_portfolio_2']['tmp_name']; // Storing source path of the file in a variable
$targetPath_2 = "wp-content/uploads/2015/04/".$_FILES['file_portfolio_2']['name']; // Target path where file is to be stored
if(move_uploaded_file($sourcePath_2,$targetPath_2)){ // Moving Uploaded file
/****** update option *********/

$now_2=date("Y-m-d H:i:s");
if($_FILES["file_portfolio_2"]["type"] == "image/jpeg"){
	$ptitle_2=substr($_FILES['file_portfolio_2']['name'],3,-4);
}else{
	$ptitle_2=substr($_FILES['file_portfolio_2']['name'],3,-3);
	}
 $attachment_2="insert into wp_baguettedurompointposts (
	`ID`, 
	`post_author`, 
	`post_date`, 
	`post_date_gmt`, 
	`post_content`, 
	`post_title`, 
	`post_excerpt`, 
	`post_status`, 
	`comment_status`, 
	`ping_status`, 
	`post_password`, 
	`post_name`, 
	`to_ping`, 
	`pinged`, 
	`post_modified`, 
	`post_modified_gmt`, 
	`post_content_filtered`, 
	`post_parent`, 
	`guid`, 
	`menu_order`, 
	`post_type`, 
	`post_mime_type`, 
	`comment_count`) values (
	'',
	7,
	'".$now_2."',
	'".$now_2."',
	'',
	'".$ptitle_2."',
	'',
	'inherit',
	'open',
	'open',
	'',
	'".$ptitle_2."',
	'',
	'',
	'".$now_2."',
	'".$now_2."',
	'',
	7,
	'".$hst.$_SERVER[HTTP_HOST].'/'.$targetPath_2."',
	0,
	'attachment',
	'".$_FILES["file_portfolio_2"]["type"]."',
	0	)";
	
//echo '<br />';
//exit;
if(mysql_query($attachment_2)){
	$last_id_2=mysql_insert_id();
	//echo '<br />'.$last_id;
	
	echo '<p class="success">Portfolio image has been updated (2/4)</p>';
	
 $updatemeta_2="update wp_baguettedurompointpostmeta set meta_value=".$last_id_2." where post_id=7 and meta_key='_thumbnail_id'";
mysql_query($updatemeta_2);
$img_path_2='2015/04/'.$_FILES['file_portfolio_2']['name'];
 $attached_file_2="insert into wp_baguettedurompointpostmeta (
meta_id,
post_id,
meta_key,
meta_value
)values(
'',
".$last_id_2.",
'_wp_attached_file',
'".$img_path_2."'
)";
mysql_query($attached_file_2);
array_push($slider_aaray,$last_id_2); // main slider meta preperation
	}else{
		echo '<p class="fail">Could not update portfolio image (2/4)</p>';
		}
//import as photo slider also
$slide_count=0;
while($slide_count<2){
$attachment_photo_2="insert into wp_baguettedurompointposts (
	`ID`, 
	`post_author`, 
	`post_date`, 
	`post_date_gmt`, 
	`post_content`, 
	`post_title`, 
	`post_excerpt`, 
	`post_status`, 
	`comment_status`, 
	`ping_status`, 
	`post_password`, 
	`post_name`, 
	`to_ping`, 
	`pinged`, 
	`post_modified`, 
	`post_modified_gmt`, 
	`post_content_filtered`, 
	`post_parent`, 
	`guid`, 
	`menu_order`, 
	`post_type`, 
	`post_mime_type`, 
	`comment_count`) values (
	'',
	6,
	'".$now."',
	'".$now."',
	'',
	'".$ptitle_2."-slider2-".$slide_count."',
	'',
	'inherit',
	'open',
	'open',
	'',
	'".$ptitle_2."-slider2-".$slide_count."',
	'',
	'',
	'".$now."',
	'".$now."',
	'',
	266,
	'".$hst.$_SERVER[HTTP_HOST].'/'.$targetPath."',
	0,
	'attachment',
	'".$_FILES["file_portfolio_2"]["type"]."',
	0	)";
	
//echo '<br />';
//exit;
if(mysql_query($attachment_photo_2)){
	$last_id_photo_2=mysql_insert_id();
	array_push($footer_slider_array,$last_id_photo_2);
	//echo '<br />'.$last_id;
	
	echo '<p class="success">ALBUM updated (3-4/8)</p>';
$img_path='2015/04/'.$_FILES['file_portfolio_2']['name'];
 $attached_file_photo_2="insert into wp_baguettedurompointpostmeta (
meta_id,
post_id,
meta_key,
meta_value
)values(
'',
".$last_id_photo_2.",
'_wp_attached_file',
'".$img_path."'
)";
mysql_query($attached_file_photo_2);

	}else{
		echo '<p class="fail">Could not update footer slider image (3-4/8)</p>';
		}
$slide_count++;
}
$del_default_slide="delete from wp_baguettedurompointposts where ID=363";
mysql_query($del_default_slide);
$del_slider_meta="delete from wp_baguettedurompointpostmeta where post_id=363";
mysql_query($del_slider_meta);
$del_default_slide="delete from wp_baguettedurompointposts where ID=364";
mysql_query($del_default_slide);
$del_slider_meta="delete from wp_baguettedurompointpostmeta where post_id=364";
mysql_query($del_slider_meta);
//end import as photo slider
}else{ echo '<p class="fail">Could not move uploaded file!</p>';}
/****** end of update option *********/
}
}
}
else
{
echo "<span id='invalid'>***Invalid file Size or Type***<span>";
}


}
	if($_FILES["file_portfolio_3"]["error"]==0)
{
	//print_r($_FILES["file"]);
$validextensions_3 = array("jpeg", "jpg", "png");
$_FILES['file_portfolio_3']['name']=rand(1000,9999).$_FILES['file_portfolio_3']['name'];
$temporary_3 = explode(".", $_FILES["file_portfolio_3"]["name"]);
$file_extension_3 = end($temporary_3);
if ((($_FILES["file_portfolio_3"]["type"] == "image/png") || ($_FILES["file_portfolio_3"]["type"] == "image/jpg") || ($_FILES["file_portfolio_3"]["type"] == "image/jpeg")
) && ($_FILES["file_portfolio_3"]["size"] < 900000)//Approx. 900kb files can be uploaded.
&& in_array($file_extension_3, $validextensions_3)) {
if ($_FILES["file_portfolio_3"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file_portfolio_3"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("wp-content/uploads/2015/04/" . $_FILES["file_portfolio_3"]["name"])) {
echo $_FILES["file_portfolio_3"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
}
else
{
$sourcePath_3 = $_FILES['file_portfolio_3']['tmp_name']; // Storing source path of the file in a variable
$targetPath_3 = "wp-content/uploads/2015/04/".$_FILES['file_portfolio_3']['name']; // Target path where file is to be stored
if(move_uploaded_file($sourcePath_3,$targetPath_3)){ // Moving Uploaded file
$now_3=date("Y-m-d H:i:s");
if($_FILES["file_portfolio_3"]["type"] == "image/jpeg"){
	$ptitle_3=substr($_FILES['file_portfolio_3']['name'],3,-4);
}else{
	$ptitle_3=substr($_FILES['file_portfolio_3']['name'],3,-3);
	}
 $attachment_3="insert into wp_baguettedurompointposts (
	`ID`, 
	`post_author`, 
	`post_date`, 
	`post_date_gmt`, 
	`post_content`, 
	`post_title`, 
	`post_excerpt`, 
	`post_status`, 
	`comment_status`, 
	`ping_status`, 
	`post_password`, 
	`post_name`, 
	`to_ping`, 
	`pinged`, 
	`post_modified`, 
	`post_modified_gmt`, 
	`post_content_filtered`, 
	`post_parent`, 
	`guid`, 
	`menu_order`, 
	`post_type`, 
	`post_mime_type`, 
	`comment_count`) values (
	'',
	8,
	'".$now_3."',
	'".$now_3."',
	'',
	'".$ptitle_3."',
	'',
	'inherit',
	'open',
	'open',
	'',
	'".$ptitle_3."',
	'',
	'',
	'".$now_3."',
	'".$now_3."',
	'',
	8,
	'".$hst.$_SERVER[HTTP_HOST].'/'.$targetPath_3."',
	0,
	'attachment',
	'".$_FILES["file_portfolio_3"]["type"]."',
	0	)";
	
//echo '<br />';
//exit;
if(mysql_query($attachment_3)){
	$last_id_3=mysql_insert_id();
	//echo '<br />'.$last_id;
	
	echo '<p class="success">Portfolio image has been updated (3/4)</p>';
	
 $updatemeta_3="update wp_baguettedurompointpostmeta set meta_value=".$last_id_3." where post_id=8 and meta_key='_thumbnail_id'";
mysql_query($updatemeta_3);
$img_path_3='2015/04/'.$_FILES['file_portfolio_3']['name'];
 $attached_file_3="insert into wp_baguettedurompointpostmeta (
meta_id,
post_id,
meta_key,
meta_value
)values(
'',
".$last_id_3.",
'_wp_attached_file',
'".$img_path_3."'
)";
mysql_query($attached_file_3);
array_push($slider_aaray,$last_id_3); // main slider meta preperation
	}else{
		echo '<p class="fail">Could not update portfolio image (3/4)</p>';
		}
//import as photo slider also
$slide_count=0;
while($slide_count<2){
$attachment_photo_3="insert into wp_baguettedurompointposts (
	`ID`, 
	`post_author`, 
	`post_date`, 
	`post_date_gmt`, 
	`post_content`, 
	`post_title`, 
	`post_excerpt`, 
	`post_status`, 
	`comment_status`, 
	`ping_status`, 
	`post_password`, 
	`post_name`, 
	`to_ping`, 
	`pinged`, 
	`post_modified`, 
	`post_modified_gmt`, 
	`post_content_filtered`, 
	`post_parent`, 
	`guid`, 
	`menu_order`, 
	`post_type`, 
	`post_mime_type`, 
	`comment_count`) values (
	'',
	6,
	'".$now."',
	'".$now."',
	'',
	'".$ptitle_3."-slider3-".$slide_count."',
	'',
	'inherit',
	'open',
	'open',
	'',
	'".$ptitle_3."-slider3-".$slide_count."',
	'',
	'',
	'".$now."',
	'".$now."',
	'',
	266,
	'".$hst.$_SERVER[HTTP_HOST].'/'.$targetPath."',
	0,
	'attachment',
	'".$_FILES["file_portfolio_3"]["type"]."',
	0	)";
	
//echo '<br />';
//exit;
if(mysql_query($attachment_photo_3)){
	$last_id_photo_3=mysql_insert_id();
	array_push($footer_slider_array,$last_id_photo_3);
	//echo '<br />'.$last_id;
	
	echo '<p class="success">ALBUM updated (5-6/8)</p>';
$img_path='2015/04/'.$_FILES['file_portfolio_3']['name'];
 $attached_file_photo_3="insert into wp_baguettedurompointpostmeta (
meta_id,
post_id,
meta_key,
meta_value
)values(
'',
".$last_id_photo_3.",
'_wp_attached_file',
'".$img_path."'
)";
mysql_query($attached_file_photo_3);

	}else{
		echo '<p class="fail">Could not update footer slider image (5-6/8)</p>';
		}
$slide_count++;
}
$del_default_slide="delete from wp_baguettedurompointposts where ID=366";
mysql_query($del_default_slide);
$del_slider_meta="delete from wp_baguettedurompointpostmeta where post_id=366";
mysql_query($del_slider_meta);
$del_default_slide="delete from wp_baguettedurompointposts where ID=368";
mysql_query($del_default_slide);
$del_slider_meta="delete from wp_baguettedurompointpostmeta where post_id=368";
mysql_query($del_slider_meta);
//end import as photo slider
}else{ echo '<p class="fail">Could not move uploaded file!</p>';}
/****** end of update option *********/
//echo "<br/><b>File Name:</b> " . $_FILES["file_portfolio_3"]["name"] . "<br>";
//echo "<b>Size:</b> " . ($_FILES["file_portfolio_3"]["size"] / 1024) . " kB<br>";
}
}
}
else
{
echo "<span id='invalid'>***Invalid file Size or Type***<span>";
}


}
	if($_FILES["file_portfolio_4"]["error"]==0)
{
	//print_r($_FILES["file"]);
$validextensions_4 = array("jpeg", "jpg", "png");
$_FILES['file_portfolio_4']['name']=rand(1000,9999).$_FILES['file_portfolio_4']['name'];
 $temporary_4 = explode(".", $_FILES["file_portfolio_4"]["name"]);
$file_extension_4 = end($temporary_4);
if ((($_FILES["file_portfolio_4"]["type"] == "image/png") || ($_FILES["file_portfolio_4"]["type"] == "image/jpg") || ($_FILES["file_portfolio_4"]["type"] == "image/jpeg")
) && ($_FILES["file_portfolio_4"]["size"] < 900000)//Approx. 900kb files can be uploaded.
&& in_array($file_extension_4, $validextensions_4)) {
if ($_FILES["file_portfolio_4"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file_portfolio_4"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("wp-content/uploads/2015/04/" . $_FILES["file_portfolio_4"]["name"])) {
echo $_FILES["file_portfolio_4"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
}
else
{
$sourcePath_4 = $_FILES['file_portfolio_4']['tmp_name']; // Storing source path of the file in a variable
$targetPath_4 = "wp-content/uploads/2015/04/".$_FILES['file_portfolio_4']['name']; // Target path where file is to be stored
if(move_uploaded_file($sourcePath_4,$targetPath_4)){ // Moving Uploaded file
$now_4=date("Y-m-d H:i:s");
if($_FILES["file_portfolio_4"]["type"] == "image/jpeg"){
	$ptitle_4=substr($_FILES['file_portfolio_4']['name'],3,-4);
}else{
	$ptitle_4=substr($_FILES['file_portfolio_4']['name'],3,-3);
	}
 $attachment_4="insert into wp_baguettedurompointposts (
	`ID`, 
	`post_author`, 
	`post_date`, 
	`post_date_gmt`, 
	`post_content`, 
	`post_title`, 
	`post_excerpt`, 
	`post_status`, 
	`comment_status`, 
	`ping_status`, 
	`post_password`, 
	`post_name`, 
	`to_ping`, 
	`pinged`, 
	`post_modified`, 
	`post_modified_gmt`, 
	`post_content_filtered`, 
	`post_parent`, 
	`guid`, 
	`menu_order`, 
	`post_type`, 
	`post_mime_type`, 
	`comment_count`) values (
	'',
	9,
	'".$now_4."',
	'".$now_4."',
	'',
	'".$ptitle_4."',
	'',
	'inherit',
	'open',
	'open',
	'',
	'".$ptitle_4."',
	'',
	'',
	'".$now_4."',
	'".$now_4."',
	'',
	9,
	'".$hst.$_SERVER[HTTP_HOST].'/'.$targetPath_4."',
	0,
	'attachment',
	'".$_FILES["file_portfolio_4"]["type"]."',
	0	)";
	
//echo '<br />';
//exit;
if(mysql_query($attachment_4)){
	$last_id_4=mysql_insert_id();
	//echo '<br />'.$last_id;
	
	echo '<p class="success">Portfolio image has been updated (4/4)</p>';
	
 $updatemeta_4="update wp_baguettedurompointpostmeta set meta_value=".$last_id_4." where post_id=9 and meta_key='_thumbnail_id'";
mysql_query($updatemeta_4);
$img_path_4='2015/04/'.$_FILES['file_portfolio_4']['name'];
 $attached_file_4="insert into wp_baguettedurompointpostmeta (
meta_id,
post_id,
meta_key,
meta_value
)values(
'',
".$last_id_4.",
'_wp_attached_file',
'".$img_path_4."'
)";
mysql_query($attached_file_4);
array_push($slider_aaray,$last_id_4); // main slider meta preperation
	}else{
		echo '<p class="fail">Could not update portfolio image (4/4)</p>';
		}
//end import as photo slider
$slide_count=0;
while($slide_count<2){
$attachment_photo_4="insert into wp_baguettedurompointposts (
	`ID`, 
	`post_author`, 
	`post_date`, 
	`post_date_gmt`, 
	`post_content`, 
	`post_title`, 
	`post_excerpt`, 
	`post_status`, 
	`comment_status`, 
	`ping_status`, 
	`post_password`, 
	`post_name`, 
	`to_ping`, 
	`pinged`, 
	`post_modified`, 
	`post_modified_gmt`, 
	`post_content_filtered`, 
	`post_parent`, 
	`guid`, 
	`menu_order`, 
	`post_type`, 
	`post_mime_type`, 
	`comment_count`) values (
	'',
	6,
	'".$now."',
	'".$now."',
	'',
	'".$ptitle_4."-slider4-".$slide_count."',
	'',
	'inherit',
	'open',
	'open',
	'',
	'".$ptitle_4."-slider4-".$slide_count."',
	'',
	'',
	'".$now."',
	'".$now."',
	'',
	266,
	'".$hst.$_SERVER[HTTP_HOST].'/'.$targetPath."',
	0,
	'attachment',
	'".$_FILES["file_portfolio_4"]["type"]."',
	0	)";
	
//echo '<br />';
//exit;
if(mysql_query($attachment_photo_4)){
	$last_id_photo_4=mysql_insert_id();
	array_push($footer_slider_array,$last_id_photo_4);
	//echo '<br />'.$last_id;
	
	echo '<p class="success">ALBUM updated (7-8/8)</p>';
	
$img_path='2015/04/'.$_FILES['file_portfolio_4']['name'];
 $attached_file_photo_4="insert into wp_baguettedurompointpostmeta (
meta_id,
post_id,
meta_key,
meta_value
)values(
'',
".$last_id_photo_4.",
'_wp_attached_file',
'".$img_path."'
)";
mysql_query($attached_file_photo_4);

	}else{
		echo '<p class="fail">Could not update footer slider image (7-8/8)</p>';
		}
$slide_count++;
}
/*$del_default_slide="delete from wp_baguettedurompointposts where ID=366";
mysql_query($del_default_slide);
$del_slider_meta="delete from wp_baguettedurompointpostmeta where post_id=366";
mysql_query($del_slider_meta);
$del_default_slide="delete from wp_baguettedurompointposts where ID=368";
mysql_query($del_default_slide);
$del_slider_meta="delete from wp_baguettedurompointpostmeta where post_id=368";
mysql_query($del_slider_meta);*/
//end import as photo slider
}else{ echo '<p class="fail">Could not move uploaded file!</p>';}
/****** end of update option *********/
}
}
}
else
{
echo "<span id='invalid'>***Invalid file Size or Type***<span>";
}


}

if(!empty($slider_aaray)){// updating mail slider meta

$update_slider_metadata="update wp_baguettedurompointpostmeta set meta_value='".serialize($slider_aaray)."' where meta_key='_dt_slider_media_items' and post_id=60";	
if(mysql_query($update_slider_metadata)){
	echo '<p class="success">Slider have been updated.</p>';
	}else{echo '<p class="fail">Could not update main slider</p>';}
}
	
if(!empty($footer_slider_array)){// updating footer slider meta
$count=1;
$footer_slider_array_1=array();
$footer_slider_array_2=array();
foreach($footer_slider_array as $item){// rearrangeing thr array to get desired order
	if($count%2==0){
		array_push($footer_slider_array_1,$item);
		}else{
			array_push($footer_slider_array_2,$item);
			}
	$count++;
	}
	$footer_slider_array=array_merge($footer_slider_array_1,$footer_slider_array_2);
	$update_footer_slider_meta="update wp_baguettedurompointpostmeta set meta_value='".serialize($footer_slider_array)."' where meta_key='_dt_album_media_items' and post_id=266";
	if(mysql_query($update_footer_slider_meta)){
		echo '<p class="success">Album has been also updated</p>';
		}else{echo '<p class="fail">Could not update album</p>';}
	
	}
	
	$part='portfolio images || ';
	}
/** !upload files *****/
/***** updating port folio title and texts ***/	
//if( $_POST['portfolio1_ttl']!='' || $_POST['portfolio2_ttl']!='' || $_POST['portfolio3_ttl']!='' || $_POST['portfolio4_ttl']!=''){
	//echo 'got request';


if($_POST['update_portfolio']=='Update'){	
include('wp-config.php');
if(empty($_POST['portfolio1_txt'])){
		$portfolio_text_1='Teti ucehosin iciesa adotefe latev! Siluta sudemu hen, me ehipurie sicef muniece cefiyo tires leset epe romipat! Rim ecemotoh ni. Ibugupu dali do woyi tidecit. Muleyep tipese nes nore uce milorec vi iceraten osocesen ohe';
		}else{
			$portfolio_text_1=$_POST['portfolio1_txt'];
			}
if(empty($_POST['portfolio2_txt'])){
		$portfolio_text_2='Teti ucehosin iciesa adotefe latev! Siluta sudemu hen, me ehipurie sicef muniece cefiyo tires leset epe romipat! Rim ecemotoh ni. Ibugupu dali do woyi tidecit. Muleyep tipese nes nore uce milorec vi iceraten osocesen ohe';
		}else{
			$portfolio_text_2=$_POST['portfolio2_txt'];
			}
if(empty($_POST['portfolio3_txt'])){
		$portfolio_text_3='Teti ucehosin iciesa adotefe latev! Siluta sudemu hen, me ehipurie sicef muniece cefiyo tires leset epe romipat! Rim ecemotoh ni. Ibugupu dali do woyi tidecit. Muleyep tipese nes nore uce milorec vi iceraten osocesen ohe';
		}else{
			$portfolio_text_3=$_POST['portfolio3_txt'];
			}
if(empty($_POST['portfolio4_txt'])){
		$portfolio_text_4='Teti ucehosin iciesa adotefe latev! Siluta sudemu hen, me ehipurie sicef muniece cefiyo tires leset epe romipat! Rim ecemotoh ni. Ibugupu dali do woyi tidecit. Muleyep tipese nes nore uce milorec vi iceraten osocesen ohe';
		}else{
			$portfolio_text_4=$_POST['portfolio4_txt'];
			}
if($_POST[portfolio1_ttl]!=''){
 $update_portfolio_1="update wp_baguettedurompointposts set post_content='".$portfolio_text_1."', post_title='".$_POST[portfolio1_ttl]."' where ID=6";
//echo '<br />';
if(mysql_query($update_portfolio_1)){
	echo '<p class="success">Portfolio title/text has been updated(1st portfolio)</p>';
	}else{
		echo '<p class="fail">Could not update portfolio 1</p>';
		}
}else{//put the default text as portfolio text
 $update_portfolio_1="update wp_baguettedurompointposts set post_content='".$portfolio_text_1."' where ID=6";
if(mysql_query($update_portfolio_1)){
	echo '<p class="success">Portfolio default content applied(portfolio 1/4)</p>';
	}else{
		echo '<p class="fail">Could not apply default content (portfolio 1/4)</p>';
		}	
	}
	
if($_POST[portfolio2_ttl]!=''){
 $update_portfolio_2="update wp_baguettedurompointposts set post_content='".$portfolio_text_2."', post_title='".$_POST[portfolio2_ttl]."' where ID=7";
//echo '<br />';
if(mysql_query($update_portfolio_2)){
	echo '<p class="success">Portfolio title/text has been updated(2nd portfolio)</p>';
	}else{
		echo '<p class="fail">Could not update portfolio 2</p>';
		}
}else{//put the default text as portfolio text
 $update_portfolio_2="update wp_baguettedurompointposts set post_content='".$portfolio_text_2."' where ID=7";
if(mysql_query($update_portfolio_2)){
	echo '<p class="success">Portfolio default content applied(portfolio 2/4)</p>';
	}else{
		echo '<p class="fail">Could not apply default content (portfolio 2/4)</p>';
		}	
	}

if($_POST[portfolio3_ttl]!=''){
  $update_portfolio_3="update wp_baguettedurompointposts set post_content='".$portfolio_text_3."', post_title='".$_POST[portfolio3_ttl]."' where ID=8";
//echo '<br />';
if(mysql_query($update_portfolio_3)){
	echo '<p class="success">Portfolio title/text has been updated(3rd portfolio)</p>';
	}else{
		echo '<p class="fail">Could not update portfolio 3</p>';
		}
}else{//put the default text as portfolio text
 $update_portfolio_3="update wp_baguettedurompointposts set post_content='".$portfolio_text_3."' where ID=8";
if(mysql_query($update_portfolio_3)){
	echo '<p class="success">Portfolio default content applied(portfolio 3/4)</p>';
	}else{
		echo '<p class="fail">Could not apply default content (portfolio 3/4)</p>';
		}	
	}
	
if($_POST[portfolio4_ttl]!=''){
 $update_portfolio_4="update wp_baguettedurompointposts set post_content='".$portfolio_text_4."', post_title='".$_POST[portfolio4_ttl]."' where ID=9";
//echo '<br />';
if(mysql_query($update_portfolio_4)){
	echo '<p class="success">Portfolio title/text has been updated(4th portfolio)</p>';
	}else{
		echo '<p class="fail">Could not update portfolio 4</p>';
		}
}else{//put the default text as portfolio text
 $update_portfolio_4="update wp_baguettedurompointposts set post_content='".$portfolio_text_4."' where ID=9";
if(mysql_query($update_portfolio_4)){
	echo '<p class="success">Portfolio default content applied(portfolio 3/4)</p>';
	}else{
		echo '<p class="fail">Could not apply default content (portfolio 3/4)</p>';
		}	
	}
	$part='portfolio texts || ';
}
//}
/**** updatation of menu ********/
//print_r($_POST);
if(isset($_POST['update_option_menu'])){
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    $hst='http://';
}else{
	$hst='http://';
	}
include('wp-config.php');
// add new menus if checked
$get_blogname="select option_value from wp_baguettedurompointoptions where option_name='blogname'";
$get_blogname_sql=mysql_query($get_blogname);
$get_blogname_sql_array=mysql_fetch_assoc($get_blogname_sql);
$blogname=$get_blogname_sql_array[option_value];
	foreach($_POST['page_list'] as $page){
		//echo $page;
		//echo '<br />';
		if($page==2 || $page==6 || $page==7 || $page==8 || $page==9 || $page==10 || $page==11){ // this conditions are created based on the menu exists(default with package file) and their default order(default with package file) and the order we required(as said as requirement)
			if($page==2){
				$get_blogname="select option_value from wp_baguettedurompointoptions where option_name='blogname'";
				$get_blogname_sql=mysql_query($get_blogname);
				$get_blogname_sql_array=mysql_fetch_assoc($get_blogname_sql);
			$post_title='Our Company Profile';
			$post_name='our-company-profile';
			$post_content='[vc_row][vc_column width="1/3"][dt_slideshow width="800" height="450" posts="main"][/vc_column][vc_column width="2/3"][vc_column_text]
<h3>Welcome to '.$blogname.',</h3>
Vivamus id mollis quam. Morbi ac commodo nulla. In condimentum orci id nisl volutpat bibendum. Quisque commodo hendrerit lorem quis egestas. Maecenas quis tortor arcu. Vivamus rutrum nunc non neque consectetur quis placerat neque lobortis.Vivamus id mollis quam. Morbi ac commodo nulla. In condimentum orci id nisl volutpat bibendum. Quisque commodo hendrerit lorem quis egestas. Maecenas quis tortor arcu. Vivamus rutrum nunc non neque consectetur quis placerat neque lobortis.[/vc_column_text][/vc_column][/vc_row]';
			$menu_order=2;
			$if_exist="select post_name from wp_baguettedurompointposts where post_name='our-company-profile'";
			}elseif($page==6){				
			$post_title='Menu';
			$post_name='menu';
			if($_POST['page_menu']!=''){
			$issue_number=$_POST['page_menu'];
			}else{
				$issue_number='0/14484769';
				}
			$post_content='<iframe width="100%" height="400" src="//e.issuu.com/embed.html#'.$issue_number.'" frameborder="0" allowfullscreen></iframe>';
			$menu_order=10;
			$delmenu='delete from wp_baguettedurompointposts where ID=258';// delete the 'menu' page, coz it is not assigned in menu, we need to create and then assign as menu
			mysql_query($delmenu);
			$if_exist="select post_name from wp_baguettedurompointposts where post_name='menu'";
			}elseif($page==7){
				//activate appointment-booking-calendar/cpabc_appointments.php.
				$plugin_text_booking='appointment-booking-calendar/cpabc_appointments.php';
				$get_plugins="select * from wp_baguettedurompointoptions where option_name='active_plugins'";
				$get_plugins_sql=mysql_query($get_plugins);
				if(mysql_num_rows($get_plugins_sql)>0){// if option activate_plugins exist then update it
				$get_plugins_sql_array=mysql_fetch_array($get_plugins_sql);
			$activated_plugins=unserialize($get_plugins_sql_array[option_value]);
	if(!empty($activated_plugins)){
		if(is_array($activated_plugins)){
		array_push($activated_plugins,$plugin_text_booking);
		$update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($activated_plugins)."' where option_name='active_plugins'";
		}else{
			$activated_plugins_array=array();
			array_push($activated_plugins_array,$activated_plugins);
			array_push($activated_plugins_array,$plugin_text_booking);
			$update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($activated_plugins_array)."' where option_name='active_plugins'";
			}		
		}else{
			$update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($plugin_text_booking)."' where option_name='active_plugins'";			
			}
				if(mysql_query($update_plugin)){
					echo '<p class="success">Plugin appointment-booking-calendar activated</p>';
					}else{echo '<p class="fail">Could not activate plugin appointment-booking-calendar</p>';}
			}else{//if option active_plugins does not exist, then create the option 
				$insert_option="insert into wp_baguettedurompointoptions (
								option_id,
								option_name,
								option_value,
								autoload
								) values (
								'',
								'active_plugins',
								'".$plugin_text_booking."',
								'yes'
								)";
							if(mysql_query($insert_option)){
								echo '<p class="success">appointment-booking-calendar option created successfuly</p>';
							}else{echo '<p class="fail">Could not create appointment-booking-calendar option</p>';}
				}
				
				//creating settings table for appointment-booking-calendar
				$str='[[{"name":"email","index":0,"title":"Email","ftype":"femail","userhelp":"","csslayout":"","required":true,"predefined":"","size":"medium"},{"name":"subject","index":1,"title":"Subject","required":true,"ftype":"ftext","userhelp":"","csslayout":"","predefined":"","size":"medium"},{"name":"message","index":2,"size":"large","required":true,"title":"Message","ftype":"ftextarea","userhelp":"","csslayout":"","predefined":""}],[{"title":"","description":"","formlayout":"top_aligned"}]]';
				$create_table_cpabc_settings="CREATE TABLE IF NOT EXISTS `wp_baguettedurompointcpabc_appointment_calendars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conwer` int(11) NOT NULL,
  `vs_text_submitbtn` varchar(250) NOT NULL DEFAULT '',
  `vs_text_min` varchar(250) NOT NULL DEFAULT '',
  `vs_text_max` varchar(250) NOT NULL DEFAULT '',
  `vs_text_digits` varchar(250) NOT NULL DEFAULT '',
  `vs_text_number` varchar(250) NOT NULL DEFAULT '',
  `vs_text_dateddmmyyyy` varchar(250) NOT NULL DEFAULT '',
  `vs_text_datemmddyyyy` varchar(250) NOT NULL DEFAULT '',
  `vs_text_is_email` varchar(250) NOT NULL DEFAULT '',
  `vs_text_is_required` varchar(250) NOT NULL DEFAULT '',
  `vs_use_validation` varchar(10) NOT NULL DEFAULT '',
  `specialDates` text,
  `form_structure` mediumtext,
  `title` varchar(255) NOT NULL DEFAULT '',
  `uname` varchar(100) DEFAULT NULL,
  `passwd` varchar(100) DEFAULT NULL,
  `lang` varchar(5) DEFAULT NULL,
  `cpages` tinyint(3) unsigned DEFAULT NULL,
  `ctype` tinyint(3) unsigned DEFAULT NULL,
  `msg` varchar(255) NOT NULL DEFAULT '',
  `workingDates` varchar(255) NOT NULL DEFAULT '',
  `restrictedDates` text,
  `timeWorkingDates0` text,
  `timeWorkingDates1` text,
  `timeWorkingDates2` text,
  `timeWorkingDates3` text,
  `timeWorkingDates4` text,
  `timeWorkingDates5` text,
  `timeWorkingDates6` text,
  `nremind_emailformat` text,
  `nadmin_emailformat` text,
  `nuser_emailformat` text,
  `cp_cal_checkboxes` text,
  `cv_text_enter_valid_captcha` varchar(250) NOT NULL DEFAULT '',
  `dexcv_font` text,
  `dexcv_border` text,
  `dexcv_background` text,
  `dexcv_noise_length` text,
  `dexcv_noise` text,
  `dexcv_max_font_size` text,
  `dexcv_min_font_size` text,
  `dexcv_chars` text,
  `dexcv_height` text,
  `dexcv_width` text,
  `dexcv_enable_captcha` text,
  `reminder_content` text,
  `reminder_subject` text,
  `reminder_hours` text,
  `enable_reminder` text,
  `email_notification_to_admin` text,
  `email_subject_notification_to_admin` text,
  `email_confirmation_to_user` text,
  `email_subject_confirmation_to_user` text,
  `notification_destination_email` text,
  `notification_from_email` text,
  `cu_user_email_field` varchar(250) NOT NULL DEFAULT '',
  `paypal_language` text,
  `url_cancel` text,
  `url_ok` text,
  `currency` text,
  `paypal_product_name` text,
  `request_cost` text,
  `paypal_email` text,
  `enable_paypal` text,
  `paypal_mode` varchar(10) NOT NULL DEFAULT '',
  `quantity_field` varchar(10) NOT NULL DEFAULT '',
  `close_fpanel` varchar(10) NOT NULL DEFAULT '',
  `max_slots` varchar(10) NOT NULL DEFAULT '',
  `min_slots` varchar(10) NOT NULL DEFAULT '',
  `calendar_theme` text,
  `calendar_maxdate` text,
  `calendar_mindate` text,
  `calendar_weekday` text,
  `calendar_militarytime` text,
  `calendar_pages` text,
  `calendar_dateformat` text,
  `calendar_language` text,
  `caldeleted` tinyint(3) unsigned DEFAULT NULL,
  `calendar_startmonth` varchar(20) NOT NULL DEFAULT '',
  `calendar_startyear` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
				if(mysql_query($create_table_cpabc_settings)){
					$cpabc_settings_data="INSERT INTO `wp_baguettedurompointcpabc_appointment_calendars` (`id`, `conwer`, `vs_text_submitbtn`, `vs_text_min`, `vs_text_max`, `vs_text_digits`, `vs_text_number`, `vs_text_dateddmmyyyy`, `vs_text_datemmddyyyy`, `vs_text_is_email`, `vs_text_is_required`, `vs_use_validation`, `specialDates`, `form_structure`, `title`, `uname`, `passwd`, `lang`, `cpages`, `ctype`, `msg`, `workingDates`, `restrictedDates`, `timeWorkingDates0`, `timeWorkingDates1`, `timeWorkingDates2`, `timeWorkingDates3`, `timeWorkingDates4`, `timeWorkingDates5`, `timeWorkingDates6`, `nremind_emailformat`, `nadmin_emailformat`, `nuser_emailformat`, `cp_cal_checkboxes`, `cv_text_enter_valid_captcha`, `dexcv_font`, `dexcv_border`, `dexcv_background`, `dexcv_noise_length`, `dexcv_noise`, `dexcv_max_font_size`, `dexcv_min_font_size`, `dexcv_chars`, `dexcv_height`, `dexcv_width`, `dexcv_enable_captcha`, `reminder_content`, `reminder_subject`, `reminder_hours`, `enable_reminder`, `email_notification_to_admin`, `email_subject_notification_to_admin`, `email_confirmation_to_user`, `email_subject_confirmation_to_user`, `notification_destination_email`, `notification_from_email`, `cu_user_email_field`, `paypal_language`, `url_cancel`, `url_ok`, `currency`, `paypal_product_name`, `request_cost`, `paypal_email`, `enable_paypal`, `paypal_mode`, `quantity_field`, `close_fpanel`, `max_slots`, `min_slots`, `calendar_theme`, `calendar_maxdate`, `calendar_mindate`, `calendar_weekday`, `calendar_militarytime`, `calendar_pages`, `calendar_dateformat`, `calendar_language`, `caldeleted`, `calendar_startmonth`, `calendar_startyear`) VALUES
(1, 0, 'Continue', 
'Please enter a value greater than or equal to {0}.', 
'Please enter a value less than or equal to {0}.', 'Please enter only digits.', 'Please enter a valid number.', 
'Please enter a valid date with this format(dd/mm/yyyy)', 'Please enter a valid date with this format(mm/dd/yyyy)', 
'Please enter a valid email address.', 'This field is required.', '', NULL, 
'".$str."', 
'cal1', 'Calendar Item 1', '', 'ENG', 1, 3, 'Please, select your appointment.', '1,2,3,4,5', '', '', '9:0,10:0,11:0,12:0,13:0,14:0,15:0,16:0', '9:0,10:0,11:0,12:0,13:0,14:0,15:0,16:0', '9:0,10:0,11:0,12:0,13:0,14:0,15:0,16:0', '9:0,10:0,11:0,12:0,13:0,14:0,15:0,16:0', '9:0,10:0,11:0,12:0,13:0,14:0,15:0,16:0', '', 'text', 'text', 'text', '', 'Please enter a valid captcha code.', 'font-1.ttf', '000000', 'ffffff', '4', '200', '35', '25', '5', '60', '180', 'true', '', '', '', '', 'New appointment made with the following information:\r\n\r\n%INFORMATION%\r\n\r\nBest regards.', 'New appointment requested...', 'We have received your request with the following information:\r\n\r\n%INFORMATION%\r\n\r\nThank you.\r\n\r\nBest regards.', 'Thank you for your request...', 'put_your@email_here.com', 'put_your@email_here.com', '', 'EN', 'http://testserver.byconsole.com/6003', 'http://testserver.byconsole.com/6003', 'USD', 'Consultation', '25', '', '', 'production', '1', 'yes', '1', '1', '', '', 'today', '0', '1', '3', '0', 'EN', 0, '0', '0')
";
if(mysql_query($cpabc_settings_data)){
	echo '<p class="success">Booking page settings created</p>';
	}else{echo '<p class="fail">Could not create booking page settings</p>';}
					}
			$post_title='Booking Form';
			$post_name='booking-form';
			$post_content=$_POST['page_booking'];
			$menu_order=11;
			$if_exist="select post_name from wp_baguettedurompointposts where post_name='booking-form'";
			}elseif($page==8){
				
				//activate calpress-event-calendar/calpress.php 
				$plugin_text_event='calpress-event-calendar/calpress.php';
				$get_plugins="select * from wp_baguettedurompointoptions where option_name='active_plugins'";
				$get_plugins_sql=mysql_query($get_plugins);
				if(mysql_num_rows($get_plugins_sql)>0){// if option exist then update it
					$get_plugins_sql_array=mysql_fetch_array($get_plugins_sql);
					//$pgugin_array=unserialize($get_plugins_sql_array[option_value]);
					
					$activated_plugins=unserialize($get_plugins_sql_array[option_value]);
	if(!empty($activated_plugins)){
		if(is_array($activated_plugins)){
		array_push($activated_plugins,$plugin_text_event);
		 $update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($activated_plugins)."' where option_name='active_plugins'";
		}else{
			$activated_plugins_array=array();
			array_push($activated_plugins_array,$activated_plugins);
			array_push($activated_plugins_array,$plugin_text_event);
			 $update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($activated_plugins_array)."' where option_name='active_plugins'";
			}		
		}else{
			 $update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($plugin_text_event)."' where option_name='active_plugins'";			
			}
					if(mysql_query($update_plugin)){
						echo '<p class="success">Plugin calpress activated</p>';
							}else{echo '<p class="fail">Could not activate plugin calpress</p>';}
						}else{// if option does not exist then create it
							$insert_option="insert into wp_baguettedurompointoptions (
								option_id,
								option_name,
								option_value,
								autoload
								) values (
								'',
								'active_plugins',
								'".$plugin_text_event."',
								'yes'
								)";
							if(mysql_query($insert_option)){
								echo '<p class="success">calpress-event-calendar option created successfuly</p>';
							}else{echo '<p class="fail">Could not create calpress-event-calendar option</p>';}
							}
				
			$post_title='Event Calander';
			$post_name='event-calander';
			$post_content=$_POST['page_event'];
			$menu_order=12;
			$if_exist="select post_name from wp_baguettedurompointposts where post_name='event-calander'";
			
			}elseif($page==9){
				
				//activate contact-form-7/wp-contact-form-7.php
				$plugin_text_contact='contact-form-7/wp-contact-form-7.php';
				$get_plugins="select * from wp_baguettedurompointoptions where option_name='active_plugins'";
				$get_plugins_sql=mysql_query($get_plugins);
				if(mysql_num_rows($get_plugins_sql)>0){// if option exist then update it
					$get_plugins_sql_array=mysql_fetch_assoc($get_plugins_sql);
					//$pgugin_array=unserialize($get_plugins_sql_array[option_value]);
					
					$activated_plugins=unserialize($get_plugins_sql_array[option_value]);
	if(!empty($activated_plugins)){
		if(is_array($activated_plugins)){
		array_push($activated_plugins,$plugin_text_contact);
		 $update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($activated_plugins)."' where option_name='active_plugins'";
		}else{
			$activated_plugins_array=array();
			array_push($activated_plugins_array,$activated_plugins);
			array_push($activated_plugins_array,$plugin_text_contact);
			 $update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($activated_plugins_array)."' where option_name='active_plugins'";
			}		
		}else{
			 $update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($plugin_text_contact)."' where option_name='active_plugins'";			
			}
					if(mysql_query($update_plugin)){
						echo '<p class="success">Plugin contact from 7 activated</p>';
							}else{echo '<p class="fail">Could not activate plugin contact form 7</p>';}
						}else{// if option does not exist then create it
							$insert_option="insert into wp_baguettedurompointoptions (
								option_id,
								option_name,
								option_value,
								autoload
								) values (
								'',
								'active_plugins',
								'".$plugin_text_contact."',
								'yes'
								)";
							if(mysql_query($insert_option)){
								echo '<p class="success">calpress-event-calendar option created successfuly</p>';
							}else{echo '<p class="fail">Could not create calpress-event-calendar option</p>';}
							}
							
							//create a contact form
							$cdate=date("Y-m-d H:i:s");
							$contact_form_title='Contact form 1';
							$contact_form_name='contact-form-1';
							$contact_form_content='We are seeking to recruit young dynamic and ambitious candidates to join us.
You are welcome to apply online if you are interested.

Job Announcement
We are seeking to recruit young Lebanese, energetic, qualified and motivated females and males to join its team of skilled group. 

<p>Your Name (required):<br />
    [text* your-name] </p>

<p>Your Email (required):<br />
    [email* your-email] </p>

<p>Phone Number:<br />
    [text your-subject] </p>

<p>Address (required):<br />
    [text* your-name] </p>

<p>Nationality (required):<br />
    [email* your-email] </p>

<p>Job Position:<br />
    [text your-subject] </p>

<p>Upload CV:<br />
    [file file-720] </p>

<p>Any Questions:<br />
    [textarea your-message] </p>

<p>[submit "Send"]</p>
[your-subject]
[your-name] <wordpress@testserver.byconsole.com>
From: [your-name] <[your-email]>
Subject: [your-subject]

Message Body:
[your-message]

--
This e-mail was sent from a contact form on samples (http://testserver.byconsole.com/6004)
chahine.haytham@gmail.com
Reply-To: [your-email]




[your-subject]
samples <wordpress@testserver.byconsole.com>
Message Body:
[your-message]

--
This e-mail was sent from a contact form on samples (http://testserver.byconsole.com/6004)
[your-email]
Reply-To: chahine.haytham@gmail.com



Your message was sent successfully. Thanks.
Failed to send your message. Please try later or contact the administrator by another method.
Validation errors occurred. Please confirm the fields and submit it again.
Failed to send your message. Please try later or contact the administrator by another method.
Please accept the terms to proceed.
Please fill in the required field.
This input is too long.
This input is too short.
Your entered code is incorrect.
Number format seems invalid.
This number is too small.
This number is too large.
Email address seems invalid.
URL seems invalid.
Telephone number seems invalid.
Your answer is not correct.
Date format seems invalid.
This date is too early.
This date is too late.
Failed to upload file.
This file type is not allowed.
This file is too large.
Failed to upload file. Error occurred.';
							$add_contact_form="insert into wp_baguettedurompointposts (
	ID,
	post_author,
	post_date,
	post_date_gmt,
	post_content,
	post_title,
	post_excerpt,
	post_status,
	comment_status,
	ping_status,
	post_password,
	post_name,
	to_ping,
	pinged,
	post_modified,
	post_modified_gmt,
	post_content_filtered,
	post_parent,
	guid,
	menu_order,
	post_type,
	post_mime_type,
	comment_count
			) values (
			'',
			1,
			'".$cdate."',
			'".$cdate."',
			'".$contact_form_content."',
			'".$contact_form_title."',
			'',
			'publish',
			'closed',
			'open',
			'',
			'".$contact_form_name."',
			'',
			'',
			'".$cdate."',
			'".$cdate."',
			'',
			0,
			'',
			0,
			'wpcf7_contact_form',
			'',
			0
			)";
//echo '<br/>';
mysql_query($add_contact_form);
$contact_from_id=mysql_insert_id();
$contact_from_guid=$hst.$_SERVER['HTTP_HOST'].'/?post_type=wpcf7_contact_form&#038;p='.$contact_from_id;
$update_contact_from="update wp_baguettedurompointposts set guid='".$contact_from_guid."' where ID=".$contact_from_id;	
	mysql_query($update_contact_from);
// add post meta data in postmeta table
$messages='a:23:{s:12:"mail_sent_ok";s:43:"Your message was sent successfully. Thanks.";s:12:"mail_sent_ng";s:93:"Failed to send your message. Please try later or contact the administrator by another method.";s:16:"validation_error";s:74:"Validation errors occurred. Please confirm the fields and submit it again.";s:4:"spam";s:93:"Failed to send your message. Please try later or contact the administrator by another method.";s:12:"accept_terms";s:35:"Please accept the terms to proceed.";s:16:"invalid_required";s:34:"Please fill in the required field.";s:16:"invalid_too_long";s:23:"This input is too long.";s:17:"invalid_too_short";s:24:"This input is too short.";s:17:"captcha_not_match";s:31:"Your entered code is incorrect.";s:14:"invalid_number";s:28:"Number format seems invalid.";s:16:"number_too_small";s:25:"This number is too small.";s:16:"number_too_large";s:25:"This number is too large.";s:13:"invalid_email";s:28:"Email address seems invalid.";s:11:"invalid_url";s:18:"URL seems invalid.";s:11:"invalid_tel";s:31:"Telephone number seems invalid.";s:23:"quiz_answer_not_correct";s:27:"Your answer is not correct.";s:12:"invalid_date";s:26:"Date format seems invalid.";s:14:"date_too_early";s:23:"This date is too early.";s:13:"date_too_late";s:22:"This date is too late.";s:13:"upload_failed";s:22:"Failed to upload file.";s:24:"upload_file_type_invalid";s:30:"This file type is not allowed.";s:21:"upload_file_too_large";s:23:"This file is too large.";s:23:"upload_failed_php_error";s:38:"Failed to upload file. Error occurred.";}';
$mail_2='a:9:{s:6:"active";b:0;s:7:"subject";s:14:"[your-subject]";s:6:"sender";s:44:"samples <wordpress@testserver.byconsole.com>";s:4:"body";s:123:"Message Body:
[your-message]

--
This e-mail was sent from a contact form on samples (http://testserver.byconsole.com/6004)";s:9:"recipient";s:12:"[your-email]";s:18:"additional_headers";s:35:"Reply-To: chahine.haytham@gmail.com";s:11:"attachments";s:0:"";s:8:"use_html";b:0;s:13:"exclude_blank";b:0;}';
$mail='a:8:{s:7:"subject";s:14:"[your-subject]";s:6:"sender";s:48:"[your-name] <wordpress@testserver.byconsole.com>";s:4:"body";s:181:"From: [your-name] <[your-email]>
Subject: [your-subject]

Message Body:
[your-message]

--
This e-mail was sent from a contact form on samples (http://testserver.byconsole.com/6004)";s:9:"recipient";s:25:"chahine.haytham@gmail.com";s:18:"additional_headers";s:22:"Reply-To: [your-email]";s:11:"attachments";s:0:"";s:8:"use_html";b:0;s:13:"exclude_blank";b:0;}';
$form='We are seeking to recruit young dynamic and ambitious candidates to join us.
You are welcome to apply online if you are interested.

Job Announcement
We are seeking to recruit young Lebanese, energetic, qualified and motivated females and males to join its team of skilled group. 

<p>Your Name (required):<br />
    [text* your-name] </p>

<p>Your Email (required):<br />
    [email* your-email] </p>

<p>Phone Number:<br />
    [text your-subject] </p>

<p>Address (required):<br />
    [text* your-name] </p>

<p>Nationality (required):<br />
    [email* your-email] </p>

<p>Job Position:<br />
    [text your-subject] </p>

<p>Upload CV:<br />
    [file file-720] </p>

<p>Any Questions:<br />
    [textarea your-message] </p>

<p>[submit "Send"]</p>';
$add_contact_form_meta_1="insert into wp_baguettedurompointpostmeta (meta_id,post_id,meta_key,meta_value) values ('',".$contact_from_id.",'_locale','en_US')";
mysql_query($add_contact_form_meta_1);
$add_contact_form_meta_2="insert into wp_baguettedurompointpostmeta (meta_id,post_id,meta_key,meta_value) values ('',".$contact_from_id.",'_additional_settings','')";
mysql_query($add_contact_form_meta_2);
$add_contact_form_meta_3="insert into wp_baguettedurompointpostmeta (meta_id,post_id,meta_key,meta_value) values ('',".$contact_from_id.",'_messages','".$messages."')";
mysql_query($add_contact_form_meta_3);
$add_contact_form_meta_4="insert into wp_baguettedurompointpostmeta (meta_id,post_id,meta_key,meta_value) values ('',".$contact_from_id.",'_mail_2','".$mail_2."')";
mysql_query($add_contact_form_meta_4);
$add_contact_form_meta_5="insert into wp_baguettedurompointpostmeta (meta_id,post_id,meta_key,meta_value) values ('',".$contact_from_id.",'_mail','".$mail."')";
mysql_query($add_contact_form_meta_5);
$add_contact_form_meta_6="insert into wp_baguettedurompointpostmeta (meta_id,post_id,meta_key,meta_value) values ('',".$contact_from_id.",'_form','".$form."')";
mysql_query($add_contact_form_meta_6);

//end of contact form creation
							
			$post_title='Careers';
			$post_name='careers';
			$post_content='[vc_row][vc_column width="1/1"][contact-form-7 id="'.$contact_from_id.'"][/vc_column][/vc_row]';
			$menu_order=13;
			$if_exist="select post_name from wp_baguettedurompointposts where post_name='careers'";
			
			}elseif($page==11){
								
			$post_title='Virtual Tour';
			$post_name='virtual-tour';
			$post_content='[vc_row][vc_column width="1/1"][dt_map height="550" margin_top="40" margin_bottom="40" fullwidth="false" src="https://www.google.com/maps/embed?pb=!1m0!3m2!1sen!2slb!4v1438128783589!6m8!1m7!1sjFMiUSMM2T0AAAQJOHrFCQ!2m2!1d33.89272!2d35.478114!3f107.93204142664243!4f21.38866689921622!5f0.7820865974627469"][/vc_column][/vc_row]';
			$menu_order=20; // place the menu just befor contact-us page
			$if_exist="select post_name from wp_baguettedurompointposts where post_name='virtual-tour'";
			
				
				}else{}
			$if_exist_sql=mysql_query($if_exist);
			if(mysql_num_rows($if_exist_sql)==0){
				
				
			$cdate=date("Y-m-d H:i:s");
			// create a page for our menu
			//echo '<hr />';
			$add_post="insert into wp_baguettedurompointposts (
	ID,
	post_author,
	post_date,
	post_date_gmt,
	post_content,
	post_title,
	post_excerpt,
	post_status,
	comment_status,
	ping_status,
	post_password,
	post_name,
	to_ping,
	pinged,
	post_modified,
	post_modified_gmt,
	post_content_filtered,
	post_parent,
	guid,
	menu_order,
	post_type,
	post_mime_type,
	comment_count
			) values (
			'',
			1,
			'".$cdate."',
			'".$cdate."',
			'".$post_content."',
			'".$post_title."',
			'',
			'publish',
			'closed',
			'open',
			'',
			'".$post_name."',
			'',
			'',
			'".$cdate."',
			'".$cdate."',
			'',
			0,
			'',
			0,
			'page',
			'',
			0
			)";
//echo '<br/>';
mysql_query($add_post);
$last_post_id=mysql_insert_id();

if($page==8){//update event option if inserted page is event calender page, we need to set this page id in event settings
$Calp_Settings='O:13:"Calp_Settings":19:{s:16:"calendar_page_id";i:'.$last_post_id.';s:21:"default_calendar_view";s:5:"month";s:14:"calendar_theme";s:7:"default";s:14:"week_start_day";s:1:"1";s:22:"agenda_events_per_page";s:2:"10";s:21:"calendar_css_selector";s:0:"";s:21:"include_events_in_rss";b:0;s:25:"allow_publish_to_facebook";b:0;s:20:"facebook_credentials";N;s:26:"user_role_can_create_event";N;s:9:"cron_freq";s:5:"daily";s:8:"timezone";s:14:"Africa/Abidjan";s:17:"input_date_format";s:3:"def";s:14:"input_24h_time";b:0;s:13:"settings_page";s:48:"calp_event_page_calpress-event-calendar-settings";s:18:"geo_region_biasing";b:0;s:14:"hide_subscribe";b:0;s:29:"turn_off_subscription_buttons";b:0;s:11:"addons_page";s:46:"calp_event_page_calpress-event-calendar-addons";}
';
$check_if_option_exist="select * from wp_baguettedurompointoptions where option_name='calp_settings'";
$check_if_option_exist_sql=mysql_query($check_if_option_exist);
if(mysql_num_rows($check_if_option_exist_sql)>0){//if option_name already exist then update it's value
	$update_calp_settings="update wp_baguettedurompointoptions set option_value='".$Calp_Settings."' where option_name='calp_settings'";
	if(mysql_query($update_calp_settings)){
		echo '<p class="success">Event calender settings updated</p>';
		}else{echo '<p class="fail">Could not update event calender settings</p>';}
	}else{ // if option_name does not exist then create it.
		$insert_calp_settings="insert into wp_baguettedurompointoptions (	
	option_id,
	option_name,
	option_value,
	autoload
	) values (
	'',
	'calp_settings',
	'".$Calp_Settings."',
	'yes'
	)";
	if(mysql_query($insert_calp_settings)){
		echo '<p class="success">Calender settings created successfuly</p>';
		}else{echo '<p class="fail">Could not create calender settings</p>';}
		}
	//changing deafult sidebar to no sidebar while page is Our Company Profile
	$sidebar="insert into wp_baguettedurompointpostmeta (meta_id,post_id,meta_key,meta_value) values ('',".$last_post_id.",'_dt_sidebar_position','disabled')";
	mysql_query($sidebar);
}
if($page==2 || $page==6 || $page==7 || $page==9 || $page==11){//changing deafult sidebar to no sidebar while page is Our Company Profile/booking from/careers page
	$sidebar="insert into wp_baguettedurompointpostmeta (meta_id,post_id,meta_key,meta_value) values ('',".$last_post_id.",'_dt_sidebar_position','disabled')";
	mysql_query($sidebar);
	}
$post_guid=$hst.$_SERVER['HTTP_HOST'].'/?page_id='.$last_post_id;
$update_post="update wp_baguettedurompointposts set guid='".$post_guid."' where ID=".$last_post_id;	
	mysql_query($update_post);
	// create a menu item
			$add_menu="insert into wp_baguettedurompointposts (
	ID,
	post_author,
	post_date,
	post_date_gmt,
	post_content,
	post_title,
	post_excerpt,
	post_status,
	comment_status,
	ping_status,
	post_password,
	post_name,
	to_ping,
	pinged,
	post_modified,
	post_modified_gmt,
	post_content_filtered,
	post_parent,
	guid,
	menu_order,
	post_type,
	post_mime_type,
	comment_count
			) values (
			'',
			1,
			'".$cdate."',
			'".$cdate."',
			'',
			'".$post_title."',
			'',
			'publish',
			'open',
			'open',
			'',
			'".$post_name."-menu',
			'',
			'',
			'".$cdate."',
			'".$cdate."',
			'',
			0,
			'',
			'".$menu_order."',
			'nav_menu_item',
			'',
			0
			)";
	//echo '<br/>';
	mysql_query($add_menu);
	$last_menu_id=mysql_insert_id();
	$guid=$htst.$_SERVER['HTTP_HOST'].'?/p='.$last_menu_id;
	 $update_menu="update wp_baguettedurompointposts set post_name='".$last_menu_id."', guid='".$guid."' where ID=".$last_menu_id;
	//echo '<br/>';
	mysql_query($update_menu);
	// add the menu in term_relationship
	$relationship="insert into wp_baguettedurompointterm_relationships (
	object_id,
	term_taxonomy_id,
	term_order
	) values (
	'".$last_menu_id."',
	5,
	0
	)";
	echo '<br/>';
	mysql_query($relationship);
	
	// update count column in term_taxonomy table
	$total_menu="SELECT ID
FROM `wp_baguettedurompointposts`
WHERE post_type = 'nav_menu_item'";
$total_menu_sql=mysql_query($total_menu);
$total_menu_sql_num_row=mysql_num_rows($total_menu_sql);
	$update_term_taxonomy="update wp_baguettedurompointterm_taxonomy set count=".$total_menu_sql_num_row." where taxonomy='nav_menu'";
	mysql_query($update_term_taxonomy);
	
	//add the menu info into post_meta table
 	$add_meta="insert into wp_baguettedurompointpostmeta (
		meta_id,
		post_id,
		meta_key,
		meta_value
	) values 
	('', ".$last_menu_id.", '_menu_item_type', 'post_type'),
	('', ".$last_menu_id.", '_menu_item_menu_item_parent', '0'),
	('', ".$last_menu_id.", '_menu_item_object_id', '".$last_post_id."'),
	('', ".$last_menu_id.", '_menu_item_object', 'page')
";
mysql_query($add_meta);
			}// if mysql_num_row > 0
			}
		
		if($page==10){// update contactus page menu order as last menu item in menu
			$update_menu_order="update wp_baguettedurompointposts set menu_order=21 where ID=274 and post_type='nav_menu_item'";
			mysql_query($update_menu_order);
			//update map
			if(!empty($_POST['page_contact'])){
				$contact_map_link=$_POST['page_contact'];
				}else{
					//$contact_map_link='https://www.google.com.lb/maps/place/Beirut/data=!4m2!3m1!1s0x151f17215880a78f:0x729182bae99836b4?sa=X&ved=0CBsQ8gEwAGoVChMI3rCyrYX_xgIVh9MUCh2FZAI_';
					$contact_map_link='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13248.159262871146!2d35.495479399999994!3d33.8886284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f17215880a78f%3A0x729182bae99836b4!2z2KjZitix2YjYqg!5e0!3m2!1sar!2slb!4v1439081368377';
					}
			$get_contact="select ID,post_content from wp_baguettedurompointposts where post_name='contact-us' and post_type='page' and post_status='publish'";
			$get_contact_sql=mysql_query($get_contact);
			$get_contact_sql_array=mysql_fetch_assoc($get_contact_sql);
			$string_to_replace='https://maps.google.com.lb/maps?q=badaro&amp;hl=en&amp;sll=33.8901,35.509701&amp;sspn=0.008443,0.015278&amp;hnear=Badaro,+Beirut&amp;t=m&amp;z=16';
			//echo $string_to_replace; echo '<br />'; echo $_POST['page_contact']; echo '<br />'; echo $get_contact_sql_array[post_content]; echo '<br />';
			$new_content=str_replace($string_to_replace,$contact_map_link,$get_contact_sql_array[post_content]);
			$update_contact_page="update wp_baguettedurompointposts set post_content='".$new_content."' where ID=".$get_contact_sql_array[ID];
			mysql_query($update_contact_page);
			}
		if($page==5){
			if($_POST['page_brochure']!=''){
			$issue_number=$_POST['page_brochure'];
			}else{
				$issue_number='0/10591835';
				}
			$brochure_content='<iframe src="//e.issuu.com/embed.html#'.$issue_number.'" width="100%" height="500" frameborder="0" allowfullscreen="allowfullscreen"></iframe>';

			//$brochure_content='<iframe src="//e.issuu.com/embed.html#'.$_POST['page_brochure'].'" width="100%" height="500" frameborder="0" allowfullscreen="allowfullscreen"></iframe>';
			$update_brochure="update wp_baguettedurompointposts set post_title='Brochure', post_name='brochure', post_content='".$brochure_content."' where ID=299"; //default come along package
			if(mysql_query($update_brochure)){
				//echo '<p class="success">Brochure page content updated</p>';
				}else{
					echo '<p class="fail">Could not update brochure page content.</p>';
					}
			}
		if($page==3){
			$get_about="select post_content from wp_baguettedurompointposts where ID=93";
			$get_about_sql=mysql_query($get_about);
			$get_about_sql_array=mysql_fetch_assoc($get_about_sql);
			
			/*$get_blogname="select option_value from wp_baguettedurompointoptions where option_name='blogname'";
			$get_blogname_sql=mysql_query($get_blogname);
			$get_blogname_sql_array=mysql_fetch_assoc($get_blogname_sql);*/
			
			//echo $get_blogname_sql_array[option_value]; echo '<br />'; echo $get_about_sql_array[post_content];
			
			$new_about_content=str_replace('put client name here',$blogname,$get_about_sql_array[post_content]);
			$update_about_content="update wp_baguettedurompointposts set post_content='".$new_about_content."' where ID=93";
			mysql_query($update_about_content);
			}
		/*if($page==6){
			if($_POST['page_menu']!=''){
			$menu_content=$_POST['page_menu'];
			}else{
				$menu_content='13060665/13079535';
				}
			$brochure_content='<iframe src="//e.issuu.com/embed.html#'.$menu_content.'" width="100%" height="500" frameborder="0" allowfullscreen="allowfullscreen"></iframe>';
			//$insert_menu_menu="insert into wp_baguettedurompointposts () values ()";
			$update_brochure="update wp_baguettedurompointposts set post_content='".$brochure_content."' where ID=299"; //default come along package
			if(mysql_query($update_brochure)){
				echo '<p class="success">Menu page content updated</p>';
				}else{
					echo '<p class="fail">Could not update menu page content.</p>';
					}
			}*/
	}
		// delete menus if not checked
		$array=$_POST['page_list'];
	/*for($i=1; $i++; $i<=9){*/
	/*	if(!in_array($i,$array)){
			echo 'not in array';*/
			if(!in_array(1,$array)){
			//$post_title='Our Company Profile';
			//$post_name='our-company-profile';
			//$if_exist="select post_name from wp_baguettedurompointposts where post_name='our-company-profile'";
				}
				if(!in_array(3,$array)){ // deafault in package filed system
			//$post_title='Our Company Profile';
			//$post_name='our-company-profile';
			$if_exist="delete from wp_baguettedurompointposts where ID=273";
			mysql_query($if_exist);
				}
				if(!in_array(4,$array)){ // deafault in package filed system
			//$post_title='About us';
			//$post_name='about-the-company';
			$if_exist="delete from wp_baguettedurompointposts where ID=271";
			mysql_query($if_exist);
			$if_exist_1="delete from wp_baguettedurompointposts where ID=267";
			mysql_query($if_exist_1);
			$if_exist_2="delete from wp_baguettedurompointposts where ID=269";
			mysql_query($if_exist_2);
			$if_exist_3="delete from wp_baguettedurompointposts where ID=268";
			mysql_query($if_exist_3);
			$if_exist_4="delete from wp_baguettedurompointposts where ID=270";
			mysql_query($if_exist_4);
				}
				if(!in_array(4,$array)){
			//$if_exist="delete from wp_baguettedurompointposts where ID=269";
			
				}
				if(!in_array(5,$array)){ // deafault in package filed system
			$if_exist="delete from wp_baguettedurompointposts where ID=300";
			mysql_query($if_exist);
			//$if_exist="delete from wp_baguettedurompointposts where ID=272";
				}
				if(!in_array(7,$array)){
			
			//$if_exist="delete from wp_baguettedurompointposts where ID=272";
				}
				if(!in_array(8,$array)){
			
			//$if_exist="delete from wp_baguettedurompointposts where ID=272";
				}
				if(!in_array(9,$array)){
			$post_title='Careers';
			$post_name='careers';
		$if_exist="delete from wp_baguettedurompointposts where post_name='".$post_name."' and post_type = 'nav_menu_item'";
	mysql_query($if_exist);
				}
				if(!in_array(10,$array)){ // deafault in package filed system
			$post_title='Contact us';
			$post_name='contact-us';
			$if_exist="delete from wp_baguettedurompointposts where ID=274";
	mysql_query($if_exist);
				}
	echo '<p class="success">Menu items sucessfully updated.</p>';		
			
			/*}*/
			
	/*	}*/
	
	$part='menu || ';
	}
?>

<?php
// youtube video url updatation
//qVn2YGvIv0w
if(isset($_POST['youtube_url'])){
	include('wp-config.php');
	if(empty($_POST['youtube_url'])){
		$utube_key='qVn2YGvIv0w';
		}else{
		$utube_key=trim($_POST['youtube_url']);
		}
	$get_content="select post_content from wp_baguettedurompointposts where ID=53";
	$get_content_sql=mysql_query($get_content);
	$get_content_sql_array=mysql_fetch_array($get_content_sql);
	$content=$get_content_sql_array['post_content'];
	$content=str_replace('cbut2K6zvJY',$utube_key,$get_content_sql_array['post_content']);
	//echo '<hr />';
	//echo $content;
	
	$update_content="update wp_baguettedurompointposts set post_content='".$content."' where ID=53";
//echo	$update_content="update wp_baguettedurompointposts set post_content=REPLACE ( '".$content."', 'cbut2K6zvJY', '".$_POST['youtube_url']."' )";
	if(mysql_query($update_content)){
		echo '<p class="success">Homepage video url successfuly updated.</p>';
		}else{echo '<p class="fail">Could not update homepage video url!</p>';}
	
	$part='youtube || ';
	}
?>
<?php
// RighTune updatation
if(isset($_POST['update_website_music']) && $_POST['update_website_music']==1){
	include('wp-config.php');
	//$pgugin_array=array();
	$plugin_text='wp-conversion-by-rightune/rightune.php';
	$get_plugins="select * from wp_baguettedurompointoptions where option_name='active_plugins'";
	$get_plugins_sql=mysql_query($get_plugins);
	if(mysql_num_rows($get_plugins_sql)>0){ //if option name exist then update it
	$get_plugins_sql_array=mysql_fetch_array($get_plugins_sql);
	$activated_plugins=unserialize($get_plugins_sql_array[option_value]);
	if(!empty($activated_plugins)){
		if(is_array($activated_plugins)){
		array_push($activated_plugins,$plugin_text);
		 $update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($activated_plugins)."' where option_name='active_plugins'";
		}else{
			$activated_plugins_array=array();
			array_push($activated_plugins_array,$activated_plugins);
			array_push($activated_plugins_array,$plugin_text);
			 $update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($activated_plugins_array)."' where option_name='active_plugins'";
			}		
		}else{
			 $update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($plugin_text)."' where option_name='active_plugins'";			
			}
	
	/*array_push($pgugin_array,$get_plugins_sql_array[option_value]);
	array_push($pgugin_array,$plugin_text);
	echo $update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($pgugin_array)."' where option_name='active_plugins'";*/
	if(mysql_query($update_plugin)){
		echo '<p class="success">Website music has been updated successfuly</p>';
		}else{echo '<p class="fail">Could not update righTune option</p>';}
}else{ //if option name does not exist then create it
	$insert_option="insert into wp_baguettedurompointoptions (
	option_id,
	option_name,
	option_value,
	autoload
	) values (
	'',
	'active_plugins',
	'".$plugin_text."',
	'yes'
	)";
	//echo 'I am here';
	if(mysql_query($insert_option)){
		echo '<p class="success">righTune option created successfuly</p>';
		}else{echo '<p class="fail">Could not create righTune option</p>';}
	}
	$part='music ';
	
	// activate agca custom admin plugin and create custom settings
	$plugin_text2='ag-custom-admin/plugin.php';
	$get_plugins2="select * from wp_baguettedurompointoptions where option_name='active_plugins'";
	$get_plugins_sql2=mysql_query($get_plugins2);
	if(mysql_num_rows($get_plugins_sql2)>0){ //if option name exist then update it
	$get_plugins_sql_array2=mysql_fetch_array($get_plugins_sql2);
	$activated_plugins2=unserialize($get_plugins_sql_array2[option_value]);
	if(!empty($activated_plugins2)){
		if(is_array($activated_plugins2)){
		array_push($activated_plugins2,$plugin_text2);
		 $update_plugin2="update wp_baguettedurompointoptions set option_value='".serialize($activated_plugins2)."' where option_name='active_plugins'";
		}else{
			$activated_plugins_array2=array();
			array_push($activated_plugins_array2,$activated_plugins2);
			array_push($activated_plugins_array2,$plugin_text2);
			 $update_plugin2="update wp_baguettedurompointoptions set option_value='".serialize($activated_plugins_array2)."' where option_name='active_plugins'";
			}		
		}else{
			 $update_plugin2="update wp_baguettedurompointoptions set option_value='".serialize($plugin_text2)."' where option_name='active_plugins'";			
			}
	
	/*array_push($pgugin_array,$get_plugins_sql_array[option_value]);
	array_push($pgugin_array,$plugin_text);
	echo $update_plugin="update wp_baguettedurompointoptions set option_value='".serialize($pgugin_array)."' where option_name='active_plugins'";*/
	if(mysql_query($update_plugin2)){
		echo '<p class="success">Plugin agcs has been updated successfuly</p>';
		}else{echo '<p class="fail">Could not update plugin agca</p>';}
}else{ //if option name does not exist then create it
	$insert_option2="insert into wp_baguettedurompointoptions (
	option_id,
	option_name,
	option_value,
	autoload
	) values (
	'',
	'active_plugins',
	'".$plugin_text2."',
	'yes'
	)";
	//echo 'I am here';
	if(mysql_query($insert_option2)){
		echo '<p class="success">Plugin agca activated successfuly</p>';
		}else{echo '<p class="fail">Could not activate plugin agca</p>';}
	}
	// now create agca settings
$agca_settings="update wp_baguettedurompointoptions set option_value='' where option_name='ag_edit_adminmenu_json'";
	if(mysql_query($agca_settings)){
		echo '<p class="success">agca settings created</p>';
		}else{echo '<p class="fail">Could not create agca settings</p>';}
}
?>
