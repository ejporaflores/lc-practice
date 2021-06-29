<?php

namespace Lc\Practice\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use \Magento\Framework\Model\ResourceModel\Db\Context;

class ProductStore extends AbstractDb
{
    protected $_isPkAutoIncrement = false;

    public function __construct(Context $context) {
        parent::__construct($context);
    }

    protected function _construct() {
        $this->_init('product_store', 'product_id');
    }
}
