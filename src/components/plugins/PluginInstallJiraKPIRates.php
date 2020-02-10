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
    protected $selfItemClass = JiraKPIRate::class;
    protected $selfName = 'jira kpi rate';
    protected $selfSection = 'jira_kpi_rates';
    protected $selfRepositoryClass = IJiraKPIRateRepository::class;
    protected $selfUID = JiraKPIRate::FIELD__MONTH;
}
