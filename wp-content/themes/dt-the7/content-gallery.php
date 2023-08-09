<?php
/**
 * Portfolio masonry content. 
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$config = Presscore_Config::get_instance();

$is_pass_protected = post_password_required();
$desc_on_hover = ( 'on_hoover' == $config->get('description') );
$show_title = $config->get('show_titles') && get_the_title();
$show_details = $config->get('show_details');
$show_excerpts = ( $config->get('show_excerpts') && get_the_excerpt() ) || $is_pass_protected;
$show_meta = $config->get('show_terms') && !$is_pass_protected;
$show_content = $show_title || $show_details || $show_excerpts || $show_meta;
$preview_mode = get_post_meta( $post->ID, '_dt_album_options_preview', true );
$media_items = get_post_meta( $post->ID, '_dt_album_media_items', true );
$exclude_cover = get_post_meta( $post->ID, '_dt_album_options_exclude_featured_image', true );
$justified_grid = $config->get('justified_grid');

$class = array('rollover');
$style = ' style="width: 100%;"';
$rell = '';
$before_content = '';
$after_content = '';
$before_description = '';
$after_description = '';
$media = '';
$post_title = get_the_title();

if ( !$media_items ) {
	$media_items = array();
}

// add thumbnail to attachments list
if ( has_post_thumbnail() ) {
	array_unshift( $media_items, get_post_thumbnail_id() );
}

// if pass protected - show only cover image
if ( $media_items && $is_pass_protected ) {
	$media_items = array( $media_items[0] );
}

// get attachments data
$attachments_data = presscore_get_attachment_post_data( $media_items );

// if there are one image in gallery
if ( count($attachments_data) == 1 ) {
	$class[] = 'rollover-zoom';
	$exclude_cover = false;
}

if ( !$desc_on_hover ) {
	$class[] = 'alignnone';
}
$post_title = '<a href="" class="dt-trigger-first-mfp">' . $post_title . '</a>';

// count attachments
$attachments_count = presscore_get_attachments_data_count( (has_post_thumbnail() && $exclude_cover) ? array_slice( $attachments_data, 1 ) : $attachments_data );
list( $images_count, $videos_count ) = $attachments_count;

// if we have content to show and description on hover anabled
if ( $show_content && $desc_on_hover ) {

	$before_content = '<div class="rollover-project">';
	$after_content = '</div>';

	$before_description = '<div class="rollover-content">';
	$after_description = '<span class="close-link"></span>' . "\n" . '</div>';

	if ( $attachments_data ) {
		reset($attachments_data);

		$hidden_gallery = '';

		// $title_image = array_shift($attachments_data);
		$title_image = current($attachments_data);
		$link_class = 'link show-content';
		$link_custom = $style;
		$share_buttons = presscore_get_share_buttons_for_prettyphoto( 'photo' );

		$title_args = array(
			'img_meta' 	=> array( $title_image['full'], $title_image['width'], $title_image['height'] ),
			'img_id'	=> $title_image['ID'],
			'class'		=> $link_class,
			'custom'	=> $link_custom,
			'echo'		=> false,
			'wrap'		=> '<a %HREF% %CLASS% %CUSTOM% %TITLE%><img %IMG_CLASS% %SRC% %IMG_TITLE% %ALT% %SIZE% /></a>',
		);

		// if cover not excluded, not pass pritected and only one\
		if ( !$is_pass_protected ) {

			$title_args['custom'] .= ' data-dt-img-description="' . esc_attr($title_image['description']) . '"';

			if ( count($attachments_data) == 1 ) {
				$title_args['custom'] .= $share_buttons;
				$title_args['class'] .= ' dt-single-mfp-popup dt-mfp-item';
			} else {
				$title_args['class'] .= ' dt-gallery-mfp-popup';
			}

			if ( $title_image['video_url'] ) {
				$title_args['class'] .= ' mfp-iframe';
				$title_args['href'] = $title_image['video_url'];
			} else {
				$title_args['class'] .= ' mfp-image';
			}

		} else {

			$title_args['href'] = '#';
		}

		// proportion
		$prop = $config->get('thumb_proportions');
		if ( 'resize' == $config->get('image_layout') && $prop ) {
			$title_args['prop'] = presscore_meta_boxes_get_images_proportions( $prop );
		}

		if ( $justified_grid ) {
			$title_args['options'] = array( 'h' => round($config->get('target_height') * 1.3), 'z' => 0 );
		}

		$media = dt_get_thumb_img( $title_args );

		// do not show if password protected
		if ( !$is_pass_protected && count($attachments_data) > 1 ) {

			if ( has_post_thumbnail() && $exclude_cover ) {
				unset( $attachments_data[0] );
			}

			foreach ( $attachments_data as $attachment ) {

				$att_args = array(
					'href'		=> $attachment['full'],
					'custom'	=> '',
					'alt'		=> $attachment['title'],
					'title'		=> $attachment['description'],
					'class'		=> 'mfp-image'
				);

				if ( !empty($attachment['video_url']) ) {
					$att_args['href'] = $attachment['video_url'];
					$att_args['class'] = 'mfp-iframe';
				}

				$hidden_gallery .= sprintf( '<a href="%s" title="%s" class="%s" data-dt-img-description="%s"%s></a>',
					esc_url($att_args['href']),
					esc_attr($att_args['alt']),
					esc_attr($att_args['class'] . ' dt-mfp-item'),
					esc_attr($att_args['title']),
					$att_args['custom']
				);
			}

			if ( $hidden_gallery ) {
				$hidden_gallery = '<div class="dt-gallery-container mfp-hide"' . $share_buttons . '>' . $hidden_gallery . '</div>';
			}
		}

		$media .= $hidden_gallery;
	}

} else {

	$gallery_args = array(
		'class' => $class,
		'share_buttons' => true,
		'exclude_cover' => $exclude_cover,
		'attachments_count' => $attachments_count
	);

	if ( $justified_grid ) {
		$gallery_args['title_img_options'] = array( 'h' => round($config->get('target_height') * 1.3), 'z' => 0 );
	}

	$media =  presscore_get_images_gallery_hoovered($attachments_data, $gallery_args);
}
?>

<?php do_action('presscore_before_post'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

		<?php echo $before_content; ?>

		<?php echo $media; ?>

		<?php echo $before_description; ?>

		<?php if ( $show_title ) : ?>

			<h2 class="entry-title"><?php echo $post_title; ?></h2>

		<?php endif; ?>

		<?php if ( $show_meta ) :
			echo presscore_new_posted_on( 'dt_gallery' );
		endif; ?>

		<?php if ( $show_excerpts ) : ?>

			<?php the_excerpt(); ?>

		<?php endif; ?>

		<?php if ( $show_meta ) : ?>

			<a href="#" class="details more-link dt-trigger-first-mfp"><?php _e( 'View album', LANGUAGE_ZONE ); ?></a>

		<?php endif; ?>

		<?php if ( $show_meta ) :

			echo '<div class="num-of-items">';

			if ( $images_count ) {
				echo '<span class="num-of-images">'. $images_count . '</span>&nbsp;' ;
			}

			if ( $videos_count ) {
				echo '&nbsp;<span class="num-of-videos">' . $videos_count . '</span>&nbsp;';
			}

			echo '</div>';

		endif; ?>

		<?php if ( $show_content ) :
			echo presscore_post_edit_link();
		endif; ?>

		<?php echo $after_description; ?>

	<?php echo $after_content; ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>