<?php
$installer = $this;
$installer->startSetup();
$attribute_video1_url  = array(
    'type' => 'text',
    'label'=> 'Url video 1',
    'input' => 'text',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => false,
    'user_defined' => true,
    'default' => "",
    'group' => "General Information"
);

$attribute_video2_url  = array(
    'type' => 'text',
    'label'=> 'Url video 2',
    'input' => 'text',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => false,
    'user_defined' => true,
    'default' => "",
    'group' => "General Information"
);

$installer->addAttribute('catalog_category', 'video1_url', $attribute_video1_url);
$installer->addAttribute('catalog_category', 'video2_url', $attribute_video2_url);
$installer->endSetup();
?>