<?php
add_action( 'admin_enqueue_scripts', function(){
    wp_enqueue_style( 'font-kngi', get_template_directory_uri() . '/assets/fonts/font-kngi/style.css', array(), '1.0.0'  );
    wp_enqueue_style( 'font-kngf', get_template_directory_uri() . '/assets/fonts/font-kngf/flaticon.css', array(), '1.0.0'  );
    wp_enqueue_style( 'font-kngfi', get_template_directory_uri() . '/assets/fonts/font-kngfi/flaticon1.css', array(), '1.0.0'  );
} );
// add icon to cms icon picker 
if(!function_exists('techrona_iconpicker')){
    add_filter("redux_kng_iconpicker_field/get_icons", 'techrona_kngi');
    add_filter("redux_kng_iconpicker_field/get_icons", 'techrona_kngf');
    add_filter("redux_kng_iconpicker_field/get_icons", 'techrona_kngfi');
    function techrona_kngi($icons){
        unset($icons['New in 4.6']);
        unset($icons['Web Application Icons']);
        unset($icons['Medical Icons']);
        unset($icons['Text Editor Icons']);
        unset($icons['Spinner Icons']);
        unset($icons['File Type Icons']);
        unset($icons['Directional Icons']);
        unset($icons['Video Player Icons']);
        unset($icons['Form Control Icons']);
        unset($icons['Transportation Icons']);
        unset($icons['Chart Icons']);
        unset($icons['Brand Icons']);
        unset($icons['Hand Icons']);
        unset($icons['Payment Icons']);
        unset($icons['Currency Icons']);
        unset($icons['Accessibility Icons']);
        unset($icons['Gender Icons']);
        $icons['KNG techrona 1'] = [
            array('kngi-auction'                  => 'auction'),
            array('kngi-trophy-alt'               => 'trophy-alt'),
            array('kngi-diploma'                  => 'diploma'),
            array('kngi-briefcase-medical'        => 'briefcase-medical'),
            array('kngi-users'                    => 'users'),
            array('kngi-window-close-regular'     => 'window-close-regular'),
            array('kngi-envelope-open-regular'    => 'envelope-open-regular'),
            array('kngi-user-alt'                 => 'user-alt'),
            array('kngi-heart-regular'            => 'heart-regular'),
            array('kngi-dribbble-brands'          => 'dribbble-brands'),
            array('kngi-youtube-brands'           => 'youtube-brands'),
            array('kngi-behance-brands'           => 'behance-brands'),
            array('kngi-calendar-alt-regular'     => 'calendar-alt-regular'),
            array('kngi-clock-regular'            => 'clock-regular'),
            array('kngi-marker-alt'               => 'marker-alt'),
            array('kngi-envelope-regular'         => 'envelope-regular'),
            array('kngi-phone-alt1'               => 'phone-alt1'),
            array('kngi-angle-down-solid'         => 'angle-down-solid'),
            array('kngi-phone1'                   => 'phone1'),
            array('kngi-email1'                   => 'email1'),
            array('kngi-search-400'               => 'search-400'),
            array('kngi-search-solid'             => 'search-solid'),
            array('kngi-share-alt'                => 'share-alt'),
            array('kngi-comments-regular'         => 'comments-regular'),
            array('kngi-arrow-right-solid'        => 'arrow-right-solid'),
            array('kngi-heart'                    => 'heart'),
            array('kngi-comment-alt1'             => 'comment-alt1'),
            array('kngi-comment-dots1'            => 'comment-dots1'),
            array('kngi-comment1'                 => 'comment1'),
            array('kngi-comments1'                => 'comments1'),
            array('kngi-comment-alt'              => 'comment-alt'),
            array('kngi-comment-dots'             => 'comment-dots'),
            array('kngi-comment'                  => 'comment'),
            array('kngi-comments'                 => 'comments'),
            array('kngi-user1'                    => 'user1'),
            array('kngi-user'                     => 'user'),
            array('kngi-folder1'                  => 'folder1'),
            array('kngi-folder-open1'             => 'folder-open1'),
            array('kngi-folder-open'              => 'folder-open'),
            array('kngi-folder'                   => 'folder'),
            array('kngi-arrow-circle-alt-left'    => 'arrow-circle-alt-left'),
            array('kngi-plus-circle-01'           => 'plus-circle-01'),
            array('kngi-alert'                    => 'alert'),
            array('kngi-arrow-alt-circle-down'    => 'arrow-alt-circle-down'),
            array('kngi-arrow-alt-circle-left'    => 'arrow-alt-circle-left'),
            array('kngi-arrow-alt-circle-right'   => 'arrow-alt-circle-right'),
            array('kngi-arrow-alt-circle-up'      => 'arrow-alt-circle-up'),
            array('kngi-arrow-circle-down'        => 'arrow-circle-down'),
            array('kngi-arrow-circle-left'        => 'arrow-circle-left'),
            array('kngi-arrow-circle-right'       => 'arrow-circle-right'),
            array('kngi-arrow-circle-up'          => 'arrow-circle-up'),
            array('kngi-arrow-circle-up-large'    => 'arrow-circle-up-large'),
            array('kngi-arrow-circle-down-large'  => 'arrow-circle-down-large'),
            array('kngi-arrow-circle-left-large'  => 'arrow-circle-left-large'),
            array('kngi-arrow-circle-right-large' => 'arrow-circle-right-large'),
            array('kngi-arrow-down'               => 'arrow-down'),
            array('kngi-arrow-up'                 => 'arrow-up'),
            array('kngi-arrow-left'               => 'arrow-left'),
            array('kngi-arrow-right'              => 'arrow-right'),
            array('kngi-arrow-long-down'          => 'arrow-long-down'),
            array('kngi-arrow-long-left'          => 'arrow-long-left'),
            array('kngi-arrow-long-right'         => 'arrow-long-right'),
            array('kngi-arrow-long-up'            => 'arrow-long-up'),
            array('kngi-long-arrow-up'            => 'long-arrow-up'),
            array('kngi-long-arrow-down'          => 'long-arrow-down'),
            array('kngi-long-arrow-left'          => 'long-arrow-left'),
            array('kngi-arrow-prev'               => 'arrow-prev'),
            array('kngi-arrow-next'               => 'arrow-next'),
            array('kngi-check'                    => 'check'),
            array('kngi-long-arrow-right'         => 'long-arrow-right'),
            array('kngi-check-circle'             => 'check-circle'),
            array('kngi-check-alt-circle'         => 'check-alt-circle'),
            array('kngi-chevron-circle-down'      => 'chevron-circle-down'),
            array('kngi-chevron-circle-left'      => 'chevron-circle-left'),
            array('kngi-chevron-circle-right'     => 'chevron-circle-right'),
            array('kngi-chevron-circle-up'        => 'chevron-circle-up'),
            array('kngi-chevron-down'             => 'chevron-down'),
            array('kngi-chevron-left'             => 'chevron-left'),
            array('kngi-chevron-right'            => 'chevron-right'),
            array('kngi-chevron-up'               => 'chevron-up'),
            array('kngi-clock'                    => 'clock'),
            array('kngi-download'                 => 'download'),
            array('kngi-email'                    => 'email'),
            array('kngi-facebook-circle-alt'      => 'facebook-circle-alt'),
            array('kngi-facebook-f'               => 'facebook-f'),
            array('kngi-facebook-messenger'       => 'facebook-messenger'),
            array('kngi-facebook-square'          => 'facebook-square'),
            array('kngi-facebook'                 => 'facebook'),
            array('kngi-twitter-circle'           => 'twitter-circle'),
            array('kngi-twitter-square'           => 'twitter-square'),
            array('kngi-twitter'                  => 'twitter'),
            array('kngi-instagram-square'         => 'instagram-square'),
            array('kngi-instagram'                => 'instagram'),
            array('kngi-linkedin-circle'          => 'linkedin-circle'),
            array('kngi-linkedin-in'              => 'linkedin-in'),
            array('kngi-linkedin'                 => 'linkedin'),
            array('kngi-pinterest-p'              => 'pinterest-p'),
            array('kngi-pinterest-square'         => 'pinterest-square'),
            array('kngi-youtube'                  => 'youtube'),
            array('kngi-map-marker'               => 'map-marker'),
            array('kngi-pinterest'                => 'pinterest'),
            array('kngi-phone-alt'                => 'phone-alt'),
            array('kngi-phone'                    => 'phone'),
            array('kngi-play-circle'              => 'play-circle'),
            array('kngi-play'                     => 'play'),
            array('kngi-plus'                     => 'plus'),
            array('kngi-plus-circle'              => 'plus-circle'),
            array('kngi-minus'                    => 'minus'),
            array('kngi-minus-circle'             => 'minus-circle'),
            array('kngi-remove-circle'            => 'remove-circle'),
            array('kngi-remove'                   => 'remove'),
            array('kngi-search'                   => 'search'),
            array('kngi-shadow'                   => 'shadow'),
            array('kngi-shopping-bag'             => 'shopping-bag'),
            array('kngi-shopping-basket'          => 'shopping-basket'),
            array('kngi-shopping-cart-arrow-down' => 'shopping-cart-arrow-down'),
            array('kngi-shopping-cart-plus'       => 'shopping-cart-plus'),
            array('kngi-shopping-cart'            => 'shopping-cart'),
            array('kngi-sign-in-alt'              => 'sign-in-alt'),
            array('kngi-sign-out-alt'             => 'sign-out-alt'),
            array('kngi-star-alt'                 => 'star-alt'),
            array('kngi-star'                     => 'star'),
            array('kngi-pdf'                      => 'pdf'),
            array('kngi-thumbtack'                => 'thumbtack'),
            array('kngi-google-plus-g'            => 'google-plus-g'),
            array('kngi-google-plus-square'       => 'google-plus-square'),
            array('kngi-google-plus'              => 'google-plus'),
            array('kngi-google'                   => 'google'),
            array('kngi-rss-square'               => 'rss-square'),
            array('kngi-rss'                      => 'rss'),
            array('kngi-skype'                    => 'skype'),
            array('kngi-tumblr-square'            => 'tumblr-square'),
            array('kngi-tumblr'                   => 'tumblr'),
            array('kngi-vimeo-square'             => 'vimeo-square'),
            array('kngi-vimeo-v'                  => 'vimeo-v'),
            array('kngi-vimeo'                    => 'vimeo'),
            array('kngi-yelp'                     => 'yelp'),
            array('kngi-spinner'                  => 'spinner'),
            array('kngi-clock-o'                  => 'clock-o'),
            array('kngi-chevron-down1'            => 'chevron-down1'),
            array('kngi-search1'                  => 'search1'),
            array('kngi-calendar'                 => 'calendar'),
            array('kngi-angle-down'               => 'angle-down'),
            array('kngi-angle-up'                 => 'angle-up'),
            array('kngi-angle-left'               => 'angle-left'),
            array('kngi-angle-right'              => 'angle-right'),
            array('kngf-balance'                  => 'balance'),
            array('kngf-darts'                    => 'darts'),
            array('kngf-guarantee'                => 'guarantee'),
            array('kngf-payment'                  => 'payment'),
            array('kngf-support'                  => 'support'),
            array('kngf-user'                     => 'user'),
            array('kngf-right-quote'              => 'right-quote'),
            array('kngf-libra'                    => 'libra'),
            array('kngf-marijuana'                => 'marijuana'),
            array('kngf-bail'                     => 'bail'),
            array('kngf-traffic-lights'           => 'traffic-lights'),
            array('kngf-gavel'                    => 'gavel'),
            array('kngf-justice'                  => 'justice'),
            array('kngf-civil-right'              => 'civil-right'),
            array('kngf-contract'                 => 'contract'),
            array('kngf-stethoscope'              => 'stethoscope'),
            array('kngf-courthouse'               => 'courthouse'),
            array('kngf-building'                 => 'building'),
            array('kngf-recession'                => 'recession'),
            array('kngf-power-plug'               => 'power-plug'),
            array('kngf-house'                    => 'house'),
        ];
        return $icons;
    }
    function techrona_kngf($icons){
        unset($icons['New in 4.6']);
        unset($icons['Web Application Icons']);
        unset($icons['Medical Icons']);
        unset($icons['Text Editor Icons']);
        unset($icons['Spinner Icons']);
        unset($icons['File Type Icons']);
        unset($icons['Directional Icons']);
        unset($icons['Video Player Icons']);
        unset($icons['Form Control Icons']);
        unset($icons['Transportation Icons']);
        unset($icons['Chart Icons']);
        unset($icons['Brand Icons']);
        unset($icons['Hand Icons']);
        unset($icons['Payment Icons']);
        unset($icons['Currency Icons']);
        unset($icons['Accessibility Icons']);
        unset($icons['Gender Icons']);
        $icons['KNG techrona 2'] = [
            array('kngf-balance'        => 'balance'),
            array('kngf-darts'          => 'darts'),
            array('kngf-guarantee'      => 'guarantee'),
            array('kngf-payment'        => 'payment'),
            array('kngf-support'        => 'support'),
            array('kngf-user'           => 'user'),
            array('kngf-right-quote'    => 'right-quote'),
            array('kngf-libra'          => 'libra'),
            array('kngf-marijuana'      => 'marijuana'),
            array('kngf-bail'           => 'bail'),
            array('kngf-traffic-lights' => 'traffic-lights'),
            array('kngf-gavel'          => 'gavel'),
            array('kngf-justice'        => 'justice'),
            array('kngf-civil-right'    => 'civil-right'),
            array('kngf-contract'       => 'contract'),
            array('kngf-stethoscope'    => 'stethoscope'),
            array('kngf-courthouse'     => 'courthouse'),
            array('kngf-building'       => 'building'),
            array('kngf-recession'      => 'recession'),
            array('kngf-power-plug'     => 'power-plug'),
            array('kngf-house'          => 'house'),
        ];
        return $icons;
    }
    function techrona_kngfi($icons){
        unset($icons['New in 4.6']);
        unset($icons['Web Application Icons']);
        unset($icons['Medical Icons']);
        unset($icons['Text Editor Icons']);
        unset($icons['Spinner Icons']);
        unset($icons['File Type Icons']);
        unset($icons['Directional Icons']);
        unset($icons['Video Player Icons']);
        unset($icons['Form Control Icons']);
        unset($icons['Transportation Icons']);
        unset($icons['Chart Icons']);
        unset($icons['Brand Icons']);
        unset($icons['Hand Icons']);
        unset($icons['Payment Icons']);
        unset($icons['Currency Icons']);
        unset($icons['Accessibility Icons']);
        unset($icons['Gender Icons']);
        $icons['KNG techrona 3'] = [
            array('kngfi-two-hearts'         => 'two-hearts'),
            array('kngfi-heart-shaped-gift'  => 'heart-shaped-gift'),
            array('kngfi-reading-book'       => 'reading-book'),
            array('kngfi-video-camera'       => 'video-camera'),
            array('kngfi-stethoscope'        => 'stethoscope'),
            array('kngfi-tshirt'             => 'tshirt'),
            array('kngfi-project-management' => 'project-management'),
            array('kngfi-tshirt-1'           => 'tshirt-1'),
            array('kngfi-salad'              => 'salad'),
            array('kngfi-ecological'         => 'ecological'),
            array('kngfi-crowdfunding'       => 'crowdfunding'),
            array('kngfi-social-care'        => 'social-care'),
            array('kngfi-badges'             => 'badges'),
            array('kngfi-support'            => 'support'),
            array('kngfi-heart'              => 'heart'),
            array('kngfi-right-quote'        => 'right-quote'),
            array('kngfi-phone-call'         => 'phone-call'),
            array('kngfi-place'              => 'place'),
            array('kngfi-phone-call-1'       => 'phone-call-1'),
            array('kngfi-envelope'           => 'envelope'),
            array('kngfi-finance'            => 'finance'),
            array('kngfi-open-box'           => 'open-box'),
            array('kngfi-credit'             => 'credit'),
            array('kngfi-debit-card'         => 'debit-card'),
            array('kngfi-payment'            => 'payment'),
            array('kngfi-wallet-1'           => 'wallet-1'),
            array('kngfi-telephone'          => 'telephone'),
            array('kngfi-solidarity'         => 'solidarity'),
            array('kngfi-wallet'             => 'wallet'),
            array('kngfi-wallet-2'           => 'wallet-2'),
        ];
        return $icons;
    }
}