<?php
namespace extas\components\plugins\quality\crawlers;

use extas\components\quality\crawlers\Crawler;
use extas\components\quality\crawlers\jira\kpi\rates\JiraKPIRate;
use extas\interfaces\quality\crawlers\ICrawler;
use extas\interfaces\quality\crawlers\jira\control\rates\IJiraControlRate;
use extas\interfaces\quality\crawlers\jira\issues\rates\IJiraIssuesRate;
use extas\interfaces\quality\crawlers\jira\kpi\rates\IJiraKPIRate;
use extas\interfaces\quality\crawlers\jira\kpi\rates\IJiraKPIRateRepository;
use extas\interfaces\quality\crawlers\jira\reactions\rates\IJiraReactionRate;
use extas\interfaces\quality\indexes\IIndex;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CrawlerJiraKPI
 *
 * @method indexRepository()
 * @method jiraControlRateRepository()
 * @method jiraIssuesRateRepository()
 * @method jiraReactionRateRepository()
 * @method jiraKPIRateRepository()
 *
 * @package extas\components\plugins\quality\crawlers
 * @author jeyroik@gmail.com
 */
class CrawlerJiraKPI extends Crawler
{
    protected string $title = '[Jira] KPI rates';
    protected string $description = 'Calculate jira kpi rates.';

    /**
     * @param OutputInterface $output
     * @return ICrawler
     */
    public function __invoke(OutputInterface &$output): ICrawler
    {
        /**
         * @var $kpiRepo IJiraKPIRateRepository
         * @var $qs IIndex[]
         * @var $control IJiraControlRate
         * @var $issuesRate IJiraIssuesRate
         * @var $reactionRate IJiraReactionRate
         * @var $kpi IJiraKPIRate
         */

        $month = (int) date('Ym');

        $qs = $this->indexRepository()->all([IIndex::FIELD__INDEX_MONTH => $month]);
        $control = $this->jiraControlRateRepository()->one([IJiraControlRate::FIELD__MONTH => $month]);
        $issuesRate = $this->jiraIssuesRateRepository()->one([IJiraIssuesRate::FIELD__MONTH => $month]);
        $reactionRate = $this->jiraReactionRateRepository()->one([IJiraReactionRate::FIELD__MONTH => $month]);

        $qRate = 0;

        foreach ($qs as $q) {
            $qRate += $q->getIndexValue();
        }

        $rate = $qRate +
            ($control ? $control->getRate() : 0) +
            ($issuesRate ? $issuesRate->getRate() : 0) +
            ($reactionRate ? $reactionRate->getRate() : 0);

        $output->writeln(['<info>Rate = ' . $rate . '</info>']);

        $kpiRepo = $this->jiraKPIRateRepository();
        $kpi = $kpiRepo->one([IJiraKPIRate::FIELD__MONTH => $month]);

        if (!$kpi) {
            $output->writeln(['<comment>Can not find kpi for the ' . $month . '</comment>']);
            $kpi = new JiraKPIRate();
            $kpi->setRate($rate)->setMonth($month)->setTimestamp(time());
            $kpiRepo->create($kpi);
            $output->writeln(['<info>Rates created</info>']);
        } else {
            $kpi->setRate($rate)->setTimestamp(time());
            $kpiRepo->update($kpi);
            $output->writeln(['<info>Rates updated</info>']);
        }

        return $this;
    }
}
