<select id="<?php echo $fieldId;?>" value="1" name="<?php echo $fieldId;?>">
   <?php
   if (isset($options))
     {
       $default = get_option( $fieldId, true );
       foreach ($options as $optionKey => $optionValue)
	 {
	   echo '<option value="'.$optionKey.'" '.selected($optionKey==$default).'>'.$optionValue.'</option>';
	 }
     }
   else
     echo 'No options';
?>
</select>