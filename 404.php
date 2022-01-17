<?php
/**
 * The template for displaying 404 pages (not found)
 *
 */
$img_404_page      = techrona_get_theme_opt('img_404_page',['url'=>get_template_directory_uri().'/assets/images/img-404.jpg']);
$heading           = techrona_get_theme_opt('heading_404_page',esc_html__("This  Page Are Can't Found",'techrona'));
$btn_text_404_page = techrona_get_theme_opt( 'btn_text_404_page', esc_html__('Go to home', 'techrona') );
get_header();
?>
    <div class="container kng-content-container kng-404-page">
        <div id="kng-content-area" class="kng-content-area text-center">
            <div class="kng-404-img"><img src="<?php echo esc_url($img_404_page['url']);?>"></div>
            
            <div class="bottom-wrap d-flex gutters-40 align-items-center justify-content-center">
                <div class="kng-404-heading h4"><?php echo esc_html($heading); ?></div>
                <div class="button-wrap">
                    <a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>">
                        <span class="kng-btn-content">
                            <span class="kng-btn-text"><?php printf('%s', $btn_text_404_page);?></span>
                            <span class="kng-btn-icon"><i class="kngi-arrow-right-solid"></i></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
 
</div>
</div>
</div>
<?php 
do_action( 'kng_anchor_target') ?>
<?php wp_footer(); ?>
</body>
</html>
