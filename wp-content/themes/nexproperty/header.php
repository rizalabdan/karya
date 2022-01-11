<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NexProperty
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    if(function_exists('w-body_open')){
        wp_body_open();
    } else {
        do_action('wp_body_open');
    }
    ?>
	<div class="wrapper">
        <a class="skip-link screen-reader-text" href="#content"><?php echo esc_html__( 'Skip to content', 'nexproperty' ); ?></a>
		<header>
			<div class="container">
				<div class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>">
						<?php if(( nexproperty_custom_logo() ) ) : ?>
							<img src="<?php echo esc_url( nexproperty_custom_logo()); ?>" alt="<?php echo esc_attr__('logo','nexproperty'); ?>">
						<?php else: ?>
							<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
						<?php endif; ?>
					</a>
				</div><!--icon-pr end-->
					<?php echo wp_nav_menu( array(
						'menu'  => 'Main Menu',
						'container'       => 'nav',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => '__return_false',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
                                                'theme_location' => is_user_logged_in() ? 'main_menu' : 'main_menu',
						'depth'           => 0,
					) ); ?>
						<a href="#test1" aria-expanded="false" data-set-focus=".close-nav-toggle" title="<?php echo esc_attr__( 'Mobile Menu' ,'nexproperty'); ?>" class="menu-btn"><i class="fa fa-bars"></i></a>
					<?php if( get_theme_mod( 'show_sign_in_button' ) == 'yes' || get_theme_mod( 'show_property_button' ) == 'yes' ) : ?>
					<div class="sign-in-pr">
						<ul class="sign">
							<?php if( get_theme_mod( 'show_sign_in_button' ) == 'yes' ) : ?>
								<?php if (!is_user_logged_in()): ?>
									<li><a href="<?php echo esc_url(wp_login_url());?>" class="sign_in"><i class="fas fa-user" aria-hidden="true"></i><?php echo esc_html( get_theme_mod( 'sign_in_button_text' ) ); ?></a></li>
								<?php else:?>
									<li><a href="<?php echo esc_url(wp_logout_url( get_permalink() )); ?>" class="sign_in"><i class="fa fa-sign-out" aria-hidden="true"></i><?php echo esc_html__('Log Out','nexproperty' ); ?></a></li>
								<?php endif;?>
							<?php endif; ?>
							<?php if( get_theme_mod( 'show_property_button' ) == 'yes' ) : ?>
								<li><a class="lnk-btn" href="<?php echo esc_url(wp_login_url());?>"><i class="fas fa-plus" aria-hidden="true"></i><?php echo esc_html( get_theme_mod( 'property_button_text' ) ); ?></a></li>
							<?php endif; ?>
						</ul>
					</div><!--sign-in-pr end-->
				<?php endif; ?>
			</div>
		</header><!--header end-->
		<div class="clearfix"></div>
			<?php echo wp_nav_menu( array(
				'menu'  => 'Main Menu',
				'container'       => 'div',
				'container_class' => 'mobile-menu',
				'container_id'    => '',
				'menu_class'      => 'menu',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => '__return_false',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
                                'theme_location' => is_user_logged_in() ? 'main_menu' : 'main_menu',
				'items_wrap'      => '<div><ul id = "%1$s" class = "%2$s">%3$s</ul></div>',
				'depth'           => 0,
			) ); ?>