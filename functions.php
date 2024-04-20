<?php
/*============================================================================== */
// Add styles to editor
$path = home_url().parse_url( get_stylesheet_directory_uri(), PHP_URL_PATH );
$editor_styles_folder = 'assets/css';
add_theme_support('editor-styles');
add_editor_style($path . '/'.$editor_styles_folder .'/editorstyles.css');

/*============================================================================== */
// Enqueue scripts and styles
function oas_scripts()
{
  wp_enqueue_script('jquery');
  $filename = get_template_directory() . '/assets/js/scripts.js';

  wp_enqueue_script ( 'oas_scripts', get_template_directory_uri() .'/assets/js/scripts.js',array('jquery'), true);
  wp_enqueue_script ( 'oas_scripts_io', get_template_directory_uri() .'/assets/js/io.js',array('jquery'), true);
  $filename = get_template_directory() . '/assets/css/styles.css';

  wp_enqueue_style ( 'oas_styles', get_template_directory_uri() . '/assets/css/styles.css', array(), false);    
}
add_action('wp_enqueue_scripts', 'oas_scripts');

/*============================================================================== */
// Menus
function default_menu() { register_nav_menu('default_menu',__( 'Default menu' )); }
    add_action( 'init', 'default_menu' );

function footer_menu() { register_nav_menu('footer_menu',__( 'Footer menu' )); }
    add_action( 'init', 'footer_menu' );

function logged_in_menu() { register_nav_menu('logged_in_menu',__( 'Logged in menu' )); }
    add_action( 'init', 'logged_in_menu' );


/*============================================================================== */
# Redirect login
function redirect_user( $redirect_to, $request, $user ){
    //is there a user to check?
    if ( isset( $user->roles ) ) {
        $redirect_to = '/mina-sidor';
    }
    return $redirect_to;
}

add_filter( 'login_redirect', 'redirect_user', 10, 3 );
add_filter( 'logout_redirect', function() {
    return esc_url( home_url() );
} ); 

/*============================================================================== */
// Display synced patterns(reusable blocks)
function be_reusable_blocks_admin_menu() {
    add_menu_page(
      'Mönster',
      'Mönster',
      'edit_posts',
      'edit.php?post_type=wp_block',
      '',
      'dashicons-layout',
      22
    );
  }
  add_action( 'admin_menu', 'be_reusable_blocks_admin_menu' );