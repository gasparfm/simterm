<label for="<?php echo $fieldId;?>">
   <input id="<?php echo $fieldId;?>" type="checkbox" value="1" name="<?php echo $fieldId;?>" <?php checked( get_option( $fieldId, true ) ); ?> /> 
   <?php 
	if (isset($fieldText)) 
	  echo $fieldText;
   ?>
</label>
