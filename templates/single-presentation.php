<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package _s
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php if ( defined('WPSEO_VERSION') ) {
} else {
global $post;
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
<title><?php echo the_title(); ?></title>
<meta name="description" content="<?php echo esc_html(get_the_excerpt()); ?>" >
<meta property="og:title" content="<?php echo the_title(); ?>"/>
<?php if(!empty($image)): ?>
<meta property="og:image" content="<?php echo $image[0]; ?>"/>
<?php endif; ?>
<meta property="og:site_name" content="<?php echo get_bloginfo('name') ?>"/>
<meta property="og:description" content="<?php echo esc_html(get_the_excerpt()); ?>"/>

<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="header">
<?php
$return = get_post_meta( get_the_ID(), '_mcslides_return_url', true );
?>
<a href="<?php echo get_permalink($return); ?>" class="return">Return to <?php echo get_bloginfo('name'); ?></a><a href="https://www.mattcromwell.com" target="_blank" class="home">Matt Cromwell: WordPress Tutorials, Tips, and Editorials</a>
</div>
<div id="slides" role="listbox" tabindex="0" aria-activedescendant="listbox1-1">
<ul class="slides-container" role="option">
<?php
$entries = get_post_meta( get_the_ID(), '_mcwcsd_slides', true );

foreach ( (array) $entries as $key => $entry ) {

    $img = $title = $desc = '';

    if ( isset( $entry['title'] ) )
        $title = esc_html( $entry['title'] );

    if ( isset( $entry['description'] ) )
        $desc = do_shortcode($entry['description']);

    if ( isset( $entry['image_id'] ) ) {
        $img = wp_get_attachment_image( $entry['image_id'], 'share-pick', null, array(
            'class' => 'thumb',
        ) );
	}
	if ( isset( $entry['accent_image_id'] ) ) {
        $accent = wp_get_attachment_image_src( $entry['accent_image_id'], 'medium');
	}
	if ( isset( $entry['code'] ) ) {
        $code = esc_html($entry['code']);
		    $codelang = $entry['codelanguage'];
	}
	if ( isset( $entry['foogallery'] ) )
        $foogallery = do_shortcode( $entry['foogallery'] );

	if(!empty($accent)) {
		$halfclass = 'half';
	} else {
		$halfclass = 'full';
	}

    //Output the slide content
	echo '<li>';
	echo $img;
	echo '<div class="content"><h2>' . $title . '</h2>';
	echo '<div class="' . $halfclass . '">' . $desc . '</div>';
	if(!empty( $accent )) { ?>
		<img src="<?php echo $accent[0]; ?>" width="<?php echo $accent[1]; ?>" class="preserve accent">
	<?php }
	echo '<div class="gallery">' . do_shortcode($foogallery) . '</div>';
	if(!empty($code)) { ?>
		<h5><a href="#<?php $entry->ID; ?>code" target="foobox" class="code">Code Example</a></h5>

		<div id="<?php $entry->ID; ?>code" style="display:none;">
			<h5 class="codetitle">Code Example: <?php echo $codelang; ?></h5>
			<pre><code data-language="<?php echo $codelang?>"><?php print_r( $code ); ?></code></pre>
		</div>
		<?php
	}
	echo '</div>';
	echo '</li>';

	}//end of foreach ?>
	</ul>
</div><!--end #slides-->
<?php wp_footer(); ?>

</body>
</html>
