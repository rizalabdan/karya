<?php

	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		

		<?php the_comments_navigation(); ?>

			<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'walker'	=> new \NexProperty\Comment_Walker,
				'avatar_size' => 80,
			) );
			?>

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'nexproperty' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments()

	$args = array(
		'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' => '<div class="form-field"><input id="author" placeholder="Name" name="name" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'"/></div>',

			'email' =>
			  '<div class="form-field"><input id="email" placeholder="Email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ). '"/></div>',
			'cookies' => '',
		)),
		'comment_field' => '<div class="form-field"><textarea name="comment" placeholder="'. esc_html__( 'Add a Comment', 'nexproperty' ).'"></textarea></div>',
		'class_form' => 'js-ajax-form',
		'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s">'. esc_html__( 'Post Comment', 'nexproperty' ).'</button>',
		'submit_field' => '<div class="form-submit">%1$s %2$s</div>',
		'label_submit' => esc_html__( 'Post Comment', 'nexproperty' ),
		'logged_in_as' => '',
		'comment_notes_before' => '',

	);
comment_form( $args );
