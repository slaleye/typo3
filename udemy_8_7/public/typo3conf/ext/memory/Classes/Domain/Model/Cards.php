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
 * Cards
 */
class Cards extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * card
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @validate NotEmpty
     * @cascade remove
     */
    protected $card = null;

    /**
     * Returns the card
     * 
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * Sets the card
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $card
     * @return void
     */
    public function setCard(\TYPO3\CMS\Extbase\Domain\Model\FileReference $card)
    {
        $this->card = $card;
    }
}
