<?php
$installer = $this;
$installer->getConnection()->addColumn($this->getTable('sales_flat_quote_item'), 'custom_attribute_column', 'varchar(255) NOT NULL');
$installer->getConnection()->addColumn($this->getTable('sales_flat_order_item'), 'custom_attribute_column', 'varchar(255) NOT NULL');
$installer->endSetup();
?>