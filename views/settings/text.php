<label for="<?php echo $fieldId;?>">
   <input id="<?php echo $fieldId;?>" type="text" value="<?php echo get_option( $fieldId ); ?>" name="<?php echo $fieldId;?>" /> 
   <div class="settings-text-expl">
   <?php 
	if (isset($fieldText)) 
	  echo $fieldText;
   ?>
</div>
</label>
