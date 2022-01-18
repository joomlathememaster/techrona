<?php

class KngPostCarousel_Widget extends Kngtheme_Core_Widget_Base{
    protected $name = 'kng_post_carousel';
    protected $title = 'KNG Post Carousel';
    protected $icon = 'eicon-posts-carousel';
    protected $categories = array( 'kngtheme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"post_type","label":"Select Post Type","type":"select","multiple":true,"options":{"post":"Post","service":"Service","project":"Project"},"default":"post"},{"name":"layout_post","label":"Select Templates of Post","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_post_grid-1.jpg"},"2":{"label":"Layout 2","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_post_grid-2.jpg"}},"prefix_class":"kng-post-layout-","condition":{"post_type":["post"]}},{"name":"layout_service","label":"Select Templates of Service","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_post_grid-1.jpg"},"2":{"label":"Layout 2","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_post_grid-2.jpg"}},"prefix_class":"kng-post-layout-","condition":{"post_type":["service"]}},{"name":"layout_project","label":"Select Templates of Project","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_post_grid-1.jpg"},"2":{"label":"Layout 2","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_post_grid-2.jpg"}},"prefix_class":"kng-post-layout-","condition":{"post_type":["project"]}}]},{"name":"section_swiper_slider_settings","label":"Carousel Settings","tab":"settings","controls":[{"name":"slide_direction","label":"Slides Direction","description":"Defines how slides Direction, &#039;horizontal&#039; | &#039;vertical&#039;","type":"select","options":{"horizontal":"Horizontal","vertical":"Vertical"},"default":"horizontal","condition":{"slide_to_show":"1"}},{"name":"slide_mode","label":"Slide Effect","type":"select","options":{"slide":"Slide","fade":"Fade","cube":"Cube","flip":"Flip"},"default":"slide"},{"name":"slide_to_show","label":"Slides to Show","type":"select","control_type":"responsive","widescreen_default":"5","desktop_default":"5","laptop_default":"4","tablet_extra_default":"4","tablet_default":"3","mobile_extra_default":"2","mobile_default":"1","options":{"":"Default","1":1,"2":2,"3":3,"4":4,"5":5,"6":6,"7":7,"8":8,"9":9,"10":10},"condition":{"slide_mode":["slide"]}},{"name":"slide_to_scroll","label":"Slides to Scroll","type":"select","control_type":"responsive","default":"","options":{"":"Default","1":1,"2":2,"3":3,"4":4,"5":5,"6":6,"7":7,"8":8,"9":9,"10":10},"condition":{"slide_mode":["slide"],"slide_to_show!":"1"}},{"name":"slide_percolumn","label":"Slides Per Column","description":"Number of slides per column, for multirow layout","type":"select","options":{"1":"1","2":"2","3":"3","4":"4"},"default":"1","condition":{"slide_mode":"slide","slide_to_show!":"1","slide_to_scroll!":"1"}},{"name":"slide_percolumnfill","label":"Slides Per Column Fill","description":"Defines how slides should fill rows, by column or by row","type":"select","options":{"row":"Row","column":"Column"},"default":"column","condition":{"slide_mode":"slide","slide_to_show!":"1","slide_to_scroll!":"1","slide_percolumn!":"1"}},{"name":"gap","label":"Gap","description":"Distance between slides in px","type":"number","default":30},{"name":"gap_extra","label":"Extra Gap Bottom","description":"Add extra space at bottom of each items","type":"number","default":0},{"name":"arrows","label":"Show Arrows","type":"select","options":{"true":"Yes","false":"No"},"default":"true","control_type":"responsive","separator":"before","prefix_class":"kng-swiper-arrows%s-"},{"name":"arrow_prev","label":"Previous Icon","type":"icons","label_block":true,"separator":"before"},{"name":"arrow_next","label":"Next Icon","type":"icons","label_block":true,"separator":"before"},{"name":"arrows_pos","label":"Arrows Position","type":"select","default":"in-vertical","options":{"in-vertical":"Inside Vertical","out-vertical":"Outside Vertical","top-left":"Top Left","top-right":"Top Right","top-center":"Top Center","bottom-left":"Bottom Left","bottom-right":"Bottom Right","bottom-center":"Bottom Center","left-side":"Left Side","right-side":"Right Side"},"prefix_class":"kng-swiper-nav-"},{"name":"arrows_style","label":"Arrows Styles","type":"select","default":"default","options":{"default":"Default","round":"Round Border","round-in-dark":"Round In Dark","square-in-dark":"Square In Dark"},"prefix_class":"kng-swiper-nav-style-"},{"name":"pos_top","label":"Top Position","type":"slider","control_type":"responsive","size_units":["px","%"],"selectors":{"{{WRAPPER}} .kng-swiper-arrows":"top: {{SIZE}}{{UNIT}};"},"condition":{"arrows_pos":["top-left","top-right","top-center"]}},{"name":"pos_bot","label":"Bottom Position","type":"slider","control_type":"responsive","size_units":["px","%"],"selectors":{"{{WRAPPER}} .kng-swiper-arrows":"bottom: {{SIZE}}{{UNIT}};"},"condition":{"arrows_pos":["bottom-left","bottom-right","bottom-center"]}},{"name":"arrows_color","label":"Arrows Color","type":"select","default":"","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)"},"prefix_class":"kng-swiper-nav-color-"},{"name":"arrows_color_hover","label":"Arrows Color Hover","type":"select","default":"","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)"},"prefix_class":"kng-swiper-nav-color-hover-"},{"name":"arrow_link","label":"Additional arrow link?","type":"select","options":{"":"None","text_link":"Text Link","button":"Button"},"default":"","condition":{"arrows_pos":["left-side","right-side"]},"separator":"before","label_block":true},{"name":"arrow_hyperlinklink_type","label":"Link Type","type":"select","default":"custom","options":{"custom":"Custom","page":"Internal Page","post":"Post","service":"Service","project":"Project"},"condition":{"arrow_link":"text_link","arrows_pos":["left-side","right-side"]}},{"name":"arrow_hyperlinklink_page","label":"Page Link","type":"select","default":"","options":{"":"None","680":"Blog","10":"Cart","11":"Checkout","217":"Home 1","1198":"Home 2","221":"Home 3","223":"Home 4","12":"My account","1112":"Newsletter","1301":"Service 1","1393":"Service 2","9":"Shop","7":"Wishlist"},"condition":{"arrow_link":"text_link","arrows_pos":["left-side","right-side"],"arrow_hyperlinklink_type":"page"}},{"name":"arrow_hyperlinkhyper_link","label":"Custom Link","type":"url","placeholder":"https:\/\/your-link.com","default":{"url":"#","is_external":"on"},"condition":{"arrow_link":"text_link","arrows_pos":["left-side","right-side"],"arrow_hyperlinklink_type":"custom"}},{"name":"arrow_hyperlinklink_post","label":"Post Link","type":"select","options":{"816":"Consulted admitting is power acuteness.","815":"Unsatiable entreaties may collecting","813":"Discovery incommode earnestly no comment","678":"Discovery incommode earnestly no comment"},"condition":{"arrow_hyperlinklink_type":["post"]}},{"name":"arrow_hyperlinklink_service","label":"Service Link","type":"select","options":{"1276":"Cyber Security","1275":"Cloud Computing","1274":"Data Management","1273":"IT Consultancy","1272":"Creative Minds","1218":"Analytic Solutions"},"condition":{"arrow_hyperlinklink_type":["service"]}},{"name":"arrow_hyperlinklink_project","label":"Project Link","type":"select","options":[],"condition":{"arrow_hyperlinklink_type":["project"]}},{"name":"arrow_hyperlinklink_text","label":"Link Text","type":"text","condition":{"arrow_link":"text_link","arrows_pos":["left-side","right-side"]},"dynamic":{"active":true},"default":"Read More"},{"name":"arrow_hyperlinklink_color","label":"Color","type":"select","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)"},"condition":{"arrow_link":"text_link","arrows_pos":["left-side","right-side"]}},{"name":"arrow_hyperlinklink_hover_color","label":"Hover Color","type":"select","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)"},"condition":{"arrow_link":"text_link","arrows_pos":["left-side","right-side"]}},{"name":"arrow_hyperlinklink_align","label":"Alignment","type":"choose","control_type":"responsive","options":{"start":{"title":"Start","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"end":{"title":"End","icon":"eicon-text-align-right"},"justify":{"title":"Justified","icon":"eicon-text-align-justify"}},"condition":{"arrow_link":"text_link","arrows_pos":["left-side","right-side"]}},{"name":"arrow_hyperlinklink_icon","label":"Icon","type":"icons","label_block":true,"default":{"library":"kngi","value":"kngi-arrow-right"},"condition":{"arrow_link":"text_link","arrows_pos":["left-side","right-side"]}},{"name":"arrow_hyperlinklink_icon_align","label":"Icon Position","type":"select","default":"left","options":{"left":"Before","right":"After"},"condition":{"arrow_hyperlinklink_icon[value]!":"","arrow_link":"text_link","arrows_pos":["left-side","right-side"]}},{"name":"arrow_hyperlinklink_icon_size","label":"Icon Size","type":"slider","range":{"px":{"min":5,"max":200}},"condition":{"arrow_hyperlinklink_icon[value]!":"","arrow_link":"text_link","arrows_pos":["left-side","right-side"]},"selectors":{"{{WRAPPER}} .kng-link .kng-icon":"font-size: {{SIZE}}{{UNIT}};"}},{"name":"arrow_hyperlinklink_icon_indent","label":"Icon Spacing","type":"slider","range":{"px":{"min":5,"max":200}},"condition":{"arrow_hyperlinklink_icon[value]!":"","arrow_link":"text_link","arrows_pos":["left-side","right-side"]},"selectors":{"{{WRAPPER}} .kng-align-icon-right":"margin-left: {{SIZE}}{{UNIT}};","{{WRAPPER}} .kng-align-icon-left":"margin-right: {{SIZE}}{{UNIT}};"}},{"name":"arrow_btnlinkbtn_text","label":"Button Text","type":"text","default":"Read More","placeholder":"Your Text","condition":{"arrow_link":"button","arrows_pos":["left-side","right-side"]},"separator":""},{"name":"arrow_btnlinkshow_btn_text","label":"Show Button Text","type":"switcher","default":"true","condition":{"arrow_btnlinkbtn_text!":"","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbtn_link_type","label":"Link Type","type":"select","default":"custom","options":{"custom":"Custom","page":"Internal Page","post":"Post","service":"Service","project":"Project"},"condition":{"arrow_btnlinkbtn_text!":"","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinklink_page","label":"Page Link","type":"select","default":"","options":{"":"None","680":"Blog","10":"Cart","11":"Checkout","217":"Home 1","1198":"Home 2","221":"Home 3","223":"Home 4","12":"My account","1112":"Newsletter","1301":"Service 1","1393":"Service 2","9":"Shop","7":"Wishlist"},"condition":{"arrow_btnlinkbtn_text!":"","arrow_link":"button","arrows_pos":["left-side","right-side"],"arrow_btnlinkbtn_link_type":"page"}},{"name":"arrow_btnlinkbtn_link","label":"Custom Link","type":"url","placeholder":"https:\/\/your-link.com","default":{"url":"#"},"condition":{"arrow_btnlinkbtn_text!":"","arrow_link":"button","arrows_pos":["left-side","right-side"],"arrow_btnlinkbtn_link_type":"custom"}},{"name":"arrow_btnlinklink_post","label":"Post Link","type":"select","options":{"816":"Consulted admitting is power acuteness.","815":"Unsatiable entreaties may collecting","813":"Discovery incommode earnestly no comment","678":"Discovery incommode earnestly no comment"},"condition":{"arrow_btnlinkbtn_link_type":["post"],"arrow_btnlinkbtn_text!":"","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinklink_service","label":"Service Link","type":"select","options":{"1276":"Cyber Security","1275":"Cloud Computing","1274":"Data Management","1273":"IT Consultancy","1272":"Creative Minds","1218":"Analytic Solutions"},"condition":{"arrow_btnlinkbtn_link_type":["service"],"arrow_btnlinkbtn_text!":"","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinklink_project","label":"Project Link","type":"select","options":[],"condition":{"arrow_btnlinkbtn_link_type":["project"],"arrow_btnlinkbtn_text!":"","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbtn_type","label":"Mode","type":"select","default":"btn btn-fill","options":{"btn btn-fill":"Default","btn btn-primary":"Primary","btn btn-secondary":"Secondary","btn btn-black":"black","btn btn-outline":"Outline Default","btn btn-outline primary":"Outline primary","btn btn-outline secondary":"Outline secondary","btn btn-outline third":"Outline third","btn btn-outline white":"Outline white","btn btn-outline white opacity":"Outline white opacity","btn btn-outline black":"Outline black","btn-link":"Link","btn btn-custom":"Custom"},"condition":{"arrow_btnlinkbtn_text!":"","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbtn_bg_color","label":"Background Color","type":"select","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"condition":{"arrow_btnlinkbtn_type":"btn btn-custom","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbtn_bg_color_custom","label":"Custom Bg Color","type":"color","condition":{"arrow_btnlinkbtn_type":"btn btn-custom","arrow_btnlinkbtn_bg_color":"custom","arrow_link":"button","arrows_pos":["left-side","right-side"]},"selectors":{"{{WRAPPER}} .kng-btn-wraps.arrow_btnlink .btn":"background-color:{{VALUE}};"}},{"name":"arrow_btnlinkbtn_bg_color_hover","label":"Background Color Hover","type":"select","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"condition":{"arrow_btnlinkbtn_type":"btn btn-custom","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbtn_bg_color_custom_hover","label":"Custom Bg Hover Color","type":"color","condition":{"arrow_btnlinkbtn_type":"btn btn-custom","arrow_btnlinkbtn_bg_color_hover":"custom","arrow_link":"button","arrows_pos":["left-side","right-side"]},"selectors":{"{{WRAPPER}} .kng-btn-wraps.arrow_btnlink .btn:hover":"background-color:{{VALUE}} !important;"}},{"name":"arrow_btnlinkbtn_border_color","label":"Border Color","type":"select","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"condition":{"arrow_btnlinkbtn_type":"btn btn-custom","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbtn_border_color_custom","label":"Custom Border Color","type":"color","condition":{"arrow_btnlinkbtn_type":"btn btn-custom","arrow_btnlinkbtn_border_color":"custom","arrow_link":"button","arrows_pos":["left-side","right-side"]},"selectors":{"{{WRAPPER}} .kng-btn-wraps.arrow_btnlink .btn":"border-color:{{VALUE}};"}},{"name":"arrow_btnlinkbtn_border_color_hover","label":"Border Color Hover","type":"select","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"condition":{"arrow_btnlinkbtn_type":"btn btn-custom","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbtn_border_color_custom_hover","label":"Custom Border Hover Color","type":"color","condition":{"arrow_btnlinkbtn_type":"btn btn-custom","arrow_btnlinkbtn_border_color_hover":"custom","arrow_link":"button","arrows_pos":["left-side","right-side"]},"selectors":{"{{WRAPPER}} .kng-btn-wraps.arrow_btnlink .btn:hover":"border-color:{{VALUE}} !important;"}},{"name":"arrow_btnlinkbtn_color","label":"Color","type":"select","default":"accent","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"condition":{"arrow_btnlinkbtn_type":["btn-link","btn btn-custom"],"arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbtn_color_custom","label":"Custom Color","type":"color","condition":{"arrow_btnlinkbtn_type":["btn-link","btn btn-custom"],"arrow_btnlinkbtn_color":"custom","arrow_link":"button","arrows_pos":["left-side","right-side"]},"selectors":{"{{WRAPPER}} .kng-btn-wraps.arrow_btnlink a":"color:{{VALUE}};"}},{"name":"arrow_btnlinkbtn_hover_color","label":"Hover Color","type":"select","default":"secondary","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"condition":{"arrow_btnlinkbtn_type":["btn-link","btn btn-custom"],"arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbtn_hover_color_custom","label":"Custom Hover Color","type":"color","condition":{"arrow_btnlinkbtn_type":["btn-link","btn btn-custom"],"arrow_btnlinkbtn_hover_color":"custom","arrow_link":"button","arrows_pos":["left-side","right-side"]},"selectors":{"{{WRAPPER}} .kng-btn-wraps.arrow_btnlink a:hover":"color:{{VALUE}} !important;"}},{"name":"arrow_btnlinkbtn_radius","label":"Border Radius","type":"dimensions","size_units":["px","%"],"condition":{"arrow_btnlinkbtn_text!":"","arrow_btnlinkbtn_type!":["btn-link"],"arrow_link":"button","arrows_pos":["left-side","right-side"]},"selectors":{"{{WRAPPER}} .kng-btn-wraps.arrow_btnlink .btn":"border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"}},{"name":"arrow_btnlinkbtn_size","label":"Size","type":"select","default":"","options":{"xsmall":"Extra Small","small":"Small","":"Default","medium":"Medium","large":"Large","xlarge":"Extra Large"},"condition":{"arrow_btnlinkbtn_text!":"","arrow_btnlinkbtn_type!":["btn-link"],"arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbutton_padding","label":"Button Padding(px)","type":"dimensions","control_type":"responsive","size_units":["px"],"selectors":{"{{WRAPPER}} .kng-btn-wraps.arrow_btnlink .btn":"padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"},"condition":{"arrow_btnlinkbtn_text!":"","arrow_btnlinkbtn_type!":["btn-link"],"arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbutton_margin","label":"Button Margin(px)","type":"dimensions","control_type":"responsive","size_units":["px"],"selectors":{"{{WRAPPER}} .kng-btn-wraps.arrow_btnlink":"margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"},"condition":{"arrow_btnlinkbtn_text!":"","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkalign","label":"Button Alignment","type":"choose","control_type":"responsive","options":{"start":{"title":"Start","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"end":{"title":"End","icon":"eicon-text-align-right"},"justify":{"title":"Justified","icon":"eicon-text-align-justify"}},"default":"","condition":{"arrow_btnlinkbtn_text!":"","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbtn_icon","label":"Icon","type":"icons","label_block":true,"fa4compatibility":"icon","condition":{"arrow_btnlinkbtn_text!":"","arrow_link":"button","arrows_pos":["left-side","right-side"]},"default":{"value":"","library":"kngi"}},{"name":"arrow_btnlinkshow_btn_icon","label":"Show Button Icon","type":"switcher","default":"true","condition":{"arrow_btnlinkbtn_text!":"","arrow_btnlinkbtn_icon[value]!":"","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkicon_align","label":"Icon Position","type":"select","default":"right","options":{"left":"Before","right":"After"},"condition":{"arrow_btnlinkbtn_text!":"","arrow_btnlinkbtn_icon[value]!":"","arrow_btnlinkshow_btn_icon":"true","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbtn_icon_size","label":"Icon Size","type":"slider","range":{"px":{"min":0,"max":200}},"condition":{"arrow_btnlinkbtn_text!":"","arrow_btnlinkbtn_icon[value]!":"","arrow_btnlinkshow_btn_icon":"true","arrow_link":"button","arrows_pos":["left-side","right-side"]},"selectors":{"{{WRAPPER}} .arrow_btnlinkitem .kng-btn-icon":"font-size: {{SIZE}}{{UNIT}};"}},{"name":"arrow_btnlinkicon_indent","label":"Icon Spacing","type":"slider","control_type":"responsive","range":{"px":{"min":5,"max":200}},"condition":{"arrow_btnlinkbtn_text!":"","arrow_btnlinkbtn_icon[value]!":"","arrow_btnlinkshow_btn_icon":"true","arrow_link":"button","arrows_pos":["left-side","right-side"]},"selectors":{"{{WRAPPER}} .arrow_btnlinkitem .kng-btn-content-arrow_btnlink .kng-btn-icon.kng-align-icon-right":"margin-left: {{SIZE}}{{UNIT}};","{{WRAPPER}} .arrow_btnlinkitem .kng-btn-content-arrow_btnlink .kng-btn-icon.kng-align-icon-left":"margin-right: {{SIZE}}{{UNIT}};"}},{"name":"arrow_btnlinkbtn_css_class","label":"Custom CSS Class","type":"text","condition":{"arrow_btnlinkbtn_text!":"","arrow_link":"button","arrows_pos":["left-side","right-side"]}},{"name":"arrow_btnlinkbtn_animation","label":"Button Motion Effect","type":"animation","condition":{"arrow_btnlinkbtn_text!":""}},{"name":"arrow_btnlinkbtn_animation_duration","label":"Animation Duration","type":"select","default":"normal","options":{"slow":"Slow","normal":"Normal","fast":"Fast"},"condition":{"arrow_btnlinkbtn_animation!":""}},{"name":"arrow_btnlinkbtn_animation_delay","label":"Animation Delay","type":"number","min":0,"step":100,"default":300,"condition":{"arrow_btnlinkbtn_animation!":""}},{"name":"dots","label":"Show Dots","type":"select","control_type":"responsive","options":{"true":"Yes","false":"No"},"default":"true","separator":"before","prefix_class":"kng-swiper-dots%s-"},{"name":"dots_style","label":"Dots Style","type":"select","default":"bullets","options":{"bullets":"Bullets","progressbar":"Progressbar","fraction":"Fraction"}},{"name":"dots_style_notice","type":"raw_html","raw":"How to custom pagination, readmore at <a href=\"https:\/\/swiperjs.com\/swiper-api#pagination\" target=\"_blank\">swiper.js<\/a>","condition":{"dots_style":"custom"},"content_classes":"elementor-panel-alert elementor-panel-alert-warning"},{"name":"dots_style_custom","type":"textarea","label":"Enter your code here","condition":{"dots_style":"custom"},"description":"Default: function (swiper, current, total) { return current + \' of \' + total;}"},{"name":"dots_in_nav","label":"Dots In Nav","type":"switcher","default":"","separator":"before","condition":{"arrows":"true","arrows_pos":["top-left","top-right","top-center","bottom-left","bottom-right","bottom-center"]}},{"name":"dots_pos","label":"Dots Position","type":"select","default":"out","options":{"in":"Inside","out":"Outside","middle-left-in":"Middle Left Inside","middle-left-out":"Middle Left Outside","middle-right-in":"Middle Right Inside","middle-right-out":"Middle Right Outside"},"condition":{"dots_in_nav":""},"prefix_class":"kng-swiper-dots-"},{"name":"dots_color","label":"Dots Color","type":"select","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"default":"","prefix_class":"kng-swiper-dots-color-","condition":[]},{"name":"custom_dots_color","label":"Custom Dots Color","type":"color","condition":{"dots_color":"custom"},"selectors":{"{{WRAPPER}}.kng-swiper-dots .kng-swiper-pagination-bullet:before":"border-color: {{VALUE}};"}},{"name":"dots_color_hover","label":"Dots Color Hover","type":"select","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"default":"","prefix_class":"kng-swiper-dots-color-hover-","condition":[]},{"name":"custom_dots_color_hover","label":"Custom Dots Color Hover","type":"color","condition":{"dots_color_hover":"custom"},"selectors":{"{{WRAPPER}}.kng-swiper-dots-color-hover-custom .kng-swiper-dots .swiper-pagination-bullet-active:before, .kng-swiper-dots-color-hover-custom .kng-swiper-dots .kng-swiper-pagination-bullet:hover:before":"border-color: {{VALUE}};"}},{"name":"dots_align","label":"Dots Align","type":"choose","control_type":"responsive","options":{"start":{"title":"Start","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"end":{"title":"End","icon":"eicon-text-align-right"},"around":{"title":"Around","icon":"eicon-text-align-center"},"between":{"title":"Between","icon":"eicon-text-align-justify"}},"default":"","condition":[],"prefix_class":"kng-swiper-dots-align%s-"},{"name":"autoplay","label":"Autoplay","type":"select","options":{"true":"Yes","false":"No"},"default":"false","separator":"before"},{"name":"pause_on_hover","label":"Pause on Hover","type":"select","options":{"true":"Yes","false":"No"},"default":"true","condition":{"autoplay":"true"}},{"name":"pause_on_interaction","label":"Pause on Interaction","type":"select","options":{"true":"Yes","false":"No"},"default":"true","condition":{"autoplay":"true"}},{"name":"autoplay_speed","label":"Autoplay Speed","type":"number","default":5000,"condition":{"autoplay":"true"}},{"name":"loop","label":"Infinite Loop","type":"select","options":{"true":"Yes","false":"No"},"default":"false"},{"name":"speed","label":"Animation Speed","type":"number","default":300}],"condition":[]},{"name":"source_section","label":"Source Options","tab":"content","controls":[{"name":"source_post","label":"Select Term of Post","type":"select2","multiple":true,"options":{"technology|category":"Technology"},"condition":{"post_type":["post"]}},{"name":"source_service","label":"Select Term of Service","type":"select2","multiple":true,"options":[],"condition":{"post_type":["service"]}},{"name":"source_project","label":"Select Term of Project","type":"select2","multiple":true,"options":[],"condition":{"post_type":["project"]}},{"name":"orderby","label":"Order By","type":"select","default":"date","options":{"date":"Date","ID":"ID","author":"Author","title":"Title","rand":"Random"}},{"name":"order","label":"Sort Order","type":"select","default":"desc","options":{"desc":"Descending","asc":"Ascending"}},{"name":"limit","label":"Items to show","type":"number","default":"6"}]},{"name":"thumbnail_section","label":"Thumbnail Settings","tab":"content","controls":[{"name":"thumbnail_size","label":"Image Size","type":"select","default":"medium","options":{"thumbnail":"Thumbnail - 110 X 110","medium":"Medium - 770 X 370","medium_large":"Medium_large - 740 X 600","large":"Large - 1200 X 576","full":"Full","custom":"Custom"}},{"name":"thumbnail_size_custom","label":"Image Size Custom","type":"text","description":"Enter size in pixels (Default: 370x300 (Width x Height)).","condition":{"thumbnail_size":"custom"}}]},{"name":"excerpt_section","label":"Excerpt Options","tab":"content","controls":[{"name":"show_excerpt","label":"Show Excerpt","type":"switcher","return_value":"yes","default":""},{"name":"excerpt_lenght","label":"Excerpt lenght","type":"number","default":25,"condition":{"show_excerpt":"yes"}},{"name":"excerpt_more_text","label":"Excerpt more text","type":"text","default":"...","condition":{"show_excerpt":"yes"}}],"condition":{"post_type":["post","practice"]}},{"name":"readmore_section","label":"Read More Options","tab":"content","controls":[{"name":"show_readmore","label":"Show Read More","type":"switcher","return_value":"yes","default":"yes"},{"name":"readmore_text","label":"Read More Text","type":"text","default":"Read More","condition":{"show_readmore":"yes"},"separator":"after"}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'swiper','kng-swiper' );
}