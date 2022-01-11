<?php



function ocdi_import_files() {
	return [
	  [
		'import_file_name'           => 'NexProperty Real Estate',
		'local_import_file'            => trailingslashit( get_template_directory() ) . 'includes/ocdi/demo/demo-content.pac',
		/*'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'ocdi/widgets.json',
		'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'ocdi/customizer.dat',
		'local_import_redux'           => [
		  [
			'file_path'   => trailingslashit( get_template_directory() ) . 'ocdi/redux.json',
			'option_name' => 'redux_option_name',
		  ],
		],*/
		'import_preview_image_url'   => get_template_directory_uri() . '/includes/ocdi/demo/preview_estates.jpg',
		'preview_url'                => 'https://www.wpdirectorykit.com/nexproperty/home-page/',
	],
	[
		'import_file_name'           => 'NexProperty Cars',
		'local_import_file'            => trailingslashit( get_template_directory() ) . 'includes/ocdi/demo/demo-content.pac',
		/*'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'ocdi/widgets.json',
		'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'ocdi/customizer.dat',
		'local_import_redux'           => [
		  [
			'file_path'   => trailingslashit( get_template_directory() ) . 'ocdi/redux.json',
			'option_name' => 'redux_option_name',
		  ],
		],*/
		'import_preview_image_url'   => get_template_directory_uri() . '/includes/ocdi/demo/preview_cars.jpg',
	  ]
	];
  }
  add_filter( 'ocdi/import_files', 'ocdi_import_files' );

  function ocdi_register_plugins( $plugins ) {
	$theme_plugins = [
	  [ // A WordPress.org plugin repository example.
		'name'     => 'Elementor', // Name of the plugin.
		'slug'     => 'elementor', // Plugin slug - the same as on WordPress.org plugin repository.
		'required' => true,                     // If the plugin is required or not.
	  ],
	  [ // A locally theme bundled plugin example.
		'name'     => 'Element Invader',
		'slug'     => 'elementinvader',         // The slug has to match the extracted folder from the zip.
		'required' => true,
	  ],
	  [ // A locally theme bundled plugin example.
		'name'     => 'ElementInvader Addons for Elementor',
		'slug'     => 'elementinvader-addons-for-elementor',         // The slug has to match the extracted folder from the zip.
		'required' => true,
	  ],
	  [ // A locally theme bundled plugin example.
		'name'     => 'WP Directory Kit',
		'slug'     => 'wpdirectorykit',         // The slug has to match the extracted folder from the zip.
		'required' => true,
	  ],
	  /*[ // A locally theme bundled plugin example.
		'name'     => 'Profile Picture Uploader',
		'slug'     => 'profile-picture-uploader',         // The slug has to match the extracted folder from the zip.
		'source'   => get_template_directory() . '/includes/tgm_pa/plugins/profile-picture-uploader.pac',
		'required' => false,
		'preselected' => true,
	  ],*/
	  /*[ // A locally theme bundled plugin example.
		'name'     => 'Sweet Energy Efficiency',
		'slug'     => 'sweet-energy-efficiency',         // The slug has to match the extracted folder from the zip.
		'required' => false,
		'preselected' => true,
	  ],*/
	];

	return array_merge( $plugins, $theme_plugins );
  }
  add_filter( 'ocdi/register_plugins', 'ocdi_register_plugins' );

 /* after import */
