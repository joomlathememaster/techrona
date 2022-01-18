<?php

class KngButton_Widget extends Kngtheme_Core_Widget_Base{
    protected $name = 'kng_button';
    protected $title = 'KNG Button';
    protected $icon = 'eicon-button';
    protected $categories = array( 'kngtheme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_button-1.jpg"}}}]},{"name":"source_section","label":"Source Settings","tab":"content","controls":[{"name":"btn_text","label":"Button Text","type":"text","default":"Click Here","placeholder":"Your Text","condition":[],"separator":""},{"name":"show_btn_text","label":"Show Button Text","type":"switcher","default":"true","condition":{"btn_text!":""}},{"name":"btn_link_type","label":"Link Type","type":"select","default":"custom","options":{"custom":"Custom","page":"Internal Page","post":"Post","service":"Service","project":"Project"},"condition":{"btn_text!":""}},{"name":"link_page","label":"Page Link","type":"select","default":"","options":{"":"None","680":"Blog","10":"Cart","11":"Checkout","217":"Home 1","1198":"Home 2","221":"Home 3","223":"Home 4","12":"My account","1112":"Newsletter","1301":"Service 1","1393":"Service 2","9":"Shop","7":"Wishlist"},"condition":{"btn_text!":"","btn_link_type":"page"}},{"name":"btn_link","label":"Custom Link","type":"url","placeholder":"https:\/\/your-link.com","default":{"url":"#"},"condition":{"btn_text!":"","btn_link_type":"custom"}},{"name":"link_post","label":"Post Link","type":"select","options":{"816":"Consulted admitting is power acuteness.","815":"Unsatiable entreaties may collecting","813":"Discovery incommode earnestly no comment","678":"Discovery incommode earnestly no comment"},"condition":{"btn_link_type":["post"],"btn_text!":""}},{"name":"link_service","label":"Service Link","type":"select","options":{"1276":"Cyber Security","1275":"Cloud Computing","1274":"Data Management","1273":"IT Consultancy","1272":"Creative Minds","1218":"Analytic Solutions"},"condition":{"btn_link_type":["service"],"btn_text!":""}},{"name":"link_project","label":"Project Link","type":"select","options":[],"condition":{"btn_link_type":["project"],"btn_text!":""}},{"name":"btn_type","label":"Mode","type":"select","default":"btn btn-fill","options":{"btn btn-fill":"Default","btn btn-primary":"Primary","btn btn-secondary":"Secondary","btn btn-black":"black","btn btn-outline":"Outline Default","btn btn-outline primary":"Outline primary","btn btn-outline secondary":"Outline secondary","btn btn-outline third":"Outline third","btn btn-outline white":"Outline white","btn btn-outline white opacity":"Outline white opacity","btn btn-outline black":"Outline black","btn-link":"Link","btn btn-custom":"Custom"},"condition":{"btn_text!":""}},{"name":"btn_bg_color","label":"Background Color","type":"select","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"condition":{"btn_type":"btn btn-custom"}},{"name":"btn_bg_color_custom","label":"Custom Bg Color","type":"color","condition":{"btn_type":"btn btn-custom","btn_bg_color":"custom"},"selectors":{"{{WRAPPER}} .kng-btn-wraps .btn":"background-color:{{VALUE}};"}},{"name":"btn_bg_color_hover","label":"Background Color Hover","type":"select","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"condition":{"btn_type":"btn btn-custom"}},{"name":"btn_bg_color_custom_hover","label":"Custom Bg Hover Color","type":"color","condition":{"btn_type":"btn btn-custom","btn_bg_color_hover":"custom"},"selectors":{"{{WRAPPER}} .kng-btn-wraps .btn:hover":"background-color:{{VALUE}} !important;"}},{"name":"btn_border_color","label":"Border Color","type":"select","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"condition":{"btn_type":"btn btn-custom"}},{"name":"btn_border_color_custom","label":"Custom Border Color","type":"color","condition":{"btn_type":"btn btn-custom","btn_border_color":"custom"},"selectors":{"{{WRAPPER}} .kng-btn-wraps .btn":"border-color:{{VALUE}};"}},{"name":"btn_border_color_hover","label":"Border Color Hover","type":"select","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"condition":{"btn_type":"btn btn-custom"}},{"name":"btn_border_color_custom_hover","label":"Custom Border Hover Color","type":"color","condition":{"btn_type":"btn btn-custom","btn_border_color_hover":"custom"},"selectors":{"{{WRAPPER}} .kng-btn-wraps .btn:hover":"border-color:{{VALUE}} !important;"}},{"name":"btn_color","label":"Color","type":"select","default":"accent","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"condition":{"btn_type":["btn-link","btn btn-custom"]}},{"name":"btn_color_custom","label":"Custom Color","type":"color","condition":{"btn_type":["btn-link","btn btn-custom"],"btn_color":"custom"},"selectors":{"{{WRAPPER}} .kng-btn-wraps a":"color:{{VALUE}};"}},{"name":"btn_hover_color","label":"Hover Color","type":"select","default":"secondary","options":{"":"Default","primary":"Primary (#00c3ff)","second":"Secondary (#162542)","rating":"Rating (#FFB237)","body":"Body (#555555)","heading":"Heading #222222","white":"White","footer_text":"Footer Text (#aab5cc)","custom":"Custom"},"condition":{"btn_type":["btn-link","btn btn-custom"]}},{"name":"btn_hover_color_custom","label":"Custom Hover Color","type":"color","condition":{"btn_type":["btn-link","btn btn-custom"],"btn_hover_color":"custom"},"selectors":{"{{WRAPPER}} .kng-btn-wraps a:hover":"color:{{VALUE}} !important;"}},{"name":"btn_radius","label":"Border Radius","type":"dimensions","size_units":["px","%"],"condition":{"btn_text!":"","btn_type!":["btn-link"]},"selectors":{"{{WRAPPER}} .kng-btn-wraps .btn":"border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"}},{"name":"btn_size","label":"Size","type":"select","default":"","options":{"xsmall":"Extra Small","small":"Small","":"Default","medium":"Medium","large":"Large","xlarge":"Extra Large"},"condition":{"btn_text!":"","btn_type!":["btn-link"]}},{"name":"button_padding","label":"Button Padding(px)","type":"dimensions","control_type":"responsive","size_units":["px"],"selectors":{"{{WRAPPER}} .kng-btn-wraps .btn":"padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"},"condition":{"btn_text!":"","btn_type!":["btn-link"]}},{"name":"button_margin","label":"Button Margin(px)","type":"dimensions","control_type":"responsive","size_units":["px"],"selectors":{"{{WRAPPER}} .kng-btn-wraps":"margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};"},"condition":{"btn_text!":""}},{"name":"align","label":"Button Alignment","type":"choose","control_type":"responsive","options":{"start":{"title":"Start","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"end":{"title":"End","icon":"eicon-text-align-right"},"justify":{"title":"Justified","icon":"eicon-text-align-justify"}},"default":"","condition":{"btn_text!":""}},{"name":"btn_icon","label":"Icon","type":"icons","label_block":true,"fa4compatibility":"icon","condition":{"btn_text!":""},"default":{"value":"","library":"kngi"}},{"name":"show_btn_icon","label":"Show Button Icon","type":"switcher","default":"true","condition":{"btn_text!":"","btn_icon[value]!":""}},{"name":"icon_align","label":"Icon Position","type":"select","default":"right","options":{"left":"Before","right":"After"},"condition":{"btn_text!":"","btn_icon[value]!":"","show_btn_icon":"true"}},{"name":"btn_icon_size","label":"Icon Size","type":"slider","range":{"px":{"min":0,"max":200}},"condition":{"btn_text!":"","btn_icon[value]!":"","show_btn_icon":"true"},"selectors":{"{{WRAPPER}} .item .kng-btn-icon":"font-size: {{SIZE}}{{UNIT}};"}},{"name":"icon_indent","label":"Icon Spacing","type":"slider","control_type":"responsive","range":{"px":{"min":5,"max":200}},"condition":{"btn_text!":"","btn_icon[value]!":"","show_btn_icon":"true"},"selectors":{"{{WRAPPER}} item .kng-btn-content- .kng-btn-icon.kng-align-icon-right":"margin-left: {{SIZE}}{{UNIT}};","{{WRAPPER}} item .kng-btn-content- .kng-btn-icon.kng-align-icon-left":"margin-right: {{SIZE}}{{UNIT}};"}},{"name":"btn_css_class","label":"Custom CSS Class","type":"text","condition":{"btn_text!":""}},{"name":"btn_animation","label":"Button Motion Effect","type":"animation","condition":{"btn_text!":""}},{"name":"btn_animation_duration","label":"Animation Duration","type":"select","default":"normal","options":{"slow":"Slow","normal":"Normal","fast":"Fast"},"condition":{"btn_animation!":""}},{"name":"btn_animation_delay","label":"Animation Delay","type":"number","min":0,"step":100,"default":300,"condition":{"btn_animation!":""}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'kng-animation' );
}