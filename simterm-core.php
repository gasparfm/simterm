<?php

require_once('simterm-settings.php');
require_once('simterm-line.php');

class SimTerm
{
    protected $settings;

    function __construct()
    {
	/* Inicialización básica de mi plugin 
	   (la que no tiene que ver con WordPress) */
	$this->settings = SimTermSettings::getInstance();
    }

    function settings()
    {
	return $this->settings;
    }

    function simterm_shortcode($atts, $content="")
    {
      $_lines = preg_split("/\r\n|\n|\r/", trim($content));
      if (count($_lines)==0)
	return;
      add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
      wp_enqueue_script('simterm-showyourterms', plugins_url('js/show-your-terms.min.js',__FILE__), array(), '20160705', true);
      wp_enqueue_script('simterm-launcher', plugins_url('js/simterm.js',__FILE__), array('simterm-showyourterms'), '20160705', true);
      wp_enqueue_style('simterm-showyourtermscss', plugins_url('css/show-your-terms.min.css', __FILE__), array(), '20160705', 'all');
      wp_enqueue_style('simterm-extracss', plugins_url('css/simterm.css', __FILE__), array(), '20160705', 'all');

      $data=array('lines'=> array());
      $commandPrep = get_option('simterm-command-prepend');
      $typePrep = get_option('simterm-type-prepend');
      $defaultDelay = get_option('simterm-default-delay');
      $lastLineDelay = 10000;
      $defaultTheme = get_option('simterm-default-theme');
      $data['theme'] = $defaultTheme;
      $data['title'] = "Console";

      $lines = array();
      foreach ($_lines as $l)
	{
	  $l = trim(strip_tags($l));
	  if (empty($l))
	    continue;
	  $lines[] = $l;
	}
      $lineCount = count($lines);
      for ($i = 0; $i<$lineCount; ++$i)
	{
	  $linedata = array();
	  $thisline = new SimTermLine($lines[$i], $commandPrep, $typePrep, ($i<$lineCount-1)?$defaultDelay:$lastLineDelay);
	  $data['lines'][] = $thisline->getData();
	}
      return SimTermView::render('live/syt', array('data' => $data));

?>
<?php
    }
};
