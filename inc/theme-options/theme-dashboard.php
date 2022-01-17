<?php
/* Dashboard Theme */
add_filter('kng_documentation_link',function(){
 	return 'http://doc.bravisthemes.com/techrona/index.html';
});

add_filter('kng_ticket_link', 'techrona_add_kng_ticket_link');
function techrona_add_kng_ticket_link($url)
{
    $url = array(
    	'type' => 'url', 
    	'link' => '#'
    );
    return $url;
}
add_filter('kng_video_tutorial_link',function(){
 	return '#';
});