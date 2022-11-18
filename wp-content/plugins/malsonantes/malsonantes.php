<?php
/*
Plugin Name: Cambiar Malsonantes
Plugin URI: http://wordpress.org/plugins/malsonantes/
Description: Busca palabras malsonantes y las sustituye por otras.
Author: Jackie Sierras
Version: 1.0
Author URI: http://jack.sir/
*/

function cambiar_malsonantes( $text){
    $sustituibles = ["caca","calvo","gordo","tonto","furro"];
    $recambios = ["popo","alopecico","ancho","bobo","animalista"];
	return str_replace($sustituibles , $recambios, $text);
}
/*
 * Cambia el contenido del post
 */
add_filter('the_content', 'cambiar_malsonantes');