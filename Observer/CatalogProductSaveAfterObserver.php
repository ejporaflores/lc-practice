<?php

namespace Lc\Practice\Observer;

use \Magento\Framework\Event\Observer;
use \Magento\Framework\Event\ObserverInterface;
use \Magento\Store\Model\StoreManagerInterface;

use \Psr\Log\LoggerInterface;

use Lc\Practice\Model\ProductStoreFactory;
use Lc\Practice\Model\ResourceModel\CollectionFactory;


class CatalogProductSaveAfterObserver implements ObserverInterface
{
    protected $storeManagerInterface;
    protected $logger;
    protected $productStoreFactory;
    protected $collectionFactory;

    public function __construct(
        StoreManagerInterface $storeManagerInterface,
        LoggerInterface $logger,
        ProductStoreFactory $productStoreFactory,
        CollectionFactory $collectionFactory
    ) {
        $this->storeManagerInterface = $storeManagerInterface;
        $this->logger = $logger;
        $this->productStoreFactory = $productStoreFactory;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute(Observer $observer)
    {
        $this->logger->debug('---------- Observer Catalog Product Save After Observer start ----------');
        $this->logger->debug('Event Name: ' . $observer->getName());

        $product = $observer->getData('product');
        //$product = $observer->getProduct();
        $productId = $product->getId();
        $storeId = $this->storeManagerInterface->getStore()->getId();

        $this->logger->debug('ProductId: ' . $productId);
        $this->logger->debug('StoreId: ' . $storeId);

        $lcPracticeProductStore = $this->productStoreFactory->create();
        $lcPracticeProductStore->setProductId($productId);
        $lcPracticeProductStore->setStoreId($storeId);
        $lcPracticeProductStore->save();

        $this->logger->debug('---------- Observer Catalog Product Save After Observer ends ----------');
    }
}
