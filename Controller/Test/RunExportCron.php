<?php

namespace Lc\Practice\Controller\Test;

use \Magento\Framework\App\Action\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

use Lc\Practice\Helper\DailyOrdersExportHelper;


class RunExportCron extends Action
{
    protected $resultPageFactory;
    protected $helper;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        DailyOrdersExportHelper $helper)
    {
        $this->resultPageFactory = $pageFactory;
        $this->helper = $helper;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->helper->exportCSV();

        $this->resultPage = $this->resultPageFactory->create();
        $this->resultPage->getConfig()->getTitle()->set(__('Exported CSV'));
        return $this->resultPage;
    }
}
