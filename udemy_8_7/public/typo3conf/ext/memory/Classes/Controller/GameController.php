<?php
namespace Slaleye\Memory\Controller;

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
 * GameController
 */
class GameController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * cardsRepository
     * 
     * @var \Slaleye\Memory\Domain\Repository\CardsRepository
     * @inject
     */
    protected $cardsRepository = null;

    /**
     * action board  // as in Game => board
     *
     * @return void
     */
    public function boardAction()
    {
        // Step 1: Get all cards from the DB
        $cards = $this->cardsRepository->findAll();

        // Do this twice to find a matching cards
        $duplicate_cards = $this->cardsRepository->findAll();

        // merge duplicate and original cards
        $cards = array_merge($cards,$duplicate_cards);

        // Shuffle the cards to randomize card boards
        shuffle($cards);

        //Assign Shuffled cards to the view
        $this->view->assign('cards', $cards);
    }
}
