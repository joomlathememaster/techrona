<?php

class KngSearchField_Widget extends Kngtheme_Core_Widget_Base{
    protected $name = 'kng_search_field';
    protected $title = 'Kng Search Field';
    protected $icon = 'eicon-search';
    protected $categories = array( 'kngtheme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_search-1.jpg"}}},{"name":"search_type","label":"Search Type","type":"select","options":{"1":"Default","2":"Product"},"default":"1"}]},{"name":"text_section","label":"Setting","tab":"content","controls":[{"name":"content_align","label":"Content Alignment","type":"choose","control_type":"responsive","options":{"start":{"title":"Start","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"end":{"title":"End","icon":"eicon-text-align-right"},"justify":{"title":"Justified","icon":"eicon-text-align-justify"}},"default":"start"},{"name":"placeholder","label":"Placeholder text","type":"text","label_block":true,"default":"Search for items..."},{"name":"search_text_width","label":"Search text width","type":"slider","control_type":"responsive","size_units":["px"],"default":{"unit":"px"},"range":{"px":{"min":200,"max":1200}},"selectors":{"{{WRAPPER}} .search-field":"width: {{SIZE}}{{UNIT}}"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}