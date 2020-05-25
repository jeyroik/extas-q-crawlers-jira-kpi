<?php
namespace extas\components\plugins;

use extas\components\quality\crawlers\jira\kpi\rates\JiraKPIRate;
use extas\interfaces\quality\crawlers\jira\kpi\rates\IJiraKPIRateRepository;

/**
 * Class PluginInstallJiraKPIRates
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallJiraKPIRates extends PluginInstallDefault
{
    protected string $selfItemClass = JiraKPIRate::class;
    protected string $selfName = 'jira kpi rate';
    protected string $selfSection = 'jira_kpi_rates';
    protected string $selfRepositoryClass = IJiraKPIRateRepository::class;
    protected string $selfUID = JiraKPIRate::FIELD__MONTH;
}
