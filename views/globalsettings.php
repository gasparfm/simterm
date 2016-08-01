<div class="section panel">
   <h1><?php echo __('SimTerm Options', 'simterm'); ?></h1>
   <form method="post" enctype="multipart/form-data" action="options.php">
      <?php
      settings_fields('simterm-settings');
      do_settings_sections('simterm-settings');
      ?>
      <p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
      </p>
   </form>
   <p>
   <?php
	echo sprintf (__('SimTerm by <a href="%1$s"">%2$s</a> using Show Your Terms by <a href="%3$s">%4$s</a>', 'simterm'), 
		      'http://gaspar.totaki.com', 'Gaspar Fernández', 'http://kandebonfim.com', 'Kande Bonfim');
   ?>
   </p>
</div>
