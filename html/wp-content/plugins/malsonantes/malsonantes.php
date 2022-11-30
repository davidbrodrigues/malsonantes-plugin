<?php
/*
Plugin Name: Plugin malsonantes david + Base de datos
Plugin URI: http://www.davidbr.org/
Description: blacklist de palabras malsonantes Base de datos
Version: 1.1
*/
/*
 * Remplaza las palabras malas por las buenas
 */
function malsonantes( $text ) {
    // Objeto WP DB
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    //prefijo de tabla
    $table_name = $wpdb->prefix . 'malsonantes';
    //con al funcion SELECT recogemos todos los datos de la tabla
    $datostabla = $wpdb->get_results("SELECT * FROM " . $table_name, ARRAY_A);
    //arrays que contendran las malsonantes y el reemplazo
    $malsonantes = array();
    $reemplazo = array();
    //recorremos los datos recogidos
    foreach($datostabla as $fila)
    {
        // añadimos las palabras
        array_push($malsonantes, $fila['malsonantes']);
        array_push($reemplazo, $fila['reemplazo']);
    }

    return str_replace( $malsonantes, $reemplazo, $text );
}
    //añadimos un filtro al contenido con la funcion malsonantes
add_filter( 'the_content', 'malsonantes' );

function myplugin_update_db_check() {

    // Objeto WP DB
    global $wpdb;
    // recojemos el
    $charset_collate = $wpdb->get_charset_collate();
    // le añado el prefijo a la tabla
    $table_name = $wpdb->prefix . 'malsonantes';
    //sentencia sql
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        malsonantes varchar (30),
        reemplazo varchar (20),
        PRIMARY KEY (id)
    ) $charset_collate;";
    //añadimos los requerimientos
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    //añadimos la funcion dbDelta que modifica la base de datos segun lo que especifiquemos
    dbDelta( $sql );
    // creamos los arrays de las palabras para añadir a la sql
    $malsonantes = array('gilipollas', 'subnormal', 'idiota', 'tonto');
    $reemplazo = array('palabra_blacklist', 'palabra_blacklist', 'palabra_blacklist', 'palabra_blacklist', );
    //igualamos el id a 0
    $i = 0;
    //añadimos mas requerimientos
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    // insertamos en la sql
    foreach($malsonantes as $malsonantes){
        $result = $wpdb->insert(
            $table_name,
            array(
                'id' => $i,
                'malsonantes' => $malsonantes,
                'reemplazo' => $reemplazo[$i]
            )
        );
        //va sumando 1 a la id
        $i++;
    }

    error_log("Plugin DAM insert: " . $result);
}
add_action( 'plugins_downloaded', 'myplugin_update_db_check' );
