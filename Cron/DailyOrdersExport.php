<?php

namespace Lc\Practice\Cron;

use Lc\Practice\Helper\DailyOrdersExportHelper;

class DailyOrdersExport
{
    protected $dailyOrdersExportHelper;

    public function __construct(DailyOrdersExportHelper $dailyOrdersExportHelper) {
        $this->dailyOrdersExportHelper = $dailyOrdersExportHelper;
    }

    public function execute() {
        $this->dailyOrdersExportHelper->exportCSV();
    }
}
