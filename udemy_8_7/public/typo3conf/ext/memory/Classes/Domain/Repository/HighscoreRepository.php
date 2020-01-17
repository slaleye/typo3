<?php
namespace Slaleye\Memory\Domain\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
/***
 *
 * This file is part of the "Memory" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Slaleye, Slaleye
 *
 ***/

/**
 * The repository for Highscores
 */
class HighscoreRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * Return the latest highscore
     * @return QueryResultInterface
     */
    public function findLatestHighscore()
    {
        $query = $this->createQuery();
        $query->setOrderings(['uid' => QueryInterface::ORDER_DESCENDING]);
        $query->setLimit(1);
        return $query->execute();
    }
}
