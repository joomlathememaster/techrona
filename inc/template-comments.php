<?php
/**
 * Move comment field to bottom
 */
function techrona_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	unset( $fields['cookies'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'techrona_comment_field_to_bottom' );
/**
 * Custom Comment List
 */
function techrona_comment_list( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
	?>
    <<?php echo ''.$tag ?> <?php comment_class( ['comment', empty( $args['has_children'] ) ? '' : 'parent' ]) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		    <div class="comment-inner">
		    	<div class="comment-wrap row">
			        <?php if ($args['avatar_size'] != 0) : ?>
			        	<div class="comment-avatar col-auto empty-none"><?php
			        		echo get_avatar($comment, techrona_configs('comment')['avatar-size']); 
			        	?></div>
			        <?php endif; ?>
			        <div class="comment-content col">
			        	<div class="row justify-content-between">
			        		<div class="col-auto d-flex flex-sm-row flex-column align-items-sm-center">
			        			<div class="kng-heading comment-title"><?php printf( '%s', get_comment_author_link() ); ?></div>
			        			<div class="comment-date empty-none"><?php echo get_comment_date('d F Y \A\t h\:i a') ?></div>
		        			</div>
		        			<div class="comment-reply col-auto">
			        			<?php
				            	comment_reply_link( array_merge( $args, array(
									'add_below' => $add_below,
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
									'reply_text' => esc_html__('Reply', 'techrona')
								) ) ); 
								?>
							</div>
		        		</div>
			        	<div class="comment-meta">
			            	<div class="comment-rating empty-none"><?php
			            		/**
							 * The woocommerce_review_before_comment_meta hook.
							 *
							 * @hooked woocommerce_review_display_rating - 10
							 */
			            		if(is_singular('product')){
									do_action( 'woocommerce_review_before_comment_meta', $comment );
								}
							?></div>
							<div class="empty-none"><?php
								/**
								 * The woocommerce_review_meta hook.
								 *
								 * @hooked woocommerce_review_display_meta - 10
								 */
								if(is_singular('product')){
									do_action( 'woocommerce_review_meta', $comment );
								}
							?></div>
			            </div>
			            <div class="before-comment-text empty-none"><?php
			            	if(is_singular('product')){ do_action( 'woocommerce_review_before_comment_text', $comment ); }
			            ?></div>
			            <div class="comment-text empty-none"><?php 
			            	comment_text(); 
			            	/**
							 * The woocommerce_review_comment_text hook
							 *
							 * @hooked woocommerce_review_display_comment_text - 10
							 */
			            	if(is_singular('product')){
								do_action( 'woocommerce_review_comment_text', $comment );
							}
			            ?></div>
			            <div class="after-comment-text empty-none"><?php 
			            	if(is_singular('product')){ do_action( 'woocommerce_review_after_comment_text', $comment ); }
			            ?></div>                         				 
			        </div>
		        </div>
		    </div>
		<?php if ( 'div' != $args['style'] ) : ?>
        </div>
	<?php endif;
}



add_filter( 'kng_comment_extra_control', 'techrona_comment_extra_control' );
function techrona_comment_extra_control ( $comment ) {
    $phone = get_comment_meta( $comment->comment_ID, 'phone', true );
    $subject = get_comment_meta( $comment->comment_ID, 'subject', true );
    $rating = get_comment_meta( $comment->comment_ID, 'rating', true );
    wp_nonce_field( 'techrona_comment_update', 'techrona_comment_update', false );

    $show_phone = techrona_get_theme_opt('post_comments_phone_on','1');
    $show_subject = techrona_get_theme_opt('post_comments_subject_on','1');
    $show_rating = techrona_get_theme_opt('post_comments_rating_on','0');

    ob_start();
    if($show_phone == '1'): ?>
    <p>
        <label for="phone"><?php esc_html_e( 'Phone','techrona' ); ?></label>
        <input type="text" name="phone" value="<?php echo esc_attr( $phone ); ?>" class="widefat" />
    </p>
    <?php 
    endif;

    
    if($show_subject == '1'): 
    	$post_comments_subject_option = techrona_get_theme_opt('post_comments_subject_option',[]);
	?>
    <p>
        <label for="subject"><?php esc_html_e( 'Subject','techrona' ); ?></label>
        <select id="subject" name="subject" class="widefat">
        	
        	<?php 
        	if(!empty($post_comments_subject_option))
    			foreach ($post_comments_subject_option as $sj) {
    				$selected = (sanitize_title($sj) === $subject) ? 'selected' : '';
    				echo '<option value="'.sanitize_title($sj).'" '.$selected.'>'.$sj.'</option>';
    			}
        	?>
        </select>
    </p>
    <?php 
    endif;

    
    if($show_rating == '1' && !class_exists('Woocommerce')): ?>
    <p>
        <label for="rating"><?php esc_html_e( 'Rating: ','techrona' ); ?></label>
			<span class="commentratingbox">
			<?php for( $i=1; $i <= 5; $i++ ) {
				echo '<span class="commentrating"><input type="radio" name="rating" id="rating" value="'. $i .'"';
				if ( $rating == $i ) echo ' checked="checked"';
				echo ' />'. $i .' </span>';
				}
			?>
 
    </p>
	<?php
	endif;
	return ob_get_contents();
}

add_action( 'edit_comment', 'techrona_comment_edit_metafields' );
function techrona_comment_edit_metafields( $comment_id ) {
    if( ! isset( $_POST['techrona_comment_update'] ) || ! wp_verify_nonce( sanitize_text_field($_POST['techrona_comment_update']), 'techrona_comment_update' ) ) return;
 
	if ( ( isset( $_POST['phone'] ) ) && ( $_POST['phone'] != '') ) :
		$phone = sanitize_text_field($_POST['phone']);
		update_comment_meta( $comment_id, 'phone', $phone );
	else :
		delete_comment_meta( $comment_id, 'phone');
	endif;
 
	if ( ( isset( $_POST['subject'] ) ) && ( $_POST['subject'] != '') ):
		$subject = sanitize_text_field($_POST['subject']);
		update_comment_meta( $comment_id, 'subject', $subject );
	else :
		delete_comment_meta( $comment_id, 'subject');
	endif;
 
	if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != '') ):
		$rating = sanitize_text_field($_POST['rating']);
		update_comment_meta( $comment_id, 'rating', $rating );
	else :
		delete_comment_meta( $comment_id, 'rating');
	endif;
 
}