function ocdi_after_import_setup($selected_import) {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
 
    set_theme_mod( 'nav_menu_locations', array(
            'main-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function in your theme.
	));

	$main_menu = get_term_by( 'Menu 1', 'Main Menu', 'nav_menu', 'Menu 1' );

	if(!$main_menu) {
		$main_menu = wp_get_nav_menu_object("Menu 1" );
		set_theme_mod( 'nav_menu_locations', array(
			'main-menu' => $main_menu->term_id,
			'main_menu' => $main_menu->term_id,
		));
	}
 
    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home Page' );
    $listing_page_id  = get_page_by_title( 'Listing Preview' );
    $results_page_id  = get_page_by_title( 'Grid map' );
    $page_for_posts_id = get_page_by_title( 'Blog' );
 
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $page_for_posts_id->ID );
	
	if($listing_page_id)
		update_option( 'wdk_listing_page', $listing_page_id->ID, TRUE);
	
	if($results_page_id)
		update_option( 'wdk_results_page', $results_page_id->ID, TRUE);

	/* remove default post */
		
	$post_default= get_page_by_title('Hello world!', OBJECT, 'post');
	if($post_default)
		wp_delete_post(  $post_default->ID, true );

	/* import wdk content */
	$WMVC = &wdk_get_instance();

	if ( 'NexProperty Cars' === $selected_import['import_file_name'] ) {
		$_GET['multipurpose'] = 'car-dealer.xml';
    }

	$WMVC->load_controller('wdk_settings','api_import');
 
	/* udpate posts */	
	$posts = get_posts( array(
		'numberposts'=> 5,
		'orderby'   => 'id',
		'order'      => 'ASC',
		'post_type'  => 'post',
	));

	$date = date('Y-m-d H:i:s');
	foreach($posts as $post) {
		$post_udpate = array();
		$post_udpate['ID'] = $post->ID;
		$post_udpate['post_date'] = $date;
		$post_udpate['post_date_gmt'] = $date;
		$post_udpate['post_modified'] = $date;
		$post_udpate['post_modified_gmt'] = $date;
		wp_update_post($post_udpate );
	}

	/* Replace Links */
	/* login */
		
	$from = 'https://www.wpdirectorykit.com/nexproperty/wp-admin/admin.php?page=wdk_listing';
	$to = get_admin_url();
	nexproperty_replace_links($from, $to);

	$from = 'https://www.wpdirectorykit.com/nexproperty/wp-admin/';
	$to = get_admin_url();
	nexproperty_replace_links($from, $to);

	$from = 'https://www.wpdirectorykit.com/nexproperty/index.php/login/';
	$to = get_admin_url();
	nexproperty_replace_links($from, $to);
	
	$from = 'https://www.wpdirectorykit.com/nexproperty';
	$to = get_home_url();
	nexproperty_replace_links($from, $to);
	
	/* homepage */
	$from = 'home_page_link_replace';
	$to = get_home_url();
	nexproperty_replace_links($from, $to);
	
	/* homepage */
	$from = '2020';
	$to = date('Y');
	nexproperty_replace_links($from, $to);
	
	/* wdk_listing_preview_feature_category */
	$from = 'wdk_listing_preview_feature_category';
	$to = 26;
	nexproperty_replace_links($from, $to);
	if ( 'NexProperty Cars' === $selected_import['import_file_name'] ) {
		/* homepage */
		$from = 'Properties';
		$to = 'Cars';
		nexproperty_replace_links($from, $to);
		$from = 'Popular House Types';
		$to = 'Popular Car Types';
		nexproperty_replace_links($from, $to);
		$from = 'House';
		$to = 'Car';
		nexproperty_replace_links($from, $to);
		$from = 'Add Property'; 
		$to = 'Add Car';
		nexproperty_replace_links($from, $to);
    }

	/* custom_logo */
	if(function_exists('wmvc_add_wp_image')) {
		$custom_logo_id = wmvc_add_wp_image(get_template_directory() .'/assets/images/logo.jpg');
		set_theme_mod( 'custom_logo', $custom_logo_id );

    	set_theme_mod( 'change_footer_logo', get_template_directory_uri() .'/assets/images/logo5.png');
				
		$custom_logo_id = wmvc_add_wp_image(get_template_directory() .'/assets/images/fav.jpg');
		update_option( 'site_icon', $custom_logo_id );
	}

	set_theme_mod( 'footer_content', esc_html__('Aenean sollicitudin, lorem quis bibend auctor, nisi elit consequat ipsum, necittis sem nibh id elit. Duis sed odio enim.', 'nexproperty') );
	set_theme_mod( 'footer_phone_number', '(917) 382-2057' );
	set_theme_mod( 'footer_email_address', 'agent@info.com' );
	set_theme_mod( 'footer_copyright_text', 'Copyright © '.date('Y').' NexProperty' );

	/* sidebar */
	if(true){
		/* clear */
		$sidebars_widgets = get_option( 'sidebars_widgets' );
		$sidebars_widgets['sidebar-1'] = array();
		update_option('sidebars_widgets', $sidebars_widgets); //update sidebars
		
		nexproperty_insert_widget('sidebar-1', 'search');
		nexproperty_insert_widget('sidebar-1', 'recent-posts');
		nexproperty_insert_widget('sidebar-1', 'categories');

		/* clear */
		$sidebars_widgets = get_option( 'sidebars_widgets' );
		$sidebars_widgets['sidebar'] = array();
		update_option('sidebars_widgets', $sidebars_widgets); //update sidebars
		
		nexproperty_insert_widget('sidebar', 'search');
		nexproperty_insert_widget('sidebar', 'recent-posts');
		nexproperty_insert_widget('sidebar', 'categories');

		/* clear */
		$sidebars_widgets = get_option( 'sidebars_widgets' );
		$sidebars_widgets['footer'] = array();
		update_option('sidebars_widgets', $sidebars_widgets); //update sidebars
		
		nexproperty_insert_widget('footer', 'text', array('title' => esc_html__('Popular Properties', 'nexproperty'), 'text'=>'[wdk-latest-listings-list]'));
		nexproperty_insert_widget('footer', 'recent-posts');
		nexproperty_insert_widget('footer', 'text', array('title' => esc_html__('Newsletter', 'nexproperty'), 'text'=>'[eli-newsletter]'));
	}

	/* header buttons */
	if(true){
		set_theme_mod('show_sign_in_button','yes');
		set_theme_mod('show_property_button','yes');
		set_theme_mod('sign_in_button_text', esc_html__('Sign In', 'nexproperty'));

		if ( 'NexProperty Cars' === $selected_import['import_file_name'] ) {
			set_theme_mod('property_button_text', esc_html__('Add Car', 'nexproperty'));
		} else {
			set_theme_mod('property_button_text', esc_html__('Add Property', 'nexproperty'));
		}
	}
	
}

