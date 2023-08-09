<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the <div class="wf-container wf-clearfix"> and all content after
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();
?>

	<?php if ( presscore_is_content_visible() ): ?>	

			</div><!-- .wf-container -->
		</div><!-- .wf-wrap -->
	</div><!-- #main -->

	<?php do_action('presscore_after_main_container'); ?>

	<?php if ( apply_filters( 'presscore_show_bottom_bar', true ) ): ?>

	<!-- !Bottom-bar -->
	<div id="bottom-bar" role="contentinfo">
		<div class="wf-wrap">
			<div class="wf-table wf-mobile-collapsed">

				<?php
				$bottom_logo = presscore_get_logo_image( presscore_get_footer_logos_meta() );
				if ( $bottom_logo ) :
				?>
				<div id="branding-bottom" class="wf-td"><?php

					if ( 'microsite' == $config->get('template') ) {
						$logo_target_link = get_post_meta( $post->ID, '_dt_microsite_logo_link', true );

						if ( $logo_target_link ) {
							echo sprintf('<a href="%s">%s</a>', esc_url( $logo_target_link ), $bottom_logo);
						} else {
							echo $bottom_logo;
						}

					} else {
						echo $bottom_logo;
					}

				?></div>
				<?php endif; ?>

				<?php do_action( 'presscore_credits' ); ?>

				<?php
				$copyrights = of_get_option('bottom_bar-copyrights', false);
				$credits = of_get_option('bottom_bar-credits', true);
				?>
				<?php if ( $copyrights || $credits ) : ?>
					<div class="wf-td">
						<div class="wf-float-left">
							<?php echo $copyrights; ?>
						<?php if ( $credits ) : ?>
							&nbsp;Dream-Theme &mdash; truly <a href="http://dream-theme.com" target="_blank">premium WordPress themes</a>
						<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="wf-td">
					<?php presscore_nav_menu_list('bottom'); ?>
				</div>

				<?php $bottom_text = of_get_option('bottom_bar-text', '');
				if ( $bottom_text ) : ?>

					<div class="wf-td bottom-text-block">
						<?php echo wpautop($bottom_text); ?>
					</div>

				<?php endif; ?>

			</div>
		</div><!-- .wf-wrap -->
	</div><!-- #bottom-bar -->

	<?php endif; // show_bottom_bar ?>

	<?php else: ?>

	</div><!-- #main -->

	<?php endif; ?>
	<a href="#" class="scroll-top"></a>

</div><!-- #page -->
<?php if ( 'slideshow' == $config->get('header_title') && 'metro' == $config->get('slideshow_mode') ) : ?>
<?php
$clider_cols = $config->get('slideshow_slides_in_column') ? absint($config->get('slideshow_slides_in_column')) : 6;
$slider_rows = $config->get('slideshow_slides_in_raw') ? absint($config->get('slideshow_slides_in_raw')) : 3;
?>
<script type="text/javascript">
	var swiperColH = <?php echo $slider_rows; ?>,
		swiperCol = <?php echo $clider_cols; ?>;
</script>
<?php endif; ?>
<?php $style=get_option('the7');
//print_r($style);
//echo '<hr/>';
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    $hst='http://';
}else{
	$hst='http://';
	}

?>
<style>
body{ background-color:<?php echo $style['general-boxed_bg_color'];?>; background-image:none;}
h1 {
    color: <?php echo $style['content-headers_color'];?>;
}
#header{ 
background-image:url(<?php echo substr($style['header-bg_image']['image'],1);?>); 
background-repeat:<?php echo $style['header-bg_image']['repeat'];?>; 
background-position:<?php echo $style['header-bg_image']['position_x'].','.$style['header-bg_image']['position_y'];?>;}
#page{ 
background-image:url(<?php echo substr($style['general-bg_image']['image'],1);?>); 
background-repeat:<?php echo $style['general-bg_image']['repeat'];?>; 
background-position:<?php echo $style['general-bg_image']['position_x'].','.$style['general-bg_image']['position_y'];?>;}
#top-bar{ 
background-image:url(<?php echo substr($style['top_bar-bg_image']['image'],1);?>); 
background-repeat:<?php echo $style['top_bar-bg_image']['repeat'];?>; 
background-position:<?php echo $style['top_bar-bg_image']['position_x'].','.$style['top_bar-bg_image']['position_y'];?>;}
#bottom-bar{ 
background-image:url(<?php echo substr($style['bottom_bar-bg_image']['image'],1);?>); 
background-repeat:<?php echo $style['bottom_bar-bg_image']['repeat'];?>; 
background-position:<?php echo $style['bottom_bar-bg_image']['position_x'].','.$style['bottom_bar-bg_image']['position_y'];?>;}

