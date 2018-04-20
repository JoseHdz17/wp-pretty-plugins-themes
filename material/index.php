<div class="wrap">
	<?php screen_icon('plugins'); ?>

	<!-- Begin feedback notice. Used for the new Plugin's interface. Remove once the recollection of feedback is closed. -->
	<div class="updated notice">
    <p>Web Publishing has redesigned the Plugin interface. We would like to receive your feedback! <a class="material-button-primary button-large" style="color: white; text-decoration: none; pointer: cursor;" href="https://goo.gl/forms/sjuLfJ34NhfI3r2D2" target="_blank">Submit feedback</a></p>
	</div>
	<!-- End feedback notice -->

	<h2><?php echo stripslashes($this->options['plugins_page_title']); ?></h2>
	<p><?php echo stripslashes($this->options['plugins_page_description']); ?></p>

	<!-- Begin Category Navigation Menu -->
	<div id="current-theme" class="wp-filter plugin-categories">
		<div class="theme-options plugin-options">
			<!-- Plugin count-->
			<div class="filter-count">
				<span class="count plugin-count"><?php echo count( $plugins ); ?></span>
			</div>

			<!--<div class="type categories">-->
				<!-- This section displays the "Choose category to display" text, which we want to remove to clean the UI -->
				<!--<span><?php //_e('Choose category to display:', 'wmd_prettyplugins'); ?></span>-->

				<!-- Display the categories -->
				<nav role="navigation">
					<ul id="plugin-categories-list" class="filter-links">
						<li><a href="#" class="all"><?php _e('All', 'wmd_prettyplugins'); ?></a></li>
						<?php
						foreach($plugins_categories as $plugins_category_id => $plugins_category)
							echo '<li><a href="#" class="'.$plugins_category_id.'">'.$plugins_category.'</a></li>';
						?>
					</ul>
				</nav>


			<!--</div>
			<div class="type sort">-->

			<!-- Delete the text "Search" so as to clean the interface -->
			<!-- <span><?php //_e('Sort by:', 'wmd_prettyplugins'); ?></span> -->
			<nav role="navigation">
				<ul id="plugin-status-list" class="filter-links">
					<li><a href="#" class="all"><?php _e('All', 'wmd_prettyplugins'); ?></a></li>
					<li><a href="#" class="active"><?php _e('Active', 'wmd_prettyplugins'); ?></a></li>
					<li><a href="#" class="inactive"><?php _e('Inactive', 'wmd_prettyplugins'); ?></a></li>
				</ul>
			</nav>
			<!-- </div>-->

			<!-- Search box -->
			<div class="search-form" role="search">
				<!-- Delete the text "Search" so as to clean the interface -->
				<!--<span><?php //_e('Search:', 'wmd_prettyplugins'); ?> </span>-->

				<!-- Label for accessibility purposes-->
				<label class="screen-reader-text" for="theme-search-input">Search installed plugins</label>
				<input type="search" id="theme-search-input" class="plugin-search-input" name="s" placeholder="<?php _e('Start typing to search', 'wmd_prettyplugins'); ?>" value="">
			</div>

		</div>
	</div>
	<!-- End Category Navigation Menu -->

	<div id="availableplugins">
		<!-- Begin individual plugin card -->
		<?php
		foreach($plugins as $plugin_path => $plugin) {
			// Assign plugin name to the aria-describedby id attribute
			$aria_action = esc_attr( $plugin['Name'] . '-action' );
			$aria_name   = esc_attr( $plugin['Name'] . '-name' );

			// Replace whitespace with dashes. This ensures that the ID is a single string
			$aria_action = preg_replace("/[\s_]/", "-", $aria_action);
			$aria_name = preg_replace("/[\s_]/", "-", $aria_name);
		?>


		<div tabindex="0" data-id="id-<?php echo $plugin['ListID']; ?>" data-type="<?php echo (isset($plugin['Categories'])) ? implode(' ', $plugin['Categories']) : 'all'; echo ($plugin['isActive'] == 1) ? ' active' : ' inactive'; ?>" class="available-plugin<?php echo ($plugin['isActive'] == 1) ? ' active-plugin' : ' inactive-plugin'; ?>" aria-describedby="<?php echo $aria_action . ' ' . $aria_name; ?>">
				<a href="<?php echo $plugin['ActionLink']; ?>" class="screenshot">
					<img src="<?php echo $plugin['ScreenShot']; ?>" alt="<?php echo $plugin['Name']; ?>">
					<span class="material-more-details"><?php echo $plugin['ActionLinkText'] . " plugin";?></span>
				</a>


					<div class="material-plugin-wrapper">
						<h3 id="<?php echo $aria_name; ?>"><?php echo $plugin['Name']; ?></h3>
						<p>
							<?php
								// strip plugin's excessive text to avoid text overflow
								$description_trimmed = wp_trim_words( $plugin['Description'], $num_words = 35, $more = null );
								echo $description_trimmed ;
							?>
						</p>


						<!-- Action links -->
						<div class="material-button-wrapper action-links">

							<!-- Activate/Deactivate Plugin -->
							<a tabindex="0" id="<?php echo $aria_action; ?>" role="button" href="<?php echo $plugin['ActionLink']; ?>" class="material-button-primary material-button  button-large <?php echo $plugin['ActionLinkClass']; ?> activate-deactivate" title="<?php echo $plugin['ActionLinkText'];?>"><?php echo $plugin['ActionLinkText']; ?> </a>

							<!-- Learn More Button -->
							<?php if(isset($plugin['PluginLink'])) { ?>
							<a class="material-button button button-large" style="color: #000;" href="<?php echo $plugin['PluginLink']; ?>" target="_blank" title="<?php _e('Learn more about the plugin', 'wmd_prettyplugins') ?>"><?php echo stripslashes($this->options['plugins_link_label']); ?></a>
							<?php } ?>

							<!-- Additional action links thrown by some plugins. -->
							<?php
							foreach ($plugin['Actions'] as $action)
							//	echo '<span class="material-button button button-large"><a href="' . $plugin['Actions'] . '">' . $action . '</a></span>';
							echo '<span class="material-button button button-large" role="button">' . $action . '</span>';
							?>

					</div>
				</div>
		</div>

		<?php
		}
		?>
	</div>
	<!-- End individual plugin card -->

	<div class="no-plugins-found" style="display:none;"><p><?php _e('No plugins found.', 'wmd_prettyplugins'); ?></p></div>
</div>

<!-- Category and search box -->
<script id="tmpl-category" type="text/template">
	<a data-sort="{{ data.Name }}" class="plugin-section plugin-category" href="#">{{ data[0] }}</a>
</script>
