<?php

class KngSearch_Widget extends Kngtheme_Core_Widget_Base{
    protected $name = 'kng_search';
    protected $title = 'Kng Search';
    protected $icon = 'eicon-search';
    protected $categories = array( 'kngtheme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_search-1.jpg"},"2":{"label":"Layout 2","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_search-2.jpg"},"3":{"label":"Layout 3","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_search-3.jpg"}},"prefix_class":"kng-search-layout-"},{"name":"search_type","label":"Search Type","type":"select","options":{"1":"Default","2":"Product"},"default":"1","condition":{"layout":"3"}}]},{"name":"text_section","label":"Setting","tab":"content","controls":[{"name":"content_align","label":"Content Alignment","type":"choose","control_type":"responsive","options":{"start":{"title":"Start","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"end":{"title":"End","icon":"eicon-text-align-right"},"justify":{"title":"Justified","icon":"eicon-text-align-justify"}},"default":"start"},{"name":"placeholder","label":"Placeholder text","type":"text","label_block":true,"default":"Search for items..."},{"name":"search_text_width","label":"Search text width","type":"slider","control_type":"responsive","size_units":["px","%"],"default":{"unit":"%"},"range":{"px":{"min":100,"max":1200},"%":{"min":5,"max":100}},"selectors":{"{{WRAPPER}} .search-field":"width: {{SIZE}}{{UNIT}}"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}