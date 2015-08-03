<?php
if (!defined('_PS_VERSION_'))
    exit;

class LinkSupplierPage extends Module
{
    public function __construct()
    {
        $this->name = 'linksupplierpage';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Enzo Hamelin';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.6'); 

        parent::__construct();

        $this->displayName = $this->l('Link to supplier page');
        $this->description = $this->l('Display a popup window on the supplier\'s (category) products page.');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall Link to supplier page ?');
    }

    public function install()
    {
        if (Shop::isFeatureActive())
            Shop::setContext(Shop::CONTEXT_ALL);

        if (!parent::install())
            return false;

        $sql =
            'ALTER TABLE '._DB_PREFIX_.'category ADD
			(
                                page_url VARCHAR(255) NULL,
				page_image_url VARCHAR(255) NULL
			)';
        if(!Db::getInstance()->Execute($sql))
            return false;
        
        return true;
    }

    public function uninstall()
    {
        if(!parent::uninstall())
            return false;
        
        $sql =
            'ALTER TABLE '._DB_PREFIX_.'category DROP page_url, 
                                                 DROP page_image_url';
        if(!Db::getInstance()->Execute($sql))
            return false;
        
        return true;
    }

    public function hookDisplayHeader($params)
    {
        $this->context->controller->addJs($this->_path.'linksupplierpage.js');
        $this->context->controller->addCSS($this->_path.'linksupplierpage.css');
    }

    public function hookDisplayFooter($params)
    {   
        if(!isset($_GET['id_category']))
            return;

        $category = new Category(intval($_GET['id_category']));
        
        if($category->id_parent == 2 || !isset($category->page_url) || !isset($category->page_image_url))
            return;
        
        $this->context->smarty->assign(array(
            'linksupplierpage_category' => $category->name[1],
            'linksupplierpage_url' => $category->page_url,
            'linksupplierpage_image_url' => $category->page_image_url
        ));
        return $this->display(__FILE__, 'linksupplierpage.tpl');
    }
}
?>