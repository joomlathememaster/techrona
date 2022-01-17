<?php 
$url = get_site_url();
$email_text = $widget->get_setting('email_text','Your Email Address');
 ?>
<div class="kng-newsletter">
	<div class="tnp tnp-subscription">
		<form method="post" action="<?php echo esc_url($url).'/?na=s' ?>">
			<div class="form-wrap">
				<input class="tnp-email" type="email" name="ne" id="tnp-1" value="" required placeholder="<?php echo esc_html( $email_text ) ?>">	
				<button class="tnp-submit" type="submit" value="Submit"></button>
			</div>
		</form>
	</div>
</div>