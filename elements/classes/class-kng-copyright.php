<?php

class KngCopyright_Widget extends Kngtheme_Core_Widget_Base{
    protected $name = 'kng_copyright';
    protected $title = 'KNG copyright';
    protected $icon = 'eicon-text';
    protected $categories = array( 'kngtheme-core' );
    protected $params = '{"sections":[{"name":"section_style","label":"General","tab":"style","controls":[{"name":"copyright_alignment","label":"Text Alignment","type":"choose","control_type":"responsive","options":{"start":{"title":"Start","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"end":{"title":"End","icon":"eicon-text-align-right"}},"selectors":{"{{WRAPPER}} .kng-copyright":"text-align: {{VALUE}};"}},{"name":"copyright_typo","type":"typography","control_type":"group","selector":"{{WRAPPER}} .kng-copyright"},{"name":"copyright_color","type":"color","label":"Color","selectors":{"{{WRAPPER}} .kng-copyright":"color: {{VALUE}};"}},{"name":"copyright_link_color","type":"color","label":"Link Color","selectors":{"{{WRAPPER}} .kng-copyright a":"color: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}