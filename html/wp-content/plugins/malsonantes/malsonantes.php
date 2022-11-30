<?php
/*
Plugin Name: Plugin malsonantes david
Plugin URI: http://www.davidbr.org/
Description: blacklist de palabras malsonantes
Version: 1.0
*/
/*
 * Remplaza las palabras malas por las buenas
 */
add_filter( 'the_content', 'filtro_palabras_malsonantes' );

function filtro_palabras_malsonantes( $content ) {

    $malsonantes = array('gilipollas', 'subnormal', 'idiota', 'tonto');
    $reemplazo = array('palabra_blacklist', 'palabra_blacklist', 'palabra_blacklist', 'palabra_blacklist', );

    return str_replace($malsonantes, $reemplazo, $content);

}