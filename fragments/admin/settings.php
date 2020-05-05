<div class="wrap">
	<div id="icon-themes" class="icon32"></div>
	<h2>Blogfolio Theme Settings</h2>
	<?php settings_errors() ?>
	<?php $activetab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general' ?>
	<h2 class="nav-tab-wrapper">  
		<a href="?page=blogfolio-theme-settings&tab=general" class="nav-tab<?php echo $activetab == 'general' ? ' nav-tab-active' : '' ?>"><?php _e('General Options', 'blogfolio') ?></a>
		<a href="?page=blogfolio-theme-settings&tab=about" class="nav-tab<?php echo $activetab == 'about' ? ' nav-tab-active' : '' ?>"><?php _e('About Blogfolio', 'blogfolio') ?></a>
	</h2>
	<?php
		switch($activetab) {
			case 'about' :
				BlogfolioTemplate::loadFragment( 'admin/about' );
				break;
			case 'general' :
			default :
				echo '<form method="post" action="options.php">';
				settings_fields( Blogfolio::options );
				do_settings_sections( BlogfolioAdmin::settings_page );         
				submit_button();
				echo '</form>';
		}
	?>
</div>