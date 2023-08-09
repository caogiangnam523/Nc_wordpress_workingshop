<?php
/**
 * Media gallery content. 
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$config = Presscore_Config::get_instance();
$desc_on_hoover = ( 'on_hoover' == $config->get('description') );
$show_excerpts = $config->get('show_excerpts') && get_the_content();
$show_titles = $config->get('show_titles');

$show_content = $show_excerpts || $show_titles;

$previw_type = get_post_meta( $post->ID, '_dt_project_options_preview_style', true );
$before_content = '';
$after_content = '';
$before_description = '';
$after_description = '';

$link_classes = 'alignnone';
if ( $show_content && $desc_on_hoover ) {
	$before_content = '<div class="rollover-project">';
	$after_content = '</div>';

	$before_description = '<div class="rollover-content">';
	$after_description = '<span class="close-link"></span>' . "\n" . '</div>';

	$link_classes = 'link show-content';
} elseif ( $desc_on_hoover ) {
	$link_classes = 'rollover rollover-zoom';
}
$blank_img = presscore_get_blank_image();
?>

<?php do_action('presscore_before_post'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

		<?php echo $before_content; ?>

		<?php
		$is_pass_protected = post_password_required();
		if ( !$is_pass_protected || $desc_on_hoover ) {
			$title = get_the_title();
			$content = get_the_content();

			$thumb_args = array(
				'img_meta' 	=> wp_get_attachment_image_src( $post->ID, 'full' ),
				'img_id'	=> $post->ID,
				'img_class' => 'preload-me',
				'custom'	=> ' data-dt-img-description="' . esc_attr($content) . '"',
				'title'		=> $title,
				'class'		=> $link_classes,
				'echo'		=> true,
				'wrap'		=> '<a %HREF% %CLASS% %TITLE% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /></a>',
			);

			// proportion
			$prop = $config->get('thumb_proportions');
			if ( 'resize' == $config->get('image_layout') && $prop ) {
				$thumb_args['prop'] = presscore_meta_boxes_get_images_proportions( $prop );
			}

			$video_url = esc_url( get_post_meta( $post->ID, 'dt-video-url', true ) );

			if ( $video_url ) {
				$thumb_args['href'] = $video_url;

				// dt-single-mfp-popup

				if ( !$desc_on_hoover ) {
					$thumb_args['class'] .= ' rollover-video';
					$thumb_args['wrap'] = '<div %CLASS%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /><a %HREF% %TITLE% class="video-icon dt-mfp-item mfp-iframe" %CUSTOM%></a></div>';
				} else {
					$thumb_args['class'] .= ' dt-mfp-item mfp-iframe';
				}
			} else {
				if ( !$desc_on_hoover ) {
					$thumb_args['class'] .= ' rollover rollover-zoom';
					$thumb_args['wrap'] = '<p>' . $thumb_args['wrap'] . '</p>';
				}

				$thumb_args['class'] .= ' dt-mfp-item mfp-image';
			}

			if ( $config->get('justified_grid') ) {
				$thumb_args['options'] = array( 'h' => round($config->get('target_height') * 1.3), 'z' => 0 );
			}

			dt_get_thumb_img( $thumb_args );
		}
		?>

		<?php echo $before_description; ?>

		<?php if ( $show_titles ) : ?>
			<h2 class="entry-title"><?php the_title(); ?></h2>
		<?php endif; ?>

		<?php if ( $show_excerpts ) : ?>
			<?php echo wpautop(get_the_content()); ?>
		<?php endif; ?>

		<?php echo $after_description; ?>

	<?php echo $after_content; ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>