<?php if( has_post_thumbnail() ) : ?>
<a class="post-thumbnail" href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>" rel="bookmark"><?php the_post_thumbnail() ?></a>
<?php endif ?>