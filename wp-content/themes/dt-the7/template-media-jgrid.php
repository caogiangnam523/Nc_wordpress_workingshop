<?php
/* Template Name: Gallery - justified grid */

/**
 * Media Gallery template. Uses dt_gallery post type and dt_gallery_category taxonomy.
 *
 * @package presscore
 * @since presscore 2.2
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$config = Presscore_Config::get_instance();
$config->set('template', 'media');
$config->set('justified_grid', true);
$config->base_init();

$config->set('layout', 'grid');
$config->set('description', 'on_hoover');
$config->set('columns', -1);

// add page content
add_action('presscore_before_main_container', 'presscore_page_content_controller', 15);

get_header(); ?>

		<?php if ( presscore_is_content_visible() ): ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); // main loop ?>

					<?php do_action( 'presscore_before_loop' ); ?>

					<?php
					$full_width = $config->get('full_width');
					$item_padding = $config->get('item_padding');
					$target_height = $config->get('target_height');
					$layout = $config->get('layout');

					$media_query = Presscore_Inc_Albums_Post_Type::get_media_template_query();
					?>

					<?php
					// masonry layout classes
					$masonry_container_classes = array( 'wf-container', 'dt-gallery-container', 'portfolio-grid', 'jg-container' );
					$masonry_container_classes = implode(' ', $masonry_container_classes);

					$masonry_container_data_attr = array(
						'data-padding="' . intval($item_padding) . 'px"',
						'data-target-height="' . intval($target_height) . 'px"'
					);

					if ( $config->get('hide_last_row') ) {
						$masonry_container_data_attr[] = 'data-part-row="false"';
					}

					// ninjaaaa!
					$masonry_container_data_attr = ' ' . implode(' ', $masonry_container_data_attr);

					$share_buttons = presscore_get_share_buttons_for_prettyphoto( 'photo' );
					?>

					<?php if ( $full_width ) : ?>

				<div class="full-width-wrap">

					<?php endif; ?>

					<div class="<?php echo esc_attr($masonry_container_classes); ?>"<?php echo $masonry_container_data_attr . $share_buttons; ?>>

					<?php if ( $media_query->have_posts() ): while( $media_query->have_posts() ): $media_query->the_post(); ?>

						<?php get_template_part('content', 'media'); ?>

					<?php endwhile; wp_reset_postdata(); endif; ?>

					</div>

					<?php if ( $full_width ) : ?>

				</div>

					<?php endif; ?>

					<?php dt_paginator($media_query); ?>

					<?php do_action( 'presscore_after_loop' ); ?>

					<?php endwhile; ?>

				<?php endif; ?>

			</div><!-- #content -->

			<?php do_action('presscore_after_content'); ?>

		<?php endif; // if content visible ?>

<?php get_footer(); ?>