/**
 * Comment form fields
**/
if(!function_exists('techrona_comment_form_args')){
	function techrona_comment_form_args($args = []){
		$args = wp_parse_args($args, []);
		// $show_phone = techrona_get_theme_opt('post_comments_phone_on','1');
	    // $show_subject = techrona_get_theme_opt('post_comments_subject_on','1');
		// $post_comments_subject_option = techrona_get_theme_opt('post_comments_subject_option',[]);
		$commenter = [
			'comment_author' => '',
			'comment_author_email' => ''
		];
		$kng_comment_fields = array(
			'id_form'              => 'commentform',
			'title_reply'          => esc_attr__( 'Leave a Comment', 'techrona'),
			'title_reply_to'       => esc_attr__( 'Leave a Comment To ', 'techrona') . '%s',
 			'cancel_reply_link'    => esc_attr__( 'Cancel Reply', 'techrona'),
 			'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h4>',
			'id_submit'            => 'submit',
			'class_submit'         => 'btn-primary',
			'label_submit'         =>  esc_attr__( 'Post Comment', 'techrona'),
			'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" /><span>%4$s</span></button>',
			'comment_notes_before' => '',
            'comment_field' 	   =>  '',
    	);

    	$kng_fields = [];
    	$kng_fields['open'] = '';
    	if(!is_user_logged_in()){
			$kng_fields['open'] .= techrona_comment_rating_fields([
				'echo' => false,
				'class' => 'mb-20'
			]);
			$kng_fields['open'] .= techrona_woocommerce_comment_rating_fields([
				'echo' => false,
				'class' => 'mb-20'
			]);
		}
		//open
    	$kng_fields['open'] .= '<div class="kng-comment-form-fields-wrap row gutters-30">';
		// author
		$kng_fields['author'] = '<div class="comment-form-field comment-form-author col-lg-6 col-md-6 col-sm-12">'.
        	'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        	'" size="30" placeholder="'.esc_attr__('Name', 'techrona').'"/></div>';

      //   if($show_phone == '1'){
    		// $kng_fields['phone'] = '<div class="comment-form-field comment-form-phone col-lg-6 col-md-6 col-sm-12">'.
      //   	'<input id="phone" name="phone" type="text" size="30" placeholder="'.esc_attr__('Phone Number', 'techrona').'"/></div>';
      //   }
        // email 
        $kng_fields['email'] = '<div class="comment-form-field comment-form-email col-lg-6 col-md-6 col-sm-12">'.
        	'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        	'" size="30" placeholder="'.esc_attr__('Email', 'techrona').'"/></div>';
        // subject   
        	//$post_comments_subject_option
   //  	if($show_subject == '1'){
   //  		$kng_fields['subject'] = '<div class="comment-form-field comment-form-subject col-lg-6 col-md-6 col-sm-12">'.
	  //       	'<select name="subject" id="subject">
	  //       		<option value="" disabled selected>'.esc_attr__('Subject:', 'techrona').'</option>';
	  //       		if(!empty($post_comments_subject_option))
	  //       			foreach ($post_comments_subject_option as $subject) {
	  //       				$kng_fields['subject'] .= '<option value="'.sanitize_title($subject).'">'.$subject.'</option>';
	  //       			}
			// $kng_fields['subject'] .= '</select></div>';
   //      } 
        $kng_fields['close'] = '</div>';

		$fields =  apply_filters( 'comment_form_default_fields', $kng_fields);
		$kng_comment_fields['fields'] = $fields;

		// Comment Field Message
		$kng_comment_fields['comment_field'] = '';
		if(is_user_logged_in()){
			$kng_comment_fields['comment_field'] .= techrona_comment_rating_fields([
				'echo' => false,
				'class' => 'mt-20'
			]);
			$kng_comment_fields['comment_field'] .= techrona_woocommerce_comment_rating_fields([
				'echo' => false,
				'class' => 'mt-20'
			]);
		}
		$kng_comment_fields['comment_field'] .= '<div class="kng-comment-form-fields-wrap kng-comment-form-fields-message row"><div class="comment-form-field comment-form-comment col-12"><textarea id="comment-msg" name="comment" cols="45" rows="8" placeholder="'.esc_attr__('Comment', 'techrona').'" aria-required="true">' .'</textarea></div></div>';
 

    	return $kng_comment_fields;
	}
}