function nexproperty_replace_links($from = '', $to = '') {
	global $wpdb;
	// @codingStandardsIgnoreStart cannot use `$wpdb->prepare` because it remove's the backslashes
	$rows_affected = $wpdb->query(
		"UPDATE {$wpdb->postmeta} " .
		"SET `meta_value` = REPLACE(`meta_value`, '" . str_replace( '/', '\\\/', $from ) . "', '" . str_replace( '/', '\\\/', $to ) . "') " .
		"WHERE `meta_key` = '_elementor_data' AND `meta_value` LIKE '[%' ;" );
	/* end login */
}

add_action( 'ocdi/after_import', 'ocdi_after_import_setup' );

if(!function_exists('nexproperty_insert_widget'))
{
    function nexproperty_insert_widget($sidebar_id, $widget_name, $widget_options_new = array())
    {
        static $sidebar_cleared = array();
        
        static $widgets_array = array();
        $id = 1;
        
        if(isset($widgets_array[$widget_name])) {
            $widgets_array[$widget_name]++;
            $id = $widgets_array[$widget_name];
        } else {
            $widgets_array[$widget_name] = $id;
        }
        
        $sidebars_widgets = get_option( 'sidebars_widgets' );
        /* set teme mod */ 
        
        $widget_options = get_option('widget_'.$widget_name);
        if(empty($widget_options)) {
			$widget_options = array('_multiwidget'=>1);
		}
        $widget_options[$id] = array('title'=>'');
        
        $widget_options[$id] = $widget_options_new;
        
        
        // [Check and skip import if found]
        $skip_widget_import = false;
        if(isset($sidebars_widgets[$sidebar_id]))
        foreach($sidebars_widgets[$sidebar_id] as $val)
        {
            if(strpos($val, $widget_name) !== false)
                $skip_widget_import = true;
        }
        if(false && $skip_widget_import)
        {
            return FALSE;
        }
        // [/Check and skip import if found]

        if(isset($sidebars_widgets[$sidebar_id]) && !in_array($widget_name.'-'.$id, $sidebars_widgets[$sidebar_id])) { //check if sidebar exists and it is empty
            
            if(empty($sidebars_widgets[$sidebar_id]))
            {
                $sidebars_widgets[$sidebar_id] = array($widget_name.'-'.$id); //add a widget to sidebar
            }
            else
            {
                $sidebars_widgets[$sidebar_id][] = $widget_name.'-'.$id;
            }

            update_option('widget_'.$widget_name, $widget_options); //update widget default options
            update_option('sidebars_widgets', $sidebars_widgets); //update sidebars
        }
        else // if sidebar doesn't exists'
        {
            $sidebars_widgets[$sidebar_id] = array($widget_name.'-'.$id); //add a widget to sidebar
            $sidebars_widgets[$sidebar_id][] = $widget_name.'-'.$id;

            update_option('widget_'.$widget_name, $widget_options); //update widget default options
            update_option('sidebars_widgets', $sidebars_widgets); //update sidebars
        }

        
        return TRUE;
    }
}