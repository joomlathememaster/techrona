<?php

class KngBlockQuote_Widget extends Kngtheme_Core_Widget_Base{
    protected $name = 'kng_block_quote';
    protected $title = 'KNG Block Quote';
    protected $icon = 'eicon-blockquote';
    protected $categories = array( 'kngtheme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"text_align","label":"Content Alignment","label_block":false,"type":"choose","control_type":"responsive","options":{"start":{"title":"Start","icon":"eicon-text-align-left"},"center":{"title":"Center","icon":"eicon-text-align-center"},"end":{"title":"End","icon":"eicon-text-align-right"},"justify":{"title":"Justified","icon":"eicon-text-align-justify"}},"default":""},{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_block_quote-1.jpg"}},"prefix_class":"kng-blockquote-layout-"}]},{"name":"text_section","label":"Content &amp; Client Name","tab":"content","controls":[{"name":"bq_content","label":"Content","type":"textarea","default":"\u201cWhen you think \u2018I know\u2019 and \u2018it is,\u2019 you have the illusion of knowing, the illusion of certainty, and then you\u2019re mindless\u201d"},{"name":"bq_client_name","label":"Client Name","type":"text","label_block":true,"default":"Kristoffer Nolan"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}