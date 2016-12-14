<?php
$theme = $data['theme'];
$title = $data['title'];
$statusbar = $data['statusbar'];
$animated = $data['animated'];

?>
<div class="showyourterms<?php
if (!empty($theme)) echo ' '.$theme;
if (!$animated) echo ' noanimate';
if (!$statusbar) echo ' nostatusbar';
?>"<?php if(!empty($title)) echo ' data-title="'.$title.'"'; ?>>
<?php
     $valid_types = array('type', 'command', 'line');
     foreach ($data['lines'] as $line)
   {
     $attributes="";
     if (!in_array($line['type'], $valid_types))
       continue;
     $class=$line['type'];

     if ( ($class=="command") || ($class=="type") )
       $attributes.=' data-action="command"';

     $attributes.=' data-delay="'.$line['delay'].'"';
     $attributes.=' data-speed="'.$line['speed'].'"';

     $attributes=trim($attributes);
     echo '<div class="'.$class.((!empty($line['attrs']))?(' '.$line['attrs']):'').'"';
     if (!empty($attributes))
       echo ' '.$attributes;
     echo '>'.$line['text'].'</div>';
   }
?>
<?php
?>
   </div>