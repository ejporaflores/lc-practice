<?php

namespace Lc\Practice\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
/*
    protected $_idFieldName = 'product_id';
    protected $_eventPrefix = 'lc_practice_product_store_collection';
    protected $_eventObject = 'product_store_collection';
*/
    protected function _construct() {
        $this->_init(
            'Lc\Practice\Model\ProductStore',
            'Lc\Practice\Model\ResourceModel\ProductStore'
        );
    }
}
