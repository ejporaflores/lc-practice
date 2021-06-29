<?php

namespace Lc\Practice\Helper;

use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Psr\Log\LoggerInterface;

class DailyOrdersExportHelper
{
    protected $fileSystem;
    protected $orderCollectionFactory;
    protected $logger;

    public function __construct(
        Filesystem $fileSystem,
        CollectionFactory $collectionFactory,
        LoggerInterface $logger) {
        $this->fileSystem = $fileSystem;
        $this->orderCollectionFactory = $collectionFactory;
        $this->logger = $logger;
    }

    public function exportCSV() {
        $this->exportCSVfiles($this->getDailyOrderCollection());

        $this->logger->info('---------- Exported Files ----------');
    }

    public function exportCSVfiles($orderCollection)
    {
        $dir = $this->fileSystem->getDirectoryWrite(DirectoryList::APP);
        $dir->create('export');

        $file = 'export/' . date('Y-m-d') . '-daily-orders.csv';
        $csvFile = $dir->openFile($file, 'w+');
        $csvFile->lock();

        $header = [
            'entity_id',
            'state',
            'status',
            'customer_email',
            'customer_firstname',
            'customer_lastname',
            'subtotal',
            'total_paid',
            'created_at'
        ];
        $csvFile->writeCsv($header);

        foreach($orderCollection as $orderItem) {
            $item = [
                $orderItem->getData('entity_id'),
                $orderItem->getData('state'),
                $orderItem->getData('status'),
                $orderItem->getData('customer_email'),
                $orderItem->getData('customer_firstname'),
                $orderItem->getData('customer_lastname'),
                $orderItem->getData('subtotal'),
                $orderItem->getData('total_paid'),
                $orderItem->getData('created_at'),
            ];
            $csvFile->writeCsv($item);
        }

        $csvFile->unlock();
        $csvFile->close();
    }

    public function getDailyOrderCollection()
    {
        $now = new \DateTime();

        $orderCollection = $this->orderCollectionFactory->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('created_at', ['like' => $now->format('Y-m-d') . '%']);

        return $orderCollection->getItems();
    }
}
