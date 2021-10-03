<?php if ( post_password_required() ) return ?>

<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = $req ? ' aria-required="true"' : '';

	comment_form( [
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'blitch' ) . '</label><br/><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" style="box-sizing:border-box;max-width:100%"></textarea></p>',
		'fields' => apply_filters( 'comment_form_default_fields', [
			'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /> <label for="author">' . __( 'Name', 'blitch' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
			'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /> <label for="email">' . __( 'Email', 'blitch' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
			'url' => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> <label for="url">' . __( 'Website', 'blitch' ) . '</label></p>'
		])
	] );
?>

<?php if( have_comments() ) : ?>
	<div id="commentlist">
		<h2 class="comments-heading heading">
			<?php
				printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'blitch' ),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h2>

		<?php wp_list_comments() ?>

		<?php if ( get_comment_pages_count() > 1 ) : ?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h3 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'blitch' ) ?></h3>
				<?php paginate_comments_links() ?>
			</nav>
		<?php endif ?>
	</div>

	<?php if ( !comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'blitch' ) ?></p>
	<?php endif ?>
<?php endif ?>
