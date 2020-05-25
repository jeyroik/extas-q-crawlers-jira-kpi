<?php
namespace extas\components\quality\crawlers\jira\kpi\rates;

use extas\components\repositories\Repository;
use extas\interfaces\quality\crawlers\jira\kpi\rates\IJiraKPIRateRepository;

/**
 * Class JiraKPIRateRepository
 *
 * @package extas\components\quality\crawlers\jira\kpi\rates
 * @author jeyroik@gmail.com
 */
class JiraKPIRateRepository extends Repository implements IJiraKPIRateRepository
{
    protected string $scope = 'extas';
    protected string $pk = JiraKPIRate::FIELD__MONTH;
    protected string $name = 'jira_kpi_rates';
    protected string $itemClass = JiraKPIRate::class;
}
