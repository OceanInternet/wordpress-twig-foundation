<?php

$context                = Timber::get_context();

$context['carousel']    = Timber::get_posts(
    array(
        'tag'            => 'featured',
        'posts_per_page' => 5,
        'orderby'        => 'post_date',
        'order'          => 'DESC',
        'meta_query'     => array(
            array(
                'key'     => '_thumbnail_id',
                'compare' => 'EXISTS'
            )
        )
    )
);

$context['homePrimary'] = Timber::get_widgets('home-primary');
$context['homeOne']     = Timber::get_widgets('home-one');
$context['homeTwo']     = Timber::get_widgets('home-two');

Timber::render(array('front-page.twig'), $context);
