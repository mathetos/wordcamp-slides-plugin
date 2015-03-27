<?php

//Load Presentation Template from Plugin
add_filter( 'template_include', 'mcslides_plugin_templates' );

function mcslides_plugin_templates( $template ) {
    $post_types = array( 'presentation' );

    // if ( is_post_type_archive( $post_types ) && ! file_exists( get_stylesheet_directory() . '/archive-presentation.php' ) )
        // $template = WCSD_DIR . 'templates/archive-presentation.php';
	
    if ( is_singular( $post_types ) && ! file_exists( get_stylesheet_directory() . '/single-presentation.php' ) )
        $template = WCSD_DIR . '/templates/single-presentation.php';

    return $template;
}


// Register and Enqueue Scripts
function mcslides_enqueue_scripts() {

	wp_register_script( 'superslides-js', MCSLIDES_URL . 'assets/js/jquery.superslides.min.js', array( 'jquery' ), '1.0.0', false );
	wp_register_script( 'animate-enhanced', MCSLIDES_URL . 'assets/js/animate-enhanced.min.js', array( 'jquery' ), '1.0.0', false );
	wp_register_script( 'hammer', MCSLIDES_URL . 'assets/js/hammer.min.js', array( 'jquery' ), '1.0.0', false );
	wp_register_style('superslides-css', MCSLIDES_URL . 'assets/css/superslides.css');

	if ( is_singular('presentation')) {
		wp_enqueue_script('animate-enhanced');
		wp_enqueue_script('hammer');
		wp_enqueue_script('superslides-js');
		wp_enqueue_style('superslides-css');
	}
}


add_action( 'wp_enqueue_scripts', 'mcslides_enqueue_scripts' );


//Print Superslides Init script
function print_superslides_init_script() {
  if ( (is_singular('presentation')) && (wp_script_is( 'jquery', 'done' )) ) {
?>
<script type='text/javascript'>
jQuery(document).ready(function($){
	
	$(document).on('init.slides', function() {
    $('.loading-container').fadeOut(function() {
      $(this).remove();
		});
	});

	
	$('#slides').superslides({
    slide_easing: 'easeInOutCubic',
    slide_speed: 400,
	animation: 'slide',
    pagination: true,
    hashchange: true,
    scrollable: true
  });
  
  $('#slides').hammer().on('swipeleft', function() {
    $(this).superslides('animate', 'next');
  });

  $('#slides').hammer().on('swiperight', function() {
    $(this).superslides('animate', 'prev');
  });
});
</script>
<?php
  }
}
add_action( 'wp_footer', 'print_superslides_init_script' );

//Dequeue all other Theme scripts on the Presentation pages
function mcslides_dequeue_styles() {
		if(is_singular('presentation')){
			wp_dequeue_style( 'parent-style' );
			wp_dequeue_style( 'child-style' );
			wp_dequeue_style( 'style' );
			// wp_dequeue_style( 'googleFonts' );
			wp_dequeue_style( 'wpex-responsive' );
		}
}
add_action( 'wp_print_styles', 'mcslides_dequeue_styles', 100 );



function mcslides_dequeue_scripts() {
		if(is_singular('presentation')){
			wp_dequeue_script( 'wpex-plugins' );
			wp_dequeue_script( 'wpex-global' );
		}
}
add_action( 'wp_print_scripts', 'mcslides_dequeue_scripts', 100 );


add_filter( 'wp_default_scripts', 'mcslides_remove_jquery_migrate' );

function mcslides_remove_jquery_migrate( &$scripts)
{
    if(!is_admin())
    {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.11' );
    }
}

function mcslides_foogallery_img_class($attr) {	
	if (array_key_exists('class', $attr)) {
	  $attr['class'] = $attr['class'] . ' preserve';
	} else {
	  $attr['class'] = 'preserve';
	}
	
	return $attr;
}

add_filter('foogallery_attachment_html_image_attributes', 'mcslides_foogallery_img_class', 1 );