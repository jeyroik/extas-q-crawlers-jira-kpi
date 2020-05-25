<?php
namespace extas\interfaces\quality\crawlers\jira\kpi\rates;

use extas\interfaces\IItem;
use extas\interfaces\quality\crawlers\jira\IHasMonth;
use extas\interfaces\quality\crawlers\jira\IHasRate;
use extas\interfaces\quality\crawlers\jira\IHasTimestamp;

/**
 * Interface IJiraKPIRate
 *
 * @package extas\interfaces\quality\crawlers\jira\kpi\rates
 * @author jeyroik@gmail.com
 */
interface IJiraKPIRate extends IItem, IHasRate, IHasTimestamp, IHasMonth
{
    public const SUBJECT = 'extas.quality.crawler.jira.kpi';
}