if(!function_exists('techrona_comment_product_form_args')){
	function techrona_comment_product_form_args($args = []){
		$args = wp_parse_args($args, []);
		 
		$commenter = [
			'comment_author' => '',
			'comment_author_email' => ''
		];
		$kng_comment_fields = array(
			'id_form'              => 'commentform',
			'title_reply'          => esc_attr__( 'Leave a Review', 'techrona'),
			'title_reply_to'       => esc_attr__( 'Leave a Review To ', 'techrona') . '%s',
 			'cancel_reply_link'    => esc_attr__( 'Cancel Reply', 'techrona'),
 			'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h4>',
			'id_submit'            => 'submit',
			'class_submit'         => 'btn-primary',
			'label_submit'         =>  esc_attr__( 'Post Review', 'techrona'),
			'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" /><span>%4$s</span></button>',
			'comment_notes_before' => '',
            'comment_field' 	   =>  '',
    	);

    	$kng_fields = [];
    	$kng_fields['open'] = '';
    	if(!is_user_logged_in()){
			$kng_fields['open'] .= techrona_comment_rating_fields([
				'echo' => false,
				'class' => 'mb-20'
			]);
			$kng_fields['open'] .= techrona_woocommerce_comment_rating_fields([
				'echo' => false,
				'class' => 'mb-20'
			]);
		}
		//open
    	$kng_fields['open'] .= '<div class="kng-comment-form-fields-wrap row gutters-30">';
		// author
		$kng_fields['author'] = '<div class="comment-form-field comment-form-author col-lg-6 col-md-6 col-sm-12">'.
        	'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        	'" size="30" placeholder="'.esc_attr__('Full Name', 'techrona').'"/></div>';
 
        // email 
        $kng_fields['email'] = '<div class="comment-form-field comment-form-email col-lg-6 col-md-6 col-sm-12">'.
        	'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        	'" size="30" placeholder="'.esc_attr__('Email Address', 'techrona').'"/></div>';
         
        $kng_fields['close'] = '</div>';

		$fields =  apply_filters( 'comment_form_default_fields', $kng_fields);
		$kng_comment_fields['fields'] = $fields;

		// Comment Field Message
		$kng_comment_fields['comment_field'] = '';
		if(is_user_logged_in()){
			$kng_comment_fields['comment_field'] .= techrona_comment_rating_fields([
				'echo' => false,
				'class' => 'mt-20'
			]);
			$kng_comment_fields['comment_field'] .= techrona_woocommerce_comment_rating_fields([
				'echo' => false,
				'class' => 'mt-20'
			]);
		}
		$kng_comment_fields['comment_field'] .= '<div class="kng-comment-form-fields-wrap kng-comment-form-fields-message row"><div class="comment-form-field comment-form-comment col-12"><textarea id="comment-msg" name="comment" cols="45" rows="8" placeholder="'.esc_attr__('Your review', 'techrona').'" aria-required="true">' .'</textarea></div></div>';
 

    	return $kng_comment_fields;
	}
}


