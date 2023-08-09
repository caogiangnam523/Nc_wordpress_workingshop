<?php
/* Template name: internal use */
// File Security Check
//if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();
$config->base_init();
echo '101010101';
get_header(); ?>

	<?php
if($_REQUEST[top_bar-contact_phone]==update){
				$tempoptions = get_option("the7");
				print_r($tempoptions);
				//echo '<hr/>';
				echo $tempoptions['top_bar-contact_phone']='it has been changed again4445';
				//echo '<hr/>';
				update_option("the7",$tempoptions);
}
?>	
<?php get_footer(); ?>