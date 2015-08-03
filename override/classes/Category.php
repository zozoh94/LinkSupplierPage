<?php

class Category extends CategoryCore
{
    /** @var string url of the category page */
    public $page_url;

    /** @var string url of the image category page */
    public $page_image_url;

    public function __construct($id_category = null, $id_lang = null, $id_shop = null) {
        self::$definition['fields']['page_url'] = array('type' => self::TYPE_STRING, 'validate' => 'isAbsoluteUrl', 'size' => 255);
        self::$definition['fields']['page_image_url'] = array('type' => self::TYPE_STRING, 'validate' => 'isAbsoluteUrl', 'size' => 255);
        parent::__construct($id_category, $id_lang, $id_shop);
    }
}