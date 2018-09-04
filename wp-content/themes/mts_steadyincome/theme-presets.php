<?php
// make sure to not include translations
$args['presets']['default'] = array(
    'title' => 'Default',
    'demo' => 'http://demo.mythemeshop.com/steadyincome/',
    'thumbnail' => get_template_directory_uri().'/options/demo-importer/demo-files/default/thumb.jpg',
    'menus' => array( 'primary-menu' => 'Menu', 'secondary-menu' => 'Menu', 'mobile' => '' ), // menu location slug => Demo menu name
    'options' => array( 'show_on_front' => 'page', 'page_on_front' => '257', 'page_for_posts' => '258', 'posts_per_page' => 4 ),
);

global $mts_presets;
$mts_presets = $args['presets'];
