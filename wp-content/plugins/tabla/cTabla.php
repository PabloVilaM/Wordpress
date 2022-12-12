
<?php
/**
 * Plugin Name:       MalsonantesDataBase
 * Plugin URI: http://wordpress.org/plugins/malsonantesDB/
 * Description:       Cambia malsonantes por otras cosas
 * Version:           1.0
 * Author:            Pablo Vila
 * Author URI: http://jacko
 */


function crearTablas() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name1 = $wpdb->prefix . 'mpalabras';
    $table_name2 = $wpdb->prefix . 'recambios';

    $sql = "CREATE TABLE $table_name1 (
        id mediumint(9) NOT NULL,
        text text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    $sql2 = "CREATE TABLE $table_name2 (
        id mediumint(9) NOT NULL,
        text text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    dbDelta( $sql2 );
}
add_action('plugins_loaded', 'crearTablas');


function insertValoresTablas() {
    global $wpdb;
    $table_name1 = $wpdb->prefix . 'sustituibles';
    $table_name2 = $wpdb->prefix . 'recambios';

    $sql11 = "INSERT INTO $table_name1 (id, text) VALUES (1, 'caca')";
    $sql12 = "INSERT INTO $table_name1 (id, text) VALUES (2, 'calvo')";
    $sql13 = "INSERT INTO $table_name1 (id, text) VALUES (3, 'gordo')";
    $sql14 = "INSERT INTO $table_name1 (id, text) VALUES (4, 'tonto')";
    $sql15 = "INSERT INTO $table_name1 (id, text) VALUES (5, 'furro')";

    $sql21 = "INSERT INTO $table_name2 (id, text) VALUES (1, 'popo')";
    $sql22 = "INSERT INTO $table_name2 (id, text) VALUES (2, 'alopecico')";
    $sql23 = "INSERT INTO $table_name2 (id, text) VALUES (3, 'ancho')";
    $sql24 = "INSERT INTO $table_name2 (id, text) VALUES (4, 'bobo')";
    $sql25 = "INSERT INTO $table_name2 (id, text) VALUES (5, 'animalista')";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql11);
    dbDelta( $sql12);
    dbDelta( $sql13);
    dbDelta( $sql14);
    dbDelta( $sql15);

    dbDelta( $sql21);
    dbDelta( $sql22);
    dbDelta( $sql23);
    dbDelta( $sql24);
    dbDelta( $sql25);
}
add_action('plugins_loaded', 'insertValoresTablas');


function reescribir_malsonantes( $text ) {
    global $wpdb;
    $table_malsonantes = $wpdb->prefix . 'sustituibles';
    $table_reemplazo = $wpdb->prefix . 'recambios';

    $queryMalsonantes = $wpdb->get_results( "SELECT text FROM $table_malsonantes");
    $queryReemplazos = $wpdb->get_results("SELECT text FROM $table_reemplazo");

    $sustitutas = array();
    for ($i = 0; $i < sizeof($queryMalsonantes); $i++) {
        $sustitutas[] = $queryMalsonantes[$i]->text;
    }

    $recambios = array();
    for ($i = 0; $i < sizeof($queryReemplazos); $i++) {
        $recambios[] = $queryReemplazos[$i]->text;
    }

    return str_replace( $sustitutas, $recambios, $text);
}
add_filter('the_content', 'reescribir_malsonantes');
