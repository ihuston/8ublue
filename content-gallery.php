<?php
/**
 * The template for displaying posts in the Gallery Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 */
?>

<?php if( is_single() ) { get_template_part( 'content' ); return; } //force normal single view of a 'gallery' post format ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php if ( is_single() ) : ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php else : ?>
            <h1 class="entry-title">
                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h1>
            <?php endif; // is_single() ?>
            <?php if ( comments_open() ) : ?>
                <div class="comments-link">
                    <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
                </div><!-- .comments-link -->
            <?php endif; // comments_open() ?>
        </header><!-- .entry-header -->

    <?php if ( is_search() ) : // Only display Excerpts for search pages ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
        <?php else : ?>
        <div class="entry-content">
            <?php if ( post_password_required() ) : ?>
                <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>

            <?php else : ?>
                <?php
                    $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
                    if ( $images ) :
                        $total_images = count( $images );
                        $image = array_shift( $images );
                        $image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
                ?>

                <figure class="gallery-thumb">
                    <a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
                </figure><!-- .gallery-thumb -->

                <p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'twentytwelve' ),
                        'href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ) . '" rel="bookmark"',
                        number_format_i18n( $total_images )
                    ); ?></em></p>
            <?php endif; ?>
            <?php the_excerpt(); ?>
        <?php endif; ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentytwelve' ) . '</span>', 'after' => '</div>' ) ); ?>
    </div><!-- .entry-content -->
    <?php endif; ?>

    <footer class="entry-meta">
        <?php $show_sep = false; ?>
        <?php
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );
            if ( $categories_list ):
        ?>
        <span class="cat-links">
            <?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'twentytwelve' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
            $show_sep = true; ?>
        </span>
        <?php endif; // End if categories ?>
        <?php
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );
            if ( $tags_list ):
            if ( $show_sep ) : ?>
        <span class="sep"> | </span>
            <?php endif; // End if $show_sep ?>
        <span class="tag-links">
            <?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'twentytwelve' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
            $show_sep = true; ?>
        </span>
        <?php endif; // End if $tags_list ?>

        <?php if ( comments_open() ) : ?>
        <?php if ( $show_sep ) : ?>
        <span class="sep"> | </span>
        <?php endif; // End if $show_sep ?>
        <span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '<b>1</b> Reply', 'twentytwelve' ), __( '<b>%</b> Replies', 'twentytwelve' ) ); ?></span>
        <?php endif; // End if comments_open() ?>

        <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

