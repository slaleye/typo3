<?php
namespace Slaleye\Memory\Domain\Model;

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
 * Highscore
 */
class Highscore extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * username
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $username = '';

    /**
     * score
     * 
     * @var int
     * @validate NotEmpty
     */
    protected $score = 0;

    /**
     * Returns the username
     * 
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the username
     * 
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Returns the score
     * 
     * @return int $score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Sets the score
     * 
     * @param int $score
     * @return void
     */
    public function setScore($score)
    {
        $this->score = $score;
    }
}
