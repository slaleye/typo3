<?php
namespace Slaleye\Memory\Controller;

use function GuzzleHttp\json_encode;

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
     * highscoreRepository
     *
     * @var \Slaleye\Memory\Domain\Repository\HighscoreRepository
     * @inject
     */
    protected $highscoreRepository = null;

    /**
     * action board  // as in Game => board
     *
     * @return void
     */
    public function boardAction()
    {
        // Step 1: Get all cards from the DB
        $cards = $this->cardsRepository->findAll()->toArray();

        // Do this twice to find a matching cards
        $duplicate_cards = $this->cardsRepository->findAll()->toArray();

        // merge duplicate and original cards
        $cards = array_merge($cards,$duplicate_cards);

        // Shuffle the cards to randomize card boards
        shuffle($cards);

        //Assign Shuffled cards to the view
        $this->view->assign('cards', $cards);
        // assign eid url to the view
        $this->view->assign('saveHighscoreUrl', $this->createEidUrl('GameEidController::SaveHighscore', 'tx_memory_game'));
    }

    /**
     * SAve highscore via Ajax
     * @param \Slaleye\Memory\Domain\Model\Highscore $highscore
     * @validate $highscore \Slaleye\Memory\Domain\Validator\HighscoreValidator
     * @throws
     */
    public function saveHighscoreFormAction(\Slaleye\Memory\Domain\Model\Highscore $highscore)
    {
        // Save Data to database
        $this->highscoreRepository->add($highscore);

        // User feedback
        $jsonResponse = [
          'state' => 'success'
        ];

        // Add to view
        $this->view->assign('json', json_encode($jsonResponse));
    }

    /**
     * Create the url string for jquery-slavleeCom.js
     * @param string $inEidName
     * @param string $inArgumentName
     * @return string
     */
    protected function createEidUrl($inEidName, $inArgumentName)
    {
        // request paramenter Eid and value eid
        $arguments = ['eID' => $inEidName];
        //user uriBuilder available from controllercontext
        $uriBuilder = $this->controllerContext->getUriBuilder();
        $uriBuilder->reset();
        // Set ID of current page
        $uriBuilder->setTargetPageUid($GLOBALS['TSFE']->id);
        $uriBuilder->setArguments($arguments);

        return $uriBuilder->build();
    }
}
