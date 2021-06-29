<?php

namespace Lc\Practice\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Framework\App\Helper\Context;
use \Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use \Magento\Framework\Stdlib\DateTime\DateTimeFormatterInterface;
use \Magento\Framework\Locale\Resolver;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    protected $timezoneInterface;
    protected $dateTimeFormatterInterface;
    protected $resolver;

    public function __construct(
        Context $context,
        TimezoneInterface $timezoneInterface,
        DateTimeFormatterInterface $dateTimeFormatterInterface,
        Resolver $resolver)
    {
        $this->timezoneInterface = $timezoneInterface;
        $this->dateTimeFormatterInterface = $dateTimeFormatterInterface;
        $this->resolver = $resolver;

        parent::__construct($context);
    }

    public function getFormattedTime()
    {
        $timezoneTime = $this->timezoneInterface->date();

        return $this->dateTimeFormatterInterface->formatObject(
            $timezoneTime,
            $timezoneTime->format('H:i'),
            $this->resolver->getLocale()
        );
    }

    public function getBrowserTitle()
    {
        return __('Now at %1, I am learning translations.', $this->getFormattedTime());
    }

    public function getConfig($field)
    {
        return $this->scopeConfig->getValue('practice/test/' . $field, ScopeInterface::SCOPE_STORE);
    }
}