#top-bar {background-color:  <?php echo $style['top_bar-bg_color'];?>; color: <?php echo $style['top_bar-text_color'];?>;}
#top-bar::after {
    background-color: <?php echo $style['top_bar-dividers_color'];?>;
}
#header { background-color: <?php echo $style['header-bg_color'];?>; color:<?php echo $style['header-font_color'];?>;}
/*#main-nav > li.act.menu-frame-on, .csstransforms3d #main-nav.fancy-rollovers > li.act.menu-frame-on, #mobile-menu {
    background-color:  <?php echo $style['header-bg_color'];?>;  color: <?php echo $style['header-bg_color'];?>;
}*/
.sub-nav, .dl-menuwrapper ul, #header .mini-search .field {
    background-color: <?php echo $style['header-submenu_bg_color'];?>;
}
.sub-nav > li > a {
    color: <?php echo $style['header-submenu_color'];?>;
}
/*#page {
    background: <?php //echo $style['general-bg_color'];?>;
}*/
	
#main .vc_text_separator div { background-color:  <?php echo $style['content-dividers_color'];?>; /*color:  <?php echo $style['content-primary_text_color'];?>;*/}
/*#main .vc_text_separator {border-color:  <?php echo $style['header-bg_color'];?>;}*/
body, body.page, .wf-container > *, #main ul.products > *, .woocommerce-page #main ul.products > *, #main .woocommerce ul.products > *, #main .woocommerce-page ul.products > *, .upsells.products .products > *, .related.products .products > *, .gform_wrapper .top_label .gfield_label {
    color:  <?php echo $style['content-primary_text_color'];?>;
}
#bottom-bar {
    color:  <?php echo $style['bottom_bar-color'];?>;
    background-color:  <?php echo $style['bottom_bar-bg_color'];?>;
	}
	
/*general-accent_bg_color*/
#main-nav > li.act.menu-frame-on, .csstransforms3d #main-nav.fancy-rollovers > li.act.menu-frame-on, #mobile-menu {
    background-color: <?php echo $style['general-accent_bg_color'];?>;
}
.slider-wrapper .prev i, .slider-wrapper .next i {
    background-color: <?php echo $style['general-accent_bg_color'];?>;
}
.project-details, .project-link, .project-details:hover, .project-link:hover {
    color: <?php echo $style['general-accent_bg_color'];?>;
}
.color-secondary,.text-secondary{color:<?php echo $style['top_bar-bg_color'];?>;}
.color-accent{color:<?php echo $style['top_bar-bg_color'];?>;}
.stripe-style-1 .color-accent{color:<?php echo $style['general-accent_bg_color'];?>;}
.stripe-style-2 .color-accent{color:<?php echo $style['general-accent_bg_color'];?>;}
.stripe-style-3 .color-accent{color:<?php echo $style['general-accent_bg_color'];?>;}
.stripe-style-4 .color-accent{color:<?php echo $style['general-accent_bg_color'];?>;}
.stripe-style-5 .color-accent{color:<?php echo $style['general-accent_bg_color'];?>;}
.slider-wrapper .prev.disabled i, .slider-wrapper .next.disabled i, .slider-wrapper .prev.disabled i:hover, .slider-wrapper .next.disabled i:hover {
    background-color: <?php echo $style['general-accent_bg_color'];?>;
}
.vc_text_separator {
    border-color: <?php echo $style['general-accent_bg_color'];?>;
}
.scroll-top {
    background-color: <?php echo $style['general-accent_bg_color'];?>;
}
.entry-meta:before,.entry-meta a:hover,.entry-meta a:hover *,.entry-meta a:hover time,.portfolio-categories a:hover,.portfolio-categories a:hover *,.entry-tags:before,.entry-tags a:hover,.old-ie .entry-meta a:hover,.old-ie .portfolio-categories a:hover{color:<?php echo $style['general-accent_bg_color'];?>;}
.entry-meta a:hover>*{color:<?php echo $style['general-accent_bg_color'];?>;}
.paginator a.act,.paginator a.act:hover,.filter .filter-categories a.act{background-color:<?php echo $style['general-accent_bg_color'];?>;}
.filter-categories a:hover,.paginator a:hover{color:<?php echo $style['general-accent_bg_color'];?>;}
.sidebar .custom-categories a:hover,.sidebar-content .custom-categories a:hover,.widget .custom-categories a:hover{color:<?php echo $style['general-accent_bg_color'];?>;}
.footer .custom-categories a:hover{color:<?php echo $style['general-accent_bg_color'];?>;}
.custom-nav>li>a:hover,.custom-nav>li.act>a,.custom-nav>li>ul a:hover,.content .widget .custom-categories a:hover{color:<?php echo $style['general-accent_bg_color'];?>;}
.widget_tag_cloud a:hover{color:<?php echo $style['general-accent_bg_color'];?>;}
.sidebar-content .items-grid a:hover,.sidebar-content .post-content a:hover{color:<?php echo $style['general-accent_bg_color'];?>;}
.shortcode-tabs .tab:hover,.shortcode-tabs .tab.active-tab,.wpb_tabs.wpb_content_element .wpb_tabs_nav>li>a:hover,.wpb_tabs.wpb_content_element .wpb_tabs_nav>li.ui-tabs-active>a,.wpb_tour.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav>li.ui-tabs-active>a,.wpb_tabs.wpb_content_element .wpb_tabs_nav>li>a:hover,.wpb_tour.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav>li>a:hover{color:<?php echo $style['general-accent_bg_color'];?>;}
#top-bar .menu-select:hover,#bottom-bar .menu-select:hover{color:<?php echo $style['general-accent_bg_color'];?>;}
#top-bar a.wc-ico-cart:hover{color:<?php echo $style['general-accent_bg_color'];?>;}
#main .vc_text_separator {
    border-color: <?php echo $style['general-accent_bg_color'];?>;
}
.rsHomePorthole .progress-spinner-left,.rsHomePorthole .progress-spinner-right {
  border-color: <?php echo $style['general-accent_bg_color'];?> !important;
}
.paint-accent-color {
  color: <?php echo $style['general-accent_bg_color'];?> !important;
}
.project-details,
.project-link,
.project-details:hover,
.project-link:hover {
  color: <?php echo $style['general-accent_bg_color'];?>;
}
.navigation-inner .prev-post, .navigation-inner .next-post {
    color: <?php echo $style['general-accent_bg_color'];?>;
}
.dt-form button, .dt-form input[type="button"], .dt-form input[type="reset"], .dt-form input[type="submit"], .dt-btn, .footer .dt-btn, .widget .dt-btn, .woocommerce #main a.button, #page .woocommerce a.button, .woocommerce #main button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page #main a.button, .woocommerce-page #main button.button, .woocommerce-page #main input.button, .woocommerce-page #main #respond input#submit, .woocommerce-page #main #content input.button, #main #pricing-table .plan .signup, #main #shaon-pricing-table a.signup, #main .minimal .pt-button, #main .woocommerce button.button, .nsu-submit {
    background-color: <?php echo $style['general-accent_bg_color'];?>;
}
a.clear-form, .sidebar-content a.clear-form, .footer a.clear-form {
    color: <?php echo $style['general-accent_bg_color'];?>;
}
.scroll-top:hover {
    background-color: <?php echo $style['general-accent_bg_color'];?>;
}
a {
    color: <?php echo $style['general-accent_bg_color'];?>;
}
button, input[type="button"], input[type="reset"], input[type="submit"] {
    background-color: <?php echo $style['general-accent_bg_color'];?>;
}
#main-nav>li.act>a>span>span.menu-subtitle{color:<?php echo $style['general-accent_bg_color'];?>;}
#main-nav>li:hover>a>span>span.menu-subtitle{color:<?php echo $style['general-accent_bg_color'];?>;}
#main-nav > li:hover > a, #main-nav > li > a:hover, #main-nav > li:hover > a span, #top-bar .mini-nav > ul > li:hover > a, #bottom-bar .mini-nav > ul > li:hover > a {
  color: <?php echo $style['general-accent_bg_color'];?>;
}
.filter-switch {
    background-color: <?php echo $style['general-accent_bg_color'];?>;
}
.details, .details:hover, .link.btn-link, #main ul.products li.product .button, #main ul.products li.product .button:hover, #main ul.products li.product .added_to_cart {
    color: <?php echo $style['general-accent_bg_color'];?>;
}
h2, h1.entry-title, .vc_pie_chart .vc_pie_chart_value {
    color: <?php echo $style['content-headers_color'];?>;}
	h4 a, h4 a:hover, .widget-title a {
    color: <?php echo $style['content-headers_color'];?>;
}
.entry-meta a, .entry-tags a, .entry-tags span, .portfolio-categories a {
    color: <?php echo $style['content-headers_color'];?>;
}
.entry-meta a *, .entry-tags a *, .portfolio-categories a * {
    color: <?php echo $style['content-headers_color'];?>;
}
.hr-breadcrumbs.divider-heder, .hr-breadcrumbs.divider-heder a {
    color: <?php echo $style['content-headers_color'];?>;
}
h3 a, h3 a:hover, h2.entry-title a, .comments-title a, #reply-title {
    color: <?php echo $style['content-headers_color'];?>;
}
h4, .page h4, .widget-title, .rollover-content h2.entry-title, .flex-caption h2, .gform_wrapper .gsection .gfield_label, .gform_wrapper h2.gsection_title {
    color: <?php echo $style['content-headers_color'];?>;
}
h3, h2.entry-title, .fancy-subtitle, .comments-title, .woocommerce-tabs h2, .related.products h2, .upsells.products h2, h3.gform_title, .gform_wrapper h3.gform_title, .woocommerce .cart-collaterals h2, .woocommerce-page .cart-collaterals h2 {
    color: <?php echo $style['content-headers_color'];?>;
}
.loading-label .fa, #page .tp-loader .fa, #page .ls-defaultskin .ls-loading-container .fa, #page .ls-carousel .ls-loading-container .fa, .rsHomePorthole .rsPreloader .fa, .rsShor .rsPreloader .fa, .ls-loading-indicator {
    color: <?php echo $style['general-accent_bg_color'];?>;
}
.project-details {
    background-image: url("data:image/svg+xml,%3Csvg%20version=%221.1%22%20xmlns=%22http://www.w3.org/2000/svg%22%20xmlns:xlink=%22http://www.w3.org/1999/xlink%22%20x=%220px%22%20y=%220px%22%20width=%2213px%22%20height=%2213px%22%20viewBox=%220%200%2013%2013%22%20enable-background=%22new%200%200%2013%2013%22%20xml:space=%22preserve%22%3E%3Cpath%20fill=%22<?php echo str_replace('#','%23',$style['general-accent_bg_color']);?>%22%20d=%22M3.632,0.172C3.673,0.255,11,6.5,11,6.5l-7.451,6.328l-0.998-1.005L8.859,6.5L2.634,1.177L3.632,0.172z%22/%3E%3C/svg%3E");
	/*
	background-image: url("data:image/svg+xml,<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="13px" height="13px" viewBox="0 0 13 13" enable-background="new 0 0 13 13" xml:space="preserve"><path fill="red" d="M3.632,0.172C3.673,0.255,11,6.5,11,6.5l-7.451,6.328l-0.998-1.005L8.859,6.5L2.634,1.177L3.632,0.172z"/></svg>");
	*/
}
.standard-arrow li, .breadcrumbs li, .custom-menu a {
    background-image: url("data:image/svg+xml,%3Csvg%20version=%221.1%22%20xmlns=%22http://www.w3.org/2000/svg%22%20xmlns:xlink=%22http://www.w3.org/1999/xlink%22%20x=%220px%22%20y=%220px%22%20width=%2213px%22%20height=%2213px%22%20viewBox=%220%200%2013%2013%22%20enable-background=%22new%200%200%2013%2013%22%20xml:space=%22preserve%22%3E%3Cpath%20fill=%22<?php echo str_replace('#','%23',$style['general-accent_bg_color']);?>%22%20d=%22M6.501,1.084c1.448,0,2.812,0.565,3.836,1.593c1.019,1.022,1.581,2.38,1.581,3.823c0,1.445-0.56,2.801-1.581,3.823c-1.022,1.027-2.388,1.595-3.836,1.595c-1.45,0-2.812-0.567-3.836-1.595C1.646,9.301,1.084,7.945,1.084,6.5c0-1.442,0.561-2.801,1.58-3.823C3.688,1.649,5.051,1.084,6.501,1.084%20M6.501,0%09C2.91,0,0,2.911,0,6.5C0,10.091,2.91,13,6.501,13C10.09,13,13,10.091,13,6.5C13,2.911,10.09,0,6.501,0L6.501,0z%22/%3E%3Cpolygon%20fill=%22<?php echo str_replace('#','%23',$style['general-accent_bg_color']);?>%22%20points=%225.547,2.766%209.229,6.534%205.702,10.256%204.625,9.219%207.285,6.474%204.547,3.797%20%22/%3E%3C/svg%3E");
}
.navigation-inner .prev-post, .navigation-inner .prev-post.disabled:hover {
    background-image: url("data:image/svg+xml,%3Csvg%20version=%221.1%22%20id=%22Layer_1%22%20xmlns=%22http://www.w3.org/2000/svg%22%20xmlns:xlink=%22http://www.w3.org/1999/xlink%22%20x=%220px%22%20y=%220px%22%20width=%2213px%22%20height=%2213px%22%20viewBox=%220%200%2013%2013%22%20enable-background=%22new%200%200%2013%2013%22%20xml:space=%22preserve%22%3E%3Cpath%20fill=%22<?php echo str_replace('#','%23',$style['general-accent_bg_color']);?>%22%20d=%22M9.919,12.828C9.878,12.745,2.551,6.5,2.551,6.5l7.451-6.328L11,1.177L4.691,6.5l6.226,5.323L9.919,12.828z%22/%3E%3C/svg%3E");
}
.navigation-inner .next-post, .navigation-inner .next-post.disabled:hover {
    background-image: url("data:image/svg+xml,%3Csvg%20version=%221.1%22%20xmlns=%22http://www.w3.org/2000/svg%22%20xmlns:xlink=%22http://www.w3.org/1999/xlink%22%20x=%220px%22%20y=%220px%22%20width=%2213px%22%20height=%2213px%22%20viewBox=%220%200%2013%2013%22%20enable-background=%22new%200%200%2013%2013%22%20xml:space=%22preserve%22%3E%3Cpath%20fill=%22<?php echo str_replace('#','%23',$style['general-accent_bg_color']);?>%22%20d=%22M3.632,0.172C3.673,0.255,11,6.5,11,6.5l-7.451,6.328l-0.998-1.005L8.859,6.5L2.634,1.177L3.632,0.172z%22/%3E%3C/svg%3E");
}
.clear-form::before {
    background-image: url("data:image/svg+xml,%3Csvg%20version=%221.1%22%20xmlns=%22http://www.w3.org/2000/svg%22%20xmlns:xlink=%22http://www.w3.org/1999/xlink%22%20x=%220px%22%20y=%220px%22%20width=%2213px%22%20height=%2213px%22%20viewBox=%220%200%2013%2013%22%20enable-background=%22new%200%200%2013%2013%22%20xml:space=%22preserve%22%3E%3Cpath%20fill=%22<?php echo str_replace('#','%23',$style['general-accent_bg_color']);?>%22%20d=%22M6.501,1.084c1.448,0,2.812,0.565,3.836,1.593c1.019,1.022,1.581,2.38,1.581,3.823%09c0,1.445-0.561,2.801-1.581,3.823c-1.022,1.026-2.388,1.595-3.836,1.595c-1.45,0-2.812-0.566-3.836-1.595C1.646,9.301,1.084,7.945,1.084,6.5c0-1.442,0.561-2.801,1.58-3.823C3.688,1.649,5.051,1.084,6.501,1.084%20M6.501,0%09C2.91,0,0,2.911,0,6.5C0,10.091,2.91,13,6.501,13C10.09,13,13,10.091,13,6.5C13,2.911,10.09,0,6.501,0L6.501,0z%22/%3E%3Cpolygon%20fill=%22<?php echo str_replace('#','%23',$style['general-accent_bg_color']);?>%22%20points=%223.534,8.557%204.429,9.45%209.467,4.412%208.604,3.55%20%22/%3E%3Cpolygon%20fill=%22<?php echo str_replace('#','%23',$style['general-accent_bg_color']);?>%22%20points=%229.467,8.557%208.57,9.45%203.534,4.412%204.396,3.55%20%22/%3E%20%3C/svg%3E");
}
.details, #main ul.products li.product .button, #main ul.products li.product .button:hover {
    background-image: url("data:image/svg+xml,%3Csvg%20version=%221.1%22%20xmlns=%22http://www.w3.org/2000/svg%22%20xmlns:xlink=%22http://www.w3.org/1999/xlink%22%20x=%220px%22%20y=%220px%22%20width=%2213px%22%20height=%2213px%22%20viewBox=%220%200%2013%2013%22%20enable-background=%22new%200%200%2013%2013%22%20xml:space=%22preserve%22%3E%3Cpath%20fill=%22<?php echo str_replace('#','%23',$style['general-accent_bg_color']);?>%22%20d=%22M3.632,0.172C3.673,0.255,11,6.5,11,6.5l-7.451,6.328l-0.998-1.005L8.859,6.5L2.634,1.177L3.632,0.172z%22/%3E%3C/svg%3E");
	}
.rsTitle{ display:none !important;}
</style>
<style>
ul.ts-cont li.ts-cell{ min-width:300px;}
</style>
<?php wp_footer(); ?>
</body>
</html>