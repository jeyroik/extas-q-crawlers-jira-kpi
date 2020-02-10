<?php
namespace extas\components\quality\crawlers\jira\kpi\rates;

use extas\components\Item;
use extas\components\quality\crawlers\jira\THasMonth;
use extas\components\quality\crawlers\jira\THasRate;
use extas\components\quality\crawlers\jira\THasTimestamp;
use extas\interfaces\quality\crawlers\jira\kpi\rates\IJiraKPIRate;

/**
 * Class JiraKPIRate
 *
 * @package extas\components\quality\crawlers\jira\kpi\rates
 * @author jeyroik@gmail.com
 */
class JiraKPIRate extends Item implements IJiraKPIRate
{
    use THasTimestamp;
    use THasMonth;
    use THasRate;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
