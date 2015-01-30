<?php
// Check for Timber Library
if (!class_exists('Timber')){
    add_action( 'admin_notices', function(){
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . admin_url('plugins.php#timber') . '">' . admin_url('plugins.php') . '</a></p></div>';
    });
    return;
}

// Include Composer Packages
require 'vendor/autoload.php';

add_action('tgmpa_register', 'ois_tf_register_required_plugins');

add_action('wp_enqueue_scripts', 'ois_tf_enqueue_scripts');

add_action( 'widgets_init', 'ois_tf_widgets_init');

function ois_tf_register_required_plugins() {
    $plugins = array(
        array(
            'name'     => 'Timber',
            'slug'     => 'timber-library',
            'required' => TRUE
        )
    );
    
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => TRUE,                    // Show admin notices or not.
        'dismissable'  => FALSE,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => TRUE,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );
}

function ois_tf_register_styles() {

    $dir = get_template_directory_uri();


    wp_register_style('ois_tf_app_style',  $dir . '/stylesheets/app.css', array());
}

function ois_tf_register_scripts() {

    $dir = get_template_directory_uri();

    wp_register_script('ois_tf_modernizr',  $dir . '/components/modernizr/modernizr.js', array(), FALSE, FALSE);
    wp_register_script('ois_tf_jquery',     $dir . '/components/jquery/dist/jquery.js', array(), FALSE, TRUE);
    wp_register_script('ois_tf_foundation', $dir . '/components/foundation/js/foundation.js', array('ois_tf_modernizr',
                                                                                                        'ois_tf_jquery'     ), FALSE, TRUE);
    wp_register_script('ois_tf_app_script',        $dir . '/scripts/app.js' , array('ois_tf_foundation'), FALSE, TRUE);
}

function ois_tf_enqueue_scripts() {

    ois_tf_register_styles();
    ois_tf_register_scripts();

    wp_enqueue_style('ois_tf_app_style');
    wp_enqueue_script('ois_tf_app_script');
}

function ois_tf_widgets_init() {

    register_sidebar( array(
        'name' => 'Home Primary Widget',
        'id' => 'home-primary',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );

    register_sidebar( array(
        'name' => 'Home Widget 1',
        'id' => 'home-one',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );

    register_sidebar( array(
        'name' => 'Home Widget 2',
        'id' => 'home-two',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );
}

function myfoo($text){
    $text .= ' bar!';
    return $text;
}

new Ois\TwigFoundation\TwigFoundation;
