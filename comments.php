<?php if ( post_password_required() ) return ?>

<?php if( have_comments() ) : ?>
	<h2 class="comments-title">
		<?php
			printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'blogfolio' ),
				number_format_i18n( get_comments_number() ),
				'<span>' . get_the_title() . '</span>'
			);
		?>
	</h2>

	<ol class="commentlist">
		<?php wp_list_comments() ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 ) : ?>
	<nav id="comment-nav-below" class="navigation" role="navigation">
		<h2 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'blogfolio' ) ?></h2>
		<?php paginate_comments_links() ?>
	</nav>
	<?php endif ?>

	<?php if ( !comments_open() && get_comments_number() ) : ?>
	<p class="nocomments"><?php _e( 'Comments are closed.' , 'blogfolio' ) ?></p>
	<?php endif ?>

<?php endif ?>

<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = $req ? " aria-required='true'" : '';

	comment_form( array(
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'blogfolio' ) . '</label><br/><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /> <label for="author">' . __( 'Name', 'blogfolio' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
			'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /> <label for="email">' . __( 'Email', 'blogfolio' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
			'url' => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> <label for="url">' . __( 'Website', 'blogfolio' ) . '</label></p>'
		))
	) );
