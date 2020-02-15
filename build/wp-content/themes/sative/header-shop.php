<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous" media="none" onload="if(media!='all')media='all'">
    <noscript>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    </noscript>
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets/css/prototype.css">
</head>
<body <?php body_class(); ?>>
    <div id="wrapper">
        <?php get_template_part( 'template-parts/navigation' ); ?>
        <?php if ( function_exists('yoast_breadcrumb') ) : ?>
            <aside class="breadcrumbs">
                <div class="container">
                    <div class="row">
                        <?php 
                            $args = array(
                                'delimiter' => '➞',
                                'wrap_before' => '<div class="col-12"><span>',
                                'wrap_after' => '</span></div>',
                                'before' => '<span>',
                                'after' => '</span>'
                            );
                            woocommerce_breadcrumb($args);
                        ?>
                    </div>
                </div>
            </aside>
        <?php endif; ?>