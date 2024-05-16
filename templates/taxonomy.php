<div class="wrap">
    <h1>MHamdy Plugin Taxonomy Page</h1>
    <?php settings_errors(); ?>

    
    <ul class="nav nav-tabs">
        <li class="<?php echo ( ! isset($_POST['edit_taxonomy'])) ? 'active' : '' ?>">
            <a href="#tab-1">Your Custom Taxonomies</a>
        </li>
        <li class="<?php echo (isset($_POST['edit_taxonomy'])) ? 'active' : '' ?>" >
            <a href="#tab-2">
                <?php echo (isset($_POST['edit_taxonomy'])) ? 'Edit' : 'Add'  ?> Custom Taxonomy
            </a>
        </li>
        <li >
            <a href="#tab-3">Export</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane <?php echo ( ! isset($_POST['edit_taxonomy'])) ? 'active' : '' ?>">
        <h3>Manage your Custom Taxonomy</h3>

        <?php 
				$options = get_option('mhamdy_plugin_tax') ?: []; // if not $option then $option will equall []
                
				echo '<table class="cpt-table">
                        <tr>
                            <th>ID</th>
                            
                            <th>Singular Name</th>

                            <th class="text-center">Hierarchical</th>

                            <th class="text-center">Actions</th>
                        </tr>';

                        echo '<pre>';

				foreach ($options as $option) {
                    $hierarchical = isset($option['hierarchical']) ? "TRUE": "FALSE";
                    
					echo "<tr>
                            <td>{$option['taxonomy']}</td>
                            <td>{$option['singular_name']}</td>
                            <td class=\"text-center\">{$hierarchical}</td>
                            <td class=\"text-center\">";
                            
                    /** Edit custom post type */
                    echo '<form method="post" action="" class="inline-block">';
					echo '<input type="hidden" name="edit_taxonomy" value="' . $option['taxonomy'] . '">';
					submit_button( 'Edit', 'primary small', 'submit', false);
					echo '</form> ';

                    /** Delete custom post type */
                    echo '<form method="post" action="options.php" class="inline-block">';
                    settings_fields( 'mhamdy_plugin_tax_settings' );
                    echo '<input type="hidden" name="remove" value="'.$option['taxonomy'].'">';
                    submit_button('Delete', 'delete small', 'submit', false, [
                        'onclick' => 'return confirm("Are you sure you want to delete this custom Taxonomy? The data associated with it wont be deleted. ");'
                    ]);

                    echo '</form></td></tr>';
				}

				echo '</table>';
			?>
        </div>

        <div id="tab-2" class="tab-pane <?php echo (isset($_POST['edit_taxonomy'])) ? 'active' : '' ?>">
            
            <form method="post" action="options.php">
                <?php 
                    settings_fields( 'mhamdy_plugin_tax_settings' );
                    do_settings_sections( 'mhamdy_taxonomy' );
                    submit_button();
                ?>
            </form>
        </div>

        <div id="tab-3" class="tab-pane">
            <h3>Export your Taxonomies</h3>
            
        </div>
    </div> 
</div>


