<?php

class KngNewsletter_Widget extends Kngtheme_Core_Widget_Base{
    protected $name = 'kng_newsletter';
    protected $title = 'KNG Newsletter';
    protected $icon = 'eicon-mail';
    protected $categories = array( 'kngtheme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/newletter-1.jpg"}}}]},{"name":"content_section","label":"Content","tab":"content","controls":[{"name":"email_text","label":"Email Text","type":"text","placeholder":"Enter placeholder text","label_block":true}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}