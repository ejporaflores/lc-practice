<?php

namespace Lc\Practice\Block\Test;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Framework\App\ObjectManager;

use Lc\Practice\Helper\Data;


class ProductList extends Template
{
    protected $collectionFactory;
    protected $helper;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        Data $helper)
    {
        $this->collectionFactory = $collectionFactory;
        $this->helper = $helper;
        parent::__construct($context);
    }

    /*
        $this->printProducts($this->getProductsCollection());
        die();
*/

    public function getProductsCollection($criteria=NULL)
    {
        $searchAttribute = $this->helper->getConfig('search_attribute');
        if(isset($criteria['searchAttribute']) and ($criteria['searchAttribute'] != NULL)) {
            $searchAttribute = $criteria['searchAttribute'];
        }

        $searchCriteria = $this->helper->getConfig('search_criteria');
        if(isset($criteria['searchCriteria']) and ($criteria['searchCriteria'] != NULL)) {
            $searchCriteria = $criteria['searchCriteria'];
        }

        $orderField = $this->helper->getConfig('order_field');
        if(isset($criteria['orderField']) and ($criteria['orderField'] != NULL)) {
            $orderField = $criteria['orderField'];
        }

        $orderDirection = $this->helper->getConfig('order_direction');
        if(isset($criteria['orderDirection']) and ($criteria['orderDirection'] != NULL)) {
            $orderDirection = $criteria['orderDirection'];
        }

        $limit = $this->helper->getConfig('limit');
        if(isset($criteria['limit']) and ($criteria['limit'] != NULL)) {
            $limit = $criteria['limit'];
        }

        $products = $this->collectionFactory->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter($searchAttribute, ['like' => '%' . $searchCriteria . '%'])
            ->addAttributeToSort($orderField, $orderDirection)
            ->setPageSize($limit);

        return $products;
    }
/*
    public function printProducts()
    {
        $products = $this->getProductsCollection();
        foreach($products as $product) {
            var_dump('Nombre: ' . $product->getName() . ' | Id: ' . $product->getEntityId() . ' | Path: ' . $product->getImage());
            echo '<br /><br />';
        }
    }
*/
}