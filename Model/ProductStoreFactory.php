<?php

namespace Lc\Practice\Model;

use \Magento\Framework\ObjectManagerInterface;

class ProductStoreFactory
{
    protected $objectManager = null;

    public function __construct(ObjectManagerInterface $objectManager) {
        $this->objectManager = $objectManager;
    }

    public function create(array $data = []) {
        return $this->objectManager->create('Lc\Practice\Model\ProductStore', $data);
    }
}