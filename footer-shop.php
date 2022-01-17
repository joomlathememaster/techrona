<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 *
 */ 
$product_layout = techrona_get_theme_opt('product_layout','default');
?>	
		<?php if(is_singular('product') && $product_layout != '1'): ?>
		<div class="kng-single-product-content-bottom">
			<div class="container">
			<?php do_action( 'techrona_hook_shop_related'); ?>
			</div>
		</div>
		<?php endif; ?>
		</div>
	</div>
	<?php techrona_footer();?>
	</div>
	<?php do_action( 'kng_anchor_target') ?>
<?php wp_footer(); ?>
</body>
</html>
