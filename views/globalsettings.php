<div class="section panel">
    <h1>SimTerm Options</h1>
    <form method="post" enctype="multipart/form-data" action="options.php">
        <?php 
	settings_fields('simterm-settings');
        do_settings_sections('simterm-settings');
        ?>
        <p class="submit">  
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
        </p>  
        
    </form>
    
    <p>SimTerm by <a href="http://gaspar.totaki.com">Gaspar Fernández</a> using Show Your Terms by <a href="http://kandebonfim.com">Kande Bonfim</a>.</p>
</div>
