<?php

class KngCtf7_Widget extends Kngtheme_Core_Widget_Base{
    protected $name = 'kng_ctf7';
    protected $title = 'KNG Contact Form 7';
    protected $icon = 'eicon-form-horizontal';
    protected $categories = array( 'kngtheme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_ctf7-1.jpg"},"2":{"label":"Layout 2","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_ctf7-2.jpg"},"3":{"label":"Layout 3","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_ctf7-3.jpg"},"4":{"label":"Layout 4","image":"http:\/\/localhost\/techrona\/wp-content\/themes\/techrona\/elements\/el-widgets\/layouts\/kng_ctf7-4.jpg"}},"prefix_class":"kng-cf7-layout-"}]},{"name":"source_section","label":"Source Settings","tab":"content","controls":[{"name":"bg_color","label":"Background Color","type":"color","selectors":{"{{WRAPPER}} .kng-cf7-inner":"background-color:{{VALUE}};"}},{"name":"form_title","label":"Form Title","type":"text","default":"Request An Estimate","label_block":true},{"name":"form_desc","label":"Form Description","type":"textarea","default":"For a cleaning that meets your highest standards, you need a dedicated team of trained specialists with all supplies needed to thoroughly clean your home.","label_block":true},{"name":"ctf7_id","label":"Select Form","type":"select","options":{"1108":"Email form footer 1","6":"Contact form 1"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}