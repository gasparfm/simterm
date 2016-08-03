<?php

class SimTermLine
{
    private $line;
    private $commandPrep;
    private $typePrep;
    private $typeSpeed;
    private $delay;
    private $customDelay = false;
    private $lineColor;
    private $lineData;
    private $lineAttrs;

    public function __construct($plaintext, $commandPrep, $typePrep, $defaultDelay, $typingSpeed)
    {
	$this->line = $plaintext;
	$this->commandPrep = $commandPrep;
	$this->typePrep = $typePrep;
	$this->delay = $defaultDelay;
	$this->lineData = array();
	$this->lineColor = "";
	$this->lineAttrs = "";
	$this->typeSpeed = $typingSpeed;
    }

    public function getData($filters=array())
    {
	/* One more trim */
	$this->line = trim(preg_replace_callback('/##([^#]*)##/', array($this, 'modifier'), $this->line));
	if ( (!empty($this->commandPrep)) && (strchr($this->commandPrep, $this->line[0]) !== false) )
	    $this->linedata['type'] = 'command';
	elseif ( (!empty($this->typePrep)) && (strchr($this->typePrep, $this->line[0]) !== false) )
	    $this->linedata['type'] = 'type';
	else
	    $this->linedata['type'] = 'line';

	if (in_array($this->linedata['type'], array('command', 'type')))
	    $this->line = trim(substr($this->line, 1));

	$this->linedata['attrs'] = trim($this->lineAttrs.' '.$this->lineColor);
	foreach ($filters as $filter)
	    $this->line = call_user_func($filter, $this->line);

	$this->linedata['text'] = $this->line;
	$this->linedata['delay'] = $this->delay;
	$this->linedata['speed'] = $this->typeSpeed;
	$this->linedata['customDelay'] = $this->customDelay;
	return $this->linedata;
    }

    public function modifier ($matches)
    {
	$commands = explode(',', $matches[1]);
	foreach ($commands as $command)
	{
	    $eq = explode('=', $command);
	    switch ($eq[0])
	    {
		case 'red':
		case 'yellow':
		case 'green':
		case 'blue':
		case 'grey': 
		  $this->lineColor=$eq[0];
		  break;
		case 'underline': 
		  $this->lineAttrs.=' underlined';
		  break;
		case 'blink': 
		  $this->lineAttrs.=' blink';
		  break;
		case 'active':
		  $this->lineAttrs.=' active';
		  break;
		case 'speed':
		  $this->typeSpeed=$eq[1];
		  break;
		case 'color':
		  $this->lineColor=$eq[1];
		  break;
		case 'delay':
		  $this->delay = $eq[1];
		  $this->customDelay = true;
		  break;
	    }
	}
	return "";
    }
};
