<?php if ( post_password_required() ) return ?>

<?php comment_form() ?>

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
