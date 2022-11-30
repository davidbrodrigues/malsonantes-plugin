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
/*creacion de la funcion*/
function filtro_palabras_malsonantes( $content ) {
    /*creacion de arrays de palabras malsonantes y el reemplazo*/
    $malsonantes = array('gilipollas', 'subnormal', 'idiota', 'tonto');
    $reemplazo = array('palabra_blacklist', 'palabra_blacklist', 'palabra_blacklist', 'palabra_blacklist', );

    /*la funcion que reemplaza las palabras y nos devuelve el cambio*/
    return str_replace($malsonantes, $reemplazo, $content);

}