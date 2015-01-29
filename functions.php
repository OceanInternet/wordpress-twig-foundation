<?php

// Include Composer Packages
require 'vendor/autoload.php';

add_action('tgmpa_register', 'ois_twig_foundation_register_required_plugins');

function ois_twig_register_required_plugins() {
    $plugins = array(
        array(
            'name'     => 'Timber',
            'slug'     => 'timber-library',
            'required' => TRUE
        )
    );
    tgmpa( $plugins, $config );
}
