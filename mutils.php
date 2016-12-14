<?php
function bool_from_str($str)
{
	$str = strtolower($str);
	return ( ($str=='y') || ($str=='yes') || ($str=='true') || ($str=='enabled') || ($str>0) );
}