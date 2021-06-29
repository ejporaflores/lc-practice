<?php

namespace Lc\Practice\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;

class ProductStore extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'lc_practice_product_store';

    protected $_cacheTag = 'lc_practice_product_store';
    protected $_eventPrefix = 'lc_practice_product_store';

    protected function _construct() {
        $this->_init('Lc\Practice\Model\ResourceModel\ProductStore');
    }

    public function getIdentities() {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues() {
        $values = [];

        return $values;
    }
}