//Create the rating interface.
if(!function_exists('techrona_comment_rating_fields')){
	//add_action( 'comment_form_logged_in_after', 'techrona_comment_rating_fields' );
	//add_action( 'comment_form_before_fields', 'techrona_comment_rating_fields' );
	function techrona_comment_rating_fields ($args =[]) {
		$args = wp_parse_args($args, [
			'echo'  => true,
			'class' => ''
		]);
		$show_rating = techrona_get_theme_opt('post_comments_rating_on','0');
		$rating = '';
		if('1' === $show_rating && is_singular('post')){
			$rating .= '<div class="kng-comment-form-rating kng-comment-form-fields-wrap row gutters-20 align-items-center '.esc_attr($args['class']).'">';
				$rating .= '<div  class="comment-form-field col-auto">'. esc_html__('Your Rating','techrona').'<span class="required">*</span></div>';
				$rating .= '<div class="comment-form-field comments-rating col-auto">';
					$rating .= '<span class="rating-container d-flex gutters-12 stars">';
						for ( $i = 5; $i >= 1; $i-- ) :
							$rating .= '<input type="radio" id="rating-'.$i.'" class="star-'.$i.'" name="rating" value="'.$i.'" />
										<label for="rating-'.$i.'"><span class="d-none">'.$i.'</span></label>';
						endfor;
						//$rating .= '<input type="radio" id="rating-0" class="star-cb-clear star-0" name="rating" value="0" /><label for="rating-0"><span class="d-none">0</span></label>';
					$rating .= '</span>
				</div>
			</div>';
		}
		if($args['echo']){
			printf('%s', $rating);
		} else {
			return $rating;
		}
	}
}
if(!function_exists('techrona_woocommerce_comment_rating_fields')){
	function techrona_woocommerce_comment_rating_fields($args =[]){
		$args = wp_parse_args($args, [
			'echo' => true,
			'class' => ''
		]);
		$rating = '';
		if(!function_exists('wc_review_ratings_enabled')) return;
		if (wc_review_ratings_enabled() && is_singular('product') ) {
			$rating .= '<div class="kng-comment-form-rating kng-comment-form-fields-wrap row gutters-12 align-items-center '.esc_attr($args['class']).'">';
				$rating .= '<div class="comment-form-field col-auto">' . esc_html__( 'Your rating of this product', 'techrona' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</div>';
				$rating .= '<div class="comment-form-field comments-rating col">';
					$rating .= '<select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'techrona' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'techrona' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'techrona' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'techrona' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'techrona' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'techrona' ) . '</option>
					</select>';
				$rating .= '</div>';
			$rating .= '</div>';
		}
		if($args['echo']){
			printf('%s', $rating);
		} else {
			return $rating;
		}
	}
}
 

//Save the new meta added by theme  submitted by the user.
//https://www.hoangweb.com/wordpress/using-default-wordpress-comment-system-for-single-post
if(!function_exists('techrona_comment_save_comment_meta')){
	add_action( 'comment_post', 'techrona_comment_save_comment_meta' );
	function techrona_comment_save_comment_meta( $comment_id ) {
		// phone
		if ( ( isset( $_POST['phone'] ) ) && ( sanitize_text_field($_POST['phone']) != '') )
			$phone = sanitize_text_field( sanitize_text_field($_POST['phone']));
		// rating
		if ( ( isset( $_POST['rating'] ) ) && ( '' !== sanitize_text_field($_POST['rating']) ) )
			$rating = intval( sanitize_text_field( $_POST['rating']) );
		// subject
		if ( ( isset( $_POST['subject'] ) ) && ( '' !== sanitize_text_field($_POST['subject']) ) )
			$subject = sanitize_text_field($_POST['subject']);

		add_comment_meta( $comment_id, 'phone', $phone );
		add_comment_meta( $comment_id, 'rating', $rating );
		add_comment_meta( $comment_id, 'subject', $subject );
	}
}
// Make the rating required.
if(!function_exists('techrona_comment_rating_require_rating')){
	add_filter( 'preprocess_comment', 'techrona_comment_rating_require_rating' );
	function techrona_comment_rating_require_rating( $commentdata ) {
		$show_rating = techrona_get_theme_opt('post_comments_rating_on','0');
		if('1' !== $show_rating) return $commentdata;

		if ( ! is_admin() && ( ! isset( $_POST['rating'] ) || 0 === intval( sanitize_text_field($_POST['rating']) ) ) )
		wp_die( esc_html__( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.','techrona' ) );
		return $commentdata;
	}
}
 




//Get the average rating of a post.
if(!function_exists('techrona_comment_rating_get_average_ratings')){
	function techrona_comment_rating_get_average_ratings( $id ) {
		$comments = get_approved_comments( $id );
		if ( $comments ) {
			$i = 0;
			$total = 0;
			foreach( $comments as $comment ){
				$rate = get_comment_meta( $comment->comment_ID, 'rating', true );
				if( isset( $rate ) && '' !== $rate ) {
					$i++;
					$total += $rate;
				}
			}

			if ( 0 === $i ) {
				return false;
			} else {
				return round( $total / $i, 1 );
			}
		} else {
			return false;
		}
	}
}
// Display the star average rating only
if(!function_exists('techrona_comment_rating_display_average')){
	function techrona_comment_rating_display_average() {

		global $post;

		if ( false === techrona_comment_rating_get_average_ratings( $post->ID ) ) {
			return false;
		}
		
		$stars   = '';
		$average = techrona_comment_rating_get_average_ratings( $post->ID );

		for ( $i = 1; $i <= $average + 1; $i++ ) {
			
			$width = intval( $i - $average > 0 ? 20 - ( ( $i - $average ) * 20 ) : 20 );

			if ( 0 === $width ) {
				continue;
			}
			$stars .= '<span style="overflow:hidden; width:' . $width . 'px" class="rating-icon kng-rating-icon-filled"></span>';

			if ( $i - $average > 0 ) {
				$stars .= '<span style="overflow:hidden; position:relative; left:-' . $width .'px;" class="kng-rating-icon kng-rating-icon-empty"></span>';
			}
		}
		$custom_content  = '<div class="kng-average-rating kng-average-rating-star">' . $stars .'</div>';
		return $custom_content;
	}
}
 
if(!function_exists('techrona_comment_rating_display_feedback')){
	function techrona_comment_rating_display_feedback($args=[]){
		$args = wp_parse_args($args,[
			'id'        => get_the_ID(),
			'mode'      => 'good', //bad
			'good_text' => esc_html__('positive feedback', 'techrona'),
			'bad_text'  => esc_html__('negative feedback', 'techrona'),
			'good_icon' => 'icofont-simple-smile',
			'bad_icon'  => 'icofont-sad'
		]);
		$comments = get_approved_comments( $args['id'] );
		if ( $comments ) {
			$i = 0;
			$total = 0;
			$good_rate = $bad_rate = 0;
			foreach( $comments as $comment ){
				$rate = get_comment_meta( $comment->comment_ID, 'rating', true );
				if( isset( $rate ) && '' !== $rate ) {
					$i++;
					$total += $rate;
				}
				if(isset($rate) && $rate > 3){
					$good_rate ++;
				}
				if(isset($rate) && $rate <= 3){
					$bad_rate ++;
				}
			}

			if ( 0 === $i ) {
				return false;
			} else {
				//return  $total .' good:'.$good_rate.' bad:'.$bad_rate ;
				if($args['mode'] == 'good'){
					return '<span class="kng-rating-good text-accent text-17 '.$args['good_icon'].'"></span> <span class="kng-rating-percent text-accent font-700">'.number_format_i18n( $good_rate*100 / $i, 2 ).'%</span> '.$args['good_text'];
				} else {
					return '<span class="kng-rating-bad text-accent text-17 '.$args['bad_icon'].'"></span> <span class="kng-rating-percent text-accent font-700">'.number_format_i18n( $bad_rate*100 / $i, 2 ).'%</span> '.$args['bad_text'];
				}
			}
		} else {
			return false;
		}
	}
}