<?php
/**
 * The template for displaying comments.
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package Soapee
 */

/*
 * If the current post is protected by a password and 
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
$comments_number = absint( get_comments_number() );
$post_comments_form_on = techrona_get_theme_opt( 'post_comments_form_on', true );
$post_title = get_the_title();
$wrap_class = 'comments-area kng-no-comments';
if(have_comments()) $wrap_class = 'comments-area';

if(is_page()) $wrap_class .= ' kng-page-comment';

if($post_comments_form_on) : ?>
    <div id="comments" class="<?php echo esc_attr($wrap_class);?>">
        <?php
        // You can start editing here -- including this comment!
        if ( have_comments() ) : ?>
            <div class="comment-list-wrap">
                <h4 class="comments-title"><?php
                    printf(
                        /* translators: 1: Number of comments, 2: Post title. */
                        _nx(
                            '%1$s Replies To “%2$s“',
                            '%1$s Replies To “%2$s“',
                            $comments_number,
                            $post_title,
                            'techrona'
                        ),
                        number_format_i18n( $comments_number ),
                        $post_title
                    );
                ?></h4>
                <ol class="commentlist">
                    <?php
                        wp_list_comments( array(
                            'style'      => 'ul',
                            'short_ping' => true,
                            'callback'   => 'techrona_comment_list'
                        ) );
                    ?>
                </ol>
                <nav class="navigation comments-pagination empty-none"><?php 
                    //the_comments_navigation(); 
                    paginate_comments_links([
                        'prev_text' => techrona_pagination_prev_text(),
                        'next_text' => techrona_pagination_next_text()
                    ]); 
                ?></nav>
            </div>
            <?php if ( ! comments_open() ) : ?>
                <div class="no-comments"><?php esc_html_e( 'Comments are closed.', 'techrona' ); ?></div>
            <?php
            endif;

        endif; // Check for have_comments().
        comment_form(techrona_comment_form_args());
    ?>
    </div>
<?php endif;