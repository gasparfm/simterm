<?php

class SimTermView
{

  public static function render($slug, $variables=array(), $name = null)
  {
    global $wp_query;

    $template = self::searchTemplate($slug, $name);

    if ( is_array( $wp_query->query_vars ) )
      {
	extract( $wp_query->query_vars, EXTR_SKIP );
      }

    extract($variables);

    ob_start();

    if ( $template )
      require( $template );	/* load_template just requires or require_once the file extracting wp_query vars */

    return ob_get_clean();
  }

  private static function searchTemplate($slug, $name)
  {
    $templateNames = array();
    $path = plugin_dir_path(__FILE__).'/views/';

    if (isset($name))
      $templateNames[] = "{$slug}-{$name}.php";

    $templateNames[] = "{$slug}.php";

    foreach ( (array) $templateNames as $template )
      {
	if (!$template) 
	  continue;

	if (file_exists($path . '/' . $template))
	  return $path . '/' . $template;
      }

    return false;
  }